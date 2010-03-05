<?php
$defrepo=array();

$defrepo['slackware64-current']=array(
    'create' => 1,
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/',
    'official' => 1,
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-current',
    'description' => 'repository ufficiale di slackware64 current'
  );

$defrepo['slackware-current']=array(
    'create' => 1,
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/',
    'official' => 1,
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-current',
    'description' => 'repository ufficiale di slackware current'
  );

$defrepo['slackware-12.2']=array(
    'create' => 1,
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-12.2/',
    'official' => 1,
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-12.2',
    'description' => 'repository ufficiale di slackware 12.2'
  );

$defrepo['slackware64-13.0']=array(
    'create' => 1,
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/',
    'official' => 1,
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0',
    'description' => 'repository ufficiale di slackware64 13.0'
  );

$defrepo['slackware-13.0']=array(
    'create' => 1,
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'official' => 1,
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-13.0',
    'description' => 'repository ufficiale di slackware 13.0'
  );

$defrepo['slacky-13.0']=array(
    'create' => 1,
    'url' => 'http://repository.slacky.eu/slackware-13.0/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slacky-13.0',
    'description' => 'repository ufficiale di slacky-13.0'
  );

$defrepo['slackware64-13.0-localhost']=array(
    'create' => 0,
    'url' => 'http://localhost/slak/htdocs/data/slackware64-13.0/',
    'official' => 1,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0-localhost',
    'description' => 'localhost del repository ufficiale di slackware64 13.0'
  );

$defrepo['slackware64-13.0-local']=array(
    'create' => 0,
    'url' => 'file:///var/www/htdocs/slak/htdocs/data/slackware64-13.0/',
    'official' => 1,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0-local',
    'description' => 'copia locale del repository ufficiale di slackware64 13.0'
  );

$defrepo['slackers.it']=array(
    'create' => 1,
    'url' => 'http://www.slackers.it/repository/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'slackers.it',
    'description' => 'repository di pacchetti non ufficiali'
  );

$defrepo['alien']=array(
    'create' => 1,
    'url' => 'http://connie.slackware.com/~alien/slackbuilds/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'alien',
    'description' => 'repository di pacchetti semiufficiali'
  );

$defrepo['salix-13.0']=array(
    'create' => 1,
    'url' => 'http://download.salixos.org/i486/13.0/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix-13.0',
    'description' => 'repository di pacchetti di salix-13.0'
  );

$defrepo['salix-current']=array(
    'create' => 1,
    'url' => 'http://download.salixos.org/i486/current/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'sali-current',
    'description' => 'repository di pacchetti di salix-current'
  );

$defrepo['salix64-13.0']=array(
    'create' => 1,
    'url' => 'http://download.salixos.org/x86_64/13.0/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix64-13.0',
    'description' => 'repository di pacchetti di salix64-13.0'
  );

$defrepo['salix64-current']=array(
    'create' => 1,
    'url' => 'http://download.salixos.org/x86_64/current/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix64-current',
    'description' => 'repository di pacchetti di salix64-current'
  );

?>
