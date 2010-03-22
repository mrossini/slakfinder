<?php



$defrepo=array();


function writerepos($repo){
  global $defrepo;
  /*
  $select="<select name='repo'>\n";
  $select.="  <option value='0'".((!$repo)?" selected='selected'":"").">---  All repositories ---</option>\n";
  foreach($defrepo as $id => $repof){
    $select.="  <option value='$id'".(($repo==$id)?" selected='selected'":"").">{$repof['name']}";
    if(!$repo['manifest'])$select.=" (no file search)";
    $select.="</option>\n";
  }
  $select.="</select>";
  return $select;
   */        
  $cells=array("x86_64" => array(),"i386" => array(),"mixed" => array());
  foreach($defrepo as $key => $repo){
    if(!isset($cell[$repo["arch"]][$repo["version"]]))$cell[$repo["arch"]][$repo["version"]]="";
    $cell[$repo["arch"]][$repo["version"]].="<code><nobr><input type='radio' name='repo' value=$key><a href='{$repo['url']}'>{$repo['description']}</a>".($repo['manifest']?"<sup>(*)</sup>":"")."</nobr></code> | ";
  }
  $out=tables(array("arch","distro","Repository"),1,0);
  $out.=tables(array("<code>all</code>",	"<code>all</code>",	
    		     "<input type='radio' name='repo' value=0 checked='checked'>All repositories"));
  $out.=tables(array("<code>mixed</code>",	"<code>mixed</code>",	$cell['mixed']['mixed']));
  $out.=tables(array("<code>i386</code>",	"<code>current</code>",	$cell['i386']['current']));
  $out.=tables(array("<code>x86_64</code>",	"<code>current</code>",	$cell['x86_64']['current']));
  $out.=tables(array("<code>mixed</code>",	"<code>current</code>",	$cell['mixed']['current']));
  $out.=tables(array("<code>i386</code>",	"<code>13.0</code>",	$cell['i386']['13.0']));
  $out.=tables(array("<code>x86_64</code>",	"<code>13.0</code>",    $cell['x86_64']['13.0']));
  $out.=tables(array("<code>mixed</code>",	"<code>13.0</code>",	$cell['mixed']['13.0']));
  $out.=tables(array("<code>i386</code>",	"<code>12.2</code>",	$cell['i386']['12.2']));
  $out.=tables(array("<code>i386</code>",	"<code>12.1</code>",	$cell['i386']['12.1']));

  $out.=tables();


  return $out."<sup>(*)</sup> File search support enabled<br><br>";
}

function writerepos_old($repo){
  global $defrepo;
  /*
  $select="<select name='repo'>\n";
  $select.="  <option value='0'".((!$repo)?" selected='selected'":"").">---  All repositories ---</option>\n";
  foreach($defrepo as $id => $repof){
    $select.="  <option value='$id'".(($repo==$id)?" selected='selected'":"").">{$repof['name']}";
    if(!$repo['manifest'])$select.=" (no file search)";
    $select.="</option>\n";
  }
  $select.="</select>";
  return $select;
   */        
  $out=tables(array(),1,0);
  $out.=tables(array("All Repositories","<input type='radio' name='repo' value=0 checked='checked'>"));

  $out.= tables(array("Slackware Official 32bit<sup>(*)</sup>:",
    "<input type='radio' name='repo' value=2><a href='{$defrepo[2]['url']}'>current</a> | ".
    "<input type='radio' name='repo' value=5><a href='{$defrepo[5]['url']}'>13.0</a> | ".
    "<input type='radio' name='repo' value=6><a href='{$defrepo[6]['url']}'>patch</a> | ".
    "<input type='radio' name='repo' value=3><a href='{$defrepo[3]['url']}'>12.2</a>"));
  $out.= tables(array("Slackware Official 64bit<sup>(*)</sup>:",
    "<input type='radio' name='repo' value=1><a href='{$defrepo[1]['url']}'>current</a> | ".
    "<input type='radio' name='repo' value=4><a href='{$defrepo[4]['url']}'>13.0</a> | ".
    "<input type='radio' name='repo' value=6><a href='{$defrepo[6]['url']}'>patch</a>"));
  $out.= tables(array("Slacky 32bit<sup>(*)</sup>: ",
    "<input type='radio' name='repo' value=11><a href='{$defrepo[11]['url']}'>13.0</a> | ".
    "<input type='radio' name='repo' value=12><a href='{$defrepo[12]['url']}'>12.2</a> | ".
    "<input type='radio' name='repo' value=13><a href='{$defrepo[13]['url']}'>gnome for 12.2</a>"));
  $out.= tables(array("Salix: ",
    " 32bit:   <input type='radio' name='repo' value=21><a href='{$defrepo[21]['url']}'>13.0</a> | ".
    "<input type='radio' name='repo' value=22><a href='{$defrepo[22]['url']}'>current</a> ;    ".
    " 64bit: <input type='radio' name='repo' value=23><a href='{$defrepo[23]['url']}'>13.0</a> | ".
    "<input type='radio' name='repo' value=24><a href='{$defrepo[24]['url']}'>current</a>"));
  $out.= tables(array("Dia Tech 32bit<sup>(*)</sup>: ",
    "<input type='radio' name='repo' value=51><a href='{$defrepo[51]['url']}'>13.0</a> | ".
    "<input type='radio' name='repo' value=52><a href='{$defrepo[52]['url']}'>12.2</a> | ".
    "<input type='radio' name='repo' value=53><a href='{$defrepo[53]['url']}'>kde4.4 for current</a> "));
  $out.= tables(array("Robby Workman 32&64 bit: ",
    "<input type='radio' name='repo' value=43><a href='{$defrepo[43]['url']}'>13.0</a> | ".
    "<input type='radio' name='repo' value=41><a href='{$defrepo[41]['url']}'>12.2</a> | ".
    "<input type='radio' name='repo' value=42><a href='{$defrepo[42]['url']}'>current</a>"));
  $out.= tables(array("Mixed 32&64 bit : ",
    "<input type='radio' name='repo' value='31'><a href='{$defrepo[31]['url']}'>Slackers.it</a><sup>(*)</sup> | ".
    "<input type='radio' name='repo' value='32'><a href='{$defrepo[32]['url']}'>Alien</a>"));
  $out.= tables(array("Other 32 bit :",
    "linuxpackages <input type='radio' name='repo' value='33'><a href='{$defrepo[33]['url']}'>12.2</a><sup>(*)</sup> | ".
    "<input type='radio' name='repo' value='34'><a href='{$defrepo[34]['url']}'>13.0-a</a> | ".
    "<input type='radio' name='repo' value='82'><a href='{$defrepo[82]['url']}'>13.0-b</a>  ;  ".
    "<input type='radio' name='repo' value='35'><a href='{$defrepo[35]['url']}'>Stabellini</a><sup>(*)</sup>"));
  $out.= tables(array("Other 64 bit : ",
    "<input type='radio' name='repo' value='81'><a href='{$defrepo[81]['url']}'>Daniele50</a>  | ".
    "<input type='radio' name='repo' value='54'><a href='{$defrepo[54]['url']}'>Danix</a>  | ".
    "<input type='radio' name='repo' value='36'><a href='{$defrepo[36]['url']}'>Jimmy Mixed</a><sup>(*)</sup>"));

  $out.=tables();


  return $out."(*) Supportano il file search\n\n";
}



