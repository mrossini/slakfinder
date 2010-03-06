<?php
  include 'inc/includes.inc.php';

  function tables($data=null,$what=2,$border=1){
    if(!is_null($data)){
      if($what==1){
	echo "<table border=$border cellspacing=0>\n";
	if($data){
	  echo "  <tr>";
	  foreach($data as $value) echo "<th>$value</th>";
	  echo "</tr>\n";
	}
      }elseif($what==2){
	echo "  <tr>";
	foreach($data as $value) echo "<td>$value</td>";
	echo "</tr>\n";
      }
    }else{
      echo "</table>\n";
    }
  }

  $maxresult=80;
  $db=new database();
  echo "<html><head><title>Ricerca</title></head><body>";
  echo "<pre>";
  session_start();
  if(!isset($_SESSION['searcher_visitor'])){
    $db->counter_inc('visits');
    $_SESSION['searcher_visitor']=$db->counter_get('visits');
  }
  echo "Tu sei il ".$_SESSION['searcher_visitor']."° visitatore<br>";
  $regexp=$name=$desc=$file=$repo=null;
  foreach($_GET as $key => $value)$$key=$value;
  if ($name or $desc or $file) $db->counter_inc('searches');
  echo "Sono state fatte finora ".$db->counter_get('searches')." ricerche<br><br>";

  $repof=new repository();
  $repof->find();
  echo "<form action=? >";
  echo "<input type=hidden name=act value=search>";
  tables(array(),1,0);
  $select="<select name='repo'>\n";
  $select.="  <option value='0'".((!$repo)?" selected":"").">---  Tutti i repository ---</option>\n";
  while ($repof->fetch()){ 
    $select.="  <option value='{$repof->id}'".(($repo==$repof->id)?" selected":"").">{$repof->name}";
    if(!$repof->manifest)$select.=" (no filelist)";
    $select.="</option>\n"; 
  } 
  $select.="</select>";
  tables(array("Cerca su: ",$select));
  tables(array("Nome pacchetto: ","<input name=name value='$name'>"));
  tables(array("Descrizione: ","<input name=desc value='$desc'><br>"));
  tables(array("Lista file: ","<input name=file value='$file'><br>"));
  tables(array("Usa regexp: ","<input name=regexp type=checkbox ".(($regexp)?"checked":"").">"));
  tables();
  echo "<input type=submit value='vai'>";

  echo "</form>";

  if ($name or $desc or $file){
    if(!$file){
      $pkg=new package();
      $out=$pkg->find($name,$desc,$repo,0,$maxresult+1);
//      echo "<pre>";var_dump($pkg);echo "</pre>";
      if($out>$maxresult){
	echo "La ricerca nei pacchetti ha generato più di $maxresult risultati. restringere i criteri di ricerca<br><br>";
	$out=$maxresult;
      }else{
	echo "La ricerca nei pacchetti ha generato $out risultati:<br>";
      }
      if($out){
	$repos=null;
	for ( $i=0 ; $i < $out ; $i++ ){
	  $pkg->find();
	  if($repos != $pkg->reponame){
	    if($repos) tables();
	    echo "<br>Repository: {$pkg->reponame} - url: <a href={$pkg->url}>{$pkg->url}</a>";
	    $repos=$pkg->reponame;
	    tables(array("pacchetto","versione","arch","posizione"),1);
	  }
	  tables(array("<a href={$pkg->url}{$pkg->location}{$pkg->filename}>{$pkg->name}</a>",$pkg->version,$pkg->arch,"<a href={$pkg->url}{$pkg->location}>{$pkg->location}</a>"));
	}
	tables();
      }
      echo "<br><br><br>";
    }else{
      $fl=new filelist();
      $out=$fl->find($file,$name,$desc,$repo,0,$maxresult+1,$regexp);
      echo "Tempo: ".(round($fl->db->msec,3))." millisecondi<br>";
      if($out>$maxresult){
	echo "La ricerca nella lista file ha generato più di $maxresult risultati. restringere i criteri di ricerca<br><br>";
	$out=$maxresult;
      }else{
	echo "La ricerca nella lista file ha generato $out risultati:<br><br>";
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
	  tables(array("<a href={$fl->url}{$fl->pkgloc}{$fl->pkgfile}>{$fl->pkgname}</a>",$fl->version."-".$fl->arch,$fl->filename,$fl->fullpath,"<a href={$fl->url}{$fl->pkgloc}>{$fl->pkgloc}</a>"));
	}
	tables();
      }
      echo "<br><br><br>";
    }
  }
  echo "</pre>";
  echo "</body></html>";

?>
