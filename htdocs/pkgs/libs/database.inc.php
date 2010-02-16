<?php

class mysql {
	private $db;
	public $started=false;
	public $connected=false;
	public function __construct() {
		global $dbhost,$dbuser,$dbpass,$dbdata;
		echo "\$this->db=mysql_connect($dbhost,$dbuser,$dbpass);";
		//$this->db=mysql_connect($dbhost,$dbuser,$dbpass);
		$this->db=mysql_connect("127.0.0.1");
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
		}else{
			$this->nrows=mysql_num_rows($this->results);
		}
		return true;
	}
}


?>
