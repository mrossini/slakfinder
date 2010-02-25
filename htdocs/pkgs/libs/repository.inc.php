<?php

class repository {

  private $db;
  
  public function __construct($repo=0){
    $this->id=0;
    $this->db=new mysql();
    if($repo)$this->select($repo);
  }
  public function add($repo){
    foreach($repo as $key => $value) $this->$key = $value;
    $hashfile=new internet($this->url.$this->hashfile);
    $this->hash=$hashfile->download();
    if(!$this->hash)return false;
    $this->hash=$hashfile->contents;
    $repo['hash']=$this->hash;
    if(!$this->db->insert('repository',$repo))return false;
    $this->id=$this->db->newid;
    return $this->id;
  }
  public function update(){
    $hashfile=new internet($this->url.$this->hashfile);
    $this->hash=$hashfile->download();
    if(!$this->hash)return false;
    $this->hash=$hashfile->contents;
    if(!$this->db->query("update #__repository set hash='".$this->hash."' where id=".$this->id))return false;
    return true;
  }

  public function popolate($more=array()){
    $allpackage=array();
    $pack=new package();
    $packages=new internet($this->url.$this->packages);
    $pkg="";
    $i=0;
    while(!is_null($pkln=$packages->get())){
      if($pkln===false)die('errore su packages');
      if($pkln!=""){
	$pkg.=$pkln."\n";
      }else{
	$pkg=$pack->parse($pkg);
	if($pkg){
	  $id=$pack->add($pkg,array('repository'=>$this->id),$more);
	  if(!$id){ return false; }
	  echo $id." -> ".$pack->filename."\n";
	  $allpackage[$pack->filename]=$id;
	}
	$pkg="";
      }
    }
    $list=new filelist();
    if(!$list->add($allpackage,$this))return false;
    return true;
  }
  public function needupdate(){
    $hashfile=new internet($this->url.$this->hashfile);
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
  public function exists(){
    return $this->id != 0;
  }


  static public function sql(){
    return "
      CREATE TABLE #__repository (
	id INT AUTO_INCREMENT ,
	url VARCHAR( 255 ) NOT NULL ,
	official INT ,
	manifest VARCHAR( 20 ) NOT NULL ,
	packages VARCHAR( 20 ) NOT NULL ,
	hashfile VARCHAR( 20 ) NOT NULL ,
	hash TEXT ,
	name VARCHAR( 30 ) NOT NULL ,
	description VARCHAR( 255 ) ,
	PRIMARY KEY ( id ) ,
	UNIQUE ( name )
      ) ENGINE = INNODB ;
    ";
  }

}


?>
