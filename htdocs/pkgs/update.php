<?php

/*function shutterm(){ 
  echo "\n\n\npippo\n\n\n";
  die("\n\nreceived SIGTERM\n\n"); 
}*/
//pcntl_signal(SIGINT,"shutterm");
function shutdown() { 
  global $transact,$db;
  if($transact)$db->db->rollback();
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

foreach($defrepo as $name => $repo)if($repo['create']){
  $db->db->transact();
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
	echo "eliminazione in corso";
	if(!$rep->drop()){var_dump($rep);die("errore svuotando il repository\n");}
      }else{
	echo "già aggiornato\n";
      }
    }
  }
  $rep=new repository($repo['name']);
  if(!$rep->exists()){
    echo "creazione repository:";
    if(!$out=$rep->add($repo)){
      echo "errore!\n";
      echo "dettagli errore:\n";
      var_dump($out);
      var_dump($rep);
   //   $db->db->rollback();
      die();
    }else{
      echo "fatto.\n";
    }
    echo "Creazione effettuata\n";
    echo "popolamento in corso...";
    if(!$err=$rep->popolate()){
      echo "\n";
      echo "errore popolamento!\n";
      echo "dettagli errore:\n";
//      var_dump($rep,$err);
  //    $db->db->rollback();
      die();
    }else{
      echo "\nfatto!                                                           \n";
    }
    echo "Popolamento effettuato\n";
  }
  $db->db->commit();
}




echo "\n";


?>
