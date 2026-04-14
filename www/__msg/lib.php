<?php

function HTML_msg($code,$txt)
//plansza komunikatów ajax
{

  global  $objUSER;

  $more=false;   
  $css_class='ERR';

                                                      
  if (isset($objUSER) && $objUSER->ClassName=='user_self' && $objUSER->IsLogin()) $more=true;

  $display=explode('|',$txt);
  
  //ograniczenie widoczności ścieżki tylko do ostatniego katalogu
  $s=explode('/',$display[2]);
  $p=($s[count($s)-2]!='')?'/':'';
  $p=$s[count($s)-2].$p.$s[count($s)-1];
  $display[2]=$p;  
  
  switch ($code) 
  {
   case 22:
        $display[0]='Sesja wygasła.';
        $display[1]='Zaloguj się ponownie.';
        break;
   case 23:
        $display[0]='Nie masz wymaganych uprawnień.';
        $display[1]='';
        break;
   case 29:
        $display[0]='Przerwa techniczna.';
        $display[1]='Zapraszamy ponownie za jakiś czas.';
        break;        
   case 51:
        $display[0]='Pusty identyfikator przy zapisie.';
        $display[1]='';  
        break;      
   case 52:
        $display[0]='Brak lub niewłaściwy identyfikator.';
        $display[1]='';  
        break;      
   case 53:
        $display[0]='Brak lub niewłaściwy identyfikator.';
        $display[1]='';
        break;
   case 54:
        $display[0]='Brak lub niewłaściwy identyfikator.';
        $display[1]='';
        break;
   case 99: 
        $css_class='OK';
        break;
  } 
  
  $result='';
  $result.="<div id=\"bkg\">";
  
       $result.="<table id=\"msg\">";
       $result.="<tr id=\"row\">"; 
       
         $result.="<td id=\"left\">";
         $result.="<img  src=\"__msg/info.jpg\">";
         $result.="</td>";
       
         $result.="<td id=\"right\">";
         $result.="<div id=\"content\" >";
        
          if ($code!='') 
          {
                  $result.="<div  id=\"text1_lbl\">Komunikat systemu</div>";  
         
                  $result.="<div class=\"$css_class\" id=\"text1\" >".$display[0]."</div>";
                  
                  if ($display[1]!='') 
                  {
                  $result.="<div  id=\"text2_lbl\">Porada</div>";
                  $result.="<div  id=\"text2\">".$display[1]."</div>";
                  }
          
                  if($more)
                  {                 
                  $result.="<div  id=\"get_lbl\">Lokalizacja</div>";
                  $result.="<div  id=\"get\">".$display[2]."</div>";

                  $result.="<div  id=\"get_lbl\">\$e->getMessage</div>";
                  $result.="<div  id=\"get\">".'[ '.$code.' ] '.$display[3]."</div>";
                  }     
          }
          
          $result.="<div id=\"MsgBoxDiv_close\">OK</div>";

          
          
         $result.="</div>";
         $result.="</td>";
       
       $result.="</tr>";
       $result.="</table>";     
     
     
     
  $result.="</div>"; //MsgBox
  
  return $result;    
}    


/*============================================================================*/
/*============================================================================*/

class msg
//plansza komunikatów msg.php
{

    var $classname;
    
    var $text;
    var $code; 
    var $display;
    var $more=false;
    
    var $css_class='ERR';
    var $button=true;
  
    function __construct()
    {
        global  $objUSER;

        $this->classname='msg';
                                                       
        if (isset($objUSER) && $objUSER->ClassName=='user_self' && $objUSER->IsLogin()) $this->more=true;
    }

    function __destruct() 
    {
          $_SESSION[$this->classname]=serialize($this);
          
    }
    
    function __wakeup()
    {
          $this->display=explode('|',$this->text);
          
          //ograniczenie widoczności ścieżki tylko do ostatniego katalogu
          $s=explode('/',$this->display[2]);
          $p=($s[count($s)-2]!='')?'/':'';
          $p=$s[count($s)-2].$p.$s[count($s)-1];
          $this->display[2]=$p;
          
          switch ($this->code) 
          {
           case 22:
                $this->display[0]='Sesja wygasła.';
                $this->display[1]='Zaloguj się ponownie.';
                break;
           case 23:
                $this->display[0]='Nie masz wymaganych uprawnień.';
                $this->display[1]='';
                break;
           case 25:
                $this->display[0]='Nie masz wymaganych uprawnień.<br>Niedozwolony adres IP.';
                $this->display[1]='';
                break;
           case 29:
                $this->display[0]='Przerwa techniczna.';
                $this->display[1]='Zapraszamy ponownie za jakiś czas.';
                break;                
           case 51:
                $this->display[0]='Pusty identyfikator przy zapisie.';
                $this->display[1]='';
                break;
           case 52:
                $this->display[0]='Brak lub niewłaściwy identyfikator.';
                $this->display[1]='';
                break;
           case 53:
                $this->display[0]='Brak lub niewłaściwy identyfikator.';
                $this->display[1]='';
                break;
           case 54:
                $this->display[0]='Brak lub niewłaściwy identyfikator.';
                $this->display[1]='';                
                break;
           case 88:
                $this->button=false;
                break;               
           case 99: 
                $this->css_class='OK';
                break;
          }          
    }    
    
    
    function HTMLshow()     
    {
     global  $objUSER;
      
      $result='';
      
     // $result.="<div id=\"bkg\">";
      
       $result.="<table id=\"msg\">";
       $result.="<tr id=\"row\">"; 
       
         $result.="<td id=\"left\">";
         $result.="<img  src=\"__msg/info.jpg\">";
         $result.="</td>";
       
         $result.="<td id=\"right\">";
         $result.="<div id=\"content\" >";
        
          if ($this->code!='') 
          {
                  $result.="<div  id=\"text1_lbl\">Komunikat systemu</div>";  
         
                  $result.="<div  id=\"text1\" class=\"$this->css_class\">".$this->display[0]."</div>";
                  
                  if ($this->display[1]!='') 
                  {
                  $result.="<div  id=\"text2_lbl\">Porada</div>";
                  $result.="<div  id=\"text2\">".$this->display[1]."</div>";
                  }
          
                  if($this->more)
                  {                 
                  $result.="<div  id=\"get_lbl\">Lokalizacja</div>";
                  $result.="<div  id=\"get\">".$this->display[2]."</div>";

                  $result.="<div  id=\"get_lbl\">\$e->getMessage</div>";
                  $result.="<div  id=\"get\">".'[ '.$this->code.' ] '.$this->display[3]."</div>";
                  }     
          }
          
          if($this->button)
          $result.="<a href=\"javascript:history.back()\"><div id=\"button\">Cofnij</div></a>";
      
         $result.="</div>";
         $result.="</td>";
       
       $result.="</tr>";
       $result.="</table>";
         
         
      //$result.="</div>";
    
      return $result;
    }
    
}

?>
