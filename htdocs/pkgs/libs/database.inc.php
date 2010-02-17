<?php

class mysql {
	private $db;
	public $started=false;
	public $connected=false;
	public function __construct() {
		global $dbhost,$dbuser,$dbpass,$dbdata;
		$this->db=mysql_connect($dbhost,$dbuser,$dbpass);

		if(!$this->db) return;
		$this->connected=true;
		if(!mysql_select_db($dbdata))return;
		$this->started=true;
	}
	public function __destruct(){
		if($this->db) mysql_close($this->db);
	}

	public $lastquery, $results, $errno, $error, $datas, $nrows;
	public function query($sql){
		global $dbpref;
		$this->data=null;
		$this->nrows=null;
		$this->newid=null;
		$sql=str_replace('#__',$dbpref,$sql);
		$this->results=mysql_query($sql);

		$this->lastquery=$sql;
		if(!$this->results){
			$this->errno=mysql_errno();
			$this->error=mysql_error();
			return false;
		}
		if($this->results==true){
			$this->nrows=mysql_affected_rows();
			$this->newid=mysql_insert_id();
		}else{
			$this->nrows=mysql_num_rows($this->results);
		}
		return true;
	}
}


?>
