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
?>
<html><head>
  <title>Package viewer</title>
  <style type="text/css">
  <!--
    a:link    {text-decoration: none; color: blue;}
    a:visited {text-decoration: none; color: blue;}
    a:hover   {text-decoration: underline; color: red;}                                                                                                                                                           
    input {border:1px solid #000000;}                                                                                                                                                                             
  .tab {border:1px solid #000000;}                                                                                                                                                                         
  .tab td { border-top:1px solid #000000; border-right:1px dotted; }                                                                                                                                       
  .tab th { border-right:1px dotted; }                                                                                                                                                                     
  -->                                                                                                                                                                                                             
  </style>    
</head><body>
<?php
  include 'inc/includes.inc.php';

  $db=new database();
  echo "<pre>";
  echo "<a href='javascript:history.go(-1)'>Return to back</a> | <a href='index.php'>Go to home</a><br><br>";
  $pkg=null;
  foreach($_GET as $key => $value)$$key=$value;


  if(!$pkg){
    echo "<b>No package selected</b>\n";
  }else{
    $pk=new package($pkg);
    if(!$pk->id) {
      echo "<b>Invalid package</b>\n";
    }else{
      $repo=new repository($pk->repository);
      echo tables(array('',''),1,"class='tab'");
      echo tables(array("Repository:", "<a href='showrepo.php?repo={$repo->id}'>{$repo->name}</a>"));
      echo tables(array("Repository brief:", "{$repo->brief}"));
      echo tables(array("Repository description:", "{$repo->description}"));
      echo tables(array("Repository url:", "<a href={$repo->url}>{$repo->url}</a>"));
      echo tables(array("File list: ", ($repo->manifest)?("<a href={$repo->url}{$repo->manifest}>{$repo->manifest}</a>"):"None"));
      echo tables();
      echo tables(array('',''),1, "class='tab'");
      echo tables(array("Package name:",$pk->name));
      echo tables(array("Package version:",$pk->version));
      echo tables(array("Package arch:",$pk->arch));
      echo tables(array("Package build:",$pk->build));
      echo tables(array("Package compression:",$pk->compression));
      $reqs=explode(",",$pk->required);
      foreach($reqs as $key => $req){
	$areq=explode("|",$req);
	foreach($areq as $akey => $rr){
	  $rm=preg_replace("/ .*/","",$rr);
	  $areq[$akey]="<a href='index.php?name=$rm#results'>".htmlentities($rr)."</a>";
	}
	$reqs[$key]=implode("|",$areq);
      }
      $r=implode("<br>",$reqs);
      echo tables(array("<nobr>Package required</nobr>:",$r));

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
