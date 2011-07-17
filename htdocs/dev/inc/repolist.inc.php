<?php



$defrepo=array();












###### SLACKWARE OFFICIAL ########
#
/**** SLACK 12.2 ****/
// 32bit
$defrepo[3]=array( 'info' => array('create' => 1), 'name' => 'slackware-12.2',
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-12.2/',
    'rank' => 30, 'version' => '12.2', 'arch' => 'i386', 'class' => '32122', 'deps' => 1,
    'manifest' => 'slackware/MANIFEST.bz2', 'packages' => 'http://www.stabellini.net/filesystem/slackware-12.2/PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Official', 'description' => 'Slackware 32bit Official Distribution - 12.2 Version');
/**** END SLACK 12.2 ****/
//
/**** SLACK 13.0 ****/
// 32bit
$defrepo[5]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.0', // distro
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'rank' => 30, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130', 'deps' => 1,
    'manifest' => 'slackware/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/i486/slackware-13.0/PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Official', 'description' => 'Slackware 32bit Official Distribution - 13.0 Version');
$defrepo[6]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.0-patches', // patch
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'rank' => 30, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130', 'deps' => 1,
    'manifest' => 'patches/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/i486/slackware-13.0/patches/PACKAGES.TXT', 'filelist' => 'patches/FILE_LIST',
    'brief' => 'Patches', 'description' => 'Slackware 32bit Official Patches for 13.0 Version');
$defrepo[63]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.0-extra', // extra
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'rank' => 30, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130', 'deps' => 1,
    'manifest' => 'extra/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/i486/slackware-13.0/extra/PACKAGES.TXT', 'filelist' => 'extra/FILE_LIST',
    'brief' => 'Extra', 'description' => 'Slackware 32bit Official Extra Packages for 13.0 Version');
// 64bit
$defrepo[4]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.0', // distro
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/',
    'rank' => 30, 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130', 'deps' => 1,
    'manifest' => 'slackware64/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/x86_64/slackware-13.0/PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Official', 'description' => 'Slackware 64bit Official Distribution - 13.0 Version');
$defrepo[7]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.0-patches', // patch
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/',
    'rank' => 30, 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130', 'deps' => 1,
    'manifest' => 'patches/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/x86_64/slackware-13.0/patches/PACKAGES.TXT', 'filelist' => 'patches/FILE_LIST',
    'brief' => 'Patches', 'description' => 'Slackware 64bit Official Patches for 13.0 Version');
$defrepo[61]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.0-extra', // extra
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/',
    'rank' => 30, 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130', 'deps' => 1,
    'manifest' => 'extra/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/x86_64/slackware-13.0/extra/PACKAGES.TXT', 'filelist' => 'extra/FILE_LIST',
    'brief' => 'Extra', 'description' => 'Slackware 64bit Official Extra Packages for 13.0 Version');
/**** END SLACK 13.0 ****/
//
/**** SLACK 13.1 ****/
// 32bit
$defrepo[72]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.1', // distro
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.1/',
    'rank' => 30, 'version' => '13.1', 'arch' => 'i386', 'class' => '32131', 'deps' => 1,
    'manifest' => 'slackware/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/i486/slackware-13.1/PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Official', 'description' => 'Slackware 32bit Official Distribution - 13.1 Version');
$defrepo[73]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.1-patches', // patch
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.1/',
    'rank' => 30, 'version' => '13.1', 'arch' => 'i386', 'class' => '32131', 'deps' => 1,
    'manifest' => 'patches/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/i486/slackware-13.1/patches/PACKAGES.TXT', 'filelist' => 'patches/FILE_LIST',
    'brief' => 'Patches', 'description' => 'Slackware 32bit Official Patches for 13.1 Version');
$defrepo[76]=array( 'info' => array('create' => 1), 'name' => 'slackware-13.1-extra', // extra
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.1/',
    'rank' => 30, 'version' => '13.1', 'arch' => 'i386', 'class' => '32131', 'deps' => 1,
    'manifest' => 'extra/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/i486/slackware-13.1/extra/PACKAGES.TXT', 'filelist' => 'extra/FILE_LIST',
    'brief' => 'Extra', 'description' => 'Slackware 32bit Official Extra Packages for 13.1 Version');
