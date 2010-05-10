<?php


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

  function tables($data=null,$what=2,$extra=""){
    $out='';
    if(!is_null($data)){
      if($what==1){
        $out.= "<table $extra cellspacing='0'>\n";
        if($data){
          $out.= "  <tr>";
          foreach($data as $value) $out.= "<th>$value</th>";
          $out.= "</tr>\n";
        }
      }elseif($what==2){
        $out.= "  <tr>";
        foreach($data as $value) $out.= "<td $extra>$value</td>";
        $out.= "</tr>\n";
      }
    }else{
      $out.= "</table>\n";
    }
    return $out;
  }
?>
