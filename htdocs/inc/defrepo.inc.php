<?php



$defrepo=array();
$classes=array();
$npackages=0;


function redefrepo($reposelected=0){
  global $defrepo,$classes,$npackages;
//  unset($defrepo);
  $defrepo=array();
  $classes=array();

  $repo=new repository();
  $nrepos=$repo->find();
  while ($repo->fetch()){
    $id=$repo->id;
    $defrepo[$id]=(array)$repo;
    unset($defrepo[$id]["db"]);
    $defrepo[$id]['selected']=($id==$reposelected);
    $classes[$repo->class]['class']=$repo->class;
    $classes[$repo->class]['arch']=$repo->arch;
    $classes[$repo->class]['version']=$repo->version;
    $classes[$repo->class]['selected']=($repo->class==$reposelected);
    $classes[$repo->class]['repo'][]=$repo->id;
    $npackages+=$repo->npkgs;
  //  return;
  }
  echo "<code>$nrepos repositories ($npackages packages)</code><br><br>\n";

}

function writerepos($reposelected){
  global $classes;
  global $defrepo;
  redefrepo($reposelected);
//  echo "<pre>";var_dump($defrepo);echo "</pre>";
  $cells=array();
  foreach($classes as $class){
    $cell=array();
    $cell['arch']="<code>{$class['arch']}</code>";
    $cell['version']="<code>{$class['version']}</code>";
    $cell['use']="<input type='radio' name='repo' value={$class['class']} ".($class['selected']?"checked='checked'":"").">";
    $cell['content']="";
    foreach($class['repo'] as $repoid){
      $repo=$defrepo[$repoid];
      if($cell['content'])$cell['content'].=" - ";
      $cell['content'].="<code><nobr>
	<input type='radio' name='repo' value={$repo['id']} ".($repo['selected']?"checked='checked'":"").">
	<a title='".(str_replace(array("'","\n"),array(" "," "),$repo['description']))."' href='showrepo.php?repo={$repo['id']}'>{$repo['brief']}</a>".
	"<sup>({$repo['npkgs']}".($repo['manifest']?"F":"").($repo['deps']?"D":"").")</sup>".
      "</nobr></code>";
    }
    $cells[$class['class']]=$cell;
  }
  $out=tables(array("use","arch","distro","Repository"),1," class='repository'  ");
  $out.=tables(array("&nbsp;","all","all",	
    		     "<input type='radio' name='repo' value=0".((!$reposelected)?" checked='checked'":"").">All repositories"));
  foreach($cells as $cell){
    $out.=tables(array($cell['use'],$cell['arch'],$cell['version'],$cell['content']));
  }
  $out.=tables();
  $out.="<code>(F) File search support enabled ; (D) View dependencies enabled</code><br><br>";
  return $out;
}
function writereposfile($reposelected){
  global $defrepo;
  $cells=array("x86_64" => array(),"i386" => array(),"mixed" => array());
  foreach($defrepo as $key => $repo){
    if(!isset($cell[$repo["arch"]][$repo["version"]]))$cell[$repo["arch"]][$repo["version"]]="";
    $cell[$repo["arch"]][$repo["version"]].=
      "<code><nobr>
         <input type='radio' name='repo' value=$key".(($key==$reposelected)?" checked='checked'":"").">
	 <a href='showrepo.php?id={$repo['id']}'>{$repo['brief']}</a>".
	 ($repo['manifest']?"<sup>(*)</sup>":"")."
       </nobr></code>  
      ";
  }
  $out=tables(array("arch","distro","Repository"),1);
  $out.=tables(array("<code>all</code>",	"<code>&nbsp;&nbsp;&nbsp;all</code>",	
    		     "<input type='radio' name='repo' value=0".((!$reposelected)?" checked='checked'":"").">All repositories"),2,'style="border-top:1px solid #000000; border-bottom:1px solid #000000;"');
  $out.=tables(array("<code>mixed</code>",	"<nobr><input type='radio' name='repo' value='1011'".((1011==$reposelected)?" checked='checked'":"")."><code>mixed</code></nobr>",	$cell['mixed']['mixed']),2,'style="border-bottom:1px solid #000000;"');
  $out.=tables(array("<code>i386</code>",	"<nobr><input type='radio' name='repo' value='1022'".((1022==$reposelected)?" checked='checked'":"")."><code>current</code></nobr>",	$cell['i386']['current']),2,'style="border-bottom:1px solid #000000;"');
  $out.=tables(array("<code>x86_64</code>",	"<nobr><input type='radio' name='repo' value='1032'".((1032==$reposelected)?" checked='checked'":"")."><code>current</code></nobr>",	$cell['x86_64']['current']),2,'style="border-bottom:1px solid #000000;"');
  $out.=tables(array("<code>mixed</code>",	"<nobr><input type='radio' name='repo' value='1012'".((1012==$reposelected)?" checked='checked'":"")."><code>current</code></nobr>",	$cell['mixed']['current']),2,'style="border-bottom:1px solid #000000;"');
  $out.=tables(array("<code>i386</code>",	"<nobr><input type='radio' name='repo' value='1023'".((1023==$reposelected)?" checked='checked'":"")."><code>13.0</code></nobr>",	$cell['i386']['13.0']),2,'style="border-bottom:1px solid #000000;"');
  $out.=tables(array("<code>x86_64</code>",	"<nobr><input type='radio' name='repo' value='1033'".((1033==$reposelected)?" checked='checked'":"")."><code>13.0</code></nobr>",    $cell['x86_64']['13.0']),2,'style="border-bottom:1px solid #000000;"');
  $out.=tables(array("<code>mixed</code>",	"<nobr><input type='radio' name='repo' value='1013'".((1013==$reposelected)?" checked='checked'":"")."><code>13.0</code></nobr>",	$cell['mixed']['13.0']),2,'style="border-bottom:1px solid #000000;"');
  $out.=tables(array("<code>i386</code>",	"<nobr><input type='radio' name='repo' value='1024'".((1024==$reposelected)?" checked='checked'":"")."><code>12.2</code></nobr>",	$cell['i386']['12.2']),2,'style="border-bottom:1px solid #000000;"');
  $out.=tables(array("<code>i386</code>",	"<nobr><input type='radio' name='repo' value='1025'".((1025==$reposelected)?" checked='checked'":"")."><code>12.1</code></nobr>",	$cell['i386']['12.1']),2,'style="border-bottom:1px solid #000000;"');

  $out.=tables();


  return $out."<sup>(*)</sup> File search support enabled<br><br>";
}


