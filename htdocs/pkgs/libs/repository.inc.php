<?php

class repository {

  private $db;
  
  public function __construct($id=0){
    $this->db=new mysql();
    if($id)$this->select($id);
  }
  public function add($repo){
    if(!$this->db->insert('repository',$repo))return false;
    foreach($repo as $key => $value) $this->$key = $value;
    $id=$this->db->newid;
    return $id;
  }

  public function popolate(){
    $pkg=new package();
    $int=new internet($url);

  }

  public function download(){
  //  global $repodir;
  //  $path=$repodir.$this->path;
  //  if(!file_exists($path))if(!mkdir($path))return false;
  }
  public function select($id){
    if(!$this->db->query("select * from #__repository where id=$id")) return false;
    if(!$repo=$this->db->fetch())return false;
    foreach($repo as $key => $value) $this->$key = $value;
  }


  static public function sql(){
    return "
      CREATE TABLE #__repository (
	id INT AUTO_INCREMENT ,
	url VARCHAR( 255 ) NOT NULL ,
	official INT ,
	manifest VARCHAR( 20 ) NOT NULL ,
	packages VARCHAR( 20 ) NOT NULL ,
	checksums VARCHAR( 20 ) NOT NULL ,
	sum TEXT ,
	path VARCHAR( 255 ) NOT NULL ,
	alias VARCHAR( 30 ) NOT NULL ,
	description VARCHAR( 255 ) ,
	PRIMARY KEY ( id )
      ) ENGINE = MYISAM ;
    ";
  }

}


?>
