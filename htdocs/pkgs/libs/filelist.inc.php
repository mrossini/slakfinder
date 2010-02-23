<?php


class filelist {

  private $db;

  public function __construct(){
    $this->db=new mysql();
  }
  public function add(&$filelist,$repo){

    $manifest=new internet($repo->url.$repo->manifest);

  }

  static public function sql(){
    return "
      CREATE TABLE #__filelist (
	  id INT AUTO_INCREMENT ,
	  package INT NOT NULL ,
	  fullpath VARCHAR( 511 ) NOT NULL ,
	  filename VARCHAR( 255 ) NOT NULL ,
	  filedate DATETIME NOT NULL ,
	  filesize INT NOT NULL ,
	PRIMARY KEY ( id ) ,
	FOREIGN KEY ( package ) REFERENCES #__packages ( id ) ON DELETE CASCADE
      ) ENGINE = INNODB ;
    ";
  }




}




?>
