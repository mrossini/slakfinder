<?php

class database {

	public $db;
	public $ok=false;
	public function __construct(){
		$this->db=new mysql();
		if($this->db->query('select * from #__repository')){
			$this->ok=true;
		}
	}
	public function __destruct(){
	  	$this->db->close();
	}
	public function dropdb(){
		if(!$this->db->query('drop table if exists #__filelist'))return false;
		if(!$this->db->query('DROP TABLE IF EXISTS #__packages'))return false;
		if(!$this->db->query('drop table if exists #__repository'))return false;
		return true;
	}
	public function createdb(){
	  	if(!$this->dropdb())return false;
		if(!$this->db->query(repository::sql()))return false;
		if(!$this->db->query(package::sql()))return false;
		if(!$this->db->query(filelist::sql()))return false;
		return true;
	}
}


?>
