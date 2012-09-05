<?php
/*
 * Copyright 2009, 2010, 2011, 2012 Matteo (ZeroUno) Rossini, Rome, Italy
 * All rights reserved.
 *
 * Redistribution and use of this script, with or without modification, is
 * permitted provided that the following conditions are met:
 *
 * 1. Redistributions of this script must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR ''AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO
 * EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */



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
		if(!$this->db->query(guestbook::sql()))return false;
		if(!$this->db->query("
		  CREATE TABLE IF NOT EXISTS #__mixed (
		    field VARCHAR( 255 ) NOT NULL ,
                    value VARCHAR( 255 ) NULL ,
                    PRIMARY KEY ( field )
		  ) ENGINE = MyISAM;
		"))return false;
		if(!$this->db->query("
		  CREATE TABLE IF NOT EXISTS #__searches (
		    dt    DATETIME,
		    sname VARCHAR(50),
		    sdesc VARCHAR(50),
		    sfile VARCHAR(50),
		    ip    VARCHAR(15),
		    srepo INT,
		    results INT,
		    duration INT
		  ) ENGINE = MyISAM;
	        "))return false;	
		$this->db->query("INSERT INTO #__mixed (field,value) value ('count_visits','1');");
		$this->db->query("INSERT INTO #__mixed (field,value) value ('count_searches','1');");
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
	public function addsearch($ip,$name,$desc,$file,$repo,$date,$results,$duration){
	  $this->db->insert("searches",array("ip" => $ip, "sname" => $name, "sdesc" => $desc, "sfile" => $file, "srepo" => $repo,
					     "dt" => date("Y-m-d H:i:s",$date), "results" => $results, "duration" => $duration*1000));
	}
}


?>
