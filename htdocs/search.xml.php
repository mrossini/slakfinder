<?php


  include 'inc/includes.inc.php';
  include 'inc/defrepo.inc.php';


  function usage($param=''){
    header('content-type: text/plain');
?>
Usage: http://slak.homelinux.org/search.xml.php?parameter1=value1&parameter2=value2&parameter3=value3&...
parameters:
    repo=value        <repository id> or <repository class>
    
    name=pkgname           search in package name
    desc=description       search in package description
    file=filename          search in filelisting

    start=firstrow         row to start results (0 is the first row)
    maxresult=numrows      max rows to show (default=1000)

    order=field            order results by fields (default by rank). suffix is 'u' for normal order, 'd' for reverse order
                               ranku|rankd : sort by rank (maximum first)
			       pkgu|pkgd   : sort by pkgname (alfabetically)
                               locu|locd   : sort by package location (alfabetically)
                               veru|verd   : sort by version (newer first)
			       archu|archd : sort by architecture (alfabetically)
                               distu|distd : sort by distribution type (newer first)
                               repou|repod : sort by repository description (alfabetically)
			       fileu|filed : sort by file name (alfabetically)
			       pathu|pathd : sort by file path (alfabetically)

    
you must specify at least one of 'name' or 'desc' or 'file'



you may use easely lynx, wget, curl or personal applications:

wget -q -O - "http://slak.homelinux.org/search.xml.php?name=aaa_base"
curl "http://slak.homelinux.org/search.xml.php?file=ntfs-3g&order=veru&head=1&fs=;"
lynx -source "http://slak.homelinux.org/search.xml.php?file=libraw1394.so&repo=1&fs=|"



<?php
  }

  $name=$desc=$file=$repo=$order=null;
  foreach($_GET as $key => $value)$$key=$value;
  if (!($name or $desc or $file)) {
    usage();
    exit;
  }
  $start=0;$maxresult=1000;$fs="\t";$head=0;
  foreach($_GET as $key => $value)$$key=$value;

  $ord="";

  $db=new database();
  $db->counter_inc('srcxml');

  if ($name or $desc or $file){
    if(!$file){ ///////////////////////////////////// PACKAGES.TXT RESULTS ////////////////////////////////////////////////
      switch($order){
	case "ranku": $ord='rank desc';break; case "rankd": $ord='rank';break;
	case "pkgu": $ord='P.name';break; case "pkgd": $ord='P.name desc';break;
	case "veru": $ord='P.version desc';break; case "verd": $ord='P.version';break;
	case "archu": $ord='P.arch';break; case "archd": $ord='P.arch desc';break;
	case "distu": $ord='R.version desc';break; case "distd": $ord='R.version';break;
	case "fileu": $ord='F.filename';break; case "filed": $ord='F.filename desc';break;
	case "pathu": $ord='F.fullpath';break; case "pathd": $ord='F.filename desc';break;
	case "repou": $ord='R.description';break; case "repod": $ord='R.description desc';break;
	case "locu": $ord='P.location';break; case "locd": $ord='P.location desc';break;
      }
      $pkg=new package();
      $xml=new xml('searcher',array('version'=>'0.1'));

      $xml->startSection('info');
      $xml->startSection('query');
      $xml->setElement('field',$name,array('name' => 'name','description' => 'package name'));
      $xml->setElement('field',$desc,array('name' => 'desc','descriprion' => 'package description'));
      $xml->setElement('field',$desc,array('name' => 'file','descriprion' => 'file name'));
      $xml->endSection();
      $xml->endSection();



      $nres=$pkg->find($name,$desc,$repo,$ord);
      $xml->startSection('results',array('count' => $nres));
      $to=$start+$maxresult; if($to > $nres)$to=$nres;
      if($start > 0){ $from=$start-$maxresult;if($from<0)$from=0; }
      if($to < $nres){ $pg=round($nres/$maxresult-0.5,0); $from=$start+$maxresult; $from=$maxresult*$pg; }

      $xml->startSection('fields');
      $xml->setElement('field','result rank',				array('name'=>'rank'));
      $xml->setElement('field','package name',				array('name'=>'pkgname'));
      $xml->setElement('field','package version',			array('name'=>'pkgver'));
      $xml->setElement('field','package location (into repository)',	array('name'=>'pkgloc'));
      $xml->setElement('field','package architecture',			array('name'=>'pkgarch'));
      $xml->setElement('field','package file name',			array('name'=>'pkgfile'));
      $xml->setElement('field','package full url',			array('name'=>'pkgurl'));
      $xml->setElement('field','repository version (slackware release)',array('name'=>'repover'));
      $xml->setElement('field','repository name',			array('name'=>'reponame'));
      $xml->setElement('field','repository id',				array('name'=>'repoid'));
      $xml->setElement('field','repository url',			array('name'=>'repourl'));
      $xml->setElement('field','repository architecture',		array('name'=>'repoarch'));
      $xml->setElement('field','repository class (combine release&arch)',array('name'=>'repoclass'));
      $xml->endSection();

      if($nres>$start){
	$repos=null;
	$pkg->find(null,$start);
	for ( $i=$start ; $i < $to; $i++ ){
	  $pkg->find();
	  $xml->startSection('result',array('id' => $i));
	  $xml->fromArray( array(
	      'rank' => 10000*$pkg->rank, // rank
	      'pkgname' => $pkg->name,    // package name
	      'pkgver' => $pkg->version,  // package version
	      'pkgarch' => $pkg->arch,       // package architecture
	      'pkgloc' => $pkg->location, // package location
	      'pkgfile' => $pkg->filename,  // package filename
	      'pkgurl' => $pkg->url.$pkg->location."/".$pkg->filename,         // package url
	      'repover' => $pkg->repover, // slackware revision
	      'reponame' => $pkg->reponame, // repository name
	      'repoid' => $pkg->repoid, // repository id
	      'repourl' => $pkg->url, // repository url
	      'repoarch' => $pkg->repoarch, // repository architecture
	      'repoclass' => $pkg->repoclass // repository architecture
	      ));
	  $xml->endSection();
//	  echo (10000*$pkg->rank).$fs.$pkg->name.$fs.$pkg->version.$fs.$pkg->arch.$fs.$pkg->location.$fs.$pkg->filename.$fs.$pkg->url.$pkg->location."/".$pkg->filename.$fs.
//	    $pkg->repover.$fs.$pkg->reponame.$fs.$pkg->repoid.$fs.$pkg->url."\n";
	}
      }
      $xml->endSection();
      $xml->output();
    }else{ /////////////////////////////////////////////////// MANIFEST.bz2 RESULTS ///////////////////////////////////////////////////////////
      switch($order){
	case "ranku": $ord='rank desc';break; case "rankd": $ord='rank';break;
	case "pkgu": $ord='pkgname';break; case "pkgd": $ord='pkgname desc';break;
	case "veru": $ord='version desc';break; case "verd": $ord='version';break;
	case "archu": $ord='arch';break; case "archd": $ord='arch desc';break;
	case "distu": $ord='distro desc';break; case "distd": $ord='distro';break;
	case "fileu": $ord='filename';break; case "filed": $ord='filename desc';break;
	case "pathu": $ord='fullpath';break; case "pathd": $ord='fullpath desc';break;
	case "repou": $ord='repobrief';break; case "repod": $ord='repobrief desc';break;
	case "locu": $ord='pkgloc';break; case "locd": $ord='pkgloc desc';break;
      }
      $fl=new filelist();
      $nres=$fl->find($file,$name,$desc,$repo,$ord);
      if(isset($_GET['debug']))var_dump($fl,$nres);
      $to=$start+$maxresult; if($to > $nres)$to=$nres;
      if($start > 0){ $from=$start-$maxresult;if($from<0)$from=0; }
      if($to < $nres){ $pg=round($nres/$maxresult-0.5,0); $from=$start+$maxresult; $from=$maxresult*$pg; }
      if($head)echo "rank".$fs."pkgname".$fs."pkgversion".$fs."pkgarch".$fs."pkglocation".$fs."pkgfilename".$fs."pkgurl".$fs.
   	            "repover".$fs."reponame".$fs."repoid".$fs."repourl".$fs."filepath".$fs."filename"."\n";
      if($nres>$start){
	$fl->find(null,$start);
	for ( $i=$start ; $i < $to ; $i++ ){
	  $fl->find();
	  /* echo tables(array( $fl->rank, "<a title='".(str_replace(array("'","\n"),array(" "," "),$fl->pkgdesc))."' href='show.php?pkg={$fl->pkgid}'>{$fl->pkgname}</a>",
	    $fl->version, $fl->arch, $fl->distro, str_ireplace("$file","<b style='color:red;'>$file</b>",$fl->filename), $fl->fullpath,
	    "<a title='{$fl->repodesc}' href='{$fl->url}'>{$fl->repobrief}</a>", "<a href='{$fl->url}{$fl->pkgloc}/'>{$fl->pkgloc}/</a>",
	    "<a href='{$fl->url}{$fl->pkgloc}/{$fl->pkgfile}'>download</a>"));*/
	  echo (10000*$fl->rank).$fs.$fl->pkgname.$fs.$fl->version.$fs.$fl->arch.$fs.$fl->pkgloc.$fs.$fl->pkgfile.$fs.$fl->url.$fl->pkgloc."/".$fl->pkgfile.$fs.
	    $fl->distro.$fs.$fl->reponame.$fs.$fl->repoid.$fs.$fl->url.$fs.$fl->fullpath.$fs.$fl->filename."\n";
	}
      }
      if($start > 0){ $from=$start-$maxresult;if($from<0)$from=0; }
      if($to < $nres){ $pg=round($nres/$maxresult-0.5,0); $from=$start+$maxresult; $from=$maxresult*$pg; }
    }
  }
?>
