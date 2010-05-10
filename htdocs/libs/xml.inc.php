<?php
class xml extends XMLWriter
{
  var $indstr='    ';
  var $level=0;

    public function __construct($prm_rootElementName, $prm_Attributes=null){
      $this->openMemory();
      $this->setIndent(true);
      $this->setIndentString($this->indstr);
      $this->startDocument('1.0', 'UTF-8');
      $this->startSection($prm_rootElementName,$prm_Attributes);
    }
    public function start($prm_rootElementName){
    }

    public function startSection($prm_elementName, $prm_Attributes=null){
      $this->startElement($prm_elementName, $prm_Attributes);
      $this->level++;
    }
    public function endSection(){
      $this->endElement();
      $this->level--;
    }
    public function startElement($prm_elementName, $prm_Attributes=null){
      parent::startElement($prm_elementName);
      if(is_array($prm_Attributes)){
	foreach($prm_Attributes as $key => $value)$this->writeAttribute($key,$value);
      }
    }

    public function text($content){
      if(strpos($content,"\n")!==false){
	$is=str_repeat($this->indstr,$this->level);
	$content="\n$is".str_replace("\n","\n$is",$content)."\n";
      }
      return parent::text($content);
    }

    public function setElement($prm_elementName, $prm_ElementText=null, $prm_Attributes=null){
        $this->startElement($prm_elementName,$prm_Attributes);
        if(!is_null($prm_ElementText))$this->text($prm_ElementText);
        $this->endElement();
    }
    public function endElement(){
      return parent::endElement();
    }

    public function fromArray($prm_array){
      if(is_array($prm_array)){
        foreach ($prm_array as $index => $element){
          if(is_array($element)){
            $this->startElement($index);
            $this->fromArray($element);
            $this->endElement();
          }
          else
            $this->setElement($index, $element);
         
        }
      }
    }

//    public function startAttribute($name){
 //     return parent::startAttribute($name);
  //  }

    public function getDocument(){
        $this->endSection();
        $this->endDocument();
        return $this->outputMemory();
    }

    public function output(){
        header('Content-type: text/plain');
        echo $this->getDocument();
    }
  

}

?>
