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
	public function createdb(){
		if(!$this->db->query('drop table if exists #__repository'))return false;
		if(!$this->db->query(repository::sql()))return false;
		if(!$this->db->query('drop table if exists #__filelist'))return false;
		if(!$this->db->query('CREATE TABLE #__filelist (
					id 		INT 		AUTO_INCREMENT ,
			        	pkg_id 		INT 		NOT NULL ,
				        fullpath 	VARCHAR( 511 ) 	NOT NULL ,
					filename 	VARCHAR( 255 ) 	NOT NULL ,
					filedate 	DATETIME 	NOT NULL ,
					filesize 	INT 		NOT NULL ,
					PRIMARY KEY ( id )
				      ) ENGINE = MYISAM ;'))return false;
		if(!$this->db->query('DROP TABLE IF EXISTS #__packages'))return false;
		if(!$this->db->query(package::sql()))return false;
		return true;
	}
	public function addrepository($repo){
	  if(!$this->db->query("insert into #__repository (url,official,manifest,packages,alias,description,path) value
	    			('{$repo['url']}',
				 '{$repo['official']}',
				 '{$repo['manifest']}',
				 '{$repo['packages']}',
				 '{$repo['alias']}',
				 '{$repo['description']}',
				 '{$repo['path']}');"))return false;
	  $repoid=$this->db->newid;
	  $packages=fopen($repo['path'].$repo['packages'],'r');
	  if(!$packages)return false;
	  $manifest=fopen($repo['path'].$repo['manifest'],'r');
	  if(!$manifest)return false;
	  $pkg=array();
	  while (!feof($packages)){
	    $line=trim(fgets($packages,4096));
	    $tmp=explode(':',$line,2);
	    $left=$tmp[0];
	    $right=(isset($tmp[1]))?trim($tmp[1]):"";
	    if($left == "PACKAGE NAME"){
	      $pkg['repository']=$repoid;
	      $pkg['filename']=$right;

	      $tmp=preg_split("/^(.*)-([^\-]*)-([^\-]*)-([^\.]*)\.(t.z)$/",$pkg['filename'],0,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	      $pkg['name']=$tmp[0];
	      $pkg['version']=$tmp[1];
	      $pkg['arch']=$tmp[2];
	      $pkg['build']=$tmp[3];
	      $pkg['compression']=$tmp[4];
	      $pkg['description']="";
	    }elseif($pkg){
	      if($left == "PACKAGE LOCATION") $pkg['location']=$right;
	      if($left == "PACKAGE SIZE (compressed)") $pkg['comprsize']=$right;
	      if($left == "PACKAGE SIZE (uncompressed)") $pkg['uncomprsize']=$right;
	      if($left == $pkg['name']) $pkg['description'].=addcslashes($right,"'")."\n";
	      if(!$left){ // INSERIMENTO E GENERAZIONE FILELIST
		$sql ="insert into #__packages (";
		$values="(";$sep="";
		foreach($pkg as $key => $value){
		  $sql.=$sep;
		  $values.=$sep;
		  $sep=",";
		  $sql.=$key;
		  $values.="'".$value."'";
		}
		$sql.=") value $values)";
		echo "\n==================\n$sql\n=======================\n";
		if($this->db->query($sql)){

		  
		}else{
		  //INSERIMENTO PACCHETTO FALLITO
		  return false;
		}
		$pkg="";
	      }
	    }
	  }
	  return true;
	}
	



}


?>
