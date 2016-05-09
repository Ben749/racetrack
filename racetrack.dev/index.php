<?
if($_REQUEST['jse']){file_put_contents(TMP.'jserrors.log',"\n".$_REQUEST['jse'],FILE_APPEND);die;}

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
if($_GET['e']==404)require_once'router.c.php';
#Installation : put in localhost, rename example.inc.php to 127.inc.php ( first digit of localhost )
#Assume your web root is : C:\!web or change it in this configuration file
switch(Q){
  case'style':
$f->r304(['style.css']);
$f->h('css');
echo"body{margin:auto;color:#000;font:16px Raleway;}
.button{cursor:pointer;}.button:hover{background:#000;color:#FFF;border:2px dashed #0D0;}";readfile('style.css');die;#or readfile multiples css
  case'js':$f->r304(['js.js']);$f->h('js');readfile('js.js');die;#echo"document.write('js loaded');";die;
}

if($files=$_GET['css'] or $files=$_GET['js']){
  $type=($_GET['js'])?'js':'css';
  $files=explode(',',$files);
  foreach($files as &$file)$file.='.'.$type;unset($file);
  r304($files);#based on each file in collection
  $f->h($type);
  foreach($files as $file)if(is_file($file)){echo"\n/*}$file{*/\n";readfile($file);}
  die;
}

#if(!Q)$f->R302('?putssomequerystringwhenNotSet');
if(stripos(U,'index.php')!==false)$f->R302('./?#index');
if(!Q)$f->R302('?1#');#Notice they are respectivelty cumulative with each other

$_ENV['keyw']=$_ENV['desc']=$_ENV['titre']='racetrack ² - fast & easy php plug & play framework';

$headermenu=$footermenu='';
$headerLinks=$footerLinks=[];

$f->gt('timer');

require_once'header.c.php';

$out.=' '. implode(' - ',$f->dc());

$out.="\n - <a href='/test/'>Tests ( password protected ) </a>";
$out.="\n - <a href='/adm/'>admin ( password protected ) </a>";

require_once'adm/contents/ve.blocks.1-.php';$MainPageContents=trim($x['content']);
#echo"<video class='nomob' poster='' id='bgvid' loop autoplay><source src='//x24.fr/".$vid".?1' type='video/mp4'></video>";

/* articles */
$f='adm/contents/articles.json';
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
<a href="https://github.com/Ben749/racetrack"><img style="position: fixed; top: 0; left: 0; border: 0;" src="//x24.fr/forkme_left_orange_ff7600.png" alt="Fork me on GitHub" ></a>

<pre><?=$MainPageContents?>

Directory contents :<?=$out;#='CWD : '.CWD?></pre>

<div id=top><?#="bg : ".$bg.$bgs?></div><div id=bot></div>
<?require_once'footer.c.php';die;?>












