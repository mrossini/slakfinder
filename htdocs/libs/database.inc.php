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
		if(!$this->db->query('DROP TABLE IF EXISTS #__filelist'))return false;
		if(!$this->db->query('DROP TABLE IF EXISTS #__packages'))return false;
		if(!$this->db->query('DROP TABLE IF EXISTS #__repository'))return false;
		#if(!$this->db->query('DROP TABLE IF EXISTS #__mixed'))return false;

		return true;
	}
	public function createdb(){
	  	if(!$this->dropdb())return false;
		if(!$this->db->query(repository::sql()))return false;
		if(!$this->db->query(package::sql()))return false;
		if(!$this->db->query(filelist::sql()))return false;
		if(!$this->db->query("
		  CREATE TABLE IF NOT EXISTS #__mixed (
		    id INT AUTO_INCREMENT ,
		    field VARCHAR( 255 ) NOT NULL ,
                    value VARCHAR( 255 ) NULL ,
                    PRIMARY KEY ( id )
		  ) ENGINE = InnoDB;
		"))return false;
		if(!$this->db->query("INSERT INTO #__mixed (field,value) values ('count_visits','1'),('count_searches','1');"))return false;
		return true;
	}
	public function counter_get($counter){
	  $this->db->query("select value from #__mixed where field='count_$counter';");
	  $val=$this->db->get();
	  return $val["value"];
	}

	public function counter_inc($counter){
	  $this->db->query("update #__mixed set value = (value +1)  where field='count_$counter';");
	}
}


?>
