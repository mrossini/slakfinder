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
    input {border:1px solid #000000;}
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

  $maxresult=30;
  $start=0;
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

<form action='index.php?#results'>
  <input type='hidden' name='start' value='0'>
  <input type='hidden' name='maxresult' value='<?php echo $maxresult; ?>'>
  <?php echo writerepos($repo); ?>
  <a name='results'></a>
  <nobr>Search: <input name='name' value='<?php echo $name; ?>' /> 
        <input type='submit' value='go' /> - 
	Description: <input name='desc' value='<?php echo $desc; ?>' /> - 
        Filename: <input name='file' value='<?php echo $file; ?>' /> - 
	<input name='regexp' type='checkbox' <?php echo(($regexp)?"checked='checked'":""); ?> /> Use regexp</nobr>
  </form>
  <pre>
<?php

  if ($name or $desc or $file){
    if(!$file){
      $pkg=new package();
      $nres=$pkg->find($name,$desc,$repo);
      if(isset($_GET['debug']))var_dump($pkg,$nres);
      $to=$start+$maxresult; if($to > $nres)$to=$nres;
      echo "Results ".($start+1)."-$to of $nres:                    ";
	if($start > 0){
	  echo "<a href='index.php?start=0&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file#results'>&lt;&lt;</a>  ";
	  $from=$start-$maxresult;if($from<0)$from=0;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file#results'>&lt;</a>  ";
	}
	if($to < $nres){
	  $pg=round($nres/$maxresult-0.5,0);
	  $from=$start+$maxresult;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file#results'>&gt;</a>  ";
	  $from=$maxresult*$pg;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file#results'>&gt;&gt;</a>  ";
	}
      if($nres>$start){
	echo tables(array("rank","package","version","arch","distro","repository","location",'&nbsp;'),1,"class='results' width='100%'");
	$repos=null;
	$pkg->find(null,$start);
	for ( $i=$start ; $i < $to; $i++ ){
	  $pkg->find();
	  echo tables(array(
	    $pkg->rank,
	    "<a href='show.php?pkg={$pkg->id}'>{$pkg->name}</a>",
	    $pkg->version,
	    $pkg->arch,
	    $pkg->repover,
	    "<a href='{$pkg->url}'>{$pkg->repodesc}</a>",
	    "<a href='{$pkg->url}{$pkg->location}/'>{$pkg->location}/</a>",
	    "<a href='{$pkg->url}{$pkg->location}/{$pkg->filename}'>download</a>"));
	}
	echo tables();
	if($start > 0){
	  echo "<a href='index.php?start=0&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file#results'>&lt;&lt;</a>  ";
	  $from=$start-$maxresult;if($from<0)$from=0;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file#results'>&lt;</a>  ";
	}
	if($to < $nres){
	  $pg=round($nres/$maxresult-0.5,0);
	  $from=$start+$maxresult;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file#results'>&gt;</a>  ";
	  $from=$maxresult*$pg;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file#results'>&gt;&gt;</a>  ";
	}
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
