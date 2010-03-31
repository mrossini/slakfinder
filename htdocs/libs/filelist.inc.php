<?php


class filelist {

  public $db;

  public function __construct(){
    $this->db=new mysql();
  }
  public function addall(&$allpackages,$repo){
    $this->db->insert('filelist',array('package','repository','fullpath','filename'),true);
    $step=0;
    $p=0;
    $repoid=$repo->id;
    while(!is_null($line=$repo->manifile->get())){
      if(isset($_SERVER['DEBUG']))echo "$line\n";
      if($line=="++========================================")$step=0;
      if($step==1){
	if($line){
	  $tmp=preg_split("/^(.)([^ ]+) +([^ ]+) +([^ ]+) +([^ ]+) +([^ ]+) +([^ ]*\/)*([^\/]*)(| .*)$/",$line,0, PREG_SPLIT_DELIM_CAPTURE);
	  $type=$tmp[1];$path=$tmp[7]; $file=$tmp[8];
	  if($type!="d"){
	    if($pkgid!==false)$this->db->insert(array($pkgid, $repoid, "$path", $file)); 
	  }
	}else{
	  $step=0;
	}
      }
      if($step==0){ 
	if(!$line)continue;
	if($line!="++========================================")return false;
	if(($line=$repo->manifile->get())!="||")return false;
	$line=$repo->manifile->get();
	$tmp=preg_split("/^\|\|.*[\/\s]([^\/]*\.t.z).*$/",$line,0,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	if(!$tmp)return false;
	$pkg=$tmp[0];
	if(isset($allpackages[$tmp[0]])){
	  $pkgid=$allpackages[$tmp[0]];
	}else{
	  $pkgid=false;
	}
	//echo "      - ".$p++."  - $pkgid - {$tmp[0]}                                    \n";
	echo ".";
	if(($line=$repo->manifile->get())!="||")return false;
	if(($line=$repo->manifile->get())!="++========================================")return false;
	$step=1;
	$num=0;
      }
    }
    $this->db->insert();

    return true;
  }
  public function get(){
    if(($line=$this->db->get())==false)return false;
    return $line;

  }

  public function find($file=null,$pkg=null,$desc=null,$repo=null,$start=null,$max=null,$regexp=false){ //$repo == id only
    if(!is_null($file)){
      $sql="SELECT F.*, 
	           P.name as pkgname, P.arch AS arch, P.version as version, P.location AS pkgloc, P.filename AS pkgfile,
		   R.name AS reponame, R.url AS url, P.id AS pkgid
	FROM #__filelist as F 
	LEFT JOIN  #__packages as P 
	  ON (F.package=P.id)
	LEFT JOIN #__repository as R 
	  ON (P.repository=R.id) ";
      $next="";
      if($pkg or $desc or $repo or $file){
        $sql.="WHERE ";
        if($repo){$sql.=$next." (R.id='$repo' OR R.class='$repo')";$next=" AND ";}
        if($desc){$sql.=$next." P.description LIKE '%$desc%' ";$next=" AND ";}
	if($pkg){
	  if(is_numeric($pkg)){
	    $sql.="$next ( P.id='$pkg' ) ";$next=" AND ";
	  }else{
	    $sql.="$next ( P.name LIKE '%$pkg%' ) ";$next=" AND ";
	  }
	}
	if($file and $regexp){$sql.="$next F.filename REGEXP \"$file\" ";$next=" AND ";}
	if($file and !$regexp){$sql.="$next F.filename LIKE '%$file%' ";$next=" AND ";}
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
	PRIMARY KEY ( id ) ,
	INDEX ( filename ),
	FOREIGN KEY ( package ) REFERENCES #__packages ( id ) ON DELETE CASCADE
      ) ENGINE = INNODB ;
    ";
  }




}




?>