# Official repositories
# id 1-7,61-64

$defrepo[1]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/',
    'rank' => 1,
    'version' => 'current', #OK
    'arch' => 'x86_64',
    'class' => '64cur',
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slackware64-current',
    'brief' => 'Official',
    'description' => 'Slackware 64bit Official Distribution - Current Version'
  );

$defrepo[2]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/',
    'rank' => 1,
    'version' => 'current', #OK
    'arch' => 'i386',
    'class' => '32cur',
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slackware-current',
    'brief' => 'Official',
    'description' => 'Slackware 32bit Official Distribution - Current Version'
  );

$defrepo[3]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-12.2/',
    'rank' => 1,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'class' => '32122',
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slackware-12.2',
    'brief' => 'Official',
    'description' => 'Slackware 32bit Official Distribution - 12.2 Version'
  );

$defrepo[4]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/',
    'rank' => 1,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slackware64-13.0',
    'brief' => 'Official',
    'description' => 'Slackware 64bit Official Distribution - 13.0 Version'
  );

$defrepo[5]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'rank' => 1,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slackware-13.0',
    'brief' => 'Official',
    'description' => 'Slackware 32bit Official Distribution - 13.0 Version'
  );

$defrepo[6]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'rank' => 2,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'manifest' => 'patches/MANIFEST.bz2',
    'packages' => 'patches/PACKAGES.TXT',
    'name' => 'slackware-13.0-patches',
    'brief' => 'Patches',
    'description' => 'Slackware 32bit Official Patches for 13.0 Version'
  );

$defrepo[7]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/patches/',
    'rank' => 2,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slackware64-13.0-patches',
    'brief' => 'Patches',
    'description' => 'Slackware 64bit Official Patches for 13.0 Version'
  );

$defrepo[61]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/',
    'rank' => 3,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'manifest' => 'extra/MANIFEST.bz2',
    'packages' => 'extra/PACKAGES.TXT',
    'name' => 'slackware64-13.0-extra',
    'brief' => 'Extra',
    'description' => 'Slackware 64bit Official Extra Packages for 13.0 Version'
  );

