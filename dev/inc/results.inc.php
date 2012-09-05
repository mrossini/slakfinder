<?php
/*
 * Copyright 2009, 2010, 2011, 2012 Matteo (ZeroUno) Rossini, Rome, Italy
 * All rights reserved.
 *
 * Redistribution and use of this script, with or without modification, is
 * permitted provided that the following conditions are met:
 *
 * 1. Redistributions of this script must retain the above copyright
 *    notice, this list of conditions and the following disclaimer.
 *
 * THIS SOFTWARE IS PROVIDED BY THE AUTHOR ''AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO
 * EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS;
 * OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY,
 * WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF
 * ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */


function search(){
  global $q,$in;
  $out="";
  if($in!='name'){
    $out.="NOT IMPLEMENTED!!!";
    return $out;
  }
  $out.="Searching $q in $in";

  $results=new searcher();
  $results->init(array('q' => $q,'in' => $in));

  return $out;
}
function oldsearch(){
  echo $hrepos;
  if ($name or $desc or $file){
    echo "<pre>";
    $sname=$name; $sdesc=$desc; $sfile=$file;
    $name=urlencode($name);
    $desc=urlencode($desc);
    $file=urlencode($file);
    $sname=str_replace(' ','%',$sname);
    $sdesc=str_replace(' ','%',$sdesc);
    $sfile=str_replace(' ','%',$sfile);
    $sname=preg_replace('/[%-][0-9].*/','',$sname);
    if($sfile){ $sfile="%$sfile%";}
    if(!$file){ ///////////////////////////////////// PACKAGES.TXT RESULTS ////////////////////////////////////////////////
      switch($order){
	case "ranku": $ord='rank desc';break;
	case "rankd": $ord='rank';break;
	case "pkgu": $ord='P.name';break;
	case "pkgd": $ord='P.name desc';break;
	case "veru": $ord='P.version desc';break;
	case "verd": $ord='P.version';break;
	case "archu": $ord='P.arch';break;
	case "archd": $ord='P.arch desc';break;
	case "distu": $ord='R.version desc';break;
	case "distd": $ord='R.version';break;
	case "fileu": $ord='F.filename';break;
	case "filed": $ord='F.filename desc';break;
	case "pathu": $ord='F.fullpath';break;
	case "pathd": $ord='F.filename desc';break;
	case "repou": $ord='R.description';break;
	case "repod": $ord='R.description desc';break;
	case "locu": $ord='P.location';break;
	case "locd": $ord='P.location desc';break;
      }
      $pkg=new package();
      $nres=$pkg->find($sname,$sdesc,$repo,$ord);
      
      if(isset($_GET['debug']))var_dump($pkg,$nres);
      $to=$start+$maxresult; if($to > $nres)$to=$nres;
      echo "Time: ".(round($pkg->db->msec/1000,3))." msec<br />";
      echo "Results ".($start+1)."-$to of $nres:                    ";
	if($start > 0){
	  echo "<a href='index.php?start=0&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&lt;&lt;</a>  ";
	  $from=$start-$maxresult;if($from<0)$from=0;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&lt;</a>  ";
	}
	if($to < $nres){
	  $pg=round($nres/$maxresult-0.5,0);
	  $from=$start+$maxresult;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&gt;</a>  ";
	  $from=$maxresult*$pg;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&gt;&gt;</a>  ";
	}
	echo tables(array(
	  "<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='ranku')?'rankd':'ranku')."#results'>rank</a>",
	  "<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='pkgu')?'pkgd':'pkgu')."#results'>package</a>",
	  "<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='veru')?'verd':'veru')."#results'>version</a>",
	  "<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='archu')?'archd':'archu')."#results'>arch</a>",
	  "<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='distu')?'distd':'distu')."#results'>distro</a>",
	  "<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='repou')?'repod':'repou')."#results'>repository</a>",
	  "<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='locu')?'locd':'locu')."#results'>location</a>",
	  "&nbsp;"),1,"class='results' width='100%'");
      if($nres>$start){
	$repos=null;
	$pkg->find(null,$start);
	for ( $i=$start ; $i < $to; $i++ ){
	  $pkg->find();
	  echo tables(array(
	    $pkg->rank,
	    "<a title='".(str_replace(array("'","\n"),array(" "," "),$pkg->description))."' href='show.php?pkg={$pkg->id}'>{$pkg->name}</a>",
	    $pkg->version,
	    $pkg->arch,
	    $pkg->repover,
	    "<a title='{$pkg->url}' href='showrepo.php?repo={$pkg->repoid}'>{$pkg->repobrief}</a>",
	    "<a href='{$pkg->url}{$pkg->location}/'>{$pkg->location}/</a>",
	    "<a href='{$pkg->url}{$pkg->location}/{$pkg->filename}'>download</a>"));
	}
      }
      echo tables();
      if($start > 0){
	echo "<a href='index.php?start=0&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&lt;&lt;</a>  ";
	$from=$start-$maxresult;if($from<0)$from=0;
	echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&lt;</a>  ";
      }
      if($to < $nres){
      $pg=round($nres/$maxresult-0.5,0);
      $from=$start+$maxresult;
      echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&gt;</a>  ";
	$from=$maxresult*$pg;
	echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&gt;&gt;</a>  ";
      }
      echo "<br /><br /><br />";
    }else{ /////////////////////////////////////////////////// MANIFEST.bz2 RESULTS ///////////////////////////////////////////////////////////
  //    $maxresult=80;
      switch($order){
	case "ranku": $ord='rank desc';break;
	case "rankd": $ord='rank';break;
	case "pkgu": $ord='pkgname';break;
	case "pkgd": $ord='pkgname desc';break;
	case "veru": $ord='version desc';break;
	case "verd": $ord='version';break;
	case "archu": $ord='arch';break;
	case "archd": $ord='arch desc';break;
	case "distu": $ord='distro desc';break;
	case "distd": $ord='distro';break;
	case "fileu": $ord='filename';break;
	case "filed": $ord='filename desc';break;
	case "pathu": $ord='fullpath';break;
	case "pathd": $ord='fullpath desc';break;
	case "repou": $ord='repobrief';break;
	case "repod": $ord='repobrief desc';break;
	case "locu": $ord='pkgloc';break;
	case "locd": $ord='pkgloc desc';break;
      }
      $fl=new filelist();
      $nres=$fl->find($sfile,$sname,$sdesc,$repo,$ord);
      if(isset($_GET['debug']))var_dump($fl,$nres);
      $to=$start+$maxresult; if($to > $nres)$to=$nres;
      echo "Time: ".(round($fl->db->msec/1000,3))." msec<br />";

      echo "Results ".($start+1)."-$to of $nres:                    ";

	if($start > 0){
	  echo "<a href='index.php?start=0&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&lt;&lt;</a>  ";
	  $from=$start-$maxresult;if($from<0)$from=0;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&lt;</a>  ";
	}
	if($to < $nres){
	  $pg=round($nres/$maxresult-0.5,0);
	  $from=$start+$maxresult;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&gt;</a>  ";
	  $from=$maxresult*$pg;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&gt;&gt;</a>  ";
	}




//      echo tables(array('rank','package','version','arch','distro','file','path','repository','location','&nbsp'),1,"class='results' width='100%'");
      echo tables(array(
	"<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='ranku')?'rankd':'ranku')."#results'>rank</a>",
	"<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='pkgu')?'pkgd':'pkgu')."#results'>package</a>",
	"<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='veru')?'verd':'veru')."#results'>version</a>",
	"<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='archu')?'archd':'archu')."#results'>arch</a>",
	"<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='distu')?'distd':'distu')."#results'>distro</a>",

	"<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='fileu')?'filed':'fileu')."#results'>file</a>",
	"<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='pathu')?'pathd':'pathu')."#results'>path</a>",

	"<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='repou')?'repod':'repou')."#results'>repository</a>",
	"<a href='index.php?start=$start&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=".(($order=='locu')?'locd':'locu')."#results'>location</a>",
	"&nbsp;"),1,"class='results' width='100%'");
      if($nres>$start){
	$fl->find(null,$start);
	for ( $i=$start ; $i < $to ; $i++ ){
	  $fl->find();
	  echo tables(array(
	    $fl->rank,
#	    "<a href='show.php?pkg={$fl->pkgid}'>{$fl->pkgname}</a>",
	    "<a title='".(str_replace(array("'","\n"),array(" "," "),$fl->pkgdesc))."' href='show.php?pkg={$fl->pkgid}'>{$fl->pkgname}</a>",

	    $fl->version,
	    $fl->arch,
	    $fl->distro,
	    str_ireplace("$file","<b style='color:red;'>$file</b>",$fl->filename),
	    $fl->fullpath,
	    "<a title='{$fl->repodesc}' href='{$fl->url}'>{$fl->repobrief}</a>",
	    "<a href='{$fl->url}{$fl->pkgloc}/'>{$fl->pkgloc}/</a>",
	    "<a href='{$fl->url}{$fl->pkgloc}/{$fl->pkgfile}'>download</a>"));
	}
      }
      echo tables();
	if($start > 0){
	  echo "<a href='index.php?start=0&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&lt;&lt;</a>  ";
	  $from=$start-$maxresult;if($from<0)$from=0;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&lt;</a>  ";
	}
	if($to < $nres){
	  $pg=round($nres/$maxresult-0.5,0);
	  $from=$start+$maxresult;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&gt;</a>  ";
	  $from=$maxresult*$pg;
	  echo "<a href='index.php?start=$from&maxresult=$maxresult&repo=$repo&name=$name&desc=$desc&file=$file&order=$order#results'>&gt;&gt;</a>  ";
	}





      echo "</pre>";
      echo "<br /><br /><br />";
    }
    ?>
    <script>
    var wait=document.getElementById('wait1');
    wait.style.color="white";
    var wait=document.getElementById('wait2');
    wait.style.color="white";
    </script>
    <?php
  }
}
/*
  if (!($name or $desc or $file)){
    echo "<br><table width=100% style='border-top:1px dotted #000000;border-bottom:1px dotted #000000;'>";
    echo "<tr>";
    echo "<td width='50%'>";

    $gb=new guestbook();
    echo "<a href='gb.php'>Guest Book</a>: you can <a href='gb.php'>post comments</a>, suggests, bug/repository reports, or just your signature.<br><br>";
    $mm=5;
    echo tables(array("","",""),1," class='gb' ");
    echo tables(array("Date","Nick","Message"),1," class='gb' ");
    while($message=$gb->fetch() and ($mm-- > 0)){
      echo tables(array("<sup>{$message['date']}</sup>","<font color='red'>".$message['nick']."</font> ","".$message['message']));
    }
    echo tables();
    echo "<a href='gb.php'>show all</a>";  
    echo "<nobr><form action='gb.php' method='post'><br>Nick: ";
    echo "<input name=nick size=10 maxlenght=15 "; 
    if(isset($_SESSION['slakhomelinux2guestbooknick']))echo "value='{$_SESSION['slakhomelinux2guestbooknick']}'";
    echo "> -message: <br>";
    echo "<textarea name=message cols=30 rows=3></textarea><br>";
    echo "<input type=submit value='go'><br></form></nobr>";

    echo "<br>";


    echo "</td>";
    echo "<td width='50%' valign=top style='border-left:1px dotted #000000'>";

    echo "<b>NEWS:</b><br><br>\n\n";
    include "news.php";

    echo "</td>";
    echo "</tr>";
    echo "</table>";

 

  }
?>
<p>To report a bug, mail to <a href='mailto:zerouno@slacky.it'>zerouno@slacky.it</a>. Thanks.</p>
</body></html>
 */

?>
