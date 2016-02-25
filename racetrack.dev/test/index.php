<?
$_ENV['titre']='tests';
require_once'../header.c.php';
echo'<pre>';
$x=glob('*.php');
foreach($x as $v){
  if(strpos($v,'index.php')!==false or strpos($v,'.c.php')!==false or strpos($v,'.inc.php')!==false || strpos($v,'todo')!==false || strpos($v,'router')!==false)continue;
  echo"\n - <a href='$v'>".str_replace('.php','',$v)."</a>";
}
echo'</pre>';
require_once'../footer.c.php';