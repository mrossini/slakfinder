<?php

class package {

  private $db;
  
  public function __construct($id=0){
    $this->db=new mysql();
    if($id)$this->select($id);
  }
  /*
      id INT AUTO_INCREMENT NOT NULL ,
      repository INT NOT NULL ,
      filename VARCHAR( 64 ) NOT NULL ,
      name VARCHAR( 32 ) NOT NULL ,
      version VARCHAR( 16 ) NOT NULL ,
      arch VARCHAR( 16 ) NOT NULL ,
      build VARCHAR( 16 ) NOT NULL ,
      compression VARCHAR( 4 ) NOT NULL ,
      description TEXT NOT NULL ,
      location VARCHAR( 128 ) NOT NULL ,
      comprsize INT NOT NULL ,
      uncomprsize INT NOT NULL ,
   */
  public function parse($pkg,$more=array()){
    $pkg=explode("\n",$pkg);
    $pkexp=explode(':',$pkg[0],2);
    $field=$pkexp[0];
    $data=(isset($pkexp[1]))?trim($pkexp[1]):"";
    if($field!="PACKAGE NAME")return false;
    $pack=array();
    $name="";
    foreach($pkg as $line){
      $pkexp=explode(':',$line,2);
      $field=$pkexp[0];
      $data=(isset($pkexp[1]))?trim($pkexp[1]):"";
      switch($field){
	case "PACKAGE NAME": 
	  $tmp=preg_split("/^(.*)-([^\-]*)-([^\-]*)-([^\.]*)\.(t.z)$/",$data,0,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	  $pack['filename']=$data;
	  $pack['name']=$name=$tmp[0];
	  $pack['version']=$tmp[1];
          $pack['arch']=$tmp[2];
          $pack['build']=$tmp[3];
	  $pack['compression']=$tmp[4];
	  break;
	case "PACKAGE LOCATION":
	  $pack['location']=$data;
	  break;
	case "PACKAGE SIZE (compressed)":
	  $pack['comprsize']=$data;
	  break;
	case "PACKAGE SIZE (uncompressed)":
	  $pack['uncomprsize']=$data;
	  break;
	case "PACKAGE REQUIRED":
	  $pack['required']=$data;
	  break;
	case "PACKAGE CONFLICTS":
	  $pack['conflicts']=$data;
	  break;
	case "PACKAGE SUGGESTS":
	  $pack['suggests']=$data;
	  break;
	case "PACKAGE DESCRIPTION":
	  $pack['description']="";
	  break;
	case $name:
	  $pack['description'].="$data\n";
	  break;
      }
    }
    $pack=array_merge($pack,$more);
    return $pack;
  }
  public function add($pkg,$more=array()){
    $pkg=array_merge($pkg,$more);
    if(!$this->db->insert("packages",$pkg))return false;
    foreach($pkg as $key => $value) $this->$key = $value;
    return $this->db->newid;
  }

  public function fetch($packages){
    $pkg="";
    while(!is_null($pkln=$packages->get())){
      if($pkln===false)die('errore su packages');
      if($pkln!=""){
	$pkg.=$pkln."\n";
      }else{
	$pkg=$this->parse($pkg);
	return $pkg;
      }
    }
    return null;
  }


  public function download(){
    global $repodir;
    $path=$repodir.$this->path;
    if(!file_exists($path))if(!mkdir($path))return false;
  #  if(file_exists($path


  }
  public function select($id){
    if(!$this->db->query("select * from #__repository where id=$id")) return false;
    if(!$repo=$this->db->fetch())return false;
    foreach($repo as $key => $value) $this->$key = $value;
  }


  static public function sql(){
    return "
      CREATE TABLE #__packages (
	  id INT AUTO_INCREMENT NOT NULL ,
	  repository INT NOT NULL ,
	  filename VARCHAR( 64 ) NOT NULL ,
	  name VARCHAR( 32 ) NOT NULL ,
	  version VARCHAR( 16 ) NOT NULL ,
	  arch VARCHAR( 16 ) NOT NULL ,
	  build VARCHAR( 16 ) NOT NULL ,
	  compression VARCHAR( 4 ) NOT NULL ,
	  location VARCHAR( 128 ) NOT NULL ,
	  comprsize INT NOT NULL ,
	  uncomprsize INT NOT NULL ,
	  required TEXT ,
	  conflicts TEXT ,
	  suggests TEXT ,
	  description TEXT NOT NULL ,
	PRIMARY KEY ( id ),
        FOREIGN KEY ( repository ) REFERENCES #__repository ( id ) ON DELETE CASCADE

      ) ENGINE = INNODB ;
    ";
  }

}


?>
