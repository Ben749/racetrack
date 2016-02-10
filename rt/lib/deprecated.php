<?#Fichier des fonctions secondaires ou depréciées
//**********obselete & aliases'
#function Pat($x='',$y=''){Die("$x<div style='position:fixed;#position:absolute;top:0px;right:0px;'>$y".Gt('000')."ms</div></body></html>");}
function IsGoodMail($x){return ismail($x);}function checkmail($x){Return ismail($x);}function Patricia($x=''){Pat($x);}function I2Bm($mail,$sujet,$msg,$de='',$html=1,$sign=0){Bmail($sujet,$msg,$mail,0,$de);}function Pmail($mail,$sujet,$msg,$html='',$de=''){Bmail($sujet,$msg,$mail,0,$de);}function Cmail($mail,$sujet,$msg,$de='',$html=1){Bmail($sujet,$msg,$mail,0,$de);}

function Ad($x){echo"<center><script>google_ad_client='pub-7780240920056810';google_ad_slot='$x';google_ad_width=728;google_ad_height=90;</script><script type='text/javascript' src='http://pagead2.googlesyndication.com/pagead/show_ads.js'></script></center>";}

//**************************************************************************************************************************
function GGStripper($Query,$titre){$n=0;
  while($n<9){$st=$n*100;if($st<1)$st='';$x=ggstripper2($Query,$titre,$st);
    if(!$x OR $x==$y){break;}$Total.=$x."\n\n";sleep(0.3);$n++;$y=$x;
  }return $Total;
}
function e500(){
  echo"<center><a href='".surl."'><img src='//x24.fr/e500.gif'></a><br>Erreur momentanée - veuillez réactualiser la page svp";
  av($_ENV['dbe']);die;
}
function Parser($x){return do_clickable($x);}
function do_clickable($text){$o=$text;$text=' '.$text;
  #$text=ereg_replace('/\*(.*)\*/|/\*(.*)|##(.*)',"<div id=s>\\1\\2\\3</div>",$text);//si non achevée :)
  if(strpos($text,'yt='))$text=ereg_replace("yt=([^;]+);","\n<script>yt('\\1');</script>",$text);
  if(strpos($text,'mflv='))$text=ereg_replace("mflv=([^;]+);","\n<script>mFlv('\\1');</script>",$text);
  if(strpos($text,'flvx='))$text=ereg_replace("flvx=([^;]+);","\n<script>Flvx('\\1');</script>",$text);
  $text=ereg_replace("flv=([^;]+);","\n<script>Flv('\\1','align=left');</script>",$text);$text=ereg_replace("mp3=([^;]+);","<script>mp3x('\\1');</script>",$text);
  $text=ereg_replace("i=([^,]+),([^ ]+)","<a target=i href='\\1' onmouseover=\"ST2('<IMG SRC=\\1 id=i4>');\" onmouseout=\"HT()\">\\2</a>",$text);
#$text=eregi_replace(".*([^*]+)\.jpg.*","http://a74.fr/y/\\1.jpg",$text);//:) WTF.....???
#$text=preg_replace('~([\s\(\)])(https?|ftp|news){1}://([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^"\s\(\)<\[]*)?)~ie','\'$1\'.handle_url_tag(\'$2://$3\')',$text);
#$text=preg_replace('~([\s\(\)])(www|ftp)\.(([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^"\s\(\)<\[]*)?)~ie', '\'$1\'.handle_url_tag(\'$2.$3\', \'$2.$3\')', $text);
#if(!$text && j10)die($o);
  if(strpos($text,'img='))$text=ereg_replace("img=([^;]+);","<img src='/y/\\1'>",$text);
  if(strpos($text,'swf='))$text=ereg_replace("swf=([^,]+),([^,]+),([^,]+);","<center><script>intflash('\\1','\\2','\\3');</script></center>",$text);
  #$text=ereg_replace("mflv=([^;]+);","<script>mflv('\\1');</script>",$text);
  #$text=eregi_replace('\$\$([^$]+)\$\$\w',"<script>\\1</script>",$text);
  $text=str_replace('\n<',"<",$text);//esquiver saut de ligne suite à une balise :)
  $text=str_replace(array(">\r\n",">\n",">\r",">\s"),">",$text);
  
  Return trim($text);// =)
}
function handle_url_tag($url,$link=''){
  $full_url=str_replace(array(' ', '\'', '`', '"'),array('%20', '', '', ''),$url);
  $x=parse_url($url);$url=$x['path'];$url=CLT($url);
  $url=trim(ereg_replace("[ ]{2,}"," ",ereg_replace("/|_|-|,|\."," ",$url)));$url=urldecode(str_replace('%E9','é',$url));
  if(strlen($url)<5)$url="$x[host] $url";//***fracking nonsense
  $link=stripslashes($url);//ereg_replace("([0-9]+)","",$url)
  $link=(strlen($link)>30)? substr($link,0,5).'&hellip;'.substr($url,-25):$link;
if(eregi("\.(jpg|png|gif)",$full_url))$rel="onmouseover=\"ST2('<IMG SRC=$full_url id=benj>');\" onmouseout=\"HT()\"";#Images OnmouseOver
$link=trim(ereg_replace("([0-9]+)$","",$link));
  return "<a target='r3' href='$full_url' title='$link' $rel>$link</a> ";
}
function Meregi($Values,$mat){$reg=implode("|",$Values);if(eregi($reg,$mat,$t))return $t[0];}
function eregis($AR,$str,$R){if(Meregi($AR,$str))r302($R);}//+r302
function Enc1($x){//Correction Accents UFT8_decode
  While(eregi("Ã|±|€",$x)AND $n<2){$x=utf8_decode($x);$n++;}Return $x;
  $A=array("Ãª","Ã©","Ã¨","Ã","à§","à‰","â€¢","â‚¬","Â¤","à¢","à´","''","à¹","à»","à´","Â°0","à®","â€™","Â°","Â»","Â«","â€¦","Â®","â€” ","à«");
  $B=array("ê","é","è","à","ç","É","-","€","¤","â","ô","'","ù","û","ô","]","î","'","°","»","«","","®",":","ê");
  return str_replace($A,$B,$str);
}

