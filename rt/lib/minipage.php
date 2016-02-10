<?
function minipage($title,$targetTitle=null,$text=null,$img=null,$desc=null,$enc='UTF-8'){
  $linklist=[];$links='';
  if(is_array($title)){
    $keys=array_keys($title);
    if(!is_numeric($keys[0]))extract($title);
    else list($title,$targetTitle,$text,$img,$linklist)=$title;
#echo'<pre>';print_r(compact('keys','title','text','linklist'));die;
  }
foreach($linklist as $k=>$v){
  if(is_numeric($k))$k=trim(preg_replace('# +#',' ',str_replace(['http://','www.','.html','.php','-','bf'],' ',$v)));
  $v=preg_replace('~^bf~','',$v);
  $links.=" <a href='$v' title='$k'>$k</a>";
}  
  
#windows-1252,iso-8859-1
if(!$desc)$desc=$title;
  return"<!DOCTYPE HTML><HTML><HEAD><TITLE>".$title."</TITLE>
<link href='/css.css?alone' type='text/css' rel='stylesheet'/>
<meta name='viewport' content='width=device-width, user-scalable=yes'/>
<meta http-equiv='Content-Type' content='text/html;charset=".$enc."'/><meta property='og:image' content='//x24.fr/prechoix-200.png'/>
<META Name='robots' Content='NOARCHIVE'/><link rel='shortcut icon' type='image/png' href='/favicon.ico'/><meta name='description' content=\"".$desc."\"/><meta name='keywords' content=\"".$desc."\"/><meta name='author' content=\"".$desc."\"/><link rel='canonical' href='".SU."'><link rel='alternate' type='application/rss+xml' title='RSS' href='/?rss'>
<!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' /><![endif]-->
</HEAD><BODY><center><a href='/' title=\"".$targetTitle."\"><img src='".$img."' alt=\"".$targetTitle."\"></a></center>
<div class=q>".$text."\n\n".date('Y-m-d H:i:s').' - '.$links."</div></BODY></HTML>";
}
