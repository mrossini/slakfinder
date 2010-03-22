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
	<a href='{$repo['url']}'>{$repo['description']}</a><sup>({$repo['npkgs']}".
	($repo['manifest']?"*":"").")</sup>
      </nobr></code>";
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
  $out.="<code>(*) File search support enabled</code><br><br>";
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
	 <a href='{$repo['url']}'>{$repo['description']}</a>".
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
    'info' => array('create' => 0),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/',
    'rank' => 1,
    'version' => 'current', #OK
    'arch' => 'x86_64',
    'class' => '64cur',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-current',
    'description' => 'Official'
  );

$defrepo[2]=array(
    'info' => array('create' => 0),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/',
    'rank' => 1,
    'version' => 'current', #OK
    'arch' => 'i386',
    'class' => '32cur',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-current',
    'description' => 'Official'
  );

$defrepo[3]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-12.2/',
    'rank' => 1,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'class' => '32122',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-12.2',
    'description' => 'Official'
  );

$defrepo[4]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/',
    'rank' => 1,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'slackware64/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0',
    'description' => 'Official'
  );

$defrepo[5]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'rank' => 1,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'slackware/MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-13.0',
    'description' => 'Official'
  );

$defrepo[6]=array(
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/',
    'rank' => 1,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'patches/MANIFEST.bz2',
    'packages' => 'patches/PACKAGES.TXT',
    'hashfile' => 'patches/CHECKSUMS.md5.asc',
    'name' => 'slackware-13.0-patches',
    'description' => 'Patches'
  );

$defrepo[7]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/patches/',
    'rank' => 1,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0-patches',
    'description' => 'Patches'
  );

$defrepo[61]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-13.0/extra/',
    'rank' => 1,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-13.0-extra',
    'description' => 'Extra'
  );

$defrepo[62]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware64-current/extra/',
    'rank' => 1,
    'version' => 'current', #OK
    'arch' => 'x86_64',
    'class' => '64cur',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware64-current-extra',
    'description' => 'Extra'
  );

$defrepo[63]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-13.0/extra/',
    'rank' => 1,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'slackware-13.0-extra',
    'description' => 'Extra'
  );

$defrepo[64]=array( 
    'info' => array('create' => 1),
    'url' => 'http://ftp.osuosl.org/pub/slackware/slackware-current/extra/',
    'rank' => 1,
    'version' => 'current', #OK
    'arch' => 'i386',
    'class' => '32cur',
    'npkgs' => 0,
    'nfiles' => 0,
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
    'rank' => 0,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slacky-13.0',
    'description' => 'Slacky'
  );

$defrepo[12]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.slacky.eu/slackware-12.2/',
    'rank' => 0,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'class' => '32122',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'packages' => 'PACKAGES.TXT',
    'name' => 'slacky-12.2',
    'description' => 'Slacky'
  );

$defrepo[13]=array(
    'info' => array('create' => 1),
    'url' => 'http://repository.slacky.eu/gnome-slacky-12.2/',
    'rank' => 0,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'class' => '32122',
    'npkgs' => 0,
    'nfiles' => 0,
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
    'rank' => 0,
    'version' => '13.0', #OK
    'arch' => 'i386',
    'class' => '32130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix-13.0',
    'description' => 'Salix'
  );

$defrepo[22]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/i486/current/',
    'rank' => 1,
    'version' => 'current', #OK
    'arch' => 'i386',
    'class' => '32cur',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix-current',
    'description' => 'Salix'
  );

$defrepo[23]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/x86_64/13.0/',
    'rank' => 0,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz.asc',
    'name' => 'salix64-13.0',
    'description' => 'Salix64'
  );

$defrepo[24]=array(
    'info' => array('create' => 1),
    'url' => 'http://download.salixos.org/x86_64/current/',
    'rank' => 0,
    'version' => 'current', #OK
    'arch' => 'x86_64',
    'class' => '64cur',
    'npkgs' => 0,
    'nfiles' => 0,
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
    'rank' => 0,
    'version' => 'current', #OK
    'arch' => 'mixed',
    'class' => 'micur',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'slackers.it',
    'description' => 'Slackers'
  );

$defrepo[32]=array(
    'info' => array('create' => 1),
    'url' => 'http://connie.slackware.com/~alien/slackbuilds/',
    'rank' => 0,
    'version' => 'mixed', # MIXED
    'arch' => 'mixed',
    'class' => 'mimix',
    'npkgs' => 0,
    'nfiles' => 0,
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
    'rank' => 0,
    'version' => '12.2', # OK
    'arch' => 'i386',
    'class' => '32122',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz',
    'name' => 'linuxpackages-12.2-i386',
    'description' => 'LinuxPackages'
  );

