<?php
require("../lib/lib_oflor.php");
session_start();
try 
{
  $objOflor = new oflor();
  
?>  

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<HTML>
<HEAD>
<TITLE>Oflor Desktop</TITLE>
<META name="KEYWORDS" content="DataOnline">
<META name="DESCRIPTION" content="DataOnline">
<META name="Author" content="DataOnline">
<META name="ROBOTS" content="none">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--[if lt IE 8]>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=invalid.html">
<![endif]-->
<?php
echo "<script src=\"__jquery/jquery.min.js".__ver."\"></script>";
//echo "<script src=\"__jquery/lightbox/lightbox.min.js".__ver."\"></script>";

echo "<script src=\"js/_common.js".__ver."\"></script>";

echo "<link rel=\"shortcut icon\" href=\"style/favicon.ico\">";
//===== 
//module
  if (file_exists("style/_common.css"))    
    echo "<link rel=\"stylesheet\" href=\"style/_common.css".__ver."\" type=\"text/css\">";
    
  if (file_exists("style/InstantAlert.css"))    
    echo "<link rel=\"stylesheet\" href=\"style/InstantAlert.css".__ver."\" type=\"text/css\">";    
    
  if (file_exists("style/Alert.css"))    
    echo "<link rel=\"stylesheet\" href=\"style/Alert.css".__ver."\" type=\"text/css\">";    

  if (file_exists("style/Info.css"))    
    echo "<link rel=\"stylesheet\" href=\"style/Info.css".__ver."\" type=\"text/css\">";    

  if (file_exists("style/SumOfProd.css"))    
    echo "<link rel=\"stylesheet\" href=\"style/SumOfProd.css".__ver."\" type=\"text/css\">";

  if (file_exists("style/SumOfProd2.css"))    
    echo "<link rel=\"stylesheet\" href=\"style/SumOfProd2.css".__ver."\" type=\"text/css\">";    
?>

</HEAD>
<BODY> 

<?php

//include("__noscript/info.php");
//include("__acceptcookie/info.php");

//echo "<center><div id=\"MsgBoxDiv\"></div></center>"; //okienko komunikatów

echo "<center>";  

  //echo "<div id=\"msg\">msg</div>";
  echo "<div id=\"TimeCounter\"></div>";
  
  echo "<div id=\"mainpanel\">";  
  echo "</div>";  // mainpanel

echo "</center>";  
?>

</BODY>
</HTML>

<?php
}
catch (Exception $e) {

echo  $e->getMessage()."<br><br>Kod błędu: ".$e->getCode();
  
echo "<noscript>";  
  echo "<div id=\"main_JS\" style=\"position:relative;\">";
    echo "Dla prawidłowej pracy aplikacji włącz obsługę JavaScript w swojej przeglądarce.";
  echo "</div>";
echo "</noscript>" ;
//echo "<SCRIPT LANGUAGE=JAVASCRIPT>document.location.href=\"msg.php\"</SCRIPT>";
}
?>