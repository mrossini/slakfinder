<?php

if (!isset($_SERVER["_"])){

if(isset($_GET['PASS'])){
  $PASS=$_GET['PASS'];
}else{
  echo "Password non inserita!!!";
  die();
}

if($PASS != date('j')){
  echo "Password errata!!!";
  die();
}
}
/*
 * Parametri:
 *
 * DROPDB: Elimina e ricostruisce il Database ad eccezione dei contatori che vengono preservati
 * REPO=id: Analizza esclusivamente il repository specificato
 * REDEFINE: Ridefinisce e fixa nel database le intestazioni del repository, senza riscaricare tutto
 * SHOWQ: Mostra le query che vengono eseguite
 * DEBUG: Abilita modalità di debugging
 * DIE: Su fallimento non continuare l'esecuzione
 *
 */

$NL="\n";
if(isset($_SERVER['HTTP_HOST'])){
//  $NL="<br>\n";
  echo "<pre>";
}

$repoinprogress=0;
function shutdown() { 
  global $db,$repoinprogress;
  if($repoinprogress){
    echo "DISTRUZIONE REPOSITORY ($repoinprogress) in corso...";
    $rep=new repository($repoinprogress);
    $repoinprogress=0;
    $rep->drop();
    echo "REPOSITORY DISTRUTTO.";
  }
  echo "Chiusura applicazione";
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
if(isset($_SERVER['CREATE'])){ $repo['info']['create']=$_SERVER['CREATE']; }
if(isset($_GET['CREATE'])){ $repo['info']['create']=$_GET['CREATE']; }
if($repo['info']['create']){
  flush();
  $info=$repo['info'];
  $create=$info['create'];
  $repo['id']=$id;
  unset ($repo['info']);
  echo "REPOSITORY: $id => {$repo['name']}... ";
  flush();
  $rep=new repository($id);
  if($create==3){
    echo "rimozione...";
    if(!$out=$rep->drop()){
      echo "ERRORE NELLA DISTRUZIONE!!! ";
      if(isset($_SERVER['DIE'])or isset($GET['DIE'])){die();}else {continue;}
    };
    echo "rimozione effettuata.$NL";
    continue;
  }
  if($rep->exists()){
    if(isset($_SERVER['REDEFINE'])or isset($_GET['REDEFINE'])){
      $rep->redefine($repo,(isset($_SERVER['REDEFINE'])?$_SERVER['REDEFINE']:0)+(isset($_GET['REDEFINE'])?$_GET['REDEFINE']:0));
      echo "aggiornato$NL";
      continue;
    }
    echo "già esiste... ";
    if($create==2){
      echo "distruzione forzata... ";
      if(!$out=$rep->drop()){
	echo "ERRORE NELLA DISTRUZIONE!!! ";
	if(isset($_SERVER['DIE'])or isset($GET['DIE'])){die();}else {continue;}
      };
    }

    if($rep->exists()){
      if($rep->needupdate()){
	echo "richiede aggiornamento... ";
	echo "eliminazione in corso... ";
	flush();
	if(!$rep->drop()){
	  echo "ERRORE SVUOTANDO IL REPOSITORY!!! ";
	  if(isset($_SERVER['DIE'])or isset($GET['DIE'])){die();}else {continue;}
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
    $repoinprogress=$id;
    if(!$out=$rep->add($repo)){
      echo "ERRORE aggiungendo il repository!!! ";
      echo "DISTRUZIONE in corso... ";
      if(!$out=$rep->drop()){
	$repoinprogress=0;
	echo "ERRORE NELLA DISTRUZIONE!!! ";
	if(isset($_SERVER['DIE'])or isset($GET['DIE'])){die();}else {continue;}
      };
      $repoinprogress=0;
      echo "DISTRUZIONE effettuata.. salto al prossimo repository.$NL";
      if(isset($_SERVER['DIE'])or isset($GET['DIE'])){die();}else {continue;}
    }
    $repoinprogress=0;
    echo "Creazione effettuata... ";
    echo "popolamento in corso...$NL";
    flush();
    $repoinprogress=$id;
    if(!$err=$rep->popolate()){
      echo $NL."ERRORE popolando il repository!!! ";
      echo "DISTRUZIONE in corso... ";
      if(!$out=$rep->drop()){
	$repoinprogress=0;
	echo "ERRORE NELLA DISTRUZIONE!!! ";
	if(isset($_SERVER['DIE'])or isset($GET['DIE'])){die();}else {continue;}
      };
      $repoinprogress=0;
      echo "DISTRUZIONE effettuato.. salto al prossimo repository.$NL";
      if(isset($_SERVER['DIE'])or isset($GET['DIE'])){die();}else {continue;}
    }
    $repoinprogress=0;
    echo "Repository creato$NL";
  }
}}

echo "{$NL}";