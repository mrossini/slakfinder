<?php

include 'inc/includes.inc.php';
include 'inc/defrepo.inc.php';


//echo "<html><head><title>test</title></head><body>\n";


$db=new database();
$out=$db->createdb();
if(!$out){die("collegamento fallito");}
foreach($defrepo as $repo){
  $rep=new repository();
  $out=$rep->add($repo);
  if(!$out){var_dump($db);die("creazione repo fallita");}
  $out=$rep->popolate();
}


//echo "</body></html>\n";


echo "\n";


?>