function Article2007($Title='',$Legend='button',$Bla='',$short='',$sup='',$sup2='',$liens=''){
  if($liens){$liens=explode("\n",trim($liens));Foreach($liens as $v){$sup2.=handle_url_tag($v).", ";}}
  $x=sql5("select sql_cache(keyword)from CSF where url='".addslashes(u)."' order by hits desc limit 0,30",'no=1');
  if($x){foreach($x as $t){$kw.=blod($t['keyword'])." ";}}
  #if(j9)Die("$Title<li>$Legend<li>$Bla<li>$short<li>$sup<li>$sup2<li>$liens");
$z="<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"><html><head><TITLE>$Title</TITLE><META name='description' content='$Title'><link type='text/css' rel='stylesheet' href='/?css'><meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'><script src='/js.js'></script><link rel='canonical' href='".surl."'></HEAD><BODY>$GLOBALS[pp]";
if(strlen($Bla)>10){
  $z.="<div id=seo5>$kw</div><fieldset class=Mk1><LEGEND>$Legend</LEGEND><div class=Mk2><textarea id=Mk3>";
  if($short)$z.="</textarea><style>#Mk3{display:none}</style><div>$Bla</div>$sup2</fieldset></div></body></html>";
  else $z.="$Bla</textarea>$sup2</fieldset></div></body></html>";
}
  Return $z."<script src='http://www.google-analytics.com/ga.js'></script><script>try{var pageTracker=_gat._getTracker('".$GLOBALS['ga']."');pageTracker._initData();pageTracker._trackPageview();}catch(e){}s7x();</script>";
}
function Art2010($MetaData,$divortxt=0){$m=explode("##",trim($MetaData));Return Article2007($m[0],$m[0],$m[1],$divortxt,'',$m[3],$m[2]);}
function Art2009($a,$text,$liens='',$sup=''){return Article2007($a,$a,$text,'','',$sup,$liens);}
function Tiny($y,$x=''){Return Art2010($y."##".$x."##",1);}//Scan for CSF like page -> keywords

function FAPD($file,$k='',$v='',$inc=0){FAP($file,$k,$v,$inc);}
#function Def($a='',$b='',$c='',$d=''){if($a)return $a;if($b)return $b;if($c)return $c;if($d)return $d;}

