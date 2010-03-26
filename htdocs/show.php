<?php
  include 'inc/includes.inc.php';

  $db=new database();
  echo "<html><head><title>Package viewer</title></head><body>";
  echo "<pre>";
  $pkg=null;
  foreach($_GET as $key => $value)$$key=$value;


  if(!$pkg){
    echo "<b>No package selected</b>\n";
  }else{
    $pk=new package($pkg);
//    var_dump($pk);
    if(!$pk->id) {
      echo "<b>Invalid package</b>\n";
    }else{
      $repo=new repository($pk->repository);
      echo tables(array('',''),1,"0 cellpadding=0");
      echo tables(array("Repository:", "{$repo->name}"));
      echo tables(array("Repository description:", "{$repo->description}"));
      echo tables(array("Repository url:", "<a href={$repo->url}>{$repo->url}</a>"));
      echo tables(array("File list: ", ($repo->manifest)?("<a href={$repo->url}{$repo->manifest}>{$repo->manifest}</a>"):"None"));
      echo tables();
      echo tables(array('',''),1, "0 cellpadding=0");
      echo tables(array("Package name:",$pk->name));
      echo tables(array("Package version:",$pk->version));
      echo tables(array("Package arch:",$pk->arch));
      echo tables(array("Package build:",$pk->build));
      echo tables(array("Package compression:",$pk->compression));
      echo tables(array("Package location:", "<a href={$repo->url}{$pk->location}>{$pk->location}</a>"));
      echo tables(array("Package filename:", "<a href={$repo->url}{$pk->location}/{$pk->filename}>{$pk->filename}</a>"));
      echo tables();
      if($pk->description){
	echo "Description:\n";
	echo str_replace("\n","\n| ","\n".$pk->description);
      }
      if($repo->manifest){
	$list=new filelist();
	$nrow=$list->find('',$pkg);
	echo "\n\nThis package contain $nrow files:\n\n";
	while($line=$list->get()){
	  echo $line['fullpath'].$line['filename']."\n";
	}

      }
    }
  }
  echo "</pre>";
  echo "To report a bug, send a mail to <a href='mailto:zerouno@slacky.it'>zerouno@slacky.it</a>. Thanks.";
  echo "</body></html>";



    /*
  if ($name or $desc or $file) $db->counter_inc('searches');
  echo "Searched ".$db->counter_get('searches')." packages from 6 March 2010<br><br>";

  $repof=new repository();
  $repof->find();
  echo "<form action=? >";
  echo "<input type=hidden name=act value=search>";
  tables(array(),1,0);
  $select="<select name='repo'>\n";
  $select.="  <option value='0'".((!$repo)?" selected":"").">---  All repositories ---</option>\n";
  while ($repof->fetch()){ 
    $select.="  <option value='{$repof->id}'".(($repo==$repof->id)?" selected":"").">{$repof->name}";
    if(!$repof->manifest)$select.=" (no file search)";
    $select.="</option>\n"; 
  } 
  $select.="</select>";
  tables(array("Search from: ",$select));
  tables(array("Package name: ","<input name=name value='$name'>"));
  tables(array("Description: ","<input name=desc value='$desc'><br>"));
  tables(array("Filename: ","<input name=file value='$file'><br>"));
  tables(array("Use regexp: ","<input name=regexp type=checkbox ".(($regexp)?"checked":"").">"));
  tables();
  echo "<input type=submit value='go'>";

  echo "</form>";

  if ($name or $desc or $file){
    if(!$file){
      $pkg=new package();
      $out=$pkg->find($name,$desc,$repo,0,$maxresult+1);
//      echo "<pre>";var_dump($pkg);echo "</pre>";
      if($out>$maxresult){
	echo "Founded more than $maxresult results.<br><br>";
	$out=$maxresult;
      }else{
	echo "Founded $out results:<br>";
      }
      if($out){
	$repos=null;
	for ( $i=0 ; $i < $out ; $i++ ){
	  $pkg->find();
	  if($repos != $pkg->reponame){
	    if($repos) tables();
	    echo "<br>Repository: {$pkg->reponame} - url: <a href={$pkg->url}>{$pkg->url}</a>";
	    $repos=$pkg->reponame;
	    tables(array("package","version","arch","location"),1);
	  }
	  tables(array("<a href={$pkg->url}{$pkg->location}/{$pkg->filename}>{$pkg->name}</a>",$pkg->version,$pkg->arch,"<a href={$pkg->url}{$pkg->location}/>{$pkg->location}/</a>"));
	}
	tables();
      }
      echo "<br><br><br>";
    }else{
      $fl=new filelist();
      $out=$fl->find($file,$name,$desc,$repo,0,$maxresult+1,$regexp);
      echo "Time: ".(round($fl->db->msec,3))." msec<br>";
      if($out>$maxresult){
	echo "Founded more than $maxresult results<br><br>";
	$out=$maxresult;
      }else{
	echo "Founded $out results:<br><br>";
      }
      if($out){
	$repos="";
	$pack="";
	for ( $i=0 ; $i < $out ; $i++ ){
	  $fl->find();
	  if($repos != $fl->reponame){
	    if($repos) tables();
	    echo "<br>Repository: {$fl->reponame} - url: <a href={$fl->url}>{$fl->url}</a>";
	    $repos=$fl->reponame;
	    tables(array("package","version","file","path","location"),1);
	  }
	  tables(array("<a href={$fl->url}{$fl->pkgloc}/{$fl->pkgfile}>{$fl->pkgname}</a>",$fl->version."-".$fl->arch,$fl->filename,$fl->fullpath,"<a href={$fl->url}{$fl->pkgloc}/>{$fl->pkgloc}/</a>"));
	}
	tables();
      }
      echo "<br><br><br>";
    }
  }
     */

?>
