<?php


function _str_getcsv($input,$delimiter=",",$enclosure="'"){
  $out=array();
  foreach (explode($delimiter,trim($input,"\n")) as $field)$out[]=trim($field,$enclosure);
  return $out;
}


/*
 * 0 id notes macro version arch enabled update remove name 
 * url manifest deps rank class packages brief description
 */
$defrepo=array();
$idx=array();
foreach(_str_getcsv(file_get_contents("repolist.csv"),"\n") as $row){
  if(!$idx){
    $csv=_str_getcsv($row,";","'");
    $idx=array_combine($csv,array_keys($csv));
  }else{
    $csv=_str_getcsv($row,";","'");
    $defrepo[(int)$csv[$idx['id']]][0]=              (int)   $csv[$idx[0]];
    $defrepo[(int)$csv[$idx['id']]]['id']=           (int)   $csv[$idx['id']];
    $defrepo[(int)$csv[$idx['id']]]['notes']=        (string)$csv[$idx['notes']];
    $defrepo[(int)$csv[$idx['id']]]['macro']=        (string)$csv[$idx['macro']];
    $defrepo[(int)$csv[$idx['id']]]['version']=      (string)$csv[$idx['version']];
    $defrepo[(int)$csv[$idx['id']]]['arch']=         (string)$csv[$idx['arch']];
    $defrepo[(int)$csv[$idx['id']]]['enabled']=      (bool)  $csv[$idx['enabled']];
    $defrepo[(int)$csv[$idx['id']]]['update']=       (bool)  $csv[$idx['update']];
    $defrepo[(int)$csv[$idx['id']]]['remove']=       (bool)  $csv[$idx['remove']];
    $defrepo[(int)$csv[$idx['id']]]['name']=         (string)$csv[$idx['name']];
    $defrepo[(int)$csv[$idx['id']]]['url']=          (string)$csv[$idx['url']];
    $defrepo[(int)$csv[$idx['id']]]['rank']=         (int)   $csv[$idx['rank']];
    $defrepo[(int)$csv[$idx['id']]]['class']=        (string)$csv[$idx['class']];
    $defrepo[(int)$csv[$idx['id']]]['packages']=     (string)$csv[$idx['packages']];
    $defrepo[(int)$csv[$idx['id']]]['manifest']=     
      (((string)$csv[$idx['manifest']])=="0")?false:((string)$csv[$idx['manifest']]);
    $defrepo[(int)$csv[$idx['id']]]['brief']=        (string)$csv[$idx['brief']];
    $defrepo[(int)$csv[$idx['id']]]['description']=  (string)$csv[$idx['description']];
    if(!$csv[$idx['remove']] and !$csv[$idx['update']])$defrepo[(int)$csv[$idx['id']]]['info']=array('create' => 4);
    if( $csv[$idx['remove']] and !$csv[$idx['update']])$defrepo[(int)$csv[$idx['id']]]['info']=array('create' => 3);
    if( $csv[$idx['remove']] and  $csv[$idx['update']])$defrepo[(int)$csv[$idx['id']]]['info']=array('create' => 2);
    if(!$csv[$idx['remove']] and  $csv[$idx['update']])$defrepo[(int)$csv[$idx['id']]]['info']=array('create' => 1);
    if(!$csv[$idx['enabled']])$defrepo[(int)$csv[$idx['id']]]['info']=array('create' => 0);
  }
}


var_dump($defrepo);
?>