$defrepo[62]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/',
    'rank' => 3,
    'version' => 'current', #OK
    'arch' => 'x86_64',
    'class' => '64cur',
    'manifest' => 'extra/MANIFEST.bz2',
    'packages' => 'extra/PACKAGES.TXT',
    'name' => 'slackware64-current-extra',
    'brief' => 'Extra',
    'description' => 'Slackware 64bit Official Extra Packages for Current Version'
  );

$defrepo[63]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'rank' => 3,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'manifest' => 'extra/MANIFEST.bz2',
    'packages' => 'extra/PACKAGES.TXT',
    'name' => 'slackware-13.0-extra',
    'brief' => 'Extra',
    'description' => 'Slackware 32bit Official Extra Packages for 13.0 Version'
  );

$defrepo[64]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/',
    'rank' => 3,
    'version' => 'current', #OK
    'arch' => 'i386',
    'class' => '32cur',
    'manifest' => 'extra/MANIFEST.bz2',
    'packages' => 'extra/PACKAGES.TXT',
    'name' => 'slackware-current-extra',
    'brief' => 'Extra',
    'description' => 'Slackware 32bit Official Extra Packages for Current Version'
  );









# Slacky repositories
# id 11-13

$defrepo[11]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.slacky.eu/slackware-13.0/',
    'rank' => 10,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'deps' => 1,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slacky-13.0',
    'brief' => 'Slacky',
    'description' => 'Slacky.eu Community s Repository for Slackware 13.0'
  );

$defrepo[12]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.slacky.eu/slackware-12.2/',
    'rank' => 10,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'class' => '32122',
    'deps' => 1,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slacky-12.2',
    'brief' => 'Slacky',
    'description' => 'Slacky.eu Community s Repository for Slackware 12.2'
  );

$defrepo[13]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.slacky.eu/gnome-slacky-12.2/',
    'rank' => 11,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'class' => '32122',
    'deps' => 1,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'gnome-slacky-12.2',
    'brief' => 'Gnome Slacky',
    'description' => 'Slacky.eu Community s Repository of a Gnome 2.28.0 for Slackware 12.2'
  );
























# Salix repositories
# id 21-24

$defrepo[21]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/i486/13.0/',
    'rank' => 20,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'deps' => 1,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'salix-13.0',
    'brief' => 'Salix',
    'description' => 'Salix 32bit Distribution perfectly compatible with Slackware 13.0'
  );

$defrepo[22]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/i486/current/',
    'rank' => 20,
    'version' => 'current', #OK
    'arch' => 'i386',
    'class' => '32cur',
    'deps' => 1,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'salix-current',
    'brief' => 'Salix',
    'description' => 'Salix 32bit Distribution perfectly compatible with Slackware Current'
  );

$defrepo[23]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/x86_64/13.0/',
    'rank' => 20,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'deps' => 1,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'salix64-13.0',
    'brief' => 'Salix64',
    'description' => 'Salix 64bit Distribution perfectly compatible with Slackware64 13.0'
  );

$defrepo[24]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/x86_64/current/',
    'rank' => 20,
    'version' => 'current', #OK
    'arch' => 'x86_64',
    'class' => '64cur',
    'deps' => 1,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'salix64-current',
    'brief' => 'Salix64',
    'description' => 'Salix 64bit Distribution perfectly compatible with Slackware64 Current'
  );





$defrepo[25]=array(
    'info' => array('create' => 1),
    'url' => 'http://mirror.informatik.uni-mannheim.de/pub/linux/distributions/slackware-unsupported/gsb/gsb64-2.26_slackware64-13.0/',
    'rank' => 99,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'deps' => 1,
    'manifest' => 'gsb64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'gsb64-gnome2.26',
    'brief' => 'gnome-2.26',
    'description' => 'GSB Gnome 2.26.0 64bit for Slackware64 13.0'
  );

$defrepo[26]=array(
    'info' => array('create' => 1),
    'url' => 'http://mirror.informatik.uni-mannheim.de/pub/linux/distributions/slackware-unsupported/gsb/gsb64-current/',
    'rank' => 99,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'deps' => 1,
    'manifest' => 'gsb64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'gsb64-gnome-current',
    'brief' => 'gsb-gnome2.28',
    'description' => 'GSB Gnome 2.28.0 64bit for Slackware64 Current'
  );

