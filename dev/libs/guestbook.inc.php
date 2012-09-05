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




class guestbook {
  public $db,$nmsg=0;
  public $idx=0;
  public $messages=array();

  public function __construct($message=null,$nick=null){
    $this->db=new mysql();
    if($message)$this->insert($message,$nick);
    if($x=$this->db->query('select * from #__guestbook')){
      $this->nmsg=$this->db->nrows;
      $messages=array();
      while($row=$this->db->get()){
	if(!preg_match('/http:\/\/|www|\.com\//i',$row['message'])){
	  $msg=array();
	  $msg['ip']=$row['ip'];
	  $msg['nick']=$row['nick'];
	  $msg['date']=date("j/M G:i",$row['itime']);
	  $msg['message']=preg_replace('#((http|https|ftp)://[^ ]*)#i','<a href="$1">$1</a>',$row['message']);
	  $messages[]=$msg;
	}
      }
      $this->messages=array_reverse($messages);
    }
  }
  public function insert($message="",$nick=""){
    $ip=$_SERVER["REMOTE_ADDR"];
    $date=time();
    $nick=strip_tags($nick);
    $message=htmlentities(strip_tags($message));
    if(!$nick)$nick="anonymous";

    return $this->db->insert('guestbook',array(
	'ip' => $ip,
	'itime' => $date,
	'nick' => $nick,
	'message' => $message
    ));
  }
  public function fetch(){
    if(!isset($this->messages[$this->idx]))return false;
    $msg=$this->messages[$this->idx];
    $this->idx++;
    return $msg;
  }
  public function eof(){
    return $this->idx >= $this->nmsg;
  }
  public function reset(){
    $this->idx=-1;
  }
  public function curr(){
    if(isset($this->messages[$this->idx])){
      return $this->messages[$this->idx];
    }else{
      return false;
    }
  }
  static public function sql(){
    return "
      CREATE TABLE IF NOT EXISTS #__guestbook (
	id INT AUTO_INCREMENT ,
	itime INT(10),
	nick VARCHAR(20),
	ip VARCHAR(15),
	message TEXT,
	PRIMARY KEY ( id ) 
      ) ENGINE = MyISAM ;
    ";
  }

}



?>
