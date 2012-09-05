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



class stats {
  var $db;
  public function __construct(){
    $this->db=new mysql();
  }
  public function lastsearch($count){
    $this->db->query("SELECT sname FROM #__searches WHERE sname <> '' ORDER BY dt DESC LIMIT 0,$count");
    $out=array();
    while($res=$this->db->get())$out[]=$res['sname'];
    return $out;
  }
  public function lastminsearch($count){
    $this->db->query("SELECT sname,TIMESTAMPDIFF(SECOND,dt,now()) AS sec FROM #__searches WHERE sname <> '' ORDER BY sec ASC LIMIT 0,$count");
    $out=array();
    while($res=$this->db->get())$out[]=array("min" => round($res['sec']/60),"sname"=>$res['sname']);
    return $out;
  }
  public function groupbypkg($count){
    $this->db->query("SELECT sname,COUNT(sname) as ns FROM #__searches WHERE sname <> '' GROUP BY sname ORDER BY ns DESC LIMIT 0,$count");
    $out=array();
    while($res=$this->db->get())$out[]=array("ns" => $res['ns'],"sname"=>$res['sname']);
    return $out;
  }
  public function maxbyday(){
    $this->db->query("SELECT COUNT(dt) AS ct, DATEDIFF(now(),dt) AS d FROM #__searches GROUP BY d ORDER BY ct DESC LIMIT 0,1");
    $out=$this->db->get();
    return $out['ct'];
  }
  public function numdays(){
    $this->db->query("SELECT DATEDIFF(now(),dt) AS d FROM #__searches LIMIT 0,1");
    $out=$this->db->get();
    return $out['d']+1;
  }
  public function countbyday($count){
    $this->db->query("SELECT COUNT(dt) AS ct, DATEDIFF(now(),dt) AS d FROM #__searches GROUP BY d ORDER BY d ASC LIMIT 0,$count");
    $out=array();
    $tmp=array();
    while($res=$this->db->get())$tmp[$res['d']]=$res['ct'];
    for ($i=0;$i<$count;$i++){
      if(isset($tmp[$i])){
	$out[$i]=$tmp[$i];
      }else{
	$out[$i]=0;
      }
    }
    return $out;
  }
  public function countall(){
    $this->db->query("SELECT COUNT(*) AS ct FROM #__searches");
    $out=$this->db->get();
    return $out['ct'];
  }

}



?>