$defrepo[27]=array(
    'info' => array('create' => 1),
    'url' => 'http://mirror.informatik.uni-mannheim.de/pub/linux/distributions/slackware-unsupported/gsb/gsb-2.26_slackware-13.0/',
    'rank' => 99,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'deps' => 1,
    'manifest' => 'gsb/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'gsb-gnome2.26',
    'brief' => 'gnome-2.26',
    'description' => 'GSB Gnome 2.26.0 32bit for Slackware 13.0'
  );

$defrepo[28]=array(
    'info' => array('create' => 1),
    'url' => 'http://mirror.informatik.uni-mannheim.de/pub/linux/distributions/slackware-unsupported/gsb/gsb-current/',
    'rank' => 99,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'deps' => 1,
    'manifest' => 'gsb/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'gsb-gnome-current',
    'brief' => 'gsb-gnome2.28',
    'description' => 'GSB Gnome 2.28.0 32bit for Slackware Current'
  );









# Other that have PACKAGES.TXT
# id 31-35

$defrepo[31]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.slackers.it/repository/',
    'rank' => 99,
    'version' => 'current', #OK
    'arch' => 'mixed',
    'class' => 'micur',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'slackers.it',
    'brief' => 'Slackers',
    'description' => 'Repository from www.slackers.it; contains mixed 32 and 64 bit packages for Slackware Current'
  );

$defrepo[32]=array(
    'info' => array('create' => 1),
    'url' => 'http://connie.slackware.com/~alien/slackbuilds/',
    'rank' => 99,
    'version' => 'mixed', # MIXED
    'arch' => 'mixed',
    'class' => 'mimix',
//    'manifest' => '',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'alien',
    'brief' => 'Alien Bob',
    'description' => 'Repository from Alien Bob (connie.slackware.com/~alien) containing mixed 32 and 64 bit packages for mixed Slackware versions'
  );

$defrepo[33]=array(
    'info' => array('create' => 1),
    'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-12.2-i386/',
    'rank' => 99,
    'version' => '12.2', # OK
    'arch' => 'i386',
    'class' => '32122',
    'deps' => 1,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'linuxpackages-12.2-i386',
    'brief' => 'LinuxPackages',
    'description' => 'Repository from LinuxPackages.net containing 32bit packages for Slackware 12.2'
  );

$defrepo[34]=array(
    'info' => array('create' => 1),
    'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-13.0-i386/sotirov/',
    'rank' => 99,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'class' => '32130',
    'deps' => 1,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'linuxpackages-13.0-i386-sotirov',
    'brief' => 'LP Sotirov',
    'description' => 'Repository from LinuxPackages.net containing 32bit packages for Slackware 13.0'
  );

$defrepo[35]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.stabellini.net/filesystem/repository/Stefano_Stabellini/',
    'rank' => 99,
    'version' => '12.1', 
    'arch' => 'i386',
    'class' => '32121',
    'deps' => 1,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'stabellini',
    'brief' => 'Stabellini',
    'description' => 'Repository from www.stabellini.net packages for Slackware 12.1'
  );

$defrepo[36]=array(
    'info' => array('create' => 1),
    'url' => 'http://danixland.net/packages/slackware64-13.0/',
    #'url' => 'http://c4dwbspace.altervista.org/',
    'rank' => 99,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'description' => 'Jimmy_page_89 (c4dwbspace.altervista.org) packages for Slackware64-13.0; thanx to Danix for webspace',
    'name' => 'c4dwbspace-jimmy_page_89-x86_64',
    'brief' => 'Jimmy_page_89'
  );

$defrepo[37]=array(
    'info' => array('create' => 1),
    'url' => 'ftp://ftp.slackware.org.uk/people/alien/restricted_slackbuilds/',
    'rank' => 99,
    'version' => 'mixed', # MIXED
    'arch' => 'mixed',
    'class' => 'mimix',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'alien-restricted',
    'brief' => 'Alien Restricted'
  );









# Robby Workman Repository
# id 41-43

$defrepo[41]=array(
    'info' => array('create' => 1),
    'url' => 'http://rlworkman.net/pkgs/12.2/',
    'rank' => 99,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'class' => '32122',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'rlworkman-for-12.2',
    'brief' => 'Robby Workman',
    'description' => 'Robby Workman s Packages for Slackware 12.2'
  );