$defrepo[34]=array(
    'info' => array('create' => 1),
    'url' => 'http://linuxpackages.inode.at/Slackware/Slackware-13.0-i386/sotirov/',
    'rank' => 0,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'class' => '32130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.gz',
    'name' => 'linuxpackages-13.0-i386-sotirov',
    'description' => 'LP Sotirov'
  );

$defrepo[35]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.stabellini.net/filesystem/repository/Stefano_Stabellini/',
    'rank' => 0,
    'version' => '12.1', 
    'arch' => 'i386',
    'class' => '32121',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'stabellini',
    'description' => 'Stabellini'
  );

$defrepo[36]=array(
    'info' => array('create' => 1),
    'url' => 'http://c4dwbspace.altervista.org/',
    'rank' => 0,
    'version' => '13.0', #OK
    'arch' => 'x86_64',
    'class' => '64130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'c4dwbspace-jimmy_page_89-x86_64',
    'description' => 'Jimmy_page_89'
  );

$defrepo[37]=array(
    'info' => array('create' => 0),
    'url' => 'ftp://ftp.slackware.org.uk/people/alien/restricted_slackbuilds/',
    'rank' => 0,
    'version' => 'mixed', # MIXED
    'arch' => 'mixed',
    'class' => 'mimix',
    'npkgs' => 0,
    'nfiles' => 0,
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
    'rank' => 0,
    'version' => '12.2', #OK
    'arch' => 'i386',
    'class' => '32122',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'rlworkman-for-12.2',
    'description' => 'Robby Workman'
  );

$defrepo[42]=array(
    'info' => array('create' => 1),
    'url' => 'http://rlworkman.net/pkgs/current/',
    'rank' => 0,
    'version' => 'current', # OK
    'arch' => 'mixed',
    'class' => 'micur',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'rlworkman-for-current',
    'description' => 'Robby Workman'
  );

$defrepo[43]=array(
    'info' => array('create' => 1),
    'url' => 'http://rlworkman.net/pkgs/13.0/',
    'rank' => 0,
    'version' => '13.0', # OK
    'arch' => 'mixed',
    'class' => 'mi130',
    'npkgs' => 0,
    'nfiles' => 0,
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
    'rank' => 0,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'class' => '32130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'ChangeLog.txt.gz',
    'name' => 'dia-tech-slack-13.0',
    'description' => 'Aszabo'
  );

$defrepo[52]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.dia-tech.net/linux/Slackware-12.2/',
    'rank' => 0,
    'version' => '12.2', # OK
    'arch' => 'i386',
    'class' => '32122',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'ChangeLog.txt.gz',
    'name' => 'dia-tech-slack-12.2',
    'description' => 'Aszabo'
  );

$defrepo[53]=array(
    'info' => array('create' => 1),
    'url' => 'http://www.dia-tech.net/linux/Slackware-current-kde4.4/',
    'rank' => 0,
    'version' => 'current', # OK
    'arch' => 'i386',
    'class' => '32cur',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => 'MANIFEST.bz2',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'ChangeLog.txt.gz',
    'name' => 'dia-tech-curr-kde4.4',
    'description' => 'Aszabo for kde 4.4'
  );

$defrepo[54]=array(
    'info' => array('create' => 1),
    'url' => 'http://danixland.net/packages/',
    'rank' => 0,
    'version' => 'current', # OK
    'arch' => 'x86_64',
    'class' => '64cur',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT.gz',
    'hashfile' => 'CHECKSUMS.md5.asc',
    'name' => 'danix-current64',
    'description' => 'Danix'
  );

$defrepo[55]=array(
    'info' => array('create' => 1),
    'url' => 'http://scxd.info/pub/',
    'rank' => 0,
    'version' => 'current', # OK
    'arch' => 'i386',
    'class' => '32cur',
    'npkgs' => 0,
    'nfiles' => 0,
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
    'rank' => 0,
    'version' => '13.0', # OK
    'arch' => 'i386',
    'class' => '32130',
    'npkgs' => 0,
    'nfiles' => 0,
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
    'rank' => 0,
    'version' => '12.2',
    'arch' => 'x86_64',
    'class' => '64122',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'daniele50.it',
    'description' => 'Daniele50'
  );

$defrepo[82]=array( ###### BUGGATO #######
    'info' => array('create' => 1),
    'url' => 'http://ftp.naist.jp/pub/Linux/linuxpackages/Slackware/',
    'rank' => 0,
    'version' => '13.0',
    'arch' => 'i386',
    'class' => '32130',
    'npkgs' => 0,
    'nfiles' => 0,
    'manifest' => '',
    'packages' => 'PACKAGES.TXT',
    'hashfile' => 'CHECKSUMS.md5',
    'name' => 'linuxpackages-13.0-i386-frias',
    'description' => 'LP frias'
  );






?>
