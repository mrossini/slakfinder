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
      }
    }
  }
  
  var $fd;
  public function open(){

    $this->fifofile="/tmp/tmpdownload.".getmypid().rand().".fifo";

    posix_mkfifo($this->fifofile,0600);
    $pid=pcntl_fork();
    if ($pid != 0) {
      $this->master=false;
      $fifo=fopen($this->fifofile,"w");
      $fd=fopen($this->url,'r');
      while(!feof($fd))fwrite($fifo,fread($fd,4096));
      fclose($fd);
      fclose($fifo);
      pcntl_waitpid($pid,$status);
      unlink($this->fifofile);
      exit;
    }else{
      $this->master=true;
    }

    switch(strtolower($this->mode)){
      case 't':
      case 'b': $this->fd=fopen($this->fifofile,'r'); break;
      case 'g': $this->fd=gzopen($this->fifofile,'r'); break;
      case 'j': $this->fd=bzopen($this->fifofile,'r'); break;
    }
    if(!$this->fd){return false;}else{return true;}

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
	return trim(fgets($this->fd,$lenght),"\n");
      }
    }
  }
  public function close(){
    fclose($this->fd);
  }
#  public function __destruct(){
#    if($this->fd)$this->close();
#  }
}





?>
