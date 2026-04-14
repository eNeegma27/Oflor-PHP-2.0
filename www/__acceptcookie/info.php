<style type="text/css">
/*--- cookie ------------------------------------------------------------------*/           
        
#cookieinfo{
position:relative;
padding-top:5px;
padding-bottom:5px;
min-height:20px;
background: darkred;

text-align:left;
font-size:14px;

}
  #cookieinfo1000{position:relative;width:1000px;}

    #cookieinfo_text{position:relative;width:800px; float:left;color:white;}
      #cookieinfo_text #cookieinfo_strong {font-size:16px;font-weight:bold;}
    #cookieinfo_button{position:relative;width:198px;margin-right:2px;line-height:40px;float:right;background:#cccccc;color:black;cursor:pointer;font-weight:bold;}
    
  #cookieinfosep{position:relative;
  float:none;
  clear:both;
  width:1000px;}   
</style> 
<?php
if (!isset($_COOKIE['ZgodaNaCookie']))
{
$HTML='';
  $HTML.="<script type=\"text/javascript\" src=\"__acceptcookie/set.js\"></script>";
  
  $HTML.="<div id=\"cookieinfo\">";
    
    $HTML.="<center><div id=\"cookieinfo1000\">";
  
    $HTML.="<div id=\"cookieinfo_text\">";
      $HTML.="<span id=\"cookieinfo_strong\">TA STRONA UŻYWA COOKIE</span> dla celów statystycznych i identyfikacyjnych. ";
      $HTML.="Korzystając z serwisu wyrażasz zgodę na umieszczanie plików cookie na twoim urządzeniu końcowym zgodnie z aktualnymi ustawieniami twojej przeglądarki.";
    $HTML.="</div>"; //cookieinfo_text
     
    $HTML.="<div id=\"cookieinfo_button\" onclick=\"setCookie();\">";
      $HTML.="Zamknij ten komunikat. ";
    $HTML.="</div>"; //cookieinfo_button

   $HTML.="<div id=\"cookieinfosep\"></div>";
   
    $HTML.="</div></center>";//cookieinfo1000
  $HTML.="</div>";
  echo  $HTML;
}



?>
