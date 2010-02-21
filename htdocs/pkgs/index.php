<?php

include 'inc/includes.inc.php';
include 'inc/defrepo.inc.php';


//echo "<html><head><title>test</title></head><body>\n";


$db=new database();
$out=$db->createdb();
var_dump($out);


foreach($defrepo as $name => $repo){
  echo "\n\nrepository: $name\n";
  $rep=new repository($name);
  if($rep->exists()){
    echo "già esiste\n";
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
  }else{
    echo "creazione in corso\n";
    if(!$rep->add($repo))die("creazione repo fallita\n");
    echo "Creazione effettuata\n";
    if(!$rep->popolate())die("errore nel popolamento\n");
    echo "Popolamento effettuato\n";
  }
}


//echo "</body></html>\n";


echo "\n";


?>
