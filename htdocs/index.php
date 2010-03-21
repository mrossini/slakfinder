<?php session_start(); 
echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Package Finder</title>
  </head>
<body>
<!--<pre>-->
<?php
  include 'inc/includes.inc.php';
  include 'inc/defrepo.inc.php';

  $maxresult=80;
  $db=new database();
  if(!isset($_SESSION['searcher_visitor'])){
    $db->counter_inc('visits');
    $_SESSION['searcher_visitor']=$db->counter_get('visits');
  }
  echo "You are the ".$_SESSION['searcher_visitor']."st visitor<br />";
  $regexp=$name=$desc=$file=$repo=null;
  foreach($_GET as $key => $value)$$key=$value;
  if ($name or $desc or $file) $db->counter_inc('searches');
  echo "Searched ".$db->counter_get('searches')." packages from 6 March 2010<br /><br />";

  echo "<form action='?' >";
  echo "<input type='hidden' name='act' value='search' />\n";
  echo tables(array(),1,0);
  $from=writerepos($repo);
  echo tables(array("Search from: ",$from));
  echo tables(array("Package name: ","<input name='name' value='$name' />"));
  echo tables(array("Description: ","<input name='desc' value='$desc' /><br />"));
  echo tables(array("Filename: ","<input name='file' value='$file' /><br />"));
  echo tables(array("Use regexp: ","<input name='regexp' type='checkbox' ".(($regexp)?"checked='checked'":"")." />"));
  echo tables();
  echo "<input type='submit' value='go' />";

  echo "</form>";
  echo "<pre>";

  if ($name or $desc or $file){
    if(!$file){
      $pkg=new package();
      $out=$pkg->find($name,$desc,$repo,0,$maxresult+1);
//      echo "<pre>";var_dump($pkg);echo "</pre>";
      if($out>$maxresult){
	echo "Found more than $maxresult results.<br /><br />";
	$out=$maxresult;
      }else{
	echo "Found $out results:<br />";
      }
      if($out){
	$repos=null;
	for ( $i=0 ; $i < $out ; $i++ ){
	  $pkg->find();
	  if($repos != $pkg->reponame){
	    if($repos) echo tables();
	    echo "<br />Repository: {$pkg->reponame} - url: <a href={$pkg->url}>{$pkg->url}</a>";
	    $repos=$pkg->reponame;
	    echo tables(array("package","version","arch","location",'&nbsp;'),1);
	  }
	  echo tables(array("<a href='show.php?pkg={$pkg->id}'>{$pkg->name}</a>",$pkg->version,$pkg->arch,"<a href='{$pkg->url}{$pkg->location}/'>{$pkg->location}/</a>","<a href='{$pkg->url}{$pkg->location}/{$pkg->filename}'>download</a>"));
	}
	echo tables();
      }
      echo "<br /><br /><br />";
    }else{
      $fl=new filelist();
      $out=$fl->find($file,$name,$desc,$repo,0,$maxresult+1,$regexp);
      echo "Time: ".(round($fl->db->msec,3))." msec<br />";
      if($out>$maxresult){
	echo "Founded more than $maxresult results<br /><br />";
	$out=$maxresult;
      }else{
	echo "Found $out results:<br /><br />";
      }
      if($out){
	$repos="";
	$pack="";
	for ( $i=0 ; $i < $out ; $i++ ){
	  $fl->find();
	  if($repos != $fl->reponame){
	    if($repos) echo tables();
	    echo "<br />Repository: {$fl->reponame} - url: <a href='{$fl->url}'>{$fl->url}</a>";
	    $repos=$fl->reponame;
	    echo tables(array("package","version","file","path","location",'&nbsp;'),1);
	  }
	  echo tables(array("<a href='show.php?pkg={$fl->pkgid}'>{$fl->pkgname}</a>",$fl->version."-".$fl->arch,$fl->filename,$fl->fullpath,"<a href='{$fl->url}{$fl->pkgloc}/'>{$fl->pkgloc}/</a>","<a href='{$fl->url}{$fl->pkgloc}/{$fl->pkgfile}'>download</a>"));
	}
	echo tables();
      }
      echo "<br /><br /><br />";
    }
  }
?>
</pre>
<p>To report a bug, mail to <a href='mailto:zerouno@slacky.eu'>zerouno@slacky.eu</a>. Thanks.</p>
</body></html>
