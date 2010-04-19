<?php

class history {

  static public function sql(){
    return "
      CREATE TABLE #__history (
	id 		INT(11) NOT NULL AUTO_INCREMENT,
	date		DATETIME,
	log 		VARCHAR(255),
	PRIMARY KEY ( id ) 
      ) ENGINE = INNODB ;
    ";
  }

  var $db;
  var $access_log;

  public function __construct(){
    $this->db=new mysql();
  }
  public function getlog(){
    global $access_log;
    if(!$this->access_log=fopen($access_log,'r'))return false;

    
  }





}











?>
