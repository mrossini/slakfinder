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

	public $lastquery, $results, $errno, $error, $datas, $nrows;
	public function query($sql){
		global $dbpref;
		$this->datas=null;
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
			$this->datas=array();
		}
		return true;
	}

	public function fetchtable(){
	  while($this->fetch());
	}
	public function fetch(){
	  if($tmp=mysql_fetch_assoc($this->results)){
	    $this->datas[]=$tmp;
	    return count($this->datas)-1;
	  }
	  return false;
	}
	public function get(){
	  $tmp=$this->fetch();
	  if($tmp===false)return false;
	  return $this->datas[$tmp];
	}
	public function insert($table,$data){
	  if (!is_array($data))return false;
	  $sql="insert into #__$table (";
	  $sep="";
	  if(isset($data[0])){
	    foreach($data[0] as $key => $value){ $sql.=$sep.$key; $sep=","; } 
	    $sql.=")values";
	    $values=$data;
	  }else{
	    foreach($data as $key => $value){ $sql.=$sep.$key; $sep=","; } 
	    $sql.=")value";
	    $values=array(0 => $data);
	  }
	  $gsep="";
	  foreach($values as $k => $v){
	    $sql.=$gsep."(";
	    $sep=""; 
	    foreach($v as $key => $value){ $sql.=$sep."'".addcslashes($value,"'")."'"; $sep=","; } 
	    $sql.=")";
	    $gsep=",";
	  }
	  return $this->query($sql);
	}
	public function close(){
	  return mysql_close($this->db);
	}
}


?>