// 64bit
$defrepo[71]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.1', // distro
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.1/',
    'rank' => 30, 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131', 'deps' => 1,
    'manifest' => 'slackware64/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/x86_64/slackware-13.1/PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Official', 'description' => 'Slackware 64bit Official Distribution - 13.1 Version');
$defrepo[74]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.1-patches', // patch
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.1/',
    'rank' => 30, 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131', 'deps' => 1,
    'manifest' => 'patches/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/x86_64/slackware-13.1/patches/PACKAGES.TXT', 'filelist' => 'patches/FILE_LIST',
    'brief' => 'Patches', 'description' => 'Slackware 64bit Official Patches for 13.1 Version'); 
$defrepo[75]=array( 'info' => array('create' => 1), 'name' => 'slackware64-13.1-extra', // extra
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.1/',
    'rank' => 30, 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131', 'deps' => 1,
    'manifest' => 'extra/MANIFEST.bz2', 'packages' => 'http://download.salixos.org/x86_64/slackware-13.1/extra/PACKAGES.TXT', 'filelist' => 'extra/FILE_LIST',
    'brief' => 'Extra', 'description' => 'Slackware 64bit Official Extra Packages for 13.1 Version');
/**** END SLACK 13.1 ****/
//
/**** CURRENT ****/
// 32bit
$defrepo[2]=array( 'info' => array('create' => 1), 'name' => 'slackware-current', // distro
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/',
    'rank' => 30, 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
    'manifest' => 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Official', 'description' => 'Slackware 32bit Official Distribution - Current Version');
$defrepo[64]=array( 'info' => array('create' => 1), 'name' => 'slackware-current-extra', // extra
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/',
    'rank' => 30, 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
    'manifest' => 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Extra', 'description' => 'Slackware 32bit Official Extra Packages for Current Version');
// 64bit
$defrepo[1]=array( 'info' => array('create' => 1), 'name' => 'slackware64-current', // distro
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/',
    'rank' => 30, 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur',
    'manifest' => 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Official', 'description' => 'Slackware 64bit Official Distribution - Current Version');
$defrepo[62]=array( 'info' => array('create' => 1), 'name' => 'slackware64-current-extra', // extra
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/',
    'rank' => 30, 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur',
    'manifest' => 'extra/MANIFEST.bz2', 'packages' => 'extra/PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Extra', 'description' => 'Slackware 64bit Official Extra Packages for Current Version');
/**** END CURRENT ****/
#
###### END SLACKWARE OFFICIAL ########



###### SLACKY #################
#
/**** SLACK 12.2 ****/
// 32bit
$defrepo[12]=array( 'info' => array('create' => 1), 'name' => 'slacky-12.2', // distro
    'url' => 'http://repository.slacky.eu/slackware-12.2/',
    'rank' => 99, 'version' => '12.2', 'arch' => 'i386', 'class' => '32122', 'deps' => 1,
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware 12.2');
$defrepo[13]=array( 'info' => array('create' => 1), 'name' => 'gnome-slacky-12.2', // gnome
    'url' => 'http://repository.slacky.eu/gnome-slacky-12.2/',
    'rank' => 99, 'version' => '12.2', 'arch' => 'i386', 'class' => '32122', 'deps' => 1,
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Gnome Slacky', 'description' => 'Slacky.eu Community s Repository of a Gnome 2.28.0 for Slackware 12.2');
/**** END SLACK 12.2 ****/
//
/**** SLACK 13.0 ****/
// 32bit
$defrepo[11]=array( 'info' => array('create' => 1), 'name' => 'slacky-13.0', 
    'url' => 'http://repository.slacky.eu/slackware-13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130', 'deps' => 1,
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware 13.0');
/**** END SLACK 13.0 ****/
//
/**** SLACK 13.1 ****/
// 32bit
$defrepo[9]=array( 'info' => array('create' => 1), 'name' => 'slacky-13.1',
    'url' => 'http://repository.slacky.eu/slackware-13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'i386', 'class' => '32131', 'deps' => 1,
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware 13.1');
// 64bit
$defrepo[10]=array( 'info' => array('create' => 1), 'name' => 'slacky64-13.1',
    'url' => 'http://repository.slacky.eu/slackware64-13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131', 'deps' => 1,
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Slacky', 'description' => 'Slacky.eu Community s Repository for Slackware64 13.1');
/**** END SLACK 13.1 ****/
#
##### END SLACKY ##############



##### SALIX DISTRIBUTION ##############
#
/**** SLACK 13.0 ****/
// 32bit
$defrepo[21]=array( 'info' => array('create' => 1), 'name' => 'salix-13.0',
    'url' => 'http://download.salixos.org/i486/13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130', 'deps' => 1,
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'rsync://slackware.org.uk/salix/i486/13.0/',
    'brief' => 'Salix', 'description' => 'Salix 32bit Distribution perfectly compatible with Slackware 13.0');
// 64bit
$defrepo[23]=array( 'info' => array('create' => 1), 'name' => 'salix64-13.0',
    'url' => 'http://download.salixos.org/x86_64/13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130', 'deps' => 1,
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'rsync://slackware.org.uk/salix/x86_64/13.0/',
    'brief' => 'Salix64', 'description' => 'Salix 64bit Distribution perfectly compatible with Slackware64 13.0');
/**** END SLACK 13.0 ****/
//
/**** SLACK 13.1 ****/
// 32bit
$defrepo[29]=array( 'info' => array('create' => 1), 'name' => 'salix-13.1',
    'url' => 'http://download.salixos.org/i486/13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'i386', 'class' => '32131', 'deps' => 1,
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'rsync://slackware.org.uk/salix/i486/13.1/',
    'brief' => 'Salix', 'description' => 'Salix 32bit Distribution perfectly compatible with Slackware 13.1');
// 64bit
$defrepo[30]=array( 'info' => array('create' => 1), 'name' => 'salix64-13.1',
    'url' => 'http://download.salixos.org/x86_64/13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131', 'deps' => 1,
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'rsync://slackware.org.uk/salix/x86_64/13.1/',
    'brief' => 'Salix64', 'description' => 'Salix 64bit Distribution perfectly compatible with Slackware64 13.1');
/**** END SLACK 13.1 ****/
//
/**** SLACK CURRENT ****/
// 32bit
$defrepo[22]=array( 'info' => array('create' => 0), 'name' => 'salix-current',
    'url' => 'http://download.salixos.org/i486/current/',
    'rank' => 99, 'version' => 'current', 'arch' => 'i386', 'class' => '32cur', 'deps' => 1,
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => '',
    'brief' => 'Salix', 'description' => 'Salix 32bit Distribution perfectly compatible with Slackware Current');
// 64bit
$defrepo[24]=array( 'info' => array('create' => 0), 'name' => 'salix64-current',
    'url' => 'http://download.salixos.org/x86_64/current/',
    'rank' => 99, 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur', 'deps' => 1,
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => '',
    'brief' => 'Salix64', 'description' => 'Salix 64bit Distribution perfectly compatible with Slackware64 Current');
/**** END SLACK CURRENT ****/
#
##### END SALIX DISTRIBUTION ##########


##### GSB GNOME #####################
#
/**** SLACK 13.0 ****/
// 32bit
$defrepo[27]=array( 'info' => array('create' => 1), 'name' => 'gsb-gnome2.26',
    'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-2.26_slackware-13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130', 'deps' => 1,
    'manifest' => 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'gnome-2.26', 'description' => 'GSB Gnome 2.26.0 32bit for Slackware 13.0');
// 64bit
$defrepo[25]=array( 'info' => array('create' => 1), 'name' => 'gsb64-gnome2.26',
    'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-2.26_slackware64-13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130', 'deps' => 1,
    'manifest' => 'gsb64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'gnome-2.26', 'description' => 'GSB Gnome 2.26.0 64bit for Slackware64 13.0');
/**** END SLACK 13.0 ****/
//
/**** SLACK 13.1 ****/
// 32bit
$defrepo[38]=array( 'info' => array('create' => 1), 'name' => 'gsb-gnome2.28-13.1', // gnome 2.28
    'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-2.28_slackware-13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'i486', 'class' => '32131', 'deps' => 1,
    'manifest' => 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'rsync://ftp.osuosl.org/gsb/gsb-2.28_slackware-13.1',
    'brief' => 'gnome-2.28', 'description' => 'GSB Gnome 2.28.0 bit for Slackware 13.1');
$defrepo[39]=array( 'info' => array('create' => 1), 'name' => 'gsb-gnome2.30-13.1', // gnome 2.30
    'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-2.30_slackware-13.1/',
    'rank' => 99, 'version' => 'current', 'arch' => 'i486', 'class' => '32131', 'deps' => 1,
    'manifest' => 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'rsync://ftp.osuosl.org/gsb/gsb-2.30_slackware-13.1',
    'brief' => 'gsb-gnome2.30', 'description' => 'GSB Gnome 2.30.0 bit for Slackware Current');
// 64bit
$defrepo[59]=array( 'info' => array('create' => 1), 'name' => 'gsb64-gnome2.28-13.1', // gnome 2.28
    'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-2.28_slackware64-13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131', 'deps' => 1,
    'manifest' => 'gsb64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'rsync://ftp.osuosl.org/gsb/gsb64-2.28_slackware64-13.1',
    'brief' => 'gnome-2.28', 'description' => 'GSB Gnome 2.28.0 64bit for Slackware64 13.1');
$defrepo[60]=array( 'info' => array('create' => 1), 'name' => 'gsb64-gnome2.30-13.1',
    'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-2.30_slackware64-13.1/', // gnome 2.30
    'rank' => 99, 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131', 'deps' => 1,
    'manifest' => 'gsb64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'rsync://ftp.osuosl.org/gsb/gsb64-2.30_slackware64-13.1',
    'brief' => 'gsb-gnome2.30', 'description' => 'GSB Gnome 2.30.0 64bit for Slackware64 Current');
/**** END SLACK 13.1 ****/
//
/**** SLACK CURRENT ****/
// 32bit
$defrepo[28]=array( 'info' => array('create' => 0), 'name' => 'gsb-gnome-current',
    'url' => 'http://ftp.osuosl.org/pub/gsb/gsb-current/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130', 'deps' => 1,
    'manifest' => 'gsb/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'gsb-gnome2.28', 'description' => 'GSB Gnome 2.28.0 32bit for Slackware Current');
// 64bit
$defrepo[26]=array( 'info' => array('create' => 0), 'name' => 'gsb64-gnome-current',
    'url' => 'http://ftp.osuosl.org/pub/gsb/gsb64-current/',
    'rank' => 99, 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur', 'deps' => 1,
    'manifest' => 'gsb64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'gsb-gnome2.28', 'description' => 'GSB Gnome 2.28.0 64bit for Slackware64 Current');
/**** END SLACK CURRENT ****/
#
##### END GSB GNOME ##############







##### MIXED REPOSITORIES ##########
#
/**** SLACK CURRENT ****/
// 32bit - 64bit
$defrepo[31]=array( 'info' => array('create' => 1), 'name' => 'slackers.it',
    'url' => 'http://www.slackers.it/repository/',
    'rank' => 99, 'version' => 'current', 'arch' => 'mixed', 'class' => 'micur',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT.gz',
    'brief' => 'Slackers', 'description' => 'Repository from www.slackers.it; contains mixed 32 and 64 bit packages for Slackware Current');
/**** SLACK CURRENT ****/
//
/**** SLACK ALL ****/
// 32bit - 64bit
$defrepo[32]=array( 'info' => array('create' => 1), 'name' => 'alien', // alien
    'url' => 'http://connie.slackware.com/~alien/slackbuilds/',
    'rank' => 99, 'version' => 'mixed', 'arch' => 'mixed', 'class' => 'mimix',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Alien Bob', 'description' => 'Repository from Alien Bob (connie.slackware.com/~alien) containing mixed 32 and 64 bit packages for mixed Slackware versions');
$defrepo[37]=array( 'info' => array('create' => 1), 'name' => 'alien-restricted', // alien restricted
    'url' => 'ftp://ftp.slackware.org.uk/people/alien/restricted_slackbuilds/',
    'rank' => 99, 'version' => 'mixed', 'arch' => 'mixed', 'class' => 'mimix',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Alien Restricted', 'description' => 'Alien Alternative Repository for non U.S.A. people');
$defrepo[57]=array( 'info' => array('create' => 1), 'name' => 'nielshor-for-13.0', // nielshor
    'url' => 'http://www.nielshorn.net/_download/slackware/packages/',
    'rank' => 99, 'version' => 'mixed', 'arch' => 'mixed', 'class' => 'mimix',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Niels Horn');
/**** END SLACK ALL ****/
#
###### END MIXED REPOSITORIES







##### LINUXPACKAGES #############
#
/**** SLACK 12.2 ****/
// 32bit
$defrepo[33]=array( 'info' => array('create' => 1), 'name' => 'linuxpackages-12.2-i386',
    'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-12.2-i386/',
    'rank' => 99, 'version' => '12.2', 'arch' => 'i386', 'class' => '32122', 'deps' => 1,
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'LinuxPackages', 'description' => 'Repository from LinuxPackages.net containing 32bit packages for Slackware 12.2');
/**** END SLACK 12.2 ****/
//
/**** SLACK 13.0 ****/
// 32bit
$defrepo[34]=array( 'info' => array('create' => 1), 'name' => 'linuxpackages-13.0-i386-sotirov',
    'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-13.0-i386/sotirov/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130', 'deps' => 1,
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT.gz',
    'brief' => 'LP Sotirov', 'description' => 'Repository from LinuxPackages.net containing 32bit packages for Slackware 13.0');
/**** END SLACK 13.0 ****/
#
#### END LINUXPACKAGES ########






#### NOT GROUPPED ###########
#
/**** SLACK 12.1 ****/
// 32bit
$defrepo[35]=array( 'info' => array('create' => 1), 'name' => 'stabellini',
    'url' => 'http://www.stabellini.net/filesystem/repository/Stefano_Stabellini/',
    'rank' => 99, 'version' => '12.1', 'arch' => 'i386', 'class' => '32121', 'deps' => 1,
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Stabellini', 'description' => 'Repository from www.stabellini.net packages for Slackware 12.1');
/**** END SLACK 12.1 ****/
//
/**** SLACK 13.1 ****/
// 64bit
$defrepo[58]=array( 'info' => array('create' => 0), 'name' => 'chessgriffin-for-13.1',
    'url' => 'http://www.chessgriffin.com/pkgs/slackware/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'x86_64', 'class' => '64131',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Chess Griffin');
/**** END SLACK 13.1 ****/
/**** SLACK CURRENT ****/
// 32bit
$defrepo[55]=array( 'info' => array('create' => 1), 'name' => 'scxd-current',
    'url' => 'http://scxd.info/pub/',
    'rank' => 99, 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Scxd', 'description' => 'Scxd repository');
/**** END SLACK CURRENT ****/
#
#### NOT GROUPPED ###########




#### DANIX ###################
#
/**** SLACK 13.0 ****/
// 64bit
$defrepo[36]=array( 'info' => array('create' => 1), 'name' => 'c4dwbspace-jimmy_page_89-x86_64',
    'url' => 'http://danixland.net/packages/slackware64-13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Jimmy_page_89', 'description' => 'Jimmy_page_89 (c4dwbspace.altervista.org) packages for Slackware64-13.0; thanx to Danix for webspace');
/**** END SLACK 13.0 ****/
//
/**** SLACK CURRENT ****/
// 64bit
$defrepo[54]=array( 'info' => array('create' => 1), 'name' => 'danix-current64',
    'url' => 'http://danixland.net/packages/slackware64-current/',
    'rank' => 99, 'version' => 'current', 'arch' => 'x86_64', 'class' => '64cur',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Danix', 'description' => 'Repository from Danix (danixland.net) for Slackware64 Current');
/**** END SLACK CURRENT ****/
#
####### END DANIX ##############








#### ROBBY WORKMAN ####
#
/**** SLACK 12.2 ****/
// 32bit
$defrepo[41]=array( 'info' => array('create' => 1), 'name' => 'rlworkman-for-12.2',
    'url' => 'http://rlworkman.net/pkgs/12.2/',
    'rank' => 99, 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Robby Workman', 'description' => 'Robby Workman s Packages for Slackware 12.2');
/**** END SLACK 12.2 ****/
//
/**** SLACK 13.0 ****/
// 32bit - 64bit
$defrepo[43]=array( 'info' => array('create' => 1), 'name' => 'rlworkman-for-13.0',
    'url' => 'http://rlworkman.net/pkgs/13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'mixed', 'class' => 'mi130',
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Robby Workman', 'description' => 'Robby Workman s Packages for Slackware 13.0 32&64 bit');
/**** END SLACK 13.0 ****/
//
/**** SLACK 13.1 ****/
// 32bit - 64bit
$defrepo[44]=array( 'info' => array('create' => 1), 'name' => 'rlworkman-for-13.1',
    'url' => 'http://rlworkman.net/pkgs/13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'mixed', 'class' => 'mi131',
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Robby Workman', 'description' => 'Robby Workman s Packages for Slackware 13.1 32&64 bit');
/**** END SLACK 13.1 ****/
//
/**** SLACK CURRENT ****/
// 32bit - 64bit
$defrepo[42]=array( 'info' => array('create' => 0), 'name' => 'rlworkman-for-current',
    'url' => 'http://rlworkman.net/pkgs/current/',
    'rank' => 99, 'version' => 'current', 'arch' => 'mixed', 'class' => 'micur',
    'manifest' => '', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Robby Workman', 'description' => 'Robby Workman s Packages for Slackware Current');
/**** END SLACK CURRENT ****/
#
######## END ROBBY WORKMAN #####################à












######## JOHANNES SHOEPFER ##########
#
/**** SLACK 13.0 ****/
// 64bit
$defrepo[45]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-x86_64-13.0',
    'url' => 'http://slackware.schoepfer.info/13.0_64/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'x86_64', 'class' => '64130',
    'manifest' => 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'http://slackware.schoepfer.info/13.0_64/',
    'brief' => 'Johannes Sch&#246;pfer', 'description' => 'Packages from Johannes Sch&#246;pfer (schoepfer.info) for Slackware64 13.0');
// 32bit
$defrepo[46]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-i386-13.0',
    'url' => 'http://slackware.schoepfer.info/13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
    'manifest' => 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'http://slackware.schoepfer.info/13.0/',
    'brief' => 'Johannes Sch&#246;pfer', 'description' => 'Packages from Johannes Sch&#246;pfer (schoepfer.info) for Slackware 13.0 32bit');
/**** END SLACK 13.0 ****/
//
/**** SLACK 12.2 ****/
// 32bit
$defrepo[47]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-i386-12.2',
    'url' => 'http://slackware.schoepfer.info/12.2/',
    'rank' => 99, 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
    'manifest' => 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Johannes Sch&#246;pfer', 'description' => 'Packages from Johannes Sch&#246;pfer (schoepfer.info) for Slackware 12.2');
/**** END SLACK 12.2 ****/
//
/**** SLACK 13.1 ****/
// 32bit
$defrepo[48]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-i386-13.1',
    'url' => 'http://slackware.schoepfer.info/13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
    'manifest' => 'slackware/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'http://slackware.schoepfer.info/13.1/',
    'brief' => 'Johannes Sch&#246;pfer', 'description' => 'Packages from Johannes Sch&#246;pfer (schoepfer.info) for Slackware 13.1 32bit');
// 64bit
$defrepo[49]=array( 'info' => array('create' => 1), 'name' => 'schoepfer.info-x86_64-13.1',
    'url' => 'http://slackware.schoepfer.info/13.1_64/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'x86_64', 'class' => '32131',
    'manifest' => 'slackware64/MANIFEST.bz2', 'packages' => 'PACKAGES.TXT', 'filelist' => 'http://slackware.schoepfer.info/13.1_64/',
    'brief' => 'Johannes Sch&#246;pfer', 'description' => 'Packages from Johannes Sch&#246;pfer (schoepfer.info) for Slackware 13.1 32bit');
/**** END SLACK 13.1 ****/
#
######## END JOHANNES SHOEPFER ##########






######## DIA-TECH ASZABO REPOSITORY #########
#
/**** SLACK 12.2 ****/
// 32bit
$defrepo[52]=array( 'info' => array('create' => 0), 'name' => 'dia-tech-slack-12.2',
    'url' => 'http://www.dia-tech.net/linux/Slackware-12.2/',
    'rank' => 99, 'version' => '12.2', 'arch' => 'i386', 'class' => '32122',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Aszabo', 'description' => 'Packages from Aszabo (www.dia-tech.net) for Slackware 12.2');
/**** END SLACK 12.2 ****/
//
/**** SLACK 13.0 ****/
// 32bit
$defrepo[51]=array( 'info' => array('create' => 0), 'name' => 'dia-tech-slack-13.0',
    'url' => 'http://www.dia-tech.net/linux/Slackware-13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Aszabo', 'description' => 'Packages from Aszabo (www.dia-tech.net) for Slackware 13.0 32bit');
/**** END SLACK 13.0 ****/
//
/**** SLACK 13.1 ****/
// 32bit
$defrepo[50]=array( 'info' => array('create' => 0), 'name' => 'dia-tech-slack-13.1',
    'url' => 'http://www.dia-tech.net/linux/Slackware-13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'i386', 'class' => '32131',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Aszabo', 'description' => 'Packages from Aszabo (www.dia-tech.net) for Slackware 13.1 32bit');
/**** END SLACK 13.1 ****/
//
/**** SLACK CURRENT ****/
// 32bit
$defrepo[53]=array( 'info' => array('create' => 0), 'name' => 'dia-tech-curr-kde4.4', // for kde 4.4
    'url' => 'http://www.dia-tech.net/linux/Slackware-current-kde4.4/',
    'rank' => 99, 'version' => 'current', 'arch' => 'i386', 'class' => '32cur',
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Aszabo for kde 4.4', 'description' => 'Kde 4.4 from Aszabo (www.dia-tech.net) for Slackware Current');
/**** END SLACK CURRENT ****/
#
####### END DIA-TECH ASZABO REPOSITORY #########




###### ELETTROLINUX #############
#
/**** SLACK 13.0 ****/
// 32bit
$defrepo[56]=array( 'info' => array('create' => 1), 'name' => 'elettrolinux-for-13.0',
    'url' => 'http://repository.elettrolinux.com/Slackware-13.0/',
    'rank' => 99, 'version' => '13.0', 'arch' => 'i386', 'class' => '32130', 'deps' => 1,
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'FILELIST.TXT',
    'brief' => 'Michele.P');
/**** END SLACK 13.0 ****/
//
/**** SLACK 13.1 ****/
// 32bit
$defrepo[77]=array( 'info' => array('create' => 1), 'name' => 'elettrolinux-for-13.1',
    'url' => 'http://repository.elettrolinux.com/Slackware-13.1/',
    'rank' => 99, 'version' => '13.1', 'arch' => 'i386', 'class' => '32131', 'deps' => 1,
    'manifest' => 'MANIFEST.bz2', 'packages' => 'PACKAGES.TXT.gz', 'filelist' => 'http://repository.elettrolinux.com/Slackware-13.1/',
    'brief' => 'Michele.P');
/**** END SLACK 13.1 ****/
#
##### END ELETTROLINUX ###########



?>
