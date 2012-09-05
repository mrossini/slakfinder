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




  function url_parse($url=null){
    if(!$url){
      if(!isset($_SERVER["REQUEST_URI"])){
	return false;
      }else{
	$url=$_SERVER["REQUEST_URI"];
      }
    }
    if(substr($url,0,4)!="http"){
      if(isset($_SERVER['HTTP_HOST'])){
	$url=$_SERVER['HTTP_HOST'].$url;
      }elseif(isset($_SERVER['HOSTNAME'])){
	$url=$_SERVER['HOSTNAME'].$url;
      }else{
	$url='localhost'.$url;
      }
      if(isset($_SERVER['HTTP_HOST'])){
	if(isset($_SERVER['HTTPS'])){
	  $url="https://".$url;
	}else{
	  $url="http://".$url;
	}
      }else{
	$url='http://'.$url;
      }

    }
    $parseurl=parse_url($url);
    if(!isset($parseurl['path']))$parseurl['path']="/";

    $parseurl['request']=$parseurl['path'].(isset($parseurl['query'])?"?".$parseurl['query']:"").(isset($parseurl['fragment'])?"#".$parseurl['fragment']:"");
    $parseurl['url']=$parseurl['scheme']."://".$parseurl['host'].(isset($parseurl['port'])?":".$parseurl['port']:"").$parseurl['request'];

    if(!isset($parseurl['port'])){
      if($parseurl['scheme']=="http")$parseurl['port']=80;
      if($parseurl['scheme']=="https")$parseurl['port']=443;
    }

    foreach(pathinfo($parseurl['path']) as $key => $value)$parseurl[$key]=$value;
    $parseurl['get']=array();
    if(!isset($parseurl['query']))$parseurl['query']="";
    parse_str($parseurl['query'],$parseurl['get']);
    return $parseurl;
  }

  function tables($data=null,$what=2,$extra="",$etr=""){
    $out='';
    if(!is_null($data)){
      if($what==1){
        $out.= "<table $extra cellspacing='0'>\n";
        if($data){
          $out.= "  <tr $etr>";
          foreach($data as $value) $out.= "<th>$value</th>";
          $out.= "</tr>\n";
        }
      }elseif($what==2){
        $out.= "  <tr $etr>";
        foreach($data as $value) $out.= "<td $extra>$value</td>";
        $out.= "</tr>\n";
      }
    }else{
      $out.= "</table>\n";
    }
    return $out;
  }
  function histogram(&$arr,$large=3,$multi=1){
    $max=0;
    foreach($arr as $val)$max=($val>$max)?$val:$max;

    $im=ImageCreate($large*count($date),$max*$multi)or die("failed");
    $bg=ImageColorAllocate($im,240,255,250);
    $bar=imagecolorallocate($im, 0, 0, 0);  

    $i=0;
    foreach($date as $val){
      imagefilledrectangle($im,$i*$large,$max*$multi-$val*$multi,$i*$large+$large-1,$max*$multi,$bar);
      $i++;
    }

    header("Content-type: image/png");
    imagepng($im);
    imagedestroy($im);
  }
?>
