<?php
session_start();
try 
{
$result=array();  
$result['ok']=0; 
$result['msg']='';
$result['content']='';

  if (!isset($_COOKIE['ZgodaNaCookie'])) setcookie('ZgodaNaCookie', session_id(), time()+365*86400,'/' );
 
  $result['ok']=1;
 
  echo json_encode($result);
  
}
catch (Exception $e) 
{
  $result['msg']='Wystąpił nieoczekiwany błąd.';
  echo json_encode($result);
}
?>
