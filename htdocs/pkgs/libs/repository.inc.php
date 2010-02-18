<?php

class repository {

  private $db;
  
  public function __construct($id=0){
    global $db;
    $this->db=$db;
    if($id)$this->select($id);
  }
  public function add($repo){
    if(!$this->db->query("
      insert into #__repository (url,official,manifest,packages,alias,description,path) value (
	'{$repo['url']}', '{$repo['official']}', '{$repo['manifest']}',
	'{$repo['packages']}', '{$repo['alias']}', '{$repo['description']}', '{$repo['path']}'
      );"))return false;
    foreach($repo as $key => $value) $this->$key = $value;
    $id=$this->db->newid;
    return $id;
  }


  public function download(){
    global $repodir;
    $path=$repodir.$this->path;
    if(!file_exists($path))if(!mkdir($path))return false;
  #  if(file_exists($path


  }
  public function select($id){
    if(!$this->db->query("select * from #__repository where id=$id")) return false;
    if(!$repo=$this->db->fetch())return false;
    foreach($repo as $key => $value) $this->$key = $value;
  }

}


?>
