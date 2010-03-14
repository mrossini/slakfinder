<?php
  function tables($data=null,$what=2,$border=1){
    if(!is_null($data)){
      if($what==1){
        echo "<table border='$border' cellspacing='0'>\n";
        if($data){
          echo "  <tr>";
          foreach($data as $value) echo "<th>$value</th>";
          echo "</tr>\n";
        }
      }elseif($what==2){
        echo "  <tr>";
        foreach($data as $value) echo "<td>$value</td>";
        echo "</tr>\n";
      }
    }else{
      echo "</table>\n";
    }
  }
?>
