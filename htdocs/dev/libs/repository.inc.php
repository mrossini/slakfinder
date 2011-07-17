<?php

class repository {

  public $db;
  public $pkgsfile=null;
  public $treefile=null;
  public $manifile=null;
  
  public function __construct($repo=0){
    $this->id=0;
    $this->db=new mysql();
    if($repo)$this->select($repo);
  }
  public function add($repo){
    foreach($repo as $key => $value) $this->$key = $value;
    $this->openurl('packages');
    if(!$this->pkgsfile->exists())return false;
    $this->mtime=strtotime($this->pkgsfile->head['Last-Modified']);
    $repo['mtime']=$this->mtime;
    if(!$this->db->insert('repository',$repo))return false;
    return $repo['id'];
  }
  public function update(){	# DA SISTEMARE
    $this->openurl('packages');
    $this->hash=$hashfile->download();
    if(!$this->pkgsfile->exists())return false;
    $this->mtime=strtotime($this->pkgsfile->head['Last-Modified']);
    $repo['mtime']=$this->mtime;
    if(!$this->db->query("update #__repository set mtime='".$this->mtime."' where id=".$this->id))return false;
    return true;
  }
  public function redefine($repo,$nf=''){
    $this->db->query("select count(*) as npkgs from #__packages where repository='{$repo['id']}'");
    $this->db->fetch();
    $repo['npkgs']=$this->db->datas[0]['npkgs'];
    if($nf){
      $this->db->query("select count(*) as nfiles from #__filelist where repository='{$repo['id']}'");
      $this->db->fetch();
      $repo['nfiles']=$this->db->datas[0]['nfiles'];
    }
    $top=$repo['rank'];
    $p1=$top* (pow($repo['npkgs'],1/4)/pow(2356,1/4)) *30/100;
    $p2=0; $p3=0; $p4=0;
    if ( isset($repo['deps']) )if($repo['deps']==1)$p2=$top*2/100;
    if ( $nf )$p3=$top*4/100;
    switch ($repo['version']){
      case '13.1': $p4=$top*15/100;break;
      case 'current': $p4=$top*12/100;break;
      case '13.0': $p4=$top*10/100;break;
      case 'mixed': $p4=$top*7/100;break;
      case '12.2': $p4=$top*4/100;break;
      case '12.1': $p4=$top*0/100;break;
    }
    $repo['rank']=round($top-($p1+$p2+$p3+$p4));
    $out=$this->db->update("#__repository",$repo,array("id" => "{$repo['id']}"));
    return ! ! $out;
  }
  public function openurl($type){
    switch($type){
      case 'packages': $where='pkgsfile'; $what='packages'; break;
      case 'manifest': $where='manifile'; $what='manifest'; break;
      case 'filelist': $where='treefile'; $what='filelist'; break;
    }
    if(!$this->$where){
      if(stripos($this->$what,'tp://')===FALSE){
	$this->$where=new internet($this->url.$this->$what);
      }else{
	$this->$where=new internet($this->$what);
      }
    }
  }

