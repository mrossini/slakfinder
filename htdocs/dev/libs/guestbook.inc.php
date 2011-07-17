<?php


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
      ) ENGINE = INNODB ;
    ";
  }

}



?>
