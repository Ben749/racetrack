<?#fonctions en dehors de la distri*
$f=__DIR__.'/php7.obs.php';if(is_file($f))require_once $f;
//***********[ MAIL section ]***********************
function France($tel){//Telephone en Array, si un valide passer à ok la validation des fiches =)
  if($tel=="sans")return $tel;
    $tel=ToNumber($tel);$D4=substr($tel,0,4);$D2=substr($tel,0,2);
    if(Preg_match("~12345|643322031|65035676|010101|020202|010203|060606|0000|15151|202020|6677|7788|6699|8877~",$tel,$t)OR strlen($tel)<8){G2('tel',$t);Return"¤$tel";}#
    if(in_array($D4,array('0032','0033','0034','0049','0041')))return $tel;//internationnaux authorisés
    if(in_array($D2,array('01','02',"03","04","05","06","07","08","09","41","49","33")))return $tel;//Si un ok, return direct =)
  Return"¤$tel";#si aucun n'est bon au final =)
}

function testnom($v){if(strlen($v)<3)Return;
  if(eregi("[0-9]|abcd|fgf|toto|ffd|test|nom|blabla|titi|huyu|htht|dfd|aaa|bbb|ccc|ddd|eee|fdgd|fff|ggg|sss|ffg|zob|xxx|yyy|hfjrfj|pouet|interna|hd|df|rqg|dfg|dfs",$v)){Return;}Return 1;
}

function menscredit($cout=200000,$taux=0.026,$mois=240,$apport=0){$cout*=(100-$apport)/100;
  $mens=($cout*$taux/12)/(1-pow(1+$taux/12,-$mois));$ctc=round($mens*$mois-$cout);$p2=$ctc*100/$cout;$mens=Round($mens,2);
  return $mens;#Array($m,$ctc);
}

function hex2rgb($hex){$hex=str_replace('#','',$hex);
   if(strlen($hex)==3){$r=hexdec(substr($hex,0,1).substr($hex,0,1));$g=hexdec(substr($hex,1,1).substr($hex,1,1));$b=hexdec(substr($hex,2,1).substr($hex,2,1));}
   else{$r=hexdec(substr($hex,0,2));$g=hexdec(substr($hex,2,2));$b=hexdec(substr($hex,4,2));}return"$r,$g,$b";
}

function CLT($text){//convertir url en titre le plus proche
  $text=trim(Str_ireplace(Array('c.html','/Q.','p.html','.sh',"frontalier74","frontaliers","creditimmo","a74","s74","xzxzx","index","2007","_vd","z/","y/","http://",".fr/"),'',$text),'&? ');
  $text=Preg_replace("~\.(shtml|html|php|php5)$~is",'',$text);
  $text=Preg_replace("~^/?s\.~is",'',$text);
  $text=trim(Preg_Replace("~\.((ch|co|com|fr|org|biz|info)/?|(shtml|html|htm|php|fla|jpg|bg|K)\$)~",' ',$text));
  $text=Str_ireplace(array('%E0',"%e0",'à'),'a',$text);#,"f.","a."
  $text=Str_ireplace(array("1rachat-credit","portail-patrimoine"),'rachat de credit',$text);
  $text=eregi_replace("(c|p)?.html",'',$text);
  $text=ereg_replace("_([0-9]+)|^([0-9]+)-|-([0-9]+)|\.([0-9]+)|\/([0-9]+)|htm.\$","",$text);//Les nombes en trop en paramètres ..
  $text=ucfirst(trim(str_replace(array("%20","-","_","/",".",",",'|')," ",$text)));#ore processing factory
  $pos=strpos($text,'?',0);if($pos>0){
    Preg_match_all("~=([^&]+)~is",$text,$t);$text=substr($text,0,$pos);if($t){$t=$t[1];$text.=implode(' ',$t);}
  }
  Return $text;
  //Supprimer le Get de merde, non, en aucun cas, on le conserve
}
function BL($p=''){$def=array('se'=>'.','d'=>'./','ex'=>'µù','mt'=>1,'mxt'=>2115286871,'mr'=>9999,'mfs'=>0,'ac'=>0,'MaxFS'=>999999999);extract($def);
  $y=param($p);extract($y);#av($d.":".$se);
  return BL2($d,$se,$ex,$mt,$mxt,$mr,$mfs,$ac,$MaxFS);#BL('d=dir&se=search,ex=top|page|pict,mt=,mxt=,mr=9,mfs,ac'
}
function BL1($d='./',$se='.',$ex='µù',$mt=1,$mxt=2115286871,$mr=9999,$mfs=0,$ac=0){Return BL2($d,$se,$ex,$mt,$mxt,$mr,$mfs,$ac);}
function BenList4($d='./',$t='.',$ex='µù',$MiT='',$MaT='',$mrs='',$mfs='',$keyac=''){Return BL2($d,$t,$ex,$MiT,$MaT,$mrs,$mfs,$keyac);}
function BenList2($d="./",$x=".",$ex='µù'){return BL2($d,$x,$ex);} function BenList3($d="./",$x=".",$ex='µ'){return BL2($d,$x,$ex);}
function BL2($DIR='./',$type='.',$exclude='µù',$MiT=1,$MaT=2115286871,$max=9999,$MinFS=0,$keyac=0,$MaxFS=99999999){#whatever
  #USED @ A BAD PLACE ../
  $type=($type)?$type:'.';GT('l'.__LINE__);memuse();$files=scandir($DIR);
  IF(!$files)return;Memuse();//$type="\.jpg|\.gif"
#[[12-Jan-2012 16:00:31] PHP Fatal error:  Allowed memory size of 209715200 bytes exhausted (tried to allocate 71 bytes) in /home/ovh/fun.php on line 601] => 1
  Foreach($files as $file){if(is_dir($DIR.$file))continue;$w=@filemtime($DIR.$file);
    #if(J9)echo"<li>".(strlen($file)<4).';'.($w<$MiT).';'.$MaxFS.';'.(filesize($DIR.$file)).';'.(filesize($DIR.$file)>$MaxFS);

    if(Preg_Match('~'.$exclude."|htaccess|index\.php~is",$file)OR strlen($file)<4 OR $w<$MiT OR $w>$MaT OR filesize($DIR.$file)<$MinFS OR filesize($DIR.$file)>$MaxFS)Continue;
    if($type!='.'){if(Preg_Match("~$type~is",$file)){
        if($keyac){if($T){while(array_key_exists($w,$T))$w++;}if(is_file($DIR.$file))Touch($DIR.$file,$w);$T[$w]=$file;$i++;}
        else $T[]=$file;
    }}else $T[]=$file;

  }if(count($T)<1){return;}
  if($keyac){krsort($T);}if(count($T)>$max){$T=Array_slice($T,0,$max,1);}return $T;
}

