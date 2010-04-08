<?php

class repository {

  public $db;
  public $pkgsfile=null;
  
  public function __construct($repo=0){
    $this->id=0;
    $this->db=new mysql();
    if($repo)$this->select($repo);
  }
  public function add($repo){
    foreach($repo as $key => $value) $this->$key = $value;
    if(!$this->pkgsfile)$this->pkgsfile=new internet($this->url.$this->packages);
    if(!$this->pkgsfile->exists())return false;
    $this->mtime=$this->pkgsfile->head['Last-Modified'];
    $repo['mtime']=$this->mtime;
    if(!$this->db->insert('repository',$repo))return false;
    return $repo['id'];
  }
  public function update(){	# DA SISTEMARE
    $this->pkgfile=new internet($this->url.$this->packages);
    $this->hash=$hashfile->download();
    if(!$this->pkgsfile->exists())return false;
    $this->mtime=$this->pkgsfile->head['Last-Modified'];
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
    $out=$this->db->update("#__repository",$repo,array("id" => "{$repo['id']}"));
    return ! ! $out;
  }

  public function popolate($more=array()){
    $allpackage=array();
    $pack=new package();
    if(!$this->pkgsfile)$this->pkgsfile=new internet($this->url.$this->packages);
    if(!$this->pkgsfile->exists())return false;
    $i=0;
    while(!is_null($pkg=$pack->fetch($this->pkgsfile))){
      if($pkg){
	$id=$pack->add($pkg,array('repository'=>$this->id),$more);
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
    $list=new filelist();
    if($this->manifest){
      $this->manifile=new internet($this->url.$this->manifest);
      if(!$i=$list->addall($allpackage,$this))return false;
      if(!$this->db->query("update #__repository set nfiles='$i' where id='{$this->id}'"))var_dump($this->db);
    }
    return true;
  }
  public function needupdate(){
    if(!$this->pkgsfile)$this->pkgsfile=new internet($this->url.$this->packages);
    if(!$this->pkgsfile->exists())return false;
    $mtime=$this->pkgsfile->head['Last-Modified'];
    return $mtime != $this->mtime;
  }


  public function drop(){
    return $this->db->query("delete from #__repository where id=".$this->id);
  }
  public function truncate(){
    return $this->db->query("delete from #__packages where repository=".$this->id);
  }

  public function download(){
  //  global $repodir;
  //  $path=$repodir.$this->path;
  //  if(!file_exists($path))if(!mkdir($path))return false;
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
	manifest VARCHAR( 30 ) ,
	packages VARCHAR( 30 ) ,
	version VARCHAR( 10 ) ,
	arch VARCHAR( 10 ) ,
	class VARCHAR( 10 ) ,
	mtime VARCHAR( 40 ),
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
