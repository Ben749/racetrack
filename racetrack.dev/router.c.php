<?
if(preg_match('~^([0-9]+)~',U,$m)){
  $id=$m[1];require_once'article.c.php';
}
#Might include routers here
die("/*404 : <a href='/#404'>home</a>*/");#for js and css, at least
$f->R404();#Main 404 controller - really :)
