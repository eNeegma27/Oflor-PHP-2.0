<?php
require("../../lib/lib_oflor.php");
session_start();
try 
{
$result=array();  
$result['ok']=-1; 
$result['msg']='';
$result['content']='';


  //throw new Exception("Info<br>Błąd testowy<br>".__METHOD__."#".__LINE__."",10);
  
  $objOflor = new oflor();

  //$result['content']=date("H:i:s");
  $result['content']=$objOflor->HTML_Info();
  $result['ok']=0;

  echo json_encode($result);
  
  
}
catch (Exception $e) 
{
  $result['msg']=$e->getMessage();
  $result['ok']=$e->getCode();
  echo json_encode($result);
}
?>
