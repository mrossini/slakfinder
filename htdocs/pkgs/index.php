<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><title>Package Finder</title></head>
<?php 
//<html xmlns="http://www.w3.org/1999/xhtml" dir="{%lang_direction%}" lang="en" xml:lang="en">
?>
<body>
<pre>
<?php
  include 'inc/includes.inc.php';

  $maxresult=80;
  $db=new database();
  session_start();
  if(!isset($_SESSION['searcher_visitor'])){
    $db->counter_inc('visits');
    $_SESSION['searcher_visitor']=$db->counter_get('visits');
  }
  echo "You are the ".$_SESSION['searcher_visitor']."st visitor<br />";
  $regexp=$name=$desc=$file=$repo=null;
  foreach($_GET as $key => $value)$$key=$value;
  if ($name or $desc or $file) $db->counter_inc('searches');
  echo "Searched ".$db->counter_get('searches')." packages from 6 March 2010<br /><br />";

  $repof=new repository();
  $repof->find();
  echo "<form action='?' >";
  echo "<input type='hidden' name='act' value='search' />\n";
  tables(array(),1,0);
  $select="<select name='repo'>\n";
  $select.="  <option value='0'".((!$repo)?" selected='selected'":"").">---  All repositories ---</option>\n";
  while ($repof->fetch()){ 
    $select.="  <option value='{$repof->id}'".(($repo==$repof->id)?" selected='selected'":"").">{$repof->name}";
    if(!$repof->manifest)$select.=" (no file search)";
    $select.="</option>\n"; 
  } 
  $select.="</select>";
  tables(array("Search from: ",$select));
  tables(array("Package name: ","<input name='name' value='$name' />"));
  tables(array("Description: ","<input name='desc' value='$desc' /><br />"));
  tables(array("Filename: ","<input name='file' value='$file' /><br />"));
  tables(array("Use regexp: ","<input name='regexp' type='checkbox' ".(($regexp)?"checked='checked'":"")." />"));
  tables();
  echo "<input type='submit' value='go' />";

  echo "</form>";

  if ($name or $desc or $file){
    if(!$file){
      $pkg=new package();
      $out=$pkg->find($name,$desc,$repo,0,$maxresult+1);
//      echo "<pre>";var_dump($pkg);echo "</pre>";
      if($out>$maxresult){
	echo "Founded more than $maxresult results.<br /><br />";
	$out=$maxresult;
      }else{
	echo "Founded $out results:<br />";
      }
      if($out){
	$repos=null;
	for ( $i=0 ; $i < $out ; $i++ ){
	  $pkg->find();
	  if($repos != $pkg->reponame){
	    if($repos) tables();
	    echo "<br />Repository: {$pkg->reponame} - url: <a href={$pkg->url}>{$pkg->url}</a>";
	    $repos=$pkg->reponame;
	    tables(array("package","version","arch","location",'&npsp;'),1);
	  }
	  tables(array("<a href='show.php?pkg={$pkg->id}'>{$pkg->name}</a>",$pkg->version,$pkg->arch,"<a href='{$pkg->url}{$pkg->location}/'>{$pkg->location}/</a>","<a href='{$pkg->url}{$pkg->location}/{$pkg->filename}'>download</a>"));
	}
	tables();
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
	echo "Founded $out results:<br /><br />";
      }
      if($out){
	$repos="";
	$pack="";
	for ( $i=0 ; $i < $out ; $i++ ){
	  $fl->find();
	  if($repos != $fl->reponame){
	    if($repos) tables();
	    echo "<br />Repository: {$fl->reponame} - url: <a href='{$fl->url}'>{$fl->url}</a>";
	    $repos=$fl->reponame;
	    tables(array("package","version","file","path","location"),1);
	  }
	  tables(array("<a href='{$fl->url}{$fl->pkgloc}/{$fl->pkgfile}'>{$fl->pkgname}</a>",$fl->version."-".$fl->arch,$fl->filename,$fl->fullpath,"<a href='{$fl->url}{$fl->pkgloc}/'>{$fl->pkgloc}/</a>"));
	}
	tables();
      }
      echo "<br /><br /><br />";
    }
  }
?>
</pre>
<p>To report a bug mail to <a href='mailto:zerouno@slacky.eu'>zerouno@slacky.eu</a>. Thanks.</p>
</body></html>

