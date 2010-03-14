<?php

class repository {

  private $db;
  
  public function __construct($repo=0){
    $this->id=0;
    $this->db=new mysql();
    if($repo)$this->select($repo);
  }
  public function add($repo){
    global $repodir;
    foreach($repo as $key => $value) $this->$key = $value;
    if(file_exists("$repodir/{$this->name}/{$this->hashfile}")){
      $hashfile=new internet("file://$repodir/{$this->name}/{$this->hashfile}");
    }else{
      $hashfile=new internet($this->url.$this->hashfile);
    }
    $this->hash=$hashfile->download();
    if(!$this->hash)return false;
    $this->hash=$hashfile->contents;
    $repo['hash']=$this->hash;
    if(!$this->db->insert('repository',$repo))return false;
    return $repo['id'];
  }
  public function update(){
    global $repodir;
    if(file_exists("$repodir/{$this->name}/{$this->hashfile}")){
      $hashfile=new internet("file://$repodir/{$this->name}/{$this->hashfile}");
    }else{
      $hashfile=new internet($this->url.$this->hashfile);
    }
    $this->hash=$hashfile->download();
    if(!$this->hash)return false;
    $this->hash=$hashfile->contents;
    if(!$this->db->query("update #__repository set hash='".$this->hash."' where id=".$this->id))return false;
    return true;
  }

  public function popolate($more=array()){
    global $repodir;
    $allpackage=array();
    $pack=new package();
    if(file_exists("$repodir/{$this->name}/{$this->packages}")){
      $this->pkgsfile=new internet("file://$repodir/{$this->name}/{$this->packages}");
    }else{
      $this->pkgsfile=new internet($this->url.$this->packages);
    }
    $i=0;
    while(!is_null($pkg=$pack->fetch($this->pkgsfile))){
      if($pkg){
	$id=$pack->add($pkg,array('repository'=>$this->id),$more);
	if(!$id){ return false; }
//	echo $id." -> ".$pack->filename."               \n";
	echo ".";
	$allpackage[$pack->filename]=$id;
	$i++;
      }
    }
    $this->pkgsfile->close();
    echo "\n$i packages\n";
    $list=new filelist();
    if($this->manifest){
      $this->manifile=new internet($this->url.$this->manifest);
      if(!$list->addall($allpackage,$this))return false;
    }
    return true;
  }
  public function needupdate(){
    global $repodir;
    if(file_exists("$repodir/{$this->name}/{$this->hashfile}")){
      $hashfile=new internet("file://$repodir/{$this->name}/{$this->hashfile}");
    }else{
      $hashfile=new internet($this->url.$this->hashfile);
    }
    $hashfile->download();
    return ($hashfile->contents != $this->hash);
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
	official INT ,
	manifest VARCHAR( 30 ) NOT NULL ,
	packages VARCHAR( 30 ) NOT NULL ,
	hashfile VARCHAR( 30 ) NOT NULL ,
	hash TEXT ,
	name VARCHAR( 40 ) NOT NULL ,
	description VARCHAR( 255 ) ,
	PRIMARY KEY ( id ) ,
	UNIQUE ( name )
      ) ENGINE = INNODB ;
    ";
  }


}


?>
