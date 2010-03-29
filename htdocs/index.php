<?php session_start(); 
echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>Package Finder</title>
  </head>
  <style type="text/css">
  <!--
    a:link    {text-decoration: none; color: blue;}
    a:visited {text-decoration: none; color: blue;}
    a:hover   {text-decoration: underline; color: red;}
  .repository {border:1px solid #000000;}
  .repository td { border-top:1px solid #000000; border-right:1px dotted; }
  .repository th { border-right:1px dotted; }
  .results {border:1px solid #000000;}
  .results td { border-top:1px solid #000000; border-right:1px dotted; }
  .results th { border-right:1px dotted; }
  -->
  </style>
<body>
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
?>

<form action='index.php?#results'
  <input type='hidden' name='act' value='search' />
  <?php echo writerepos($repo); ?>
  <a name='results'></a>
  <nobr>Search: <input name='name' value='<?php echo $name; ?>' /> 
        <input type='submit' value='go' /> - 
	Description: <input name='desc' value='<?php echo $desc; ?>' /> - 
        Filename: <input name='file' value='<?php echo $file; ?>' /> - 
	<input name='regexp' type='checkbox' <?php echo(($regexp)?"checked='checked'":""); ?> /> Use regexp</nobr>";
  </form>
  <pre>
<?php

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
	    echo tables(array("package","version","arch","location",'&nbsp;'),1,"class='results'");
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
	    echo tables(array("package","version","file","path","location",'&nbsp;'),1,"class='results'");
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
<p>To report a bug, mail to <a href='mailto:zerouno@slacky.it'>zerouno@slacky.it</a>. Thanks.</p>
</body></html>