function stel($x){return str_replace(array(' ','-','.','00410','0041','00330','0033'),Array('','','','+41','+41','+33','+33'),$x);}
function Buscar($cles,$champ,$limit=25){Static $NumResults;//contenu RaceTrack{22}
  foreach($cles as $v){
    if(strlen($v)>3){
$x=sql("select url,id,nom,cat,LEFT(contenu,400)as ct from p.zpages where $champ like(\"%$v%\") and length(contenu)>40 order by id desc limit 5");
while($t=@mysql_fetch_assoc($x)){$NumResults++;if($NumResults>$limit)return;
  $_GET['HTML'][2][$t['id']]=SuperSeoResume($t['ct'])." » <a href=\"$t[url]\">".CLT($t['nom'])."</a><br>";}
}}}//_s.html pages, tronque les textes pour + grandes densités, juillet 2007, audrey's sister & ass !

function SuperSeoResume($str,$length=550,$search=''){
  $str=trim(strtolower(strip_tags($str)));//Perhaps can you just make it better !
  $str=ereg_replace(" (ces?|qui|est|sur|dans|une|leurs?|mots?|les?|plus|des?|par|nue|pour|pas|sont|en|la|à|du|doit|donner|être|sera|non|et) ",' ',$str);//oliane jump,"d'","l'","d’","l’",".",",","»","«","…"
  $str=ereg_replace("[ ]{2,}"," ",$str);
  return substr($str,0,$length);
}
#shutdown('perf');
#http://1rachat-credit.fr/vente-terrain-+-imposition-plus-value-+-d%e9duction-imp%f4ts.shtml

