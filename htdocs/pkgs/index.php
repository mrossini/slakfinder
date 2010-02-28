<?php

include 'inc/includes.inc.php';
include 'inc/defrepo.inc.php';




$db=new database();


/*
echo "eliminazione database... ";
$out=$db->dropdb();
if(!$out){
  echo "errore!\n\n";
  echo "dettagli:\n";
  var_dump($db);
  die();
}else{
  echo "fatto\n";
}

echo "creazione database... ";
$out=$db->createdb();
if(!$out){
  echo "errore!\n\n";
  echo "dettagli:\n";
  var_dump($db);
  die();
}else{
  echo "fatto\n";
}
 */
foreach($defrepo as $name => $repo)if($repo['create']){
  $create=$repo['create'];
  unset ($repo['create']);
  echo "\n\nREPOSITORY: {$repo['name']}\n";
  $rep=new repository($repo['name']);
  if($rep->exists()){
    echo "già esiste\n";
    if($create==2){
      echo "distruzione forzata\n";
      if(!$out=$rep->drop()){
	echo "errore nella distruzione\n";
	var_dump($rep);
      };
    }
    if($rep->exists()){
      if($rep->needupdate()){
	echo "richiede aggiornamento\n";
	if(!$rep->truncate())die("errore svuotando il repository\n");
	echo "svuotato\n";
	if(!$rep->update())die("aggiornamento fallito\n");
	echo "aggiornato\n";
	if(!$rep->popolate())die("errore nel popolamento\n");
	echo "Popolamento rieffettuato\n";
	
      }else{
	echo "già aggiornato\n";
      }
    }
  }
  if(!$rep->exists()){
    echo "creazione repository:";
    if(!$out=$rep->add($repo)){
      echo "errore!\n";
      echo "dettagli errore:\n";
      var_dump($out);
      var_dump($rep);
      die();
    }else{
      echo "fatto.\n";
    }
    echo "Creazione effettuata\n";
    echo "popolamento in corso...";
    if(!$err=$rep->popolate()){
      echo "errore popolamento!\n";
      echo "dettagli errore:\n";
//      var_dump($rep,$err);
      die();
    }else{
      echo "fatto!                                                           \n";
    }
    echo "Popolamento effettuato\n";
  }
}




echo "\n";


?>
