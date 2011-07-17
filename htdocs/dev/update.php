<?php



/*
 * Parametri:
 *
 * DROPDB: Elimina e ricostruisce il Database ad eccezione dei contatori che vengono preservati
 * REPO=id: Analizza esclusivamente il repository specificato
 * REDEFINE: Ridefinisce e fixa nel database le intestazioni del repository, senza riscaricare tutto
 * SHOWQ: Mostra le query che vengono eseguite
 * DEBUG: Abilita modalità di debugging
 *
 */

$NL="\n";
if(isset($_SERVER['HTTP_HOST'])){
  $NL="<br>\n";

}

function shutdown() { 
  global $transact,$db;
  if($transact){
    echo "operazione annullata... rollback in corso!";
    $db->rollback();
    echo "fatto.";
  }
  flush();

}
register_shutdown_function('shutdown');

include 'inc/includes.inc.php';




$db=new database();

echo "svuotamento cache$NL";
$db->db->dropcache();
if(isset($_SERVER['DROPDB'])or isset($_GET['DROPDB'])){
  echo "eliminazione database... ";
  $out=$db->dropdb();
  if(!$out){
    echo "errore!$NL$NL";
    echo "dettagli:$NL";
    var_dump($db);
    die();
  }else{
    echo "fatto$NL";
  }

  echo "creazione database... ";
  $out=$db->createdb();
  if(!$out){
    echo "errore!$NL$NL";
    echo "dettagli:$NL";
    var_dump($db);
    die();
  }else{
    echo "fatto$NL";
  }
}

if(isset($_SERVER['REPO'])){
  $defrepo=array($_SERVER['REPO'] => $defrepo[$_SERVER['REPO']]);
}
if(isset($_GET['REPO'])){
  $defrepo=array($_GET['REPO'] => $defrepo[$_GET['REPO']]);
}
foreach($defrepo as $id => $repo){ 
  if(isset($_SERVER['CREATE'])) $repo['info']['create']=$_SERVER['CREATE'];
  if(isset($_GET['CREATE'])) $repo['info']['create']=$_SERVER['CREATE'];
  echo "REPOSITORY: $id => {$repo['name']}... ";
  if(!$repo['info']['create']){
    echo "skipped\n";
  }else{
    flush();
    $db->transact();
    $info=$repo['info'];
    $create=$info['create'];
    
    $repo['id']=$id;
    unset ($repo['info']);
    flush();
    $rep=new repository($id);
    if($create==3){
      echo "rimozione...";
      if(!$out=$rep->drop()){
	echo "ERRORE NELLA DISTRUZIONE!!! ";
	echo "annullamento in corso... ";
	$db->rollback();
	echo "annullamento effettuato.. salto al prossimo repository.$NL";
	continue;
      };
      $db->commit();
      echo "rimozione effettuata.$NL";
      continue;
    }
    if($rep->exists()){
      if(isset($_SERVER['REDEFINE'])or isset($_GET['REDEFINE'])){
	$rep->redefine($repo,(isset($_SERVER['REDEFINE'])?$_SERVER['REDEFINE']:0)+(isset($_GET['REDEFINE'])?$_GET['REDEFINE']:0));
	$db->commit();
	echo "aggiornato$NL";
	continue;
      }
      echo "già esiste... ";
      if($create==2){
	echo "distruzione forzata... ";
	if(!$out=$rep->drop()){
	  echo "ERRORE NELLA DISTRUZIONE!!! ";
	  echo "annullamento in corso... ";
	  $db->rollback();
	  echo "annullamento effettuato.. salto al prossimo repository.$NL";
	  continue;
	};
      }

      if($rep->exists()){
	if($rep->needupdate()){
	  echo "richiede aggiornamento... ";
	  echo "eliminazione in corso... ";
	  flush();
	  if(!$rep->drop()){
	    echo "ERRORE SVUOTANDO IL REPOSITORY!!! ";
	    echo "annullamento in corso... ";
	    $db->rollback();
	    echo "annullamento effettuato.. salto al prossimo repository.$NL";
	    continue;
	  }
	}else{
	  echo "già aggiornato!$NL";
	}
      }
    }
    flush();
    $rep=new repository($id);
    if(!$rep->exists()){
      echo "creazione repository... ";
      if(!$out=$rep->add($repo)){
	echo "ERRORE!!! ";
	echo "annullamento in corso... ";
	$db->rollback();
	echo "annullamento effettuato.. salto al prossimo repository.$NL";
	continue;
      }
      echo "Creazione effettuata... ";
      echo "popolamento in corso...$NL";
      flush();
      if(!$err=$rep->popolate()){
	echo $NL."ERRORE!!! ";
	echo "annullamento in corso... ";
	$db->rollback();
	echo "annullamento effettuato.. salto al prossimo repository.$NL";
	continue;
	die();
      }
      echo "Repository creato$NL";
    }
    $db->commit();
  }
}




echo "$NL";


?>
