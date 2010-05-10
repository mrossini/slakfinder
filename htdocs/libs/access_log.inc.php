<?php

class access_log {

  var $db;
  var $access_log=null;
  var $row=null;
  var $cur=null;

  public function __construct(){
    $this->db=new mysql();
  }
  public function open(){
    global $access_log_file;
    if(!$this->access_log=fopen($access_log_file,'r')){
      $this->row=null;
      return false;
    }else{
      $this->row=1;
      return true;
    }
  }
  public function fetch(){
    if(feof($this->access_log))return null;
    $regex=
      "^([^ ]+) - *" // IP 1
      ."([^ ]*) *- " // USERNAME 2
      ."\[([^\]]+)\] " // TIME (20/Jun/2009:18:25:22 +0200) 3
      ."\"([A-Za-z]*) *" // METHOD 4
      ."([^ ]+) *" // URL (whithout domain) 5
      ."([^\"]*)\" " // PROTO VERSION 6
      ."(\d+) " // EXIT CODE 7
      ."(.+)$" // OUT SIZE 8 
      ;
    $line=trim(fgets($this->access_log));
    $this->row++;
    if($line){
      $tmp=preg_split("|$regex|",$line,-1,PREG_SPLIT_DELIM_CAPTURE);
      $log=array();
      $log['line']=$line;
      $log['ip']=$tmp[1];
      $log['user']=$tmp[2];
      $log['time']=strtotime($tmp[3]);
      $log['method']=$tmp[4];
      $url=url_parse($tmp[5]);
      unset($url['host'],$url['port'],$url['scheme'],$url['url']);
      $log['url']=$url;
      $log['protover']=$tmp[6];
      $log['status']=(int)$tmp[7];
      $log['size']=($tmp[8]=="-")?0:(int)$tmp[8];
      $this->cur=$log;
      return $log;
    }else{
      $this->cur=null;
      return null;
    }
  }
  public function skip($count=1){
    for($count;$count>0;$count--){
      if(!feof($this->access_log)){
	fgets($this->access_log);
	$this->row++;
      }else{
	return null;
      }
    }
    return true;
  }
  public function eof(){
    return feof($this->access_log);
  }
  public function reset(){
    $this->seek(-1);
  }
  public function seek($where=null){
    if(!$where){
      while($this->skip());
      return $this->row;
    }
    if($where=="-1"){
      fseek($this->access_log,0);
      $this->row=0;
      $this->cur=null;
      return true;
    }
    return $this->skip($where-$this->row);
  }
  var $sdata=null;
  public function search($what,$where='line',$param="~"){
    if($where=='time' and $param=="~")$param="=";
    $this->sdata=array("what"=>$what,"where"=>$where,"param"=>$param);
  }
  public function find(){
    $where=$this->sdata['where'];
    $what=$this->sdata['what'];
    $param=$this->sdata['param'];
    $found=false;
    while(!$found and !$this->eof()){
      $line=$this->fetch();
      $field=false;
      if(isset($line[$where]))$field=$line[$where];
      if(isset($line['url'][$where]))$field=$line['url'][$where];
      if(substr($where,0,1)=="_"){
	$where=substr($where,1);
	if(isset($line['get'][$where]))$field=$line['get'][$where];
      }
      if($field){
	if    ($param=="="){ if($field==$what)$found=$line; }
	elseif($param=="~"){ if(!stripos($field,$what)===false)$found=$line; }
	elseif($param==">"){ if($field>$what)$found=$line; }
	elseif($param=="<"){ if($field<$what)$found=$line; }
      }
    }
    return $found;
  }

  public function close(){
    if($this->access_log){
      fclose($this->access_log);
      $this->access_log=null;
    }
  }





}











?>
