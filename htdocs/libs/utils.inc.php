<?php
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
