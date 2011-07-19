<?php


$defrepo=array();



$defrepo[1]=array( 'info' => array('create' => 1), 'name' => 'slackware64-current',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/', 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur',
   'manifest' => 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Official', 'description' => 'Slackware 64bit Official Distribution - Current Version');

$defrepo[2]=array( 'info' => array('create' => 1), 'name' => 'slackware-current',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/', 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
   'manifest' => false and 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Official', 'description' => 'Slackware 32bit Official Distribution - Current Version');

$defrepo[3]=array( 'info' => array('create' => 1), 'name' => 'slackware-12.2',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-12.2/', 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
   'manifest' => false and 'slackware/MANIFEST.bz2', 'packages' => 'http://www.stabellini.net/filesystem/slackware-12.2/PACKAGES.TXT',
   'brief' => 'Official', 'description' => 'Slackware 32bit Official Distribution - 12.2 Version');

$defrepo[4]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.0',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/', 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130',
   'manifest' => false and 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Official', 'description' => 'Slackware 64bit Official Distribution - 13.0 Version');

$defrepo[5]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.0',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and 'slackware/MANIFEST.bz2', 'packages' => 'http://www.stabellini.net/filesystem/slackware-13.0/PACKAGES.TXT',
   'brief' => 'Official', 'description' => 'Slackware 32bit Official Distribution - 13.0 Version');

$defrepo[6]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.0-patches',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and 'patches/MANIFEST.bz2', 'packages' => 'patches/PACKAGES.TXT',
   'brief' => 'Patches', 'description' => 'Slackware 32bit Official Patches for 13.0 Version');

$defrepo[7]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.0-patches',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/', 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130',
   'manifest' => false and 'patches/MANIFEST.bz2', 'packages' => 'patches/PACKAGES.TXT',
   'brief' => 'Patches', 'description' => 'Slackware 64bit Official Patches for 13.0 Version');

$defrepo[61]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.0-extra',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/', 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130',
   'manifest' => false and 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT',
   'brief' => 'Extra', 'description' => 'Slackware 64bit Official Extra Packages for 13.0 Version');

$defrepo[62]=array( 'info' => array('create' => 1), 'name' => 'slackware64-current-extra',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/', 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur',
   'manifest' => false and 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT',
   'brief' => 'Extra', 'description' => 'Slackware 64bit Official Extra Packages for Current Version');

$defrepo[63]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.0-extra',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT',
   'brief' => 'Extra', 'description' => 'Slackware 32bit Official Extra Packages for 13.0 Version');

$defrepo[64]=array( 'info' => array('create' => 1), 'name' => 'slackware-current-extra',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/', 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
   'manifest' => false and 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT',
   'brief' => 'Extra', 'description' => 'Slackware 32bit Official Extra Packages for Current Version');

