<?php

  include 'inc/includes.inc.php';
  include 'inc/defrepo.inc.php';

  $al=new access_log();
  $al->open();

  $date=array();
  define ('DAY',3600*24);
  $days=time()/DAY;



  $pkgs=array();
  $al->setsearch('_start','=','0');
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
    $large=5; $multi=1;
    $max=0;
    foreach($date as $val)$max=($val>$max)?$val:$max;

    $im=ImageCreate($large*count($date)+1,$max*$multi);
    $bg=ImageColorAllocate($im,240,255,250);
    $bar=imagecolorallocate($im, 0, 0, 0);
    $red=imagecolorallocate($im, 255, 0, 0);

    $i=0;
    foreach($date as $key => $val){
      imagefilledrectangle($im,$i*$large+1,$max*$multi-$val*$multi,$i*$large+$large-1,$max*$multi,$bar);
      if(date('j',($key+$start)*DAY)==1) imagerectangle($im,$i*$large,0,$i*$large,$max*$multi,$red);
      $i++;
    }

    header("Content-type: image/png");
    imagepng($im);
    imagedestroy($im);


?>