//Ne seront Plus Jamais Modifiées -- C'est promis :)
function F($x){av($x);}
function FS($v){$v=@filesize($v);if($v>1000000){$v/=1048576;return ceil($v)."Mo";}if($v>1000){$v/=1024;return ceil($v)."Ko";}return ceil($v)."o";}

//poubelles à fonctions moches
//Aliases*****
//Fonctions Stupides ou Achevées
function R307(){header("Location:/",1,307);die;}
function Space2UnderKeys($array){$array=array_map("spacehypen",array_flip($array));return array_flip($array);}
function ANPE($str){return substr($str,0,-1);}
function A2L($str){return implode('',$str);}
function spacehypen($v){return str_replace(" ","-",$v);}
function GG($str){return $str;}
function CleanTitleExt($t){return CLT($t);}
function CLEANTITLE($t){return CLT($t);}
function searchengine($str,$sup=1){return seo($str,$sup);}
function trimTitle2($t){return substr(trimTitle($t),0,28);}
function Writefichier($filename,$content,$target='',$method='w+'){jx('mail');if($method=="a" OR $method=="a+")FPC($filename,$content,'app');else FPC($filename,$content);}
function explodeCase($string,$lower=1){
  $array=array();$segment='';$arr=preg_split('//',$string,-1,PREG_SPLIT_NO_EMPTY);
  foreach($arr as $char){if(ctype_upper($char)){if($segment)$array[]=$segment;$segment = $lower ? strtolower($char) : $char;}else{$segment.= $char;}}
  if($segment)$array[]=$segment;return $array;
}
#Retrouvailles des images récemments upées sur le serveur
function DImage($img_src,$img_dest,$max_w=120,$max_h=90,$qualite=80,$crop_from_center=0){//ne lit pas l'image source !
  if(!function_exists('ImageCreateTrueColor'))return 0;


  if(!is_file($img_src)){db("!is_file($img_src)");return;}$startX=$startY=0;#return;
  $size=@GetImageSize($img_src);$src_w=$size[0];$src_h=$size[1];$type=$size[2];$ratio=@round($src_w/$src_h,2);
  #$_ENV['db'].="<li>".pre($size);
  if($max_w>$src_w){copy($img_src,$img_dest);return;}#ne pas redimensioner si plus petit
  $ratiom=round($max_w/$max_h,2);
  if($ratio>$ratiom){$dst_w=$max_w;$dst_h=ceil($max_w/$ratio);}
  else{$dst_h=$max_h;$dst_w=ceil($max_h*$ratio);}
  #if($dst_w==0){$_GET[debug].="<li>$img_dest  $ratio> $ratiom? $dst_w $dst_h".($max_h*$rationm);return;}
  gt();$dst_im=ImageCreateTrueColor($dst_w,$dst_h);// Copie dedans l'image initiale redimensionnée
  if(!$dst_im){$_ENV['db'].="<li>$img_dest  $ratio> $ratiom?  $type--- FAIL $dst_w $dst_h";return;}
  switch($type){case 3:$src_im=@ImageCreateFromPng($img_src);break;case 2:$src_im=@ImageCreateFromJpeg($img_src);break;case 1:$src_im=@ImageCreateFromGif($img_src);break;}
  if(!$src_im)echo("$img_src,$img_dest,$dst_w,$dst_h,$type,$src_w,$src_h, $type,<hr>Erreur d'upload de photo pour cause de Format JPEG Pourri !");ReMapTree($img_dest);
  if(imagecopyresized($dst_im,$src_im,0,0,$startX,$startY,$dst_w,$dst_h,$src_w,$src_h)){$_ENV['db'].=" Miniature Générée";}//RESIZE TO 640 ELSE INCLUS
  switch($type){case 1:ImageGif($dst_im,$img_dest);break;case 2:ImageJpeg($dst_im,$img_dest,$qualite);break;case 3:ImagePng($dst_im,$img_dest,9);break;}
  ImageDestroy($dst_im);ImageDestroy($src_im);  $_ENV['db'].="<li>$dst_w,$dst_h,$src_w,$src_h $img_dest $ratiom=$ratio $type -";return;  // Détruis les tampons
}
?>