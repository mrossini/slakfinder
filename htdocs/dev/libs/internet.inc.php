<?php


class internet {
  public function __construct($url,$tmp=null){
    $this->url=$url;
    $this->parse();
    if($tmp){
      $this->tmpfile=$tmp;
    }else{
      $this->tmpfile="/tmp/{$this->file}.".getmypid();
      if(!$this->mode)$this->tmpfile.=$this->ext;
    }
  }
  public function parse(){
    $tmp=preg_split('#^(([^:]*)://)?([^/]*)($|/((.*)/)?(((([^/]*)(\.[^\.]*))|([^/]*)))?)$#i', $this->url,0,PREG_SPLIT_DELIM_CAPTURE);
    $this->proto=($tmp[2])?($tmp[2]):'file';
    $this->domain=$tmp[3];
    $this->fullpath=$tmp[4];
    $this->path="/".$tmp[6];
    $this->file=($tmp[10])?($tmp[10]):($tmp[12]);
    $this->ext=$tmp[11];
    switch(strtolower($this->ext)){
      case '.gz': $this->mode='z'; break;
      case '.xz': $this->mode='xz'; break;
      case '.bz2': $this->mode='bz'; break;
      default: $this->mode=''; break;
    }
  }
  var $head=null;
  public function gethead(){
    $head=array();$code=0;
    exec("curl -I {$this->url} 2>/dev/null",$head,$code);
    foreach($head as $val){
      $tmp=preg_split('/^([^ :]*):? ([^]*)?$/',$val,0,PREG_SPLIT_DELIM_CAPTURE);
      if(isset($tmp[2])) $this->head[$tmp[1]]=$tmp[2];
    }
    if(!isset($this->head['Last-Modified']))$this->head['Last-Modified']="Date Unknown (filesize: ".$this->head['Content-Length'].")";
    if(isset($this->head['HTTP/1.1'])){
      $code=substr($this->head['HTTP/1.1'],0,3);
      if($code==200)$code=0;
    }
    $this->status=$code;
    return $this->head;
  }
  var $status=null;
  public function exists(){
    if (!$this->head) $this->gethead();
    
    return !$this->status;
  }
  
  var $fd;
  var $down;
  public function close(){
    if($this->fd)fclose($this->fd);
    $this->fd=null;
    if(file_exists($this->tmpfile)and !isset($_SERVER['DEBUG']))unlink($this->tmpfile);
  }
  public function __destruct(){
    $this->close();
    if(file_exists($this->tmpfile)and !isset($_SERVER['DEBUG']))unlink($this->tmpfile);
  }

  public function open(){
    if($this->fd)return $this->fd;
    if(!$this->down)$this->download();
    if(!$this->down)return false;
    $this->fd=fopen($this->tmpfile,'r'); 
    return $this->fd;
  }
  public function download($lines=0){
    $cmd="wget ";
    if(isset($_SERVER['WGET'])){$cmd.=$_SERVER['WGET']." ";}
    $cmd.="-O - ";
    $cmd.=$this->url;
    $cmd.="|{$this->mode}cat";
    if($lines)$cmd.="|head -$lines";
    $cmd.=" > {$this->tmpfile}";
    system($cmd,$err);
    $this->down=!$err;
    return $err;
  }

  public function get(){
    if (!$this->open())return false;
    if(feof($this->fd)){
      return null;
    }else{
      $f=fgets($this->fd);
      if(isset($_SERVER['DEBUG'])and $_SERVER['DEBUG']==2)echo "$f";
      if($f===false)return false;
      $t=trim($f,"\n");
      return $t;
    }
  }

  public function eof(){
    if (!$this->open())return false;
    return feof($this->fd);
  }
}







?>
