<?php

class history {

  static public function sql(){
    return "
      CREATE TABLE #__history (
	id 		INT(11) NOT NULL AUTO_INCREMENT,
	date		DATETIME,
	ip		VARCHAR(15),
	name		VARCHAR(50),
	desc		VARCHAR(50),
	file		VARCHAR(50),
	repo		VARCHAR(5),
	query		VARCHAR(255),
	results		INT(5),
	cache		VARCHAR(50),
	PRIMARY KEY ( id ) 
      ) ENGINE = INNODB ;
    ";
  }

  var $db;

  public function __construct(){
    $this->db=new mysql();
  }
  public function search($data=array()){
    $sql="select * from #__history ";
    $where="where";
    foreach($data as $key => $value){
      $sql="$where $key='$value' ";
      $where="and";
    }
    $this->db->query($sql);

  }





}











?>
