<?php


class internet {
  public function __construct($url){
    $this->url=$url;
    $this->separe();
  }
  public function separe(){
    $tmp=preg_split('/^([^:]*):\/\/([^\/]*)(|\/((.*\/)*)([^\/]*))$/i',$this->url);
    var_dump($tmp);


  }

  public function open($url, $compr=""){

  }



}





?>
