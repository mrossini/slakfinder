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
	$msg=array();
	$msg['ip']=$row['ip'];
	$msg['nick']=$row['nick'];
	$msg['date']=date("j/M G:i",$row['itime']);
	$msg['message']=preg_replace('#((http|https|ftp)://[^ ]*)#i','<a href="$1">$1</a>',$row['message']);
	$messages[]=$msg;
      }
      $this->messages=array_reverse($messages);
    }
  }
  public function insert($message="",$nick=""){
    if(!preg_match('/http:\/\/|www|\.com\//i',$message)){
      $ip=$_SERVER["REMOTE_ADDR"];
      if($ip="127.0.0.1" or !exec("grep $ip listed_ip_90.txt")){
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
    }
    echo "<h2>You are marked as spammer!!! If you are not, send a mail to <a href='zerouno@slacky.it'>zerouno@slacky.it</a>.</h2>";
    return null;
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
