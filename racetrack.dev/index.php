<?
if($_GET['frontcontroller'])die('Frontcontroller For Url:'.U);

require_once"../rt/prepend.php";#IF not autoloaded via php auto_prepend_file OR .htaccess
$f=new f;#global functions loader ..
#new fun;#ok with autoloader -- fine && better
/*
f::function_not_loaded(['a'=>1,'b'=>2]); $_ENV['funmap'] 
if in_array_keys($name,$_ENV['funmap']) autoloader fine -> new fun;$loaded[]='fun'; then returns the right functions from global namespace
*/

$f->gt();#loads the gettime
#loaded from new fun():#virtual class
 #autoloader fine -> then returns the right functions from global namespace
#new fun;#ok with autoloader -- fine :)

#supposed "mvain controller" : any 404 rewriting goes here with RS=404
if($_GET['e']==404)require_once'router.php';
#Installation : put in localhost, rename example.inc.php to 127.inc.php ( first digit of localhost )
#Assume your web root is : C:\!web or change it in this configuration file
switch(Q){
    case'css':$f->h('css');echo"body{margin:auto;color:#000;font:16px Raleway;}
    .button{cursor:pointer;}.button:hover{background:#000;color:#FFF;border:2px dashed #0D0;}";die;#or readfile multiples css
    case'js':$f->h('js');readfile('js.js');die;#echo"document.write('js loaded');";die;
}
#if(!Q)$f->R302('?putssomequerystringwhenNotSet');
if(stripos(U,'index.php')!==false)$f->R302('./?#index');
if(!Q)$f->R302('?1#');#Notice they are respectivelty cumulative with each other

$_ENV['keyw']=$_ENV['desc']=$_ENV['titre']='racetrack ² - fast & easy php plug & play framework';

/*set to defaults values if not set :Rem($_ENV['titre'],$def['titre']);*/

$headermenu=$footermenu='';
$headerLinks=$footerLinks=[];

$f->gt('timer');

require_once'header.c.php';

$x=glob('*.php');
foreach($x as $v){
  if(strpos($v,'.c.php')!==false or strpos($v,'.inc.php')!==false || strpos($v,'todo')!==false || strpos($v,'router')!==false)continue;
  $out.="\n - <a href='$v'>".str_replace('.php','',$v)."</a>";
}
$out.="\n - <a href='/test/'>Tests ( password protected ) </a>";
$out.="\n - <a href='/adm/'>admin ( password protected ) </a>";

/* artices */
$f='adm/editor.json';
if(is_file($f)){
  $x=FGC($f);$z=[];
  foreach($x['post'] as $k=>$t){#
    if(strpos($t['cat'],'header')!==false){$headerLinks[$t['title']]=$t['url'];continue;}
    if(strpos($t['cat'],'footer')!==false){$footerLinks[$t['title']]=$t['url'];continue;}
    $a='';
    if($k===3)$a=' accesskey=a';elseif($k===$x['maxid'])$a=' accesskey=z';
    $z[]="<a href='$t[url]'".$a.">$t[title]</a>";
  }
/*todo : header menu : home,generate those links as editing += contact.php */   
  foreach($headerLinks as $k=>$v)$headermenu.="<a href='$v'>$k</a> - ";
  foreach($footerLinks as $k=>$v)$footermenu.="<a href='$v'>$k</a> - ";
  $articlesList="\n\nArticles :\n   ".implode(' - ',$z);
}

$out.= $articlesList;
$vidz=['Night-Traffic.mp4','Fish-Tank.mp4','Ideas.mp4','Coder.mp4','PC-Typing.mp4'];
shuffle($vidz);$vid=end($vidz);
?>
<video class='nomob' poster='' id="bgvid" loop autoplay><source src="//x24.fr/<?=$vid?>?1" type="video/mp4"></video>

<a href="https://github.com/Ben749/racetrack"><img style="position: fixed; top: 0; left: 0; border: 0;" src="//x24.fr/forkme_left_orange_ff7600.png" alt="Fork me on GitHub" ></a>
<div id=top><?#="bg : ".$bg.$bgs?></div><div id=bot></div>
<pre>Racetrack demo home : directory contents : <?=$out;#='CWD : '.CWD?></pre>
<?require_once'footer.c.php';die;?>












