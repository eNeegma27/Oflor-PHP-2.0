<?php
require("__msg/lib.php");
session_start();


  if(isset($_SESSION['msg'])) {$objmsg=unserialize($_SESSION['msg']);  unset($_SESSION['msg']);}
  else
  {
    $objmsg=new msg();
    $objmsg->text="Obiekt komunikatu nie został poprawnie wywołany.|Ten komunikat nie jest komunikatem błędu, a jedynie informacją, że błąd, który wystąpił, nie może zostać wyświetlony.";
    $objmsg->code=5;
    $objmsg->display=explode('|',$objmsg->text);
  } 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<HTML>
<HEAD>
<TITLE>DataOnline</TITLE>
<META name="KEYWORDS" content="DataOnline">
<META name="DESCRIPTION" content="DataOnline">
<META name="Author" content="DataOnline">
<META name="ROBOTS" content="none">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--[if lt IE 8]>
<META HTTP-EQUIV="Refresh" CONTENT="0;URL=invalid.html">
<![endif]-->

<?php
echo "<link rel=\"shortcut icon\" href=\"__msg/favicon.ico\">";

//=====
//style 
    echo "<link rel=\"stylesheet\" href=\"__msg/msg.css\" type=\"text/css\">";
//===== 
?>

</HEAD>
<BODY>
<?php
echo "<center>";
      echo $objmsg->HTMLshow();
echo "</center>";  

?>
</BODY>
</HTML>

