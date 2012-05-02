<?php


class filelist {

  public $db;

  public function __construct(){
    $this->db=new mysql();
  }
  public function addall(&$allpackages,$repo){
    $i=0;
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
	    if($pkgid!==false){
	      $this->db->insert(array($pkgid, $repoid, "$path", $file)); 
	      $i++;
	    }
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
	if(isset($_SERVER['DEBUG']))echo "$line\n";
	$tmp=preg_split("/^\|\|.*[\/\s]([^\/]*\.t.z).*$/",$line,0,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	if(!$tmp)return false;
	$pkg=$tmp[0];
	if(isset($allpackages[$tmp[0]])){
	  $pkgid=$allpackages[$tmp[0]];
	}else{
	  $pkgid=false;
	}
	//echo "      - ".$p++."  - $pkgid - {$tmp[0]}                                    \n";
	if(isset($_SERVER["_"])){ echo "\r(filelist ".$p++."($i): ".$tmp[0]."               \r" ; }else{ echo "."; }
	if(($line=$repo->manifile->get())!="||")return false;
	if(($line=$repo->manifile->get())!="++========================================")return false;
	$step=1;
	$num=0;
      }
    }
    $this->db->insert();
    if(isset($_SERVER["_"])){ echo "\r(filelist $i files                                         \n" ; }else{ echo "[$i files]\n"; }

    return $i;
  }
  public function get(){
    if(($line=$this->db->get())==false)return false;
    return $line;

  }

  public function find($file=null,$pkg=null,$desc=null,$repo=null,$order=""){ //$repo == id only
    if(!is_null($file)){
      $rank=" (
	(F.filename like '$file')*10+
	(F.filename like '$file.%')*5+
	(F.filename like '$file-%')*5+
	(F.filename like '$file%' and F.filename not like '$file.%' and F.filename not like '$file-%')*3+
	(F.filename like '%.$file.%')*2+
	(F.filename like '%-$file-%')*2+
	(F.filename like '%.$file%' and F.filename not like '%.$file.%')*2+
	(F.filename like '%-$file%' and F.filename not like '%-$file-%')*2+
	(F.filename like '%.$file')*1+
	(F.filename like '%-$file')*1+
	(F.filename like '%$file%$file%')*1+
	(LENGTH('$file')/LENGTH(F.filename))
      ) ";
      $fields="F.*, 
               P.name as pkgname, P.arch AS arch, P.version as version, P.location AS pkgloc, P.filename AS pkgfile, P.description AS pkgdesc,
               R.name AS reponame, R.url AS url, P.id AS pkgid, R.version AS distro, R.description AS repodesc, R.brief AS repobrief, R.rank AS reporank, R.id AS repoid,
	       $rank AS rank";
      $from="#__filelist as F LEFT JOIN  #__packages as P ON (F.package=P.id) LEFT JOIN #__repository as R ON (P.repository=R.id) ";
      $where="";
      $next="";
      if($pkg or $desc or $repo or $file){
        if($repo){$where.=$next." (R.id='$repo' OR R.class='$repo')";$next=" AND ";}
        if($desc){$where.=$next." P.description LIKE '%$desc%' ";$next=" AND ";}
	if($pkg){
	  if(is_numeric($pkg)){
	    $where.="$next ( P.id='$pkg' ) ";$next=" AND ";
	  }else{
	    $where.="$next ( P.name LIKE '%$pkg%' ) ";$next=" AND ";
	  }
	}
	if($file){$where.="$next F.filename LIKE '$file' ";$next=" AND ";}
      }
      if($rank){ if($order)$order.=" , ";$order.=" rank desc "; }
      if($order)$order.=" , ";$order.=" reporank ";
      if($order)$order.=" , ";$order.=" distro desc ";
      if($order)$order.=" , ";$order.=" filename desc ";
      if($order)$order.=" , ";$order.=" pkgname ";
      if($order)$order.=" , ";$order.=" version desc ";
      $limit=" 0,1000";
      $this->db->search($fields,$from,$where,$order); //,$limit);
    }else{
      if(is_numeric($pkg))return $this->db->seek($pkg);
      $this->id=0;
      if(!$out=$this->db->get())return false;
      foreach($out as $key => $value) $this->$key = $value;
      return $this->id;
    }
    return $this->db->nrows;
  }

  public function find_classic($file=null,$pkg=null,$desc=null,$repo=null,$order=""){ //$repo == id only
    if(!is_null($file)){
      $rank=" (
	(F.filename like '$file')*10+
	(F.filename like '$file.%')*5+
	(F.filename like '$file-%')*5+
	(F.filename like '$file%' and F.filename not like '$file.%' and F.filename not like '$file-%')*3+
	(F.filename like '%.$file.%')*2+
	(F.filename like '%-$file-%')*2+
	(F.filename like '%.$file%' and F.filename not like '%.$file.%')*2+
	(F.filename like '%-$file%' and F.filename not like '%-$file-%')*2+
	(F.filename like '%.$file')*1+
	(F.filename like '%-$file')*1+
	(F.filename like '%$file%$file%')*1+
	(LENGTH('$file')/LENGTH(F.filename))
      ) ";
      $sql="SELECT F.*, 
	           P.name as pkgname, P.arch AS arch, P.version as version, P.location AS pkgloc, P.filename AS pkgfile,
		   R.name AS reponame, R.url AS url, P.id AS pkgid, R.version AS distro, R.description AS repodesc, 
		   $rank AS rank
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
	if($file){$sql.="$next F.filename LIKE '%$file%' ";$next=" AND ";}
      }
      if($rank){
	if($order)$order.=" , ";$order.=" rank desc ";
      }
      if($order)$order.=" , ";$order.=" R.rank ";
      if($order)$order.=" , ";$order.=" R.version desc ";
      if($order)$order.=" , ";$order.=" F.filename desc ";
      if($order)$order.=" , ";$order.=" P.name ";
      if($order)$order.=" , ";$order.=" P.version desc ";
      if($order)$sql.=" order by $order ";
      $sql.=" limit 0,1000";
      $this->db->query($sql);
    }else{
      if(is_numeric($pkg))return $this->db->seek($pkg);
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
	INDEX ( filename )
	, INDEX ( repository )
	, INDEX ( package )
      ) ENGINE = MyISAM ;
    ";
  }




}




?>