$defrepo[65]=array( 'info' => array('create' => 1), 'name' => 'Slackware-13.37',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.37/', 'version' => '13.37', 'arch' => 'i386', 'class' => '32137',
   'manifest' => false and 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Official', 'description' => 'Slackware 32bit Official Distribution - 13.37 Version');

$defrepo[66]=array( 'info' => array('create' => 1), 'name' => 'Slackware-13.37-patches',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.37/', 'version' => '13.37', 'arch' => 'i386', 'class' => '32137',
   'manifest' => false and 'patches/MANIFEST.bz2', 'packages' => 'patches/PACKAGES.TXT',
   'brief' => 'Patches', 'description' => 'Slackware 32bit Official Patches for 13.37 Version');

$defrepo[67]=array( 'info' => array('create' => 1), 'name' => 'Slackware-13.37-extra',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.37/', 'version' => '13.37', 'arch' => 'i386', 'class' => '32137',
   'manifest' => false and 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT',
   'brief' => 'Extra', 'description' => 'Slackware 32bit Official Extra Packages for 13.37 Version');

$defrepo[68]=array( 'info' => array('create' => 1), 'name' => 'Slackware64-13.37',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.37/', 'version' => '13.37', 'arch' => 'x86_64', 'class' => '64137',
   'manifest' => false and 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Official', 'description' => 'Slackware 64bit Official Distribution - 13.37 Version');

$defrepo[69]=array( 'info' => array('create' => 1), 'name' => 'Slackware64-13.37-patches',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.37/', 'version' => '13.37', 'arch' => 'x86_64', 'class' => '64137',
   'manifest' => false and 'patches/MANIFEST.bz2', 'packages' => 'patches/PACKAGES.TXT',
   'brief' => 'Patches', 'description' => 'Slackware 64bit Official Patches for 13.37 Version');

$defrepo[70]=array( 'info' => array('create' => 1), 'name' => 'Slackware64-13.37-extra',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.37/', 'version' => '13.37', 'arch' => 'x86_64', 'class' => '64137',
   'manifest' => false and 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT',
   'brief' => 'Extra', 'description' => 'Slackware 64bit Official Extra Packages for 13.37 Version');

$defrepo[71]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.1',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.1/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Official', 'description' => 'Slackware 64bit Official Distribution - 13.1 Version');

$defrepo[72]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.1',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.1/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and 'slackware/MANIFEST.bz2', 'packages' => 'http://www.stabellini.net/filesystem/slackware-13.1/PACKAGES.TXT',
   'brief' => 'Official', 'description' => 'Slackware 32bit Official Distribution - 13.1 Version');

$defrepo[73]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.1-patches',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.1/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and 'patches/MANIFEST.bz2', 'packages' => 'patches/PACKAGES.TXT',
   'brief' => 'Patches', 'description' => 'Slackware 32bit Official Patches for 13.1 Version');

$defrepo[74]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.1-patches',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.1/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and 'patches/MANIFEST.bz2', 'packages' => 'patches/PACKAGES.TXT',
   'brief' => 'Patches', 'description' => 'Slackware 64bit Official Patches for 13.1 Version');

$defrepo[75]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.1-extra',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.1/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT',
   'brief' => 'Extra', 'description' => 'Slackware 64bit Official Extra Packages for 13.1 Version');

$defrepo[76]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.1-extra',
   'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.1/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT',
   'brief' => 'Extra', 'description' => 'Slackware 32bit Official Extra Packages for 13.1 Version');

$defrepo[9]=array( 'info' => array('create' => 1), 'name' => 'slacky-13.1',
   'url' => 'http://repository.slacky.eu/slackware-13.1/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware 13.1');

