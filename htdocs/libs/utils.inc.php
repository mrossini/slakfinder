<?php
  function tables($data=null,$what=2,$border=1){
    $out='';
    if(!is_null($data)){
      if($what==1){
        $out.= "<table border='$border' cellspacing='0'>\n";
        if($data){
          $out.= "  <tr>";
          foreach($data as $value) $out.= "<th>$value</th>";
          $out.= "</tr>\n";
        }
      }elseif($what==2){
        $out.= "  <tr>";
        foreach($data as $value) $out.= "<td>$value</td>";
        $out.= "</tr>\n";
      }
    }else{
      $out.= "</table>\n";
    }
    return $out;
  }
?>