  public function popolate($more=array()){
    $allpackage=array();

    $pkgdate=array();
    if($this->filelist){
      $f=0;
      if(strpos($this->filelist,'rsync://')!==FALSE){
	$this->treefile=popen('rsync -a '.$this->filelist.'|sed -r \'s#^(.[rwx-]+)[^rwx-] *([0-9]+) ([0-9]+)/([0-9]+)/([0-9]+) ([0-9]+):([0-9]+):[0-9]+ (.*)$#\1 1 root root \2 \3-\4-\5 \6:\7 ./\8#\'','r');
	while(!feof($this->treefile)){
	  $trfl=trim(fgets($this->treefile),"\n");
	  $tmp=preg_split("|^.* ([0-9]+-[0-9]+-[0-9]+ [0-9]+:[0-9]+) .*/([^/]*t.z)$|",$trfl,0,PREG_SPLIT_DELIM_CAPTURE);
	  $f++;
	  if(isset($tmp[2])) {
	    if(preg_match('/\.t.z$/',$tmp[2])){
	      $pkgdate[$tmp[2]]=strtotime($tmp[1]);
	      echo ".";
	    }
	  }
	}
      }elseif(strpos($this->filelist,'http://')!==FALSE){
	$this->treefile=popen('for a in $(lftp -e "find;exit"  '.$this->filelist.' |grep /$);do lftp -e "ls \'$a\';exit" '.$this->filelist.'|grep -v ^d|sed -r "s#(:[0-9][0-9])  ([^ ])#\1 $a\2#";done|sed -r \'s#^(.[rwx-]+)[^rwx-][^0-9]*([0-9KM.]+) +([0-9]+-[0-9]+-[0-9]+ [0-9]+:[0-9]+) (.*)$#\1 1 root root \2 \3 \4#\'','r');
	while(!feof($this->treefile)){
	  $trfl=trim(fgets($this->treefile),"\n");
	  $tmp=preg_split("|^.* ([0-9]+-[0-9]+-[0-9]+ [0-9]+:[0-9]+) .*/([^/]*t.z)$|",$trfl,0,PREG_SPLIT_DELIM_CAPTURE);
	  //if(isset($tmp[2])) $pkgdate[$tmp[2]]=strtotime($tmp[1]);
	  $f++;
	  if(isset($tmp[2])) {
	    if(preg_match('/\.t.z$/',$tmp[2])){
	      $pkgdate[$tmp[2]]=strtotime($tmp[1]);
	      echo ".";
	    }
	  }
	}
      }else{
	$this->openurl('filelist');
	while(!$this->treefile->eof()){
	  $trfl=$this->treefile->get();
	  $tmp=preg_split("|^.* ([0-9]+-[0-9]+-[0-9]+ [0-9]+:[0-9]+) .*/([^/]*t.z)$|",$trfl,0,PREG_SPLIT_DELIM_CAPTURE);
	  //if(isset($tmp[2])) $pkgdate[$tmp[2]]=strtotime($tmp[1]); 
	  $f++;
	  if(isset($tmp[2])) {
	    if(preg_match('/\.t.z$/',$tmp[2])){
	      $pkgdate[$tmp[2]]=strtotime($tmp[1]);
	      echo ".";
	    }
	  }
	}
      }
      echo "\n$f files in repository\n";
    }





    $pack=new package();
    $this->openurl('packages');
    if(!$this->pkgsfile->exists())return false;
    $i=0;
    while(!is_null($pkg=$pack->fetch($this->pkgsfile))){
      if($pkg){
	$ptime=array('ptime'=>0);
	if(isset($pkgdate[$pkg['filename']])){
	  $ptime=array('ptime'=>$pkgdate[$pkg['filename']]);
	}
	$id=$pack->add($pkg,$this,$ptime);
	if(!$id){ return false; }
	if(isset($_SERVER['DEBUG']))echo $id." -> ".$pack->filename."               \n";
	echo ".";
	$allpackage[$pack->filename]=$id;
	$i++;
      }
    }
    $this->pkgsfile->close();
    if(!$this->db->query("update #__repository set npkgs='$i' where id='{$this->id}'"))var_dump($this->db);
    echo "\n$i packages\n";



    
    if(!isset($_SERVER['NOFILES'])){
      $list=new filelist();
      if($this->manifest){
	$this->openurl('manifest');
	if(!$i=$list->addall($allpackage,$this)){
	  return false;
	}else{
	  echo "\n$i files in packages\n";
	}
	if(!$this->db->query("update #__repository set nfiles='$i' where id='{$this->id}'"))var_dump($this->db);
      }
    }
    

    return true;
  }
  public function needupdate(){
    $this->openurl('packages');
    if(!$this->pkgsfile->exists())return false;
    $mtime=strtotime($this->pkgsfile->head['Last-Modified']);
    return $mtime != $this->mtime;
  }


  public function drop(){
    return $this->db->query("delete from #__repository where id=".$this->id);
  }
  public function truncate(){
    return $this->db->query("delete from #__packages where repository=".$this->id);
  }

  public function select($repo){
    $this->id=0;
    if(!$this->db->query("select * from #__repository where id='$repo' or name='$repo'")) return false;
    if(!$repo=$this->db->get())return false;
    foreach($repo as $key => $value) $this->$key = $value;
  }
  public function find($repo=null){
    $sql="select * from #__repository ";
    if($repo)$sql.="where id='$repo' or name='$repo'";
    $this->db->query("$sql order by name");
    return $this->db->nrows;
  }
  public function fetch(){
    $this->id=0;
    if(!$out=$this->db->get())return false;
    foreach($out as $key => $value) $this->$key = $value;
    return $this->id;
  }
  public function exists(){
    return $this->id != 0;
  }


  static public function sql(){
    return "
      CREATE TABLE #__repository (
	id INT ,
	url VARCHAR( 255 ) NOT NULL ,
	rank INT DEFAULT '99',
	manifest VARCHAR( 255 ) ,
	packages VARCHAR( 255 ) ,
	filelist VARCHAR( 255 ) ,
	version VARCHAR( 10 ) ,
	arch VARCHAR( 10 ) ,
	class VARCHAR( 10 ) ,
	mtime INT( 11 ),
	name VARCHAR( 40 ) ,
	npkgs INT DEFAULT '0',
	nfiles INT DEFAULT '0' ,
	deps INT DEFAULT '0' ,
	description VARCHAR( 255 ) ,
	brief VARCHAR( 50 ) ,
	PRIMARY KEY ( id ) ,
	UNIQUE ( name )
      ) ENGINE = INNODB ;
    ";
  }


}


?>
