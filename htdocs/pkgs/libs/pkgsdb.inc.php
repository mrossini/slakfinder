<?php

class pkgsdb {

	private $db;
	public $ok=false;
	public function __construct(){
		$this->db=new mysql();
		if($this->db->query('select * from #__repository')){
			$this->ok=true;
		}
	}
	public function createdb(){
		if(!$this->db->query('drop table if exists #__repository'))return false;
		if(!$this->db->query('CREATE TABLE #__repository (
					id INT AUTO_INCREMENT ,
					url VARCHAR( 255 ) NOT NULL ,
					official INT NOT NULL ,
					manifest VARCHAR( 20 ) NOT NULL ,
					packages VARCHAR( 20 ) NOT NULL ,
					alias VARCHAR( 30 ) NOT NULL ,
					description VARCHAR( 255 ) NOT NULL ,
					PRIMARY KEY ( id )
				      ) ENGINE = MYISAM ;'))return false;
		if(!$this->db->query('drop table if exists #__filelist'))return false;
		if(!$this->db->query('CREATE TABLE #__filelist (
			        	pkg_id INT UNSIGNED NOT NULL ,
				        fullpath VARCHAR( 511 ) NOT NULL ,
					filename VARCHAR( 255 ) NOT NULL ,
					filedate DATETIME NOT NULL ,
					filesize INT NOT NULL
				      ) ENGINE = MYISAM ;'))return false;
		return true;

	}



}


?>
