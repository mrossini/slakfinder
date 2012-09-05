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
