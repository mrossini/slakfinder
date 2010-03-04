<?php


class filelist {

  private $db;

  public function __construct(){
    $this->db=new mysql();
  }
  public function addall(&$allpackages,$repo){
    $this->db->insert('filelist',array('package','repository','fullpath','filename','filedate','filesize'),true);
    $step=0;
    $p=0;
    $repoid=$repo->id;
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
	echo "      - ".$p++."  - $pkgid - {$tmp[0]}                                    ";
	if(($line=$repo->manifile->get())!="||")return false;
	if(($line=$repo->manifile->get())!="++========================================")return false;
	$step=1;
	$num=0;
      }elseif($step==1){
	if($line){
	  $tmp=preg_split("/^(.)([^ ]+) +([^\/]+)\/([^ ]+)[^\d]+([\,\d]+) +(\d+-\d+-\d+ \d+:\d+) +([^ ]*\/)*([^\/]*)(| .*)$/",$line,0, PREG_SPLIT_DELIM_CAPTURE);
	  $type=$tmp[1]; $perm=$tmp[2]; $user=$tmp[3]; $group=$tmp[4]; $size=$tmp[5]; $date=$tmp[6]; $path=$tmp[7]; $file=$tmp[8];
	  if($type!="d"){
	    if($type=="c" or $type=="b") $size=0;
	    $this->db->insert(array($pkgid, $repoid, "$path", $file, "$date:00", $size)); 
	    echo "\r".$num++;
	  }
	}else{
	  $this->db->insert();
	  echo "\r";
	  $step=0;
	}
      }
    }
    $this->db->insert();

    return true;
  }

  public function find($file=null,$pkg=null,$desc=null,$repo=null,$start=null,$max=null){ //$repo == id only
    if(!is_null($file)){
      $sql="SELECT F.*, P.name as pkgname, R.name AS reponame, P.version as version, P.location AS pkgloc 
	FROM #__filelist as F 
	LEFT JOIN  #__packages as P 
	  ON (F.package=P.id)
	LEFT JOIN #__repository as R 
	  ON (P.repository=R.id) ";
      $next="";
      if($pkg or $desc or $repo or $file){
        $sql.="WHERE ";
	if($file){$sql.=" F.filename REGEXP \"$file\" ";$next=" AND ";}
        if($pkg){$sql.=" ( P.id='$pkg' or P.name LIKE '%$pkg%' ) ";$next=" AND ";}
        if($desc){$sql.=$next." P.description LIKE '%$desc%' ";$next=" AND ";}
        if($repo){$sql.=$next." R.id='$repo'";}
      }
      if(is_numeric($start) and is_numeric($max)){
        $sql.=" limit $start,$max";
      }
      $this->db->query($sql);
    }else{
      $this->id=0;
      if(!$out=$this->db->get())return false;
      foreach($out as $key => $value) $this->$key = $value;
      return $this->id;
    }
    return $this->db->nrows;
  }


  static public function sql(){
    return "
      CREATE TABLE #__filelist (
	  id INT AUTO_INCREMENT ,
	  repository INT NOT NULL ,
	  package INT NOT NULL ,
	  fullpath VARCHAR( 511 ) NOT NULL ,
	  filename VARCHAR( 255 ) NOT NULL ,
	  filedate DATETIME NOT NULL ,
	  filesize INT NOT NULL ,
	PRIMARY KEY ( id ) ,
	FOREIGN KEY ( package ) REFERENCES #__packages ( id ) ON DELETE CASCADE,
	FOREIGN KEY ( repository ) REFERENCES #__packages ( repository ) ON UPDATE CASCADE
      ) ENGINE = INNODB ;
    ";
  }




}




?>
