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

$defrepo['slackware-13.0-patches']=array(
    'create' => 1,
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'official' => 1,
    'manifest' => 'patches/MANIFEST.bz2',
    'packages' => 'patches/PACKAGES.TXT',
    'hashfile' => 'patches/CHECKSUMS.md5.asc',
    'name' => 'slackware-13.0-patches',
    'description' => 'repository ufficiale di slackware 13.0, patch'
  );

$defrepo['slackware64-13.0-patches']=array(
    'create' => 1,
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/patches/',
    'official' => 1,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0-patches',
    'description' => 'repository ufficiale di slackware64 13.0, patch'
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

$defrepo['slacky-12.2']=array(
    'create' => 1,
    'url' => 'http://repository.slacky.eu/slackware-12.2/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slacky-12.2',
    'description' => 'repository ufficiale di slacky-12.2'
  );

$defrepo['gnome-slacky-12.2']=array(
    'create' => 1,
    'url' => 'http://repository.slacky.eu/gnome-slacky-12.2/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'packages' => 'PACKAGES.TXT',
    'name' => 'gnome-slacky-12.2',
    'description' => 'repository ufficiale di gnome slacky 12.2'
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
    'official' => 1,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix-current',
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

$defrepo['daniele50.it']=array(
    'create' => 1,
    'url' => 'http://www.daniele50.it/listing',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'daniele50.it',
    'description' => 'daniele50'
  );

$defrepo['linuxpackages-12.2-i386']=array(
    'create' => 1,
    'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-12.2-i386/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz',
    'name' => 'linuxpackages-12.2-i386',
    'description' => 'linuxpackages.net ver.12.2 per i386'
  );

$defrepo['linuxpackages-13.0-i386-sotirov']=array(
    'create' => 1,
    'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-13.0-i386/sotirov/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz',
    'name' => 'linuxpackages-13.0-i386-sotirov',
    'description' => 'linuxpackages.net ver.13.0 per i386 di sotirov'
  );

$defrepo['linuxpackages-13.0-i386-frias']=array(
    'create' => 1,
    'url' => 'http://ftp.naist.jp/pub/Linux/linuxpackages/Slackware/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'linuxpackages-13.0-i386-frias',
    'description' => 'linuxpackages.net ver.13.0 per i386 di frias'
  );

$defrepo['stabellini']=array(
    'create' => 1,
    'url' => 'http://www.stabellini.net/filesystem/repository/Stefano_Stabellini/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'stabellini',
    'description' => 'repo of stabellini'
  );

$defrepo['rworkman-for-12.2']=array(
    'create' => 1,
    'url' => 'http://rlworkman.net/pkgs/12.2/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'rlworkman-for-12.2',
    'description' => 'Robby Workman Repository'
  );

$defrepo['rworkman-for-current']=array(
    'create' => 1,
    'url' => 'http://rlworkman.net/pkgs/current/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'rlworkman-for-current',
    'description' => 'Robby Workman Repository'
  );

$defrepo['rworkman-for-13.0']=array(
    'create' => 1,
    'url' => 'http://rlworkman.net/pkgs/13.0/',
    'official' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'rlworkman-for-13.0',
    'description' => 'Robby Workman Repository'
  );

$defrepo['dia-tech-slack-13.0']=array(
    'create' => 1,
    'url' => 'http://www.dia-tech.net/linux/Slackware-13.0/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'ChangeLog.txt.gz',
    'name' => 'dia-tech-slack-13.0',
    'description' => 'Unknown'
  );

$defrepo['dia-tech-slack-12.2']=array(
    'create' => 1,
    'url' => 'http://www.dia-tech.net/linux/Slackware-12.2/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'ChangeLog.txt.gz',
    'name' => 'dia-tech-slack-12.2',
    'description' => 'Unknown'
  );

$defrepo['dia-tech-curr-kde4.4']=array(
    'create' => 1,
    'url' => 'http://www.dia-tech.net/linux/Slackware-current-kde4.4/',
    'official' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'ChangeLog.txt.gz',
    'name' => 'dia-tech-curr-kde4.4',
    'description' => 'Unknown'
  );


?>