$defrepo[10]=array( 'info' => array('create' => 1), 'name' => 'slacky64-13.1',
   'url' => 'http://repository.slacky.eu/slackware64-13.1/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64137',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware64 13.1');

$defrepo[11]=array( 'info' => array('create' => 1), 'name' => 'slacky-13.0',
   'url' => 'http://repository.slacky.eu/slackware-13.0/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware 13.0');

$defrepo[12]=array( 'info' => array('create' => 1), 'name' => 'slacky-12.2',
   'url' => 'http://repository.slacky.eu/slackware-12.2/', 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware 12.2');

$defrepo[13]=array( 'info' => array('create' => 1), 'name' => 'gnome-slacky-12.2',
   'url' => 'http://repository.slacky.eu/gnome-slacky-12.2/', 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Gnome Slacky', 'description' => 'Slacky.eu Community s Repository of a Gnome 2.28.0 for Slackware 12.2');

$defrepo[14]=array( 'info' => array('create' => 1), 'name' => 'Slacky-13.37',
   'url' => 'http://repository.slacky.eu/slackware-13.37/', 'version' => '13.37', 'arch' => 'i386', 'class' => '32137',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware 13.37');

$defrepo[15]=array( 'info' => array('create' => 1), 'name' => 'Slacky64-13.37',
   'url' => 'http://repository.slacky.eu/slackware64-13.37/', 'version' => '13.37', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware64 13.37');

$defrepo[27]=array( 'info' => array('create' => 1), 'name' => 'gsb-gnome2.26',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-2.26_slackware-13.0/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gnome-2.26', 'description' => 'GSB Gnome 2.26.0 32bit for Slackware 13.0');

$defrepo[38]=array( 'info' => array('create' => 1), 'name' => 'gsb-gnome2.28-13.1',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-2.28_slackware-13.1/', 'version' => '13.1', 'arch' => 'i486', 'class' => '32131',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gnome-2.28', 'description' => 'GSB Gnome 2.28.0 bit for Slackware 13.1');

$defrepo[39]=array( 'info' => array('create' => 1), 'name' => 'gsb-gnome2.30-13.1',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-2.30_slackware-13.1/', 'version' => 'current', 'arch' => 'i486', 'class' => '32131',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gsb-gnome2.30', 'description' => 'GSB Gnome 2.30.0 bit for Slackware Current');

$defrepo[28]=array( 'info' => array('create' => 0), 'name' => 'gsb-gnome-current',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-current/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gsb-gnome2.28', 'description' => 'GSB Gnome 2.28.0 32bit for Slackware Current');

$defrepo[25]=array( 'info' => array('create' => 1), 'name' => 'gsb64-gnome2.26',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-2.26_slackware64-13.0/', 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gnome-2.26', 'description' => 'GSB Gnome 2.26.0 64bit for Slackware64 13.0');

$defrepo[59]=array( 'info' => array('create' => 1), 'name' => 'gsb64-gnome2.28-13.1',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-2.28_slackware64-13.1/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gnome-2.28', 'description' => 'GSB Gnome 2.28.0 64bit for Slackware64 13.1');

$defrepo[60]=array( 'info' => array('create' => 1), 'name' => 'gsb64-gnome2.30-13.1',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-2.30_slackware64-13.1/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gsb-gnome2.30', 'description' => 'GSB Gnome 2.30.0 64bit for Slackware64 Current');

$defrepo[26]=array( 'info' => array('create' => 0), 'name' => 'gsb64-gnome-current',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-current/', 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gsb-gnome2.28', 'description' => 'GSB Gnome 2.28.0 64bit for Slackware64 Current');

$defrepo[78]=array( 'info' => array('create' => 1), 'name' => 'gsb-gnome3.0-current',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-3.0_slackware-current/', 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gsb-gnome3.0', 'description' => 'x');

$defrepo[79]=array( 'info' => array('create' => 1), 'name' => 'gsb-gnome-current-13.1',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-current_slackware-13.1/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gsb-gnome-current', 'description' => 'x');

$defrepo[80]=array( 'info' => array('create' => 1), 'name' => 'gsb64-gnome3.0-current',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-3.0_slackware64-current/', 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gsb-gnome3.0', 'description' => 'x');

$defrepo[81]=array( 'info' => array('create' => 1), 'name' => 'gsb64-gnome-current-13.1',
   'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-current_slackware64-13.1/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'gsb-gnome-current', 'description' => 'x');

$defrepo[82]=array( 'info' => array('create' => 1), 'name' => 'elettrolinux-for-13.37',
   'url' => 'http://repository.elettrolinux.com/Slackware-13.37/', 'version' => '13.37', 'arch' => 'i386', 'class' => '32137',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Michele.P', 'description' => 'x');

$defrepo[19]=array( 'info' => array('create' => 1), 'name' => 'Salix-13.37',
   'url' => 'http://download.salixos.org/i486/13.37/', 'version' => '13.37', 'arch' => 'i386', 'class' => '32137',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Salix', 'description' => 'Salix 32bit Distribution perfectly compatible with Slackware 13.37');

$defrepo[20]=array( 'info' => array('create' => 1), 'name' => 'Salix64-13.37',
   'url' => 'http://download.salixos.org/x86_64/13.37/', 'version' => '13.37', 'arch' => 'x86_64', 'class' => '64137',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Salix64', 'description' => 'Salix 64bit Distribution perfectly compatible with Slackware64 13.37');

$defrepo[21]=array( 'info' => array('create' => 1), 'name' => 'salix-13.0',
   'url' => 'http://download.salixos.org/i486/13.0/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Salix', 'description' => 'Salix 32bit Distribution perfectly compatible with Slackware 13.0');

$defrepo[22]=array( 'info' => array('create' => 0), 'name' => 'salix-current',
   'url' => 'http://download.salixos.org/i486/current/', 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Salix', 'description' => 'Salix 32bit Distribution perfectly compatible with Slackware Current');

$defrepo[23]=array( 'info' => array('create' => 1), 'name' => 'salix64-13.0',
   'url' => 'http://download.salixos.org/x86_64/13.0/', 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Salix64', 'description' => 'Salix 64bit Distribution perfectly compatible with Slackware64 13.0');

$defrepo[24]=array( 'info' => array('create' => 0), 'name' => 'salix64-current',
   'url' => 'http://download.salixos.org/x86_64/current/', 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Salix64', 'description' => 'Salix 64bit Distribution perfectly compatible with Slackware64 Current');

$defrepo[29]=array( 'info' => array('create' => 1), 'name' => 'salix-13.1',
   'url' => 'http://download.salixos.org/i486/13.1/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Salix', 'description' => 'Salix 32bit Distribution perfectly compatible with Slackware 13.1');

$defrepo[30]=array( 'info' => array('create' => 1), 'name' => 'salix64-13.1',
   'url' => 'http://download.salixos.org/x86_64/13.1/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Salix64', 'description' => 'Salix 64bit Distribution perfectly compatible with Slackware64 13.1');

$defrepo[44]=array( 'info' => array('create' => 1), 'name' => 'rlworkman-for-13.1',
   'url' => 'http://rlworkman.net/pkgs/13.1/', 'version' => '13.1', 'arch' => 'mixed', 'class' => 'mi131',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Robby Workman', 'description' => 'Robby Workman s Packages for Slackware 13.1 32&64 bit');

$defrepo[40]=array( 'info' => array('create' => 1), 'name' => 'rlworkman-for-13.37',
   'url' => 'http://rlworkman.net/pkgs/13.37/', 'version' => '13.37', 'arch' => 'mixed', 'class' => 'mi137',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Robby Workman', 'description' => 'Robby Workman s Packages for Slackware 13.37 32&64 bit');

$defrepo[41]=array( 'info' => array('create' => 1), 'name' => 'rlworkman-for-12.2',
   'url' => 'http://rlworkman.net/pkgs/12.2/', 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Robby Workman', 'description' => 'Robby Workman s Packages for Slackware 12.2');

$defrepo[42]=array( 'info' => array('create' => 0), 'name' => 'rlworkman-for-current',
   'url' => 'http://rlworkman.net/pkgs/current/', 'version' => 'current', 'arch' => 'mixed', 'class' => 'micur',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Robby Workman', 'description' => 'Robby Workman s Packages for Slackware Current');

$defrepo[43]=array( 'info' => array('create' => 1), 'name' => 'rlworkman-for-13.0',
   'url' => 'http://rlworkman.net/pkgs/13.0/', 'version' => '13.0', 'arch' => 'mixed', 'class' => 'mi130',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Robby Workman', 'description' => 'Robby Workman s Packages for Slackware 13.0 32&64 bit');

$defrepo[18]=array( 'info' => array('create' => 1), 'name' => 'linuxpackages-13.1-i386',
   'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-13.1-i386/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'LinuxPackages', 'description' => 'Repository from LinuxPackages.net containing 32bit packages for Slackware 13.1');

$defrepo[31]=array( 'info' => array('create' => 1), 'name' => 'slackers.it',
   'url' => 'http://www.slackers.it/repository/', 'version' => 'current', 'arch' => 'mixed', 'class' => 'micur',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Slackers', 'description' => 'Repository from www.slackers.it. contains mixed 32 and 64 bit packages for Slackware Current');

$defrepo[32]=array( 'info' => array('create' => 1), 'name' => 'alien',
   'url' => 'http://connie.slackware.com/~alien/slackbuilds/', 'version' => 'mixed', 'arch' => 'mixed', 'class' => 'mimix',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Alien Bob', 'description' => 'Repository from Alien Bob (connie.slackware.com/~alien) containing mixed 32 and 64 bit packages for mixed Slackware versions');

$defrepo[37]=array( 'info' => array('create' => 1), 'name' => 'alien-restricted',
   'url' => 'http://ftp.slackware.org.uk/people/alien/restricted_slackbuilds/', 'version' => 'mixed', 'arch' => 'mixed', 'class' => 'mimix',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Alien Restricted', 'description' => 'Alien Alternative Repository for non U.S.A. people');

$defrepo[57]=array( 'info' => array('create' => 1), 'name' => 'nielshor-for-13.0',
   'url' => 'http://www.nielshorn.net/_download/slackware/packages/', 'version' => 'mixed', 'arch' => 'mixed', 'class' => 'mimix',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Niels Horn', 'description' => 'x');

$defrepo[35]=array( 'info' => array('create' => 0), 'name' => 'stabellini',
   'url' => 'http://www.stabellini.net/filesystem/repository/Stefano_Stabellini/', 'version' => '12.1', 'arch' => 'i386', 'class' => '32121',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Stabellini', 'description' => 'Repository from www.stabellini.net packages for Slackware 12.1');

$defrepo[55]=array( 'info' => array('create' => 0), 'name' => 'scxd-current',
   'url' => 'http://scxd.info/pub/', 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Scxd', 'description' => 'Scxd repository');

$defrepo[58]=array( 'info' => array('create' => 0), 'name' => 'chessgriffin-for-13.1',
   'url' => 'http://www.chessgriffin.com/pkgs/slackware/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Chess Griffin', 'description' => '');

$defrepo[33]=array( 'info' => array('create' => 1), 'name' => 'linuxpackages-12.2-i386',
   'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-12.2-i386/', 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'LinuxPackages', 'description' => 'Repository from LinuxPackages.net containing 32bit packages for Slackware 12.2');

$defrepo[34]=array( 'info' => array('create' => 1), 'name' => 'linuxpackages-13.0-i386-sotirov',
   'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-13.0-i386/sotirov/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'LP Sotirov', 'description' => 'Repository from LinuxPackages.net containing 32bit packages for Slackware 13.0');

$defrepo[56]=array( 'info' => array('create' => 1), 'name' => 'elettrolinux-for-13.0',
   'url' => 'http://repository.elettrolinux.com/Slackware-13.0/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Michele.P', 'description' => 'x');

$defrepo[77]=array( 'info' => array('create' => 1), 'name' => 'elettrolinux-for-13.1',
   'url' => 'http://repository.elettrolinux.com/Slackware-13.1/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Michele.P', 'description' => 'x');

$defrepo[50]=array( 'info' => array('create' => 0), 'name' => 'dia-tech-slack-13.1',
   'url' => 'http://www.dia-tech.net/linux/Slackware-13.1/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Aszabo', 'description' => 'Packages from Aszabo (www.dia-tech.net) for Slackware 13.1 32bit');

$defrepo[51]=array( 'info' => array('create' => 0), 'name' => 'dia-tech-slack-13.0',
   'url' => 'http://www.dia-tech.net/linux/Slackware-13.0/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Aszabo', 'description' => 'Packages from Aszabo (www.dia-tech.net) for Slackware 13.0 32bit');

$defrepo[52]=array( 'info' => array('create' => 0), 'name' => 'dia-tech-slack-12.2',
   'url' => 'http://www.dia-tech.net/linux/Slackware-12.2/', 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Aszabo', 'description' => 'Packages from Aszabo (www.dia-tech.net) for Slackware 12.2');

$defrepo[53]=array( 'info' => array('create' => 0), 'name' => 'dia-tech-curr-kde4.4',
   'url' => 'http://www.dia-tech.net/linux/Slackware-current-kde4.4/', 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Aszabo for kde 4.4', 'description' => 'Kde 4.4 from Aszabo (www.dia-tech.net) for Slackware Current');

$defrepo[36]=array( 'info' => array('create' => 0), 'name' => 'c4dwbspace-jimmy_page_89-x86_64',
   'url' => 'http://danixland.net/packages/slackware64-13.0/', 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Jimmy_page_89', 'description' => 'Jimmy_page_89 (c4dwbspace.altervista.org) packages for Slackware64-13.0. thanx to Danix for webspace');

$defrepo[54]=array( 'info' => array('create' => 0), 'name' => 'danix-current64',
   'url' => 'http://danixland.net/packages/slackware64-current/', 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur',
   'manifest' => false and '', 'packages' => 'PACKAGES.TXT.gz',
   'brief' => 'Danix', 'description' => 'Repository from Danix (danixland.net) for Slackware64 Current');

$defrepo[45]=array( 'info' => array('create' => 0), 'name' => 'schoepfer.info-x86_64-13.0',
   'url' => 'http://slackware.schoepfer.info/13.0_64/', 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130',
   'manifest' => false and 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Johannes Schopfer', 'description' => 'Packages from Johannes Schopfer (schoepfer.info) for Slackware64 13.0');

$defrepo[46]=array( 'info' => array('create' => 0), 'name' => 'schoepfer.info-i386-13.0',
   'url' => 'http://slackware.schoepfer.info/13.0/', 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
   'manifest' => false and 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Johannes Schopfer', 'description' => 'Packages from Johannes Schopfer (schoepfer.info) for Slackware 13.0 32bit');

$defrepo[47]=array( 'info' => array('create' => 0), 'name' => 'schoepfer.info-i386-12.2',
   'url' => 'http://slackware.schoepfer.info/12.2/', 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
   'manifest' => false and 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Johannes Schopfer', 'description' => 'Packages from Johannes Schopfer (schoepfer.info) for Slackware 12.2');

$defrepo[48]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-i386-13.1',
   'url' => 'http://slackware.schoepfer.info/13.1/', 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Johannes Schopfer', 'description' => 'Packages from Johannes Schopfer (schoepfer.info) for Slackware 13.1 32bit');

$defrepo[49]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-x86_64-13.1',
   'url' => 'http://slackware.schoepfer.info/13.1_64/', 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
   'manifest' => false and 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Johannes Schopfer', 'description' => 'Packages from Johannes Schopfer (schoepfer.info) for Slackware 13.1 64bit');

$defrepo[83]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-x86_64-noarch',
   'url' => 'http://slackware.schoepfer.info/13.1_noarch/', 'version' => '13.1', 'arch' => 'noarch', 'class' => 'mi131',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Johannes Schopfer', 'description' => 'Packages from Johannes Schopfer (schoepfer.info) for Slackware 13.1 noarch');

$defrepo[8]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-i386-13.1',
   'url' => 'http://slackware.schoepfer.info/13.37/', 'version' => '13.37', 'arch' => 'i386', 'class' => '32131',
   'manifest' => false and 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Johannes Schopfer', 'description' => 'Packages from Johannes Schopfer (schoepfer.info) for Slackware 13.37 32bit');

$defrepo[16]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-x86_64-13.1',
   'url' => 'http://slackware.schoepfer.info/13.37_64/', 'version' => '13.37', 'arch' => 'x86_64', 'class' => '64137',
   'manifest' => false and 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Johannes Schopfer', 'description' => 'Packages from Johannes Schopfer (schoepfer.info) for Slackware 13.37 64bit');

$defrepo[17]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-x86_64-noarch',
   'url' => 'http://slackware.schoepfer.info/13.37_noarch/', 'version' => '13.37', 'arch' => 'noarch', 'class' => 'mi131',
   'manifest' => false and 'MANIFEST.bz2 ', 'packages' => 'PACKAGES.TXT',
   'brief' => 'Johannes Schopfer', 'description' => 'Packages from Johannes Schopfer (schoepfer.info) for Slackware 13.37 noarch');

?>
