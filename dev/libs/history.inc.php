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



class history {

  static public function sql(){
    return "
      CREATE TABLE #__history (
	id 		INT(11) NOT NULL AUTO_INCREMENT,
	date		DATETIME,
	ip		VARCHAR(15),
	name		VARCHAR(50),
	desc		VARCHAR(50),
	file		VARCHAR(50),
	repo		VARCHAR(5),
	query		VARCHAR(255),
	results		INT(5),
	cache		VARCHAR(50),
	PRIMARY KEY ( id ) 
      ) ENGINE = MyISAM ;
    ";
  }

  var $db;

  public function __construct(){
    $this->db=new mysql();
  }
  public function search($data=array()){
    $sql="select * from #__history ";
    $where="where";
    foreach($data as $key => $value){
      $sql="$where $key='$value' ";
      $where="and";
    }
    $this->db->query($sql);

  }





}











?>