# Official repositories
# id 1-7,61-64

$defrepo[1]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/',
    'official' => 1,
    'version' => 'current', #OK
    'arch' => 'x86_64',
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-current',
    'description' => 'Official'
  );

$defrepo[2]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/',
    'official' => 1,
    'version' => 'current', #OK
    'arch' => 'i386',
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-current',
    'description' => 'Official'
  );

$defrepo[3]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-12.2/',
    'official' => 1,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-12.2',
    'description' => 'Official'
  );

$defrepo[4]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/',
    'official' => 1,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0',
    'description' => 'Official'
  );

$defrepo[5]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'official' => 1,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-13.0',
    'description' => 'Official'
  );

$defrepo[6]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'official' => 1,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'manifest' => 'patches/MANIFEST.bz2',
    'packages' => 'patches/PACKAGES.TXT',
    'hashfile' => 'patches/CHECKSUMS.md5.asc',
    'name' => 'slackware-13.0-patches',
    'description' => 'Patches'
  );

$defrepo[7]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/patches/',
    'official' => 1,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0-patches',
    'description' => 'Patches'
  );

$defrepo[61]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/extra/',
    'official' => 1,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0-extra',
    'description' => 'Extra'
  );

$defrepo[62]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/extra/',
    'official' => 1,
    'version' => 'current', #OK
    'arch' => 'x86_64',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-current-extra',
    'description' => 'Extra'
  );

$defrepo[63]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/extra/',
    'official' => 1,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-13.0-extra',
    'description' => 'Extra'
  );

$defrepo[64]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/extra/',
    'official' => 1,
    'version' => 'current', #OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-current-extra',
    'description' => 'Extra'
  );









# Slacky repositories
# id 11-13

$defrepo[11]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.slacky.eu/slackware-13.0/',
    'official' => 0,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slacky-13.0',
    'description' => 'Slacky'
  );

$defrepo[12]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.slacky.eu/slackware-12.2/',
    'official' => 0,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slacky-12.2',
    'description' => 'Slacky'
  );

$defrepo[13]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.slacky.eu/gnome-slacky-12.2/',
    'official' => 0,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'packages' => 'PACKAGES.TXT',
    'name' => 'gnome-slacky-12.2',
    'description' => 'Gnome Slacky'
  );
























# Salix repositories
# id 21-24

$defrepo[21]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/i486/13.0/',
    'official' => 0,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix-13.0',
    'description' => 'Salix'
  );

$defrepo[22]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/i486/current/',
    'official' => 1,
    'version' => 'current', #OK
    'arch' => 'i386',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix-current',
    'description' => 'Salix'
  );

$defrepo[23]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/x86_64/13.0/',
    'official' => 0,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix64-13.0',
    'description' => 'Salix64'
  );

$defrepo[24]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/x86_64/current/',
    'official' => 0,
    'version' => 'current', #OK
    'arch' => 'x86_64',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix64-current',
    'description' => 'Salix64'
  );













