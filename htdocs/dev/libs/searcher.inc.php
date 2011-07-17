<?php


class searcher {
  var $q=''; // query: needed
  var $in='name'; // where: name,desc,file
  var $wo=null; // entire string: 0,null,'',1
  var $repo=null; // repository: 0,null,repoid
  var $arch=null; // architecture: null,any,i386,x86,x86_64,x64
  var $dver=null; // slackver: null,any,old,13.1,13.0,12.2....10.0
  var $ver=null; // pkgver: null,'',string
  var $op=null; // operator: null,0,1,'>=',2,'==','=',3,'<='


  public function init($data){
    if(!isset($data['q']))return null;
    foreach($data as $key => $val){
      $this->$key=$val;
    }
    if($this->distro){
      list($this->dver,$this->arch)=explode('-',$this->distro);
    }
    if($this->dver=="any")$this->distro=null;
    switch ($this->arch){
      case 'x86','i386','i486','i586','i686': $this->arch='i386'; break;
      case 'x64','x86_64','amd64','athlon64': $this->arch='x86_64'; break;
      default: $this->arch=null;
    }
    if($this->arch=="any")$this->arch=null;
    if($this->repo==0)$this->repo=null;
    if($this->wo!=1)$this->wo=null;
    if($this->ver='')$this->ver=null;
    if(!$this->ver)$this->op=null;
    switch ($this->op){
      case 1,'>=','>': $this->op='>='; break;
      case 2,'==','=': $this->op="="; break;
      case 3,'<=','<': $this->op="<="; break;
      default: $this->op=null;
    }
    if($this->ver and !$this->op)$this->op="=";
  }












}
