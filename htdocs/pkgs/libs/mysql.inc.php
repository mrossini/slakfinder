<?php

function quote_data(&$v,$k) { $v=addcslashes($v,"'"); }
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
		#echo "\n\n$sql\n\n";

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
	private $insertdata=false;
	private $insertstart=false;
	public $maxdata=100000;
	public function insert($first=false,$second=false,$large=false){
	  /*
	   * se large=false, $first la tabella e $second sono i dati (in array
	   * associativo) viene fatta una query standard. Eventuali buffer
	   * vengono flushati e chiusi.
	   *
	   * se large=true, allora si sta inizializzando una query multipla in cui
	   * $first è la tabella è $second è un array dei campi
	   *
	   * le richieste successive avranno $large=false.
	   * Se in queste $first=false (cioè lanciato senza parametri) si forza un
	   * flush dei dati.
	   * Se in queste $first è un array allora rappresenta i dati e vengono
	   * accodati al buffer; se il buffer è pieno questo viene prima flushato.
	   */
	  if($first===false){ // richiesta di flush
	    if(!$this->insertstart)return false; // se non c'è un buffer allora fallisce
	    if(!$this->insertdata)return true; // l'inserimento di un buffer vuoto va a buon fine
	    $out=$this->query($this->insertstart.$this->insertdata); // inserisci e
	    $this->insertdata=false;             // svuota il buffer
	    return $out;
	  }
	  if(is_array($second) and !$large){
	    if($this->insertstart)$this->insert(); $this->insertstart=false; // flusha eventuali buffer
	    // effettua query standard
	    if(isset($second[0])){
	      $sql="insert into #__$first (".implode(",",array_keys($second[0])).") values ";
	      $values=$second;
	    }else{
	      $sql="insert into #__$first (".implode(",",array_keys($second)).") value ";
	      $values=array(0 => $second);
	    }
	    array_walk_recursive($values,'quote_data');


	    foreach ($values as $key => $val)$values[$key]="'".implode("','",$val)."'";
	    $sql.="(".implode("),(",$values).")";
	    return $this->query($sql);
	  }
	  if(is_array($second) and $large){ // inizializza il buffer
	    if($this->insertdata)$this->insert();
	    $this->insertstart="insert into #__$first (".implode(",",$second).") values ";
	    return;
	  }
	  if(is_array($first)){
	    array_walk_recursive($first,'quote_data');
	    $data="('".implode("','",$first)."')";
	    if(!$this->insertdata)$this->insertdata="";
	    if(strlen($this->insertdata)+strlen($data) > $this->maxdata)$this->insert();
	    if($this->insertdata)$this->insertdata.=",";
	    $this->insertdata.=$data;
	    return;
	  }
	}
	public function close(){
	  #return mysql_close($this->db);
	}
}


?>
