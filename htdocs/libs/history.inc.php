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






}











?>
