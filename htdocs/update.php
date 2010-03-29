<?php

/*function shutterm(){ 
  echo "\n\n\npippo\n\n\n";
  die("\n\nreceived SIGTERM\n\n"); 
}*/
//pcntl_signal(SIGINT,"shutterm");
function shutdown() { 
  global $transact,$db;
  if($transact){
    echo "operazione annullata... rollback in corso!";
    $db->db->rollback();
    echo "fatto.";
  }

}
register_shutdown_function('shutdown');

include 'inc/includes.inc.php';
include 'inc/defrepo.inc.php';




$db=new database();

if(isset($_SERVER['DROPDB'])){
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
}

foreach($defrepo as $id => $repo)if($repo['info']['create']){
  $db->db->transact();
  $info=$repo['info'];
  $create=$info['create'];
  $repo['id']=$id;
  unset ($repo['info']);
  echo "REPOSITORY: $id => {$repo['name']}... ";
  $rep=new repository($id);
  if($rep->exists()){
    echo "già esiste... ";
    if($create==2){
      echo "distruzione forzata... ";
      if(!$out=$rep->drop()){
	echo "ERRORE NELLA DISTRUZIONE!!! ";
	echo "annullamento in corso... ";
	$db->db->rollback();
	echo "annullamento effettuato.. salto al prossimo repository.\n";
	continue;
      };
    }
    if($rep->exists()){
      if($rep->needupdate()){
	echo "richiede aggiornamento... ";
	echo "eliminazione in corso... ";
	if(!$rep->drop()){
	  echo "ERRORE SVUOTANDO IL REPOSITORY!!! ";
	  echo "annullamento in corso... ";
	  $db->db->rollback();
	  echo "annullamento effettuato.. salto al prossimo repository.\n";
	  continue;
	}
      }else{
	echo "già aggiornato!\n";
      }
    }
  }
  $rep=new repository($id);
  if(!$rep->exists()){
    echo "creazione repository... ";
    if(!$out=$rep->add($repo)){
      echo "ERRORE!!! ";
      echo "annullamento in corso... ";
      $db->db->rollback();
      echo "annullamento effettuato.. salto al prossimo repository.\n";
      continue;
    }
    echo "Creazione effettuata... ";
    echo "popolamento in corso...\n";
    if(!$err=$rep->popolate()){
      echo "\nERRORE!!! ";
      echo "annullamento in corso... ";
      $db->db->rollback();
      echo "annullamento effettuato.. salto al prossimo repository.\n";
      continue;
      die();
    }
    echo "Repository creato\n";
  }
  $db->db->commit();
}




echo "\n";


?>