#function ser($file,$mots,$exp=80000){$m=filemtime($file);$m2=now-$exp;$x=FGC($file);if($m>$m2)return $x;$y=explode(' ',$mots);$x=str_ireplace($y,' ',$x);FPC($file,$x);return $x;}#$x=str_replace('< ','</',$x);
function stripnames($x){$noms=explode('|','aurelie|nadia|alexandre|alexis|larequie|richard|gilles|philippe|thibault|julien|gwendoline|cyril|xavier|gwena|gwendo|menass|garzoni|dreux|pontier|sottan|pascale|monteille|scharif|mehannech|fabric|poulingu|fadela|bertran|pontier|bruno|dissau|couvron|aumencour|olivier|lantelme');Return str_ireplace($noms,'',$x);}
function diapo($list,$x=500,$y=340){return"<script>diapo('$list',$x,$y);</script>";}
function urlCorrecte($v,$com="s74.fr"){
  $v=accents($v);$v=str_replace("&","&amp;",$v);$v=str_replace("i9","e",$v);
  $v=str_ireplace(array("%E9","%E8"),"e",$v);
  $v=str_replace("/-","/",$v);$v=str_replace("-.",".",$v);
  $v=str_replace(array("--"," ",","),"-",$v);#,";"
  $v=str_replace(array('s74-fr-','a74-fr-','http-','"',"'","%22","%C2","%A4","%E2","%80","%A0","%E7","%86","%3B","%"),'',$v);$v=trim($v,"-?=&#!¤*.†");
  if(strpos($v,"http")!==0)$v="http://$com/$v";#%E9=>e %27=>' %3A=>? %E0=>a %25
  return $v;
}
function MrPropre($v,$ext=0,$delimiter="."){$v=Accents($v);#if(strpos($v,"http://")){}function illimitée
  $v=str_replace(array("\t","  "),"",$v);
  $v=str_ireplace(array("%C3%A9","%C3%A8","%E9","%EA","%E8","%i9","i9",'i8'),"e",$v);$v=preg_replace("@%.{2}@","",$v);
  if(!eregi("2007/",$v)){#ben old filepath, not to be rewriten touth
  $v1="(){}[]$%@!?\|+'~*^¨°`´²§µ£=<>&;–#’ _,:";$v2=".......................................";$v=strtr($v,$v1,$v2);#/:
  $v=preg_replace("@[^0-9a-z-\.\/\:\-]@i","",$v);$v=preg_replace("@[_ ,-]@",".",$v);
  $v=str_replace(array(".de.",".l.","./.",",","%09","%20"),".",$v);$v=preg_replace("@\.{2,}@",".",$v);
  $v=str_replace('http.//','http://',$v);
  }
  #if(!$ext)$v=ereg_replace("\."," ",$v);
  #$v=strtolower(str_replace(" ",$delimiter,(trim(ereg_replace("[ ]{2,}"," ",$v)))));//UN UNIQUE TIRET SE SUIVANT
  $v=trim($v,":-?=&#!¤*.†\t");return $v;
}

