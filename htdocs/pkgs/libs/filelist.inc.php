<?php


class filelist {

  private $db;

  public function __construct(){
    $this->db=new mysql();
  }
  public function addall(&$allpackages,$repo){
    $step=0; //clean
    $p=0;
    while(!is_null($line=$repo->manifile->get())){
      if($step==0){ 
	if(!$line)continue;
	if($line!="++========================================")return false;
	if(($line=$repo->manifile->get())!="||")return false;
	$line=$repo->manifile->get();
	$tmp=preg_split("/^\|\|.*[\/\s]([^\/]*\.t.z)$/",$line,0,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	if(!$tmp)return false;
	$pkg=$tmp[0];
	$pkgid=$allpackages[$tmp[0]];
	echo "      - ".$p++."  - $pkgid - {$tmp[0]}                  ";
	if(($line=$repo->manifile->get())!="||")return false;
	if(($line=$repo->manifile->get())!="++========================================")return false;
	$step=1;
	$num=0;
      }elseif($step==1){
	if($line){
	  $tmp=preg_split("/^(.)([^ ]+) +([^\/]+)\/([^ ]+)[^\d]+([\,\d]+) +(\d+-\d+-\d+ \d+:\d+) +([^ ]*)\/([^\/]*)(| .*)$/",$line,0, PREG_SPLIT_DELIM_CAPTURE);
	  $type=$tmp[1]; $perm=$tmp[2]; $user=$tmp[3]; $group=$tmp[4]; $size=$tmp[5]; $date=$tmp[6]; $path=$tmp[7]; $file=$tmp[8];
	  //echo "inserting|$type|$perm|$user|$group|$size|$date|$path|$file|||\n";
	  if($type=="c" or $type=="b") $size=0;
	  $this->db->insert('filelist',array('package','pullpath','filename','filedate','filesize'));
	  $this->db->insert(array($pkgid, "$path/$file", $file, "$date:00", $size)); 
	  echo "\r".$num++;
	}else{
	  $this->db->insert();
	  echo "\n";
	  $step=0;
	}
      }
    }

    return true;

  }

  static public function sql(){
    return "
      CREATE TABLE #__filelist (
	  id INT AUTO_INCREMENT ,
	  package INT NOT NULL ,
	  fullpath VARCHAR( 511 ) NOT NULL ,
	  filename VARCHAR( 255 ) NOT NULL ,
	  filedate DATETIME NOT NULL ,
	  filesize INT NOT NULL ,
	PRIMARY KEY ( id ) ,
	FOREIGN KEY ( package ) REFERENCES #__packages ( id ) ON DELETE CASCADE
      ) ENGINE = INNODB ;
    ";
  }




}




?>
