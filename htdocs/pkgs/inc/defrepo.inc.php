<?php
$defrepo=array();

/*
$defrepo['slackware64-13.0']=array(
    'url' => 'ftp://ftp.osuosl.org/pub/slackware/slackware64-13.0/',
    'official' => 1,
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0',
    'description' => 'repository ufficiale di slackware64 13.0'
  );

$defrepo['slacky-13.0']=array(
    'url' => 'http://repository.slacky.eu/slackware-13.0/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slacky-13.0',
    'description' => 'repository ufficiale di slacky-13.0'
  );
 */
$defrepo['slackware64-13.0-localhost']=array(
    'url' => 'http://localhost/slak/htdocs/data/slackware64-13.0/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'local64-13.0',
    'description' => 'localhost del repository ufficiale di slackware64 13.0'
  )
/*$defrepo['slackware64-13.0-local']=array(
    'url' => 'file:///var/www/htdocs/slak/htdocs/data/slackware64-13.0/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'local64-13.0',
    'description' => 'copia locale del repository ufficiale di slackware64 13.0'
  );
 */

?>
