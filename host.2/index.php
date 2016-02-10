<?
require_once"../rt/prepend.php";#IF not autoloaded via php auto_prepend_file OR .htaccess
#supposed "main controller" : any 404 rewriting goes here with RS=404
if($_GET['e']==404){
#Might include routers here
  R404();#Main 404 controller - really :)
}  

die('Do your stuff here : '.H);
