<?php
/*
 * Copyright 2009, 2010, 2011, 2012 Matteo (ZeroUno) Rossini, Rome, Italy
 * All rights reserved.
 *
 * Redistribution and use of this script, with or without modification, is
 * permitted provided that the following conditions are met:
 *
 * 1. Redistributions of this script must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR ''AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO
 * EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */



class package {

  public $db;
  
  public function __construct($id=0){
    $this->db=new mysql();
    if($id)$this->select($id);
  }
  /*
      id INT AUTO_INCREMENT NOT NULL ,
      repository INT NOT NULL ,
      filename VARCHAR( 64 ) NOT NULL ,
      name VARCHAR( 32 ) NOT NULL ,
      version VARCHAR( 16 ) NOT NULL ,
      arch VARCHAR( 16 ) NOT NULL ,
      build VARCHAR( 16 ) NOT NULL ,
      compression VARCHAR( 4 ) NOT NULL ,
      description TEXT NOT NULL ,
      location VARCHAR( 128 ) NOT NULL ,
      comprsize INT NOT NULL ,
      uncomprsize INT NOT NULL ,
   */
  public function parse($pkg,$more=array()){
    $pkg=explode("\n",$pkg);
    $pkexp=explode(':',$pkg[0],2);
    $field=$pkexp[0];
    $data=(isset($pkexp[1]))?trim($pkexp[1]):"";
    if($field!="PACKAGE NAME")return false;
    $pack=array();
    $name="";
    foreach($pkg as $line){
      $pkexp=explode(':',$line,2);
      $field=$pkexp[0];
      $data=(isset($pkexp[1]))?trim($pkexp[1]):"";
      switch($field){
	case "PACKAGE NAME": 
	  $tmp=preg_split("/^(.*)-([^\-]*)-([^\-]*)-([^\-]*)\.(t.z)$/",$data,0,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	  $pack['filename']=$data;
	  $pack['name']=$name=$tmp[0];
	  $pack['version']=$tmp[1];
          $pack['arch']=$tmp[2];
          $pack['build']=$tmp[3];
	  $pack['compression']=$tmp[4];
	  break;
	case "PACKAGE LOCATION":
	  $pack['location']=$data;
	  break;
	case "PACKAGE SIZE (compressed)":
	  $pack['comprsize']=$data;
	  break;
	case "PACKAGE SIZE (uncompressed)":
	  $pack['uncomprsize']=$data;
	  break;
	case "PACKAGE REQUIRED":
	  $pack['required']=$data;
	  break;
	case "PACKAGE CONFLICTS":
	  $pack['conflicts']=$data;
	  break;
	case "PACKAGE SUGGESTS":
	  $pack['suggests']=$data;
	  break;
	case "PACKAGE DESCRIPTION":
	  $pack['description']="";
	  break;
	case $name:
	  $pack['description'].="$data\n";
	  break;
      }
    }
    $pack=array_merge($pack,$more);
    return $pack;
  }
  public function add($pkg,$repo,$more=array()){
    $pkg=array_merge($pkg,$more);
    $pkg['repository']=$repo->id;
    $pkg['repover']=$repo->version;
    $pkg['repoarch']=$repo->arch;
    if($pkg['repover']=="mixed") {
      if(preg_match('/^.*1[0-9]\.[0-9]+.*$/',$pkg['location'])){
	$pkg['repover']=preg_replace('/^.*(1[0-9]\.[0-9]+).*$/','$1',$pkg['location']);
      }else{
	$pkg['repover']="";
      }
    }
    if($pkg['repoarch']=="mixed") {
      if($pkg['arch']=="x86_64"){
	$pkg['repoarch']="x86_64";
      }elseif(preg_match('/i.86/',$pkg['arch'])){
	$pkg['repoarch']="i386";
      }else{ //pkg arch == noarch
	if(strpos('64',$pkg['location'])){
	  $pkg['repoarch']="x86_64";
	}else{
	  $pkg['repoarch']="i386";
	}
      }
    }
    if(preg_match('/i.86/',$pkg['repoarch']))$pkg['repoarch']="i386";

    if(!$this->db->insert("packages",$pkg))return false;
    foreach($pkg as $key => $value) $this->$key = $value;
    return $this->db->newid;
  }

  public function fetch($packages){
    $pkg="";
    while(!$packages->eof()){
      $pkln=$packages->get();
      //if($pkln===false)die('errore su packages');
      if($pkln){
	$pkg.=$pkln."\n";
      }else{
	$pkg=$this->parse($pkg);
	return $pkg;
      }
    }
    return null;
  }


  public function select($id){
    if(!$this->db->query("select * from #__packages where id=$id")) return false;
    if(!$repo=$this->db->get())return false;
    foreach($repo as $key => $value) $this->$key = $value;
  }

  public function find($pkg=null,$desc=null,$repo=null,$order=""){ //$repo == id only
    if(!is_null($pkg)){
      $next="";
      $where="";
      $rank="";
      if($pkg or $desc or $repo){
	$where.="WHERE ";
	if($pkg){
	  $where.=" ( P.id='$pkg' or P.name LIKE '%$pkg%' ) ";$next=" AND ";
	  $rank=" (
	    (P.name like '$pkg')*10+
	    (P.name like '$pkg-%')*5+
	    (P.name like '$pkg%' and P.name not like '$pkg-%')*3+
	    (P.name like '%-$pkg-%')*2+
	    (P.name like '%-$pkg%' and P.name not like '%-$pkg-%')*2+
	    (P.name like '%-$pkg')*1+
	    (P.name like '%$pkg%$pkg%')*1+
	    ((100 - R.rank)*5)/100+
	    (LENGTH('$pkg')/LENGTH(P.name))
	  ) ";
	}else{$rank.=" ( 0 ) ";}
	if($desc){
	  $where.=$next." P.description LIKE '%$desc%' ";$next=" AND ";
	  $rank.="+ ((P.description like '% $desc %')*8+(P.description like '% $desc%')*4+(P.description like '%$desc %')*2+(P.description like '%$desc%')*1) ";
	}
	if($rank)$rank=", ( $rank ) as rank ";
	if($repo){$where.=$next." (R.id='$repo' OR R.class='$repo') ";}
      }

      $sql="SELECT P.*, 
	           R.name AS reponame, R.description AS repodesc, R.version AS repover, 
		   R.brief AS repobrief, R.url AS url, R.id AS repoid, R.class AS repoclass, R.arch AS repoarch
		   $rank   FROM #__packages as P       LEFT JOIN #__repository as R       ON (P.repository=R.id) $where ";
      if($rank){
	if($order)$order.=" , ";$order.=" rank desc ";
      }
      if($order)$order.=" , ";$order.=" R.rank ";
      if($order)$order.=" , ";$order.=" R.version desc ";
      if($order)$order.=" , ";$order.=" P.name ";
      if($order)$order.=" , ";$order.=" P.version desc ";
      if($order)$sql.=" order by $order ";


      $this->db->query($sql);
    }else{
      if(is_numeric($desc))return $this->db->seek($desc);
      $this->id=0;
      if(!$out=$this->db->get())return false;
      foreach($out as $key => $value) $this->$key = $value;
      return $this->id;
    }
    return $this->db->nrows;
  }

  static public function sql(){
    return "
      CREATE TABLE #__packages (
	  id INT AUTO_INCREMENT NOT NULL ,
	  repository INT(3) NOT NULL ,
	  ptime INT(10) NULL ,
	  filename VARCHAR( 64 ) NOT NULL ,
	  name VARCHAR( 32 ) NOT NULL ,
	  version VARCHAR( 16 ) NOT NULL ,
	  arch VARCHAR( 16 ) NOT NULL ,
	  build VARCHAR( 16 ) NOT NULL ,
	  compression VARCHAR( 4 ) NOT NULL ,
	  location VARCHAR( 128 ) NOT NULL ,
	  comprsize INT NOT NULL ,
	  uncomprsize INT NOT NULL ,
	  required TEXT ,
	  conflicts TEXT ,
	  suggests TEXT ,
	  description TEXT NOT NULL ,
	  repover VARCHAR( 16 ) NULL ,
	  repoarch VARCHAR( 16 ) NULL ,
	PRIMARY KEY ( id ),
        INDEX ( repository )

      ) ENGINE = MyISAM ;
    ";
  }

}


?>
