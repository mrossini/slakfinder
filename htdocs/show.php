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




?>
