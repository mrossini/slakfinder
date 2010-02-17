<?php
include 'inc/includes.inc.php';

//echo "<html><head><title>test</title></head><body>\n";


$db=new pkgsdb();
$out=$db->createdb();
var_dump($out);
if(!$out){var_dump($db);die();}
$out=$db->addrepository(
  array(
    'url' => 'ftp://ftp.osuosl.org/pub/slackware/slackware64-13.0/slackware64/',
    'official' => 1,
    'manifest' => 'MANIFEST',
    'packages' => 'PACKAGES.TXT',
    'alias' => 'slackware64-13.0',
    'description' => '',
    'path' => 'data/slackware64-13.0/slackware64/'
  )
);
var_dump($out);
if(!$out)var_dump($db);


//echo "</body></html>\n";


echo "\n";


?>
