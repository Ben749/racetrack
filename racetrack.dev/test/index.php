<pre><?
$x=glob('*.php');
foreach($x as $v){
  if(strpos($v,'.c.php')!==false or strpos($v,'.inc.php')!==false || strpos($v,'todo')!==false || strpos($v,'router')!==false)continue;
  echo"\n - <a href='$v'>".str_replace('.php','',$v)."</a>";
}