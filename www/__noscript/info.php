<style type="text/css">
#main_JS {
  position:fixed;
  display: table;
  width:100%;
  height:100%;
	background:red;
  color:white;
  z-index:9999;
}
#main_JStxt {
  position:relative;
  display: table-cell;
  font-size:24pt;
	text-align:center;
  font-family:Tahoma,MS Sans Serif,Arial CE;  
  vertical-align: middle;
}   

</style> 
<?php

$HTML='';

$HTML.="<noscript>";  
  $HTML.="<div id=\"main_JS\">";
  $HTML.="<div id=\"main_JStxt\">";
    $HTML.="Dla prawidłowej pracy aplikacji włącz obsługę JavaScript w swojej przeglądarce.";
  $HTML.="</div>";
  $HTML.="</div>";
$HTML.="</noscript>" ; 

echo $HTML;

?>