<?php

class form {

  var $params=array();
  var $method=null;
  public function __construct($par=null){
    if(is_null($par)){
      if(isset($_GET)){
	$this->method='get';
	$this->params=$_GET;
      }elseif(isset($_POST)){
	$this->method='post';
	$this->params=$_POST;
      }
    }else{
      $this->params=$par;
    }
    $this->parse();
  }
  public function parse(){
    @$this->search=$this->params['search'] or $this->search="";
    @$this->arch=$this->params['arch'];
    @$this->dver=$this->params['dver'];
    @$this->distro=$this->params['distro'];
    @$this->ver=$this->params['ver']; 
    @$this->op=$this->params['op']; 
    @$this->in=$this->params['in']; switch($this->in){ case 'name': case 'desc': case 'file': break; default: $this->in='name'; }

    if($this->distro){
      list($this->arch,$this->dver)=explode('-',$this->params['distro']);
    }
    switch($this->arch){
      case 'x86': case 'i386': $this->arch='x86'; break;
      case 'x64': case 'amd64': case 'athlon64': case 'x86_64': $this->arch='x64'; break;
      case 'any': break;
      default: $this->arch='x86';
    }
    switch($this->dver){
      case 'cur': case 'curr': case 'current': $this->dver='cur'; break;
      case '131': case '13.1': $this->dver='131'; break;
      case '130': case '13.0': case '13': $this->dver='130'; break;
      case '122': case '12.2': $this->dver='122'; break;
      case 'old': case 'older': $this->dver='old'; break;
      case 'any': $this->dver='any'; break;
      default: $this->dver='131';
    }
    $this->distro=$this->dver.'-'.$this->arch;
    if ($this->in=='name'){
      if(!preg_match('/[ ><=]/',$this->search)){
	$this->search=preg_replace('/\.t.z$/','',$this->search);
	$split=explode('-',$this->search);
	$n=count($split);
	if($n>=2){
	  if(preg_match('/^(i.86|noarch|x86_64)$/',$split[$n-1])){
	    $this->pkgname="";$sep="";
	    for($i=0;$i<$n-2;$i++){
	      $this->pkgname.=$sep.$split[$i];
	      $sep="-";
	    }
	    $this->ver=$split[$n-2]."-".$split[$n-1];
	    $this->op=1;
	    $this->search=$this->pkgname;
	  }elseif(preg_match('/^(i.86|noarch|x86_64)$/',$split[$n-2])){
	    $this->pkgname="";$sep="";
	    for($i=0;$i<$n-3;$i++){
	      $this->pkgname.=$sep.$split[$i];
	      $sep="-";
	    }
	    $this->ver=$split[$n-3]."-".$split[$n-2]."-".$split[$n-1];
	    $this->op=2;
	    $this->search=$this->pkgname;
	  }
	}
      }else{
	$tmp=preg_split('/^(.*) *(>|>=|<|<=|=|==) *(.*)$/',$this->search,0,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
	$this->pkgname=$tmp[0];
	if(isset($tmp[1])){$this->op=$tmp[1];}
	if(isset($tmp[2])){$this->ver=$tmp[2]; $this->search=$this->pkgname;}
	  var_dump($tmp);
      }
    }
    switch($this->op){ 
      case '1': case '>': case '>=': case '=>': $this->op=1; break;
      case '2': case '=': case '==': $this->op=2; break;
      case '3': case '<': case '<=': case '=<': $this->op=3; break;
      default:$this->op=1;
    }
    echo "<pre>";var_dump($this);echo "</pre>";
  }
  public function show(){
    $repo1=tables(array('&nbsp;','any','i386','x86_64'),1," class='repository'");
    $i=0;
    foreach (array('any'=>'any','cur'=>'current','131'=>'13.1','130'=>'13.0','122'=>'12.2','old'=>'older') as $kv => $vv){
      $row=array("<b>$vv</b>");
      $i++;
      foreach (array('any'=>'any','x86'=>'i386','x64'=>'x86_64') as $ka => $va){
	if($ka=="x64" and $i>4){
	  $row[]="&nbsp;";
	}else{
	  $row[]="<input type=radio name=distro value='$kv-$ka'".(($this->distro=="$kv-$ka")?"checked ":"").">";
	}
      }
      $repo1.=tables($row);
    }
    $repo1.=tables();
    $input="
      <table>
      <tr><td>Search:</td> <td><input size=30 name='search' value='{$this->search}' /> <input type='submit' value='go' /></td></tr> 
      <tr><td>In</td><td>
	     <input type='radio' name='in' value='name'".(($this->in=='name')?" checked":"").">pkg name - 
	     <input type='radio' name='in' value='desc'".(($this->in=='desc')?" checked":"").">description -
	     <input type='radio' name='in' value='file'".(($this->in=='file')?" checked":"").">filelist
      </td></tr> 
      <tr>
	  <td>Version:</td>
	  <td>
	      <select name='op'>
		<option value=1 ".(($this->op==1)?"selected":"").">&gt;=</option>
		<option value=2 ".(($this->op==2)?"selected":"").">==</option>
		<option value=3 ".(($this->op==3)?"selected":"").">&lt;=</option>
	      </select>
	      <input name='ver' value='$this->ver' size=23 />
	  </td>
      </tr></table>\n";
    $form="<table><tr><td>$repo1</td><td>$input</td></table>";

    return $form;
  }







}
