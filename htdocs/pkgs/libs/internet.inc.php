<?php


class internet {
  public function __construct($url){
    $this->url=$url;
    $this->separe();
  }
  public function separe(){
    $tmp=preg_split(
      '#^'.
    #    1     2                3           4        56           7     890      1           2
        '(' . '([^:]*)://)?' . '([^/]*)' . '(' . '$|/((.*)/)?' . '(' . '((([^/]*)(\.[^\.]*))|([^/]*))' . ')?' . ')'.
	'$#i',
      $this->url,0,PREG_SPLIT_DELIM_CAPTURE);
    $this->proto=($tmp[2])?($tmp[2]):http;
    $this->domain=$tmp[3];
    $this->fullpath=$tmp[4];
    $this->path="/".$tmp[6];
    $this->file=($tmp[10])?($tmp[10]):($tmp[12]);
    print_r($tmp);


  }

  public function open($url, $compr=""){

  }



}





?>