$defrepo[42]=array(
    'info' => array('create' => 0),
    'url' => 'http://rlworkman.net/pkgs/current/',
    'rank' => 99,
    'version' => 'current', # OK
    'arch' => 'mixed',
    'class' => 'micur',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'rlworkman-for-current',
    'brief' => 'Robby Workman',
    'description' => 'Robby Workman s Packages for Slackware Current'
  );

$defrepo[43]=array(
    'info' => array('create' => 1),
    'url' => 'http://rlworkman.net/pkgs/13.0/',
    'rank' => 99,
    'version' => '13.0', # OK
    'arch' => 'mixed',
    'class' => 'mi130',
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'rlworkman-for-13.0',
    'brief' => 'Robby Workman',
    'description' => 'Robby Workman s Packages for Slackware 13.0 32&64 bit'
  );



# Johannes Schöpfer 
# id 45-47

$defrepo[45]=array(
    'info' => array('create' => 1),
    'url' => 'http://slackware.schoepfer.info/13.0_64/',
    'rank' => 99,
    'version' => '13.0', # OK
    'arch' => 'x86_64',
    'class' => '64130',
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'schoepfer.info-x86_64-13.0',
    'brief' => 'Johannes Sch&#246;pfer',
    'description' => 'Packages from Johannes Sch&#246;pfer (schoepfer.info) for Slackware64 13.0'
  );

$defrepo[46]=array(
    'info' => array('create' => 1),
    'url' => 'http://slackware.schoepfer.info/13.0/',
    'rank' => 99,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'class' => '32130',
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'schoepfer.info-i386-13.0',
    'brief' => 'Johannes Sch&#246;pfer',
    'description' => 'Packages from Johannes Sch&#246;pfer (schoepfer.info) for Slackware 13.0 32bit'
  );

$defrepo[47]=array(
    'info' => array('create' => 1),
    'url' => 'http://slackware.schoepfer.info/12.2/',
    'rank' => 99,
    'version' => '12.2', # OK
    'arch' => 'x86_64',
    'class' => '64122',
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'name' => 'schoepfer.info-i386-12.2',
    'brief' => 'Johannes Sch&#246;pfer',
    'description' => 'Packages from Johannes Sch&#246;pfer (schoepfer.info) for Slackware 12.2'
  );

# Dia Tech Repository
# id 51-53

$defrepo[51]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.dia-tech.net/linux/Slackware-13.0/',
    'rank' => 99,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'class' => '32130',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'dia-tech-slack-13.0',
    'brief' => 'Aszabo',
    'description' => 'Packages from Aszabo (www.dia-tech.net) for Slackware 13.0 32bit'
  );

$defrepo[52]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.dia-tech.net/linux/Slackware-12.2/',
    'rank' => 99,
    'version' => '12.2', # OK
    'arch' => 'i386',
    'class' => '32122',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'dia-tech-slack-12.2',
    'brief' => 'Aszabo',
    'description' => 'Packages from Aszabo (www.dia-tech.net) for Slackware 12.2'
  );

$defrepo[53]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.dia-tech.net/linux/Slackware-current-kde4.4/',
    'rank' => 99,
    'version' => 'current', # OK
    'arch' => 'i386',
    'class' => '32cur',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'dia-tech-curr-kde4.4',
    'brief' => 'Aszabo for kde 4.4',
    'description' => 'Kde 4.4 from Aszabo (www.dia-tech.net) for Slackware Current'
  );

$defrepo[54]=array(
    'info' => array('create' => 1),
    'url' => 'http://danixland.net/packages/slackware64-current/',
    'rank' => 99,
    'version' => 'current', # OK
    'arch' => 'x86_64',
    'class' => '64cur',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'danix-current64',
    'brief' => 'Danix',
    'description' => 'Repository from Danix (danixland.net) for Slackware64 Current'
  );

$defrepo[55]=array(
    'info' => array('create' => 1),
    'url' => 'http://scxd.info/pub/',
    'rank' => 99,
    'version' => 'current', # OK
    'arch' => 'i386',
    'class' => '32cur',
    'manifest' => '',
    #'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'scxd-current',
    'brief' => 'Scxd'
  );

$defrepo[56]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.elettrolinux.com/Slackware-13.0/',
    'rank' => 99,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'class' => '32130',
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'name' => 'elettrolinux-for-13.0',
    'brief' => 'Michele.P'
  );










?>