function titre($x,$y){return UnikData($x,$y);}#alias
#function MrPropre($x){return str_replace(array('.',',','_',' '),'-',trim(Accents($x)));}
//todo:porter unikdata en sql
function UnikData($data='',$db='titre',$size=10){$res='';$sup=$_ENV['ksup'];$s[]="origindata:".$data;
	if(RS==404)return;
  if(!isgoodurl()or preg_match("~url.data:|image/png;|base64|/(adtech|iframeproxy)~",U)or e(',badurl',1))return;
  static $trig;if(!$trig){Gt('unikdata:start');$trig=1;}
  #Returns only unique Array Data ! For Titles + descriptions (1Mo + 13ms)
  if(strpos(u3,'.jpg'))return;  $rev=1342976292;Gt('udata');$u=$db.':'.hu3;#Maj
  if($y=param($data,'&'))extract($y);#extraction paramètres ...?
    $origin=Rem($data,CLT(surl));$data=trim(str_replace(Array('»','Â','£','N%253BO=D'),' ',$data),'!?»,. ');
    
  if(!$_ENV['auth'])$u=Preg_Replace("~(#|\?|&).*~",'',$u);#Si aucun query string autorisé et bien l'url sera réduite
  else $u=Preg_Replace("~[#|\?|&][^(&|\?)".$_ENV['auth']."]+~",'',$u);#!genius!really nice syntax-"~(#|\?|&)[^(".$_ENV['auth'].")].*~"
  
  While(strlen($data)<$size&&$sup){$next=Array_shift($sup);if(!stripos($data,$next))$data.=' '.$next;}#push ksup inside
  if(strpos(SURL,'?',0)){Preg_match_all("~=([^&]+)~is",SURL,$t);if($t){$t=$t[1];$data.=' '.implode(' ',$t);}}#si titre similaire, pusher le query string
  $ret=$data;#av("data:$data db:$db ret:$ret".pre($s));
  ###Si pas de résultats : invalider le record en placant un "1" dessus
if(1 or H=='a74.fr'){
  $arg='no=1,bd='.sip;$prev=Array();#previously db -> comes to mysql  unikdata:id,url,db,data,score
  #CREATE TABLE `unikdata`(`id` INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,`url` VARCHAR(255) NOT NULL,`data` TEXT NOT NULL,`score` INT(5) NOT NULL) ENGINE = MYISAM;#`db` VARCHAR(25) NOT NULL, 
$s[]="select sql_cache data from ".DB.".unikdata where url=\"$u\"";
$x=sql5(['cache'=>1,'sql'=>end($s)],"bd=".sip) OR $noexist=1;
#if(strpos(U,'webcam.php')){print_r(compact('y','s','u','x'));die;}
$s[]="result:".count($x)."/".$x."/data:".$data;
  
if($x==$data)Return $data;#Si correspondance exacte :)
else{#on défini le score puis On recherche si des correspondances existent déjà
  if(!Q&&e('tprio,forcetitre',1))$score[$u]=0;
  else $score[$u]=substr_count(u,'/')*20+substr_count(u,'?')*10+substr_count(u,'&')*10+strlen(u);/*Score de lui même*/$datas[$u]=$data;

    $s[]="select sql_cache url,score from ".DB.".unikdata where data=\"$data\" and url<>\"$u\" and left(url,6) rlike'$db:".H.".*' order by score asc";
    $y=sql5(['cache'=>1,'sql'=>end($s)],$arg);
/*
select * from ben.unikdata where url='titre:a74.fr/z/webcam.php';
select sql_cache url,score from ben.unikdata where data="Webcams Ski Haute Savoie" and url<>"titre:a74.fr/z/webcam.php" and left(url,6) rlike'titre:a74.fr.*' order by score asc
insert into ben.unikdata(url,data,score)VALUES("titre:a74.fr/z/webcam.php","Webcams Ski Haute Savoie","32")
*/

    #Si une ou plusieurs Pages have the same results
    if($y){
      if(!is_array($y))$y=[$y];
      Foreach($y as $t){$score[$t['url']]=$t['score'];$datas[$t['url']]=$data;}
    }      
    
    if(count($score)==1){
      if($noexist){return $data;
        $s[]="insert ignore into ".DB.".unikdata(url,data,score)VALUES(\"$u\",\"$data\",\"{$score[$u]}\")";sql5(end($s),$arg);
      }
      else{return $data;$s[]="update ".DB.".unikdata set data=\"$data\",score=\"{$score[$u]}\" where url=\"$u\"";$x=sql5(end($s),$arg);}#Non car le score est unique !
      #if($db=='titre')DbM('unikdata',surl."<li>db?$db / ".hu3."->$data<li>noexist?$noexist<li>sql:".pre($s)."<li>score:".pre($score)."<li>datas:".pre($datas)."<li>res:".pre($res)."<li>GT:".pre($_ENV['dbt']),1);
    return $data;}#insertion ok
    
    else{#si plusieurs résultats pour mêmes données, il peut exister des similarités ..
      $s[]="select sql_cache url,data,score from ".DB.".unikdata where data rlike(\"$data*\") and url rlike'$db:".H.".*' and url<>\"$u\" order by score asc";
      $y=sql5(['cache'=>1,'sql'=>end($s)],$arg);#les autres résultats proches, on s'en tape !
      if($y)Foreach($y as $t){$score[$t['url']]=$t['score'];$datas[$t['url']]=$t['data'];}
      Asort($score);
      Foreach($score as $url=>$v){#calcul des doublons et population de la matrice des résultats
        $n=0;$t2=$temp=$datas[$url];
        while(in_Array(accents(strtolower($t2)),$prev)&&$n<20){#déjà un doublon de score inférieur - 20 opérations maximum
          if($trig!='chiffres'&&Preg_match_all("~([0-9]+)~",u,$m)){$n++;$i=implode('',$m[1]);$t2=$temp." $i";$trig='chiffres';continue;}
          $i++;$t2=$temp." $i";#sinon on incrémente
        }
        $res[$url]=$t2;$prev[]=accents(strtolower($t2));#les scores les plus pourris ramassent la merde
        if($url==$u)$ret=$t2;#calcule le retour pour l'url courante
      }
      Foreach($res as $url=>$v){
        if($noexist && $url==$u){$s[]="insert into ".DB.".unikdata(url,data,score)VALUES(\"$u\",\"$v\",\"{$score[$u]}\")";sql5(end($s),$arg);Continue;}
        $s[]="update ".DB.".unikdata set data=\"$v\" where url=\"$url\"";sql5(end($s),$arg);
        #Il est possible que l'url courante n'aie pas d'enregistrements !!!
      }
    }
  if($db=='titre')DbM('unikdata',surl."<li>db?$db / ".hu3."->$data<li>noexist?$noexist<li>sql:".pre($s)."<li>score:".pre($score)."<li>datas:".pre($datas)."<li>res:".pre($res)."<li>GT:".pre($_ENV['dbt']),1);
  return $ret;
}
}#end sql for a74
else{$u=u3;#local db mode
  if($db=='titre'&&filemtime(DR.$db.'.db')<$rev)Unlink(DR.$db.'.db');#Unlink the whole file
  #if(!strpos(u3,'=')&&$_ENV['soloQ'])$u=Preg_replace("~\?(?!({$_ENV['soloQ']})).*~is",'',u3);#déjà calculée dans autoappend
  #Determine unique Array 1
  
  While(strlen($data)<$size&&$_ENV['ksup']){$next=Array_shift($_ENV['ksup']);if(!stripos($data,$next))$data.=' '.$next;}#push ksup inside
  Rem($key,$u,'index');
  
  $x=FGC(DR.$db.'.db');#if(J9)die(pre($x));
  if($x[$key]&&now>$_ENV['rev']&&!strpos($_ENV['args'],'forcetitre'))Return $x[$key];#Si la clé date d'avant la dernière révision on la retourne
  
  if($x[$key]!=$data){#différente ou non définie
    $score[$key]=substr_count(u,'/')*20+substr_count(u,'?')*10+substr_count(u,'&')*10+strlen(u);#Score de lui même
    if(strpos($_ENV['args'],',tprio'))$score[$key]=0;
    if(strpos(surl,'?',0)){
      Preg_match_all("~=([^&]+)~is",surl,$t);if($t){$t=$t[1];$data.=' '.implode(' ',$t);}#si titre similaire, ajouter le query string
    }
    #Cas 1 : il y a un chiffre dans l'url et il est différent des titres des autres, s'il y a déjà un chiffre, on remplace ce dernier par 156
  if(is_Array($x))null;else dbM("x is not array-no fucking way:{$x[$key]}§".pre($x));
  #elseif(!$x){dbM("uniktitre:x is null ?? wtf ??");return;}
    $y=Array_map('strtolower',$x);$e=print_r(error_get_last(),1);
    #if(stripos($e,'array given'))dBM("uniktitre:$db:{$x[$key]}\n<br>err:".pre($e)."\n<Br>y:".pre($y)."<Br>x:".pre($x));
    $found=array_keys($y,strtolower($data));#Arrive très souvent..;
    
    if(count($found)&&Preg_match_all("~([0-9]+)~",u,$m)){#avec des chiffres à injecter dans le titre
      $i=implode('',$m[1]);$data=$origin." $i";
      $found=array_keys($y,strtolower($data));#last verif
      IF(count($found)<1){FAP("tx=1&file=".DR.$db.'.db',Array($u=>$data));db('found:numbers injected in title');Return $data;}#Ok si aucun doublon
    }
    IF(count($found)){#des doublons de titres ont été trouvés
        Foreach($found as $k2){
          #si les scores sont égaux, on ne pourra la comparer à un autre numéro..
          $score[$k2]=substr_count($k2,'/')*20+substr_count($k2,'?')*10+substr_count($k2,'&')*10+strlen($k2);
          if($k2=='index')$score[$k2]=0;#raz page 0
        }
        Asort($score);$os=$score;
        Foreach($score as $k=>$v){#Remplacer le score par les valeurs titre
          While(in_array($data,$score)&&$n<10){$n++;$i++;$data=$origin." $i";}
          if($n>10)Dbm("$db n:$n; data:".pre($data)."score:".pre($score));
          $score[$k]=$data;GT('whilescore');#crée autant
        }#if($score[0]==$score[self])Best=1;swap titles
        #if(count($score)<2)$score=end($score);
        FAP("tx=2,$key&file=".dr.$db.'.db',$score);
        #DbM('unikdata',surl."<li>data:$data<li>x[key]:".print_r($x[$key],1)."<li>found:".print_r($found,1)."<li>score:".print_r($os,1)."<li>res:".print_r($score,1));
        Return $score[$key];
      }
    if($x[$key]&&now>$_ENV['rev']&&!strpos($_ENV['args'],'forcetitre'))Return $x[$key];
  }#swap those values pour url prioritaire!!!
  if($x[$key]&&now>$_ENV['rev']&&!strpos($_ENV['args'],'forcetitre'))Return $x[$key];
  #ajouter ici les valeurs des query strings !
  if($data&&$key){FAP("tx=3,$key&file=".dr.$db.'.db',$key,$data);gt('l'.__LINE__);Return $data;}
  DB(surl.':notitle found:'.count($found).'x[key]'.$x[$key].'data:'.$data.'origin:'.$origin);
}
}