# Other that have PACKAGES.TXT
# id 31-35

$defrepo[31]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.slackers.it/repository/',
    'official' => 0,
    'version' => 'current', #OK
    'arch' => 'mixed',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'slackers.it',
    'description' => 'Slackers'
  );

$defrepo[32]=array(
    'info' => array('create' => 1),
    'url' => 'http://connie.slackware.com/~alien/slackbuilds/',
    'official' => 0,
    'version' => 'mixed', # MIXED
    'arch' => 'mixed',
    'manifest' => '',
    //'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'alien',
    'description' => 'Alien Bob'
  );

$defrepo[33]=array(
    'info' => array('create' => 1),
    'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-12.2-i386/',
    'official' => 0,
    'version' => '12.2', # OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz',
    'name' => 'linuxpackages-12.2-i386',
    'description' => 'LinuxPackages'
  );

$defrepo[34]=array(
    'info' => array('create' => 1),
    'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-13.0-i386/sotirov/',
    'official' => 0,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz',
    'name' => 'linuxpackages-13.0-i386-sotirov',
    'description' => 'LP Sotirov'
  );

$defrepo[35]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.stabellini.net/filesystem/repository/Stefano_Stabellini/',
    'official' => 0,
    'version' => '12.1', 
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'stabellini',
    'description' => 'Stabellini'
  );

$defrepo[36]=array(
    'info' => array('create' => 1),
    'url' => 'http://c4dwbspace.altervista.org/',
    'official' => 0,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'c4dwbspace-jimmy_page_89-x86_64',
    'description' => 'Jimmy_page_89'
  );

$defrepo[37]=array(
    'info' => array('create' => 1),
    'url' => 'ftp://ftp.slackware.org.uk/people/alien/restricted_slackbuilds/',
    'official' => 0,
    'version' => 'mixed', # MIXED
    'arch' => 'mixed',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'alien-restricted',
    'description' => 'Alien Restricted'
  );









# Robby Workman Repository
# id 41-43

$defrepo[41]=array(
    'info' => array('create' => 1),
    'url' => 'http://rlworkman.net/pkgs/12.2/',
    'official' => 0,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'rlworkman-for-12.2',
    'description' => 'Robby Workman'
  );

$defrepo[42]=array(
    'info' => array('create' => 0),
    'url' => 'http://rlworkman.net/pkgs/current/',
    'official' => 0,
    'version' => 'current', # OK
    'arch' => 'mixed',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'rlworkman-for-current',
    'description' => 'Robby Workman'
  );

$defrepo[43]=array(
    'info' => array('create' => 1),
    'url' => 'http://rlworkman.net/pkgs/13.0/',
    'official' => 0,
    'version' => '13.0', # OK
    'arch' => 'mixed',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'rlworkman-for-13.0',
    'description' => 'Robby Workman'
  );





# Dia Tech Repository
# id 51-53

$defrepo[51]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.dia-tech.net/linux/Slackware-13.0/',
    'official' => 0,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'ChangeLog.txt.gz',
    'name' => 'dia-tech-slack-13.0',
    'description' => 'Aszabo'
  );

$defrepo[52]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.dia-tech.net/linux/Slackware-12.2/',
    'official' => 0,
    'version' => '12.2', # OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'ChangeLog.txt.gz',
    'name' => 'dia-tech-slack-12.2',
    'description' => 'Aszabo'
  );

$defrepo[53]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.dia-tech.net/linux/Slackware-current-kde4.4/',
    'official' => 0,
    'version' => 'current', # OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'ChangeLog.txt.gz',
    'name' => 'dia-tech-curr-kde4.4',
    'description' => 'Aszabo for kde 4.4'
  );

$defrepo[54]=array(
    'info' => array('create' => 1),
    'url' => 'http://danixland.net/packages/',
    'official' => 0,
    'version' => 'current', # OK
    'arch' => 'x86_64',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'danix-current64',
    'description' => 'Danix'
  );

$defrepo[55]=array(
    'info' => array('create' => 1),
    'url' => 'http://scxd.info/pub/',
    'official' => 0,
    'version' => 'current', # OK
    'arch' => 'i386',
    'manifest' => '',
    #'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'scxd-current',
    'description' => 'Scxd'
  );

$defrepo[56]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.elettrolinux.com/Slackware-13.0/',
    'official' => 0,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'elettrolinux-for-13.0',
    'description' => 'Michele.P'
  );








# Amatorial repository (does not have PACKAGES.TXT)
# id 81-82

$defrepo[81]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.daniele50.it/listing',
    'official' => 0,
    'version' => '12.2',
    'arch' => 'x86_64',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'daniele50.it',
    'description' => 'Daniele50'
  );

$defrepo[82]=array( ###### BUGGATO #######
    'info' => array('create' => 1),
    'url' => 'http://ftp.naist.jp/pub/Linux/linuxpackages/Slackware/',
    'official' => 0,
    'version' => '13.0',
    'arch' => 'i386',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'linuxpackages-13.0-i386-frias',
    'description' => 'LP frias'
  );






?>
