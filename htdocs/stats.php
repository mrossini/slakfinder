<?php

  include 'inc/includes.inc.php';
  include 'inc/defrepo.inc.php';

  global $date,$pkgs,$max;
  function initstat(){
    global $date,$pkgs,$max;
    $al=new tail_log();
    #$al=new tail_log();
    $al->open();

    $date=array();
    define ('DAY',3600*24);
    $now=time()/DAY;



    /*
    $pkgs=array();
    $al->setsearch('_start','=','0');
    if(isset($_GET['time'])){$time=$_GET['time'];}else{$time=365;}
      $i=1;
    while($res=$al->find()) {
      if(@$res['url']['get']['name']){
	if(!$pkgs){
	  $pkgs[]=$res;
	}else{
	  $last=end($pkgs);
	  if(($last['url']['get']['name']!=$res['url']['get']['name'])or
	     ($last['url']['get']['name']==$res['url']['get']['name'] and $last['ip']!=$res['ip'])){
	    $pkgs[]=$res;
	    $day=round($last['time']/DAY-0.5,0);
	    if($day>=$now-$time){
	      if(!isset($date[$day])){
		$date[$day]=1;
	      }else{
		$date[$day]++;
	      }
	    }
	  }
	}
      }
    }
     */
    
    $pkgs=array();
    $ip=array();
    $al->setsearch('_start','=','0');
    if(isset($_GET['time'])){$time=$_GET['time'];}else{$time=365;}
    $i=1;
    while($res=$al->find()) {
      if(@$res['url']['get']['name']){
	$pres=$res['url']['get']['name'];
	$pip=$res['ip'];
	if(@$ip[$pip]!=$pres){
	  $pkgs[]=$res;
	  $ip[$pip]=$pres;
	  $day=round($res['time']/DAY-0.5,0);
	  if($day>=$now-$time){
	    if(!isset($date[$day])){
	      $date[$day]=1;
	    }else{
	    $date[$day]++;
	    }
	  }
	}
      }
    }
    
    $bdate=array_keys($date);
    $start=reset($bdate);
    $end=end($bdate);
    for($d=$end;$d>=$start;$d--){
      if(!isset($date[$d]))$date[$d]=0;
    }
  }

  if(isset($_GET['gdaily'])){
    initstat();
    #$max=0;
    #foreach($date as $val)$max=($val>$max)?$val:$max;
    $max=max($date);
/*    echo "<pre>";
    echo $max;
    var_dump($date);
    echo "</pre>";
    exit;*/
    if(isset($_GET['y'])){
      $multi=$_GET['y']/$max;
    }else{
      $multi=1;
    }
    if(isset($_GET['x'])){
      $large=$_GET['x']/count($date)-1;
      $space=($large<3)?0:1;
    }else{
      $large=5;
      $space=1;
    }

    $im=ImageCreate($large*count($date),$max*$multi);
    $bg=ImageColorAllocate($im,240,255,250);
    #$bar=ImageColorAllocate($im, 0, 0, 0);
    $red=ImageColorAllocate($im, 255, 0, 0);
    $blue=ImageColorAllocate($im, 0, 0, 255);
    $green=ImageColorAllocate($im, 0, 255, 0);

    $col=array();
    $col[0]=ImageColorAllocate($im, 0, 0, 0);
    $col[1]=ImageColorAllocate($im, 0, 0, 0);
    $c=0;

    $i=0;
#    ImageString($im,3,1,1,"Mar",$blue);
    foreach($date as $key => $val){
      if(!$i) if(date('j',($key)*DAY)<20) ImageString($im,2,$i*$large+2,1,date("M",($key)*DAY),$red);
      $bar=$col[$c];$c=1-$c;
      ImageFilledRectangle($im,$i*$large+$space,$max*$multi-$val*$multi,($i+1)*$large-1,$max*$multi,$bar);
      if(date('j',($key)*DAY)==1) {
	ImageRectangle($im,$i*$large,0,$i*$large,$max*$multi,$red);
	ImageString($im,2,$i*$large+2,1,date("M",($key)*DAY),$red);
      }
      if($space)if(!date('w',($key)*DAY)==1) ImageRectangle($im,$i*$large,$max*$multi/4,$i*$large,$max*$multi,$green);
      $i++;
    }
    for($i=100;$i<$max;$i+=100){
      ImageRectangle($im,0,$max*$multi-$i*$multi,$large*count($date)+1,$max*$multi-$i*$multi,$blue);
      ImageString($im,2,1,$max*$multi-$i*$multi,$i,$blue);
    }

    header("Content-type: image/png");
    ImagePNG($im);
    ImageDestroy($im);
    exit;
  }
  ### ELSE
  #

  initstat();
  $names=array();
  $ord=array();
  $when=array();
  $mom=time();
  foreach($pkgs as $pkg){
    $names[]=$pkg['url']['get']['name'];
    $name=$pkg['url']['get']['name'];
    $when[]=$pkg['time'];#round(($mom-$pkg['time'])/60);
    if(isset($ord[$name])){$ord[$name]++;}else{$ord[$name]=1;}
  }
  arsort($ord,SORT_NUMERIC);
  echo "<pre>";
  echo "<table border=1 cellspacing=0>";
  echo "<tr><td colspan=2>";
  echo "Searches from begin.";
  echo " | Today: ".end($date)." | Top: ".(max($date))." | Daily";
  echo ":<br><img src='stats.php?gdaily&y=200'>";
  echo "</td></tr>";
  echo "<tr><th>Last 100</th><th>Top 100</th><tr>";
  echo "<td>";
  $names=array_reverse($names);
  $when=array_reverse($when);
  for($i=0;$i<100;$i++){
    $name=$names[$i];
    if(strlen($name)>25)$name=substr($name,0,25)."...";
    $min=round(($mom-$when[$i])/60);
    echo "$min'  $name<br>";
  }


  echo "</td><td>";
  $i=0;
  foreach($ord as $key => $val){
    if($i++ == 100)break;
    echo "$val $key<br>";
    
  }
  echo "</td></tr></table>";

  echo "</pre>";



?>
