<?php


class internet {
  /**
   * $mode indica il tipo di file; in base a questo parametro open() e gli altri tratteranno il file:
   *
   * 'a' = automatico (default): determinato in base all'estensione; le estensioni non riconosciute saranno trattate come binary
   * 'b' = binary (possibile solo download)
   * 'J' = compresso in xz (lzma) // unsupported
   * 'g' = compresso in gzip
   * 'j' = compresso in bzip2
   * 'z' = zip // unsupported
   * 'r' = rar // unsupported
   * 't' = text
   *
   * I formati compressi verranno decompressi onfly e trattati come testo
   * Il download avviene sempre in binary mode
   */
  public function __construct($url,$mode='a'){
    $this->url=$url;
    $this->mode=$mode;
    $this->parse();
  }
  public function parse(){
    $tmp=preg_split('#^(([^:]*)://)?([^/]*)($|/((.*)/)?(((([^/]*)(\.[^\.]*))|([^/]*)))?)$#i', $this->url,0,PREG_SPLIT_DELIM_CAPTURE);
    $this->proto=($tmp[2])?($tmp[2]):http;
    $this->domain=$tmp[3];
    $this->fullpath=$tmp[4];
    $this->path="/".$tmp[6];
    $this->file=($tmp[10])?($tmp[10]):($tmp[12]);
    $this->ext=$tmp[11];
    if($this->mode=='a'){
      $this->mode='b';
      switch(strtolower($this->ext)){
	case '.gz': $this->mode='g'; break;
	case '.bz2': $this->mode='j'; break;
	//case 'xz': $this->mode='J'; break;
	//case '.lzma': $this->mode='J'; break;
	//case 'zip': $this->mode='z'; break;
	//case 'rar': $this->mode='r'; break;
	case '.txt': $this->mode='t'; break;
	case '': $this->mode='t'; break;
      }
    }
  }
  
  var $fd;
  var $fifopid=0;
  var $master=true;
  public function close(){
    fclose($this->fd);
    $this->fd=null;
    if($this->master){
      posix_kill($this->fifopid,SIGTERM);
      pcntl_waitpid($this->fifopid,$status);
      unlink($this->fifofile);
    }else{
      posix_kill(getmypid(),SIGTERM);
      exit;
    }
  }
  public function __destruct(){
    if($this->fd)$this->close();
  }

  public function open(){
    $this->fifofile="/tmp/tmpdownload.".getmypid().rand().".fifo";
    $this->master=true;
    posix_mkfifo($this->fifofile,0600);
    $this->fifopid=pcntl_fork();
    if ($this->fifopid == 0) {
      $this->master=false;
      $fifo=fopen($this->fifofile,"w");
      if(isset($_SERVER[$this->proto."_proxy"])){
	$context = stream_context_create(array($this->proto => array('proxy' => 'tcp://'.$_SERVER[$this->proto."_proxy"], 'request_fulluri' => true)));
      }else{ 
	$context=null; 
      }
      if($context){ 
	$this->fd=fopen($this->url,'r',false,$context); 
      }else{ 
	$this->fd=fopen($this->url,'r'); 
      }
      while(!feof($this->fd))fwrite($fifo,fread($this->fd,4096));
      $this->close();
      exit();
    }elseif($this->fifopid == -1){
      return false;
    }
    switch(strtolower($this->mode)){
      case 't':
      case 'b': $this->fd=fopen($this->fifofile,'r'); break;
      case 'g': $this->fd=gzopen($this->fifofile,'r'); break;
      case 'j': $this->fd=bzopen($this->fifofile,'r'); break;
    }
    if(!$this->fd){
      $this->close();
      return false;
    }else{
      return true;
    }
  }
  public function download($lenght=4096){
    if(!$this->fd){
      if (!$this->open())return false;
    }
    $this->contents="";
    $nl=($this->mode=='b')?"":"\n";
    while (!is_null($tmp=$this->get($lenght))) if($tmp===false) { return false; } else {$this->contents.=$tmp.$nl; }
    return true;

  }

  public function get($lenght=4096){
    if(!$this->fd){
      if (!$this->open())return false;
    }
    if(feof($this->fd)){
      return null;
    }else{
      if($this->mode=='b'){
	return fread($this->fd,$lenght);
      }else{
	$f=fgets($this->fd,$lenght);
	$t=trim($f,"\n");
	return $t;
	return trim(fgets($this->fd,$lenght),"\n");
      }
    }
  }
}







?>
