<?
class fun{}#__call if in array_map -> require_once then return \$name($args[0]

#$def=array('re','noperf','np');foreach($def as $v)if(!isset($_GET[$v]))$_GET[$v]=null;#patch
$def=array('noperf');foreach($def as $v)if(!isset($_ENV[$v]))$_ENV[$v]=null;

function dc($dir=''){
if($dir and strpos($dir,-1)!='/')$dir.='/';
  $x=glob($dir.'*.php');$out=[];
  $negativePatterns=['.c.php','.inc.php','todo','index.php'];
  foreach($x as $v){
    foreach($negativePatterns as $negativePattern){
      if(strpos($v,$negativePattern)!==FALSE)Continue 2;
    }
    if($dir)$v=str_replace($dir,'',$v);
    $out[]="<a href='$v'>".str_replace('.php','',$v)."</a>";
  }
  return $out;
}

function dbt($prune=1){
  #Db(SU,$_ENV['dbe']['db'].$_ENV['yt']['mots']."@".GT('l'.__LINE__),'time');
  $bt=debug_backtrace();
  $i=0;while($i<$prune){$i++;array_shift($bt);}
  $bt=reset($bt);
  $bt['file']=explode('/',$bt['file']);
  $bt['file']=str_replace('.php','',end($bt['file']));
  #if(J9)die($bt['file'].':'.$bt['line']);
  return $bt['file'].':'.$bt['line'];
}
function dbtr($prune=1){#prunes itself
  $bt=debug_backtrace();
  $i=0;while($i<$prune){$i++;array_shift($bt);}
  foreach($bt as &$t)$t=$t['file'].':'.$t['line'];unset($t);
  return $bt;
}

function ssu($x){
  if(isset($_GET['loops']))return;#if allready looped to itself
  $x=strtolower(str_replace(['http://','https://','//',H],'',$x));#strips the current host as well .. to get relative path if not external
  $current=strtolower(U);
  if(strpos($x,'#')){$x=explode('#',$x);$x=reset($x);}
  if($x==$current)return;
  return 1;#failsafe for redirection loops
}

function redirLoops(&$x){#& convert that url if ok
  $hash='';
  if($x=='?' || strpos($x,'?#')===0 || strpos($x,'./?')===0)return $x;#simple assumed redirection to self page
  if(strpos($x,'#')){$x=explode('#',$x);$hash=end($x);$x=reset($x);}
  if(!ssu($x)){$x=str_replace('?'.Q,'',$x).'?loops=1&'.Q.'#'.dbt(2);return;}
  if($hash)$x.='#'.$hash;
  return $x;
}

function R301($URL='?',$m=1,$mtime=1){
  formatQS($URL);
  if(in_array(H,['cli','cron']))return $URL;
  if(!$_POST && !redirLoops($URL))return;
  if(J9){FB(debug_backtrace(),301);}#$bt=end($bt);
  
  if(headers_sent())die("<META http-equiv='refresh' content='1;URL=".$x."'><script>location.href='$x#headersSent';</script>");

  if(!preg_match("~/sql2?/~",u)&&strlen($URL)>200||preg_match("~image/png|base64,|data:~",u)){return;}#db3("r301urldata:$URL");
  if(e('nor301',1)or $_POST['r301'])return;#no fucking way !!
  static $nbessais,$lurl;$nbessais++;
  IF($_ENV['error']){Db('error:'.$_ENV['error'].":".$URL,0,'r301');R302();}#en cas erreur sql puis balancement d'une redirection 301 à ne pas enregistrer !

    $URL=str_replace('*','http://',$URL);
    if(preg('xzxz',u)){jx('mail');return;}
    gt("R301,$nbessais");

    if($nbessais>3){db('r301 nbessais>3'.SU.':activée:');return;}$lurl=$URL;
    if($_SESSION['lastredir'])if(now-$_SESSION['lastredir']<4)$_SESSION['nrdir']++;
    #if($_ENV['yt']['lastredir'])if(now-$_ENV['yt']['lastredir']<4)$_ENV['ipf']['nrdir']++;
    if($_SESSION['nrdir']>4){Db("nbredir".SU.'=>'.$URL,1,'prio');$_SESSION['nrdir']=-2;R302('/');}
    #if(j9)kill($_GET['N0301'].$_GET['N301']."$nc $lh $lr<>".SU."<>$URL<>$x");#['N0301'].$_GET['N301'].SU.' <> '.$URL
    if($_GET['N0301'].$_GET['N301']or strpos(' '.u,'Tag.php')or preg('anciensin',h))return;#|prechoix
    if(h=='a74.fr'&&preg('sxxx|#',$URL))sql5("delete from p.url where url=\"".SU."\"");

  if($m==3)R303($URL);
    $URL=ltrim(str_replace('/http:/a','http://a',$URL),'/');
    $URL=trim(Preg_replace("~%5C|%27~is",'',$URL),"'\"+%:,-=&#!¤*.† ");
    if(!strpos($URL,'ttp:/'))$URL="http://".H."/".$URL; #if(j9)kill("ahah $r301 $URL");
    IF(SU==$URL)$URL="http://".H."/";#Vers la racine si redirige sur la même url :!!
    IF(SU==$URL){Db("selfurl:".SU." - ".$URL,0,'r301');@unlink(CR301);return;}
      IF(Preg_Match("~http://.{0,1}/~",$URL)OR substr_count($URL,'/')<2)Db("redir malformée=>".$URL,0,'r301');#ici r301.db
    #put some ?go=1 interoggation first in case of loops !!!
    While($i<5&&is_file(r3p($URL))){$i++;$next=FGC(r3p($URL));if($next==SU){unlink(r3p($URL));}$URL=$next;GT("r3p$i");}$i=0;#if(j9)kill(SU.",$lurl,$URL");

      if($URL==SU){#car cette fonction est couteuse en ressources
      While($i<3){$i++;$x=h301($URL);G2("h301($URL)=>$x",GT());if($x)$URL=$x;
          if($URL==SU){G2("\$URL==SU");$URL=h301($URL.'?go=1');if($URL==SU){Db('surl3'.SU);return;}}
      else $i=4;}}

      if(!Preg('fotolia',$URL)and 0){if(!Preg('200|401|302|402|403',$a)){Db("selfurl4:$a[1]".SU."=>$URL");R303('/');}}
          #A ce moment, l'une d'entre elle redirige vers l'url de départ, ce qui n'est pas bon ! si double ou triple redirection .. changer toussa =)


      if(SU==$URL){Db("selfurl2:".SU,0,'r301');@unlink(CR301);r303('/');}
      if(!$URL){av("emptyr301:$URL");db('emptyr4'.SU);return;r303('/');}
      elseif($m==1&&!$_POST&&$URL!=SU&&$URL&&isgoodurl(SU)&&!strpos(u,'#')){
        #if(u=='3eme-pilier.php'){DBM('debug r301 3P',SU.'=>'.$URL.pre($a).pre($_ENV));return;}#Annulé
        FAP(R.'modif.db',SU,$URL);FPC(CR301,$URL);touch(CR301,$mtime);#write the file, then the file exists, no more trauma
      }
      $_GET['re']=301;R303($URL);#that's the final anyways !
    #might be an old redirect with does boomrang somewhere
}



function rhttps(){if(!$_SERVER["HTTPS"])R302(str_replace('ttp:','ttps:',SU));}

#depends on the day, PID ok :)
function formatQS(&$x,$suppr=[]){
  $x=str_replace('?','&',$x);if(strpos($x,'&')===false)return $x;
  foreach($suppr as $v)$x=preg_replace("~&".$v."=?[^&]*~",'',$x);
  $ap=strpos($x,'&');if($ap!==false)$x=substr_replace($x,'?',$ap,1);
  return $x;
}

function loga($x,$log=''){
  $p=IP.((session_id())?';'.substr(session_id(),0,10):'').'#';
  file_put_contents('/run/shm/db/'.$x.'.'.date('ymd').'.log',"\n".date('Hi').'#'.$p.$log,FILE_APPEND);
}

function sstart($x=null){
  if(session_id())return;
  if($_COOKIE['SID'] && $_GET['SID'])R302(SU,['SID']);
  if(!$_COOKIE['SID'] && $_GET['SID'])session_id($_GET['SID']);
  elseif(!$_COOKIE['SID'] && $_POST['SID'])session_id($_POST['SID']);
  if($x){
    $m='session started with:'.$x.($_COOKIE['SID']?',cookie':'').($_GET['SID']?',get':'');
    $_ENV['ss'][]=$m;
    header('Asstart: '.$m,1);
  }
  session_start();
}

function killSession($renew=0,$debug=null){
  sstart('killSession'.$debug);
  $_SESSION=[];#empty session if recycled by someone else ..
  session_destroy();
  $_ENV['ss'][]='destroyed';
header("Set-Cookie: SID=a; path=/; expires=Thu, 19 Nov 1981 08:52:00 GMT",1);
#double sécurité
setCookie('ssdestroy',date('y-m-d H:i:s').'-'.$debug,strtotime( '+130 days'));
setcookie('connexion',1,NOW-3600);
  
  if($renew){
    $_ENV['ss'][]=__FILE__.__LINE__;session_start();   
    session_regenerate_id(1);
    setCookie('ssrenew','rtfun:27:renew|'.date('y-m-d H:i:s').'|'.$debug,strtotime( '+130 days' ));
  }
  #hijack && destroy these sessions session_id($session_id_to_destroy);
}

function fixSer(&$ser=''){
  if(!is_string($ser))$ser=serialize($ser);#not serialized yet
  $ser = preg_replace_callback ( '!s:(\d+):"(.*?)";!',function($match) {
    return ($match[1] == strlen($match[2])) ? $match[0] : 's:' . strlen($match[2]) . ':"' . $match[2] . '";';}
  ,$ser);return $ser;
}

function jsonescape(&$v){
    if(in_Array(gettype($v),Array('object','array'))){
        foreach($v as $k=>&$v2){
            jsonescape($v2);
            $k1=$k;#clé : toujours une chaine, valeur, peut être récursive ...
            jsonescape($k);
            if($k!=$k1){unset($v[$k1]);$v[$k]=$v2;}#die("\n".$k1."\n".$k);
        }
        return;
    }
    $v=str_replace(array('"',"'","\'"),array("_",'',''),$v);
    #$v=str_replace("\'",'',$v);
}

function escapeJsonString(&$x) {# list from www.json.org: (\b backspace, \f formfeed)#accents !!!!
  if(is_array($x))foreach($x as &$v)escapeJsonString($v);
  $escapers = array("\\", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
  $replacements = array("\\\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
  $x=str_replace($escapers, $replacements, $x);
  toUTF8($x);
  return $x;
}

function jsonEnc(&$x){
  if(is_string($x) && substr($x,-1)=='}' && substr($x,0,1)=='{')return $x;#allready encoded
  static $t;$escaped=$base=$x;jsonescape($x);$escaped=$x;
  $x=@JSON_encode($x);$jse=jsonLastError(json_last_error());
  if($jse=='8'){utf8ize($escaped);$x=JSON_encode($escaped);$jse=jsonLastError(json_last_error());}
  #$e=error_get_last();if($e['line']===(__line__-1)){
  if($jse=='8'){dBM('debug:json encode',array(serialize($escaped))+compact('jse','x'),null,__file__.__line__);$t=1;}
  return $x;
}

function toUTF8(&$x){$x=mb_convert_encoding($x,'UTF-8','Windows-1252');return $x;}

function utf8ize(&$mixed) {
    if (is_array($mixed))foreach ($mixed as $key => $value)$mixed[$key] = utf8ize($value);
    else if(is_string ($mixed))return utf8_encode($mixed);#return mb_convert_encoding($mixed,'UTF-8','Windows-1252');#
    return $mixed;
}

function jsonLastError($jse){
  switch($jse){case JSON_ERROR_NONE:return'none';case JSON_ERROR_DEPTH:return ' - Profondeur maximale atteinte';case JSON_ERROR_STATE_MISMATCH:return ' - Inadéquation des modes ou underflow';case JSON_ERROR_CTRL_CHAR:return ' - Erreur lors du contrôle des caractères';case JSON_ERROR_SYNTAX:return ' - Erreur de syntaxe ; JSON malformé';case JSON_ERROR_UTF8:return'8';default:return ' - Erreur inconnue';
}}

function dBM($suj,$msg=null,$lock=null){
  unset($_ENV['c'],$_ENV['Adbt'],$_ENV['dbt']);
  
  if($lock){$f="/run/shm/lock/".str_replace(array('/',' ',':'),'-',$lock).".lock";if(is_file($f) && filemtime($f)>now-600)return;touch($f);}
  if(!$msg){$msg=$suj;$suj='Debug';}
  if(is_array($msg))$msg=print_r($msg,1);
  $e=error_get_last();if($e && $e['type']!=8)$erreur=$e;
  
  $bt=debug_backtrace();
  $bt[0]=$bt[0]['file'].':'.$bt[0]['line'];
  #unset($x[1]['args']);$bt=$x[1];#$bt=array($x[count($x)-1],$x[count($x)]);
  
  $b=[];
  $ok=array('SCRIPT_URI','IP','REMOTE_ADDR','HTTP_USER_AGENT');
  foreach($ok as $v){
    if($GLOBALS['a'][$v])$b[$v]=$GLOBALS['a'][$v];
    elseif($_SERVER[$v])$b[$v]=$_SERVER[$v];
  }
  $b+=array('POST'=>$_POST,'SESSION'=>$_SESSION);
  
  $data=array_filter(compact('erreur','b','bt'));
  array_walk_recursive($data,function(&$v){$v=htmlentities($v);});
  $msg.='<hr>'.print_r($data,1);#.print_r($_ENV,1)htmlentities
  Bmail($suj,'<pre>'.$msg,ADMINEMAIL);
}

$regex=array('spe1'=>'~=|\(|\)|[\'"]~','spe2'=>'~=|\(|\)|[\'"]|[\/\\\\]~','mail'=>'~[^a-z0-9@\.\-_]~i','letnum'=>'~[^\p{L}0-9 ]~','letters'=>'~[^\p{L} ]~i');

function debug($file,$err){
  if($file=='prechoixerrors' && strpos($err,'#')){$err2=explode('#',$err);$err2=reset($err2);FPC('/run/shm/db/count.fap',"\n".$err2,1);}
  FPC('/run/shm/db/'.$file.'.fap',"\n".$err,1);
}


function sqlInjection($x,$mode='spe2'){#return $mode;
    global $regex;
    if(preg_match('~(and|group_concat|null|limit|union|information_schema|where|join) ~i',$x))return'basic';
    //obvious first syntax #u:unicode:+accents
    if(in_array($mode,$regex)){
        if(preg_match($regex['mode'],$x))return $mode;
    }
}


#function Kill(){HDR(200);CacheInit();die;}##todo:get stack trace into global variable
shutdown('kill');#ces fonctions peuvent se cumuler - on peut en définir plusieurs, s'interrompent définitivement si un die ou exit à l'intérieur
function kill($x=''){
    static $t,$db;
    if(e(',die,kill,r302,r301',1) oR $t)die;#évite toute recursion et la place en fonction de die final, notez que plusieurs fonctions de shutdown peuvent être définies l'appel à la fonction permet de stocker un context backtrace
    
    if(isset($GLOBALS['mysqlconnection'])){mysqli_close($GLOBALS['mysqlconnection']);unset($GLOBALS['mysqlconnection']);}
    
    if(J10)FB($_ENV);
	if(isset($_ENV['dieecho']))echo implode('<li>',$_ENV['dieecho']);#dernier echo
	if($x)echo $x;Gt('kill');
  $t=1;$_ENV['backtrace']=debug_backtrace();#attribuer le dernier backtrace
    if(!isset($_ENV['backtrace'][0]['file']))$_ENV['backtrace']='die;';#non valide car appellé par un die ou exit...
    else{
      foreach($_ENV['backtrace']as $k=>$v){if(preg_match('~^(require|include)~i',$v['function']))continue;
        $b[]=str_replace('/home/www/','',$v['file']).':'.$v['line'].' ::: '.$v['function'].((count($v['args'])>0)?"(".fixSer($v['args']).")":'()');
      }
      Krsort($b);$_ENV['backtrace']=$b;
    }
	
	$db=debug_backtrace();krsort($db);
	$bt=print_r($_ENV['backtrace'],1);
	#if($bt!='die;'&&j9&&preg_match("#\.(html?|php)#",SU))fb('kill::'.$bt);
	if(count($db)>1&&J9&&preg_match("#\.(html?|php)#",SU))fb('kill::'.print_r($db,1));
	if(e('sqlon',1)){rep('#,sqlon:[^,]+#','',$_ENV['args']);}
	if(session_id())session_write_close();#fermer la session
	if(isset($_ENV['argswrite']))FPC(ERLOGS,"\n".$_ENV['args'],4);#écrire arguments dans error log
	if(STARTER){if(isset($_GET['r301']))FAP(IPF,'lh','!301');else FAP(IPF,'lh','!200');}#écrire les ipf
	
	FAP(1);FPC(1);Gt('kill.2:fap');#écrire les fichiers en attente
	if(ini_get('apc.enabled')){global $apc;#Si APC est présent avec des variables à enregistrer
		if(count($apc)>1){$size=$apc['size'];unset($apc['size']);Foreach($apc as $k=>$v){$s=count($v)-$size[$k];if($s==0)Continue;ApcP($k,$v,$s);}
	}}

	e(',kill,die');#no recursion
	if(isset($_POST['shut1'])||US=='ben')die;#||$a['USER']=='ben'||$a['USER']=='root'
	#finalization shutdown av("//shut:".$_ENV['args'].':'.e(',exit,r301,dead1,timerror,timerror',1),-1);#dev|/

  if(isset($_ENV['eval1'])){e('eval1');eval($_ENV['eval1']);}#pour pousser des fonctions : ex : système de cache par dessus joomla
  if(RS!=404&&(isset($_ENV['eval'])||isset($_ENV['vars']))&&!preg_match("~base64|(\.|\?)(css|js|rss|jpe?g|gif|ico|png)$~",u)&&filemtime($_SERVER['SCRIPT_FILENAME'])>$_ENV['mtime']['fmtpdata']){#av($_ENV);#de toutes façons écrit le fichier des performances
    if(!is_array($x))$x=[];
    $f=TMP."perf/".mu.".db";
    $x['eval']=$_ENV['eval'];
    $x['vars']=$_ENV['vars'];
    FAP($f,$x);unset($_ENV['vars'],$_ENV['eval']);
  }
  #fpdata dans shutdown de append.php
  #if(strpos(SU,'x24.fr/?list='))die(pre(dbgt()).pre($a).pre($_ENV));
  if(Gt('kill')>20)null;
#$_ENV['args'].=',FAPDcount:'.FAPD(2);
#Gt('shut1');#un temps phénoménal entre cacheon et kill à parvenir ici
  if(US=='ben'||e(',exit,dead1,timerror,timerror',1))return;#encore une fois, mais ne stoppe rien
    #elseif(j9)av($_SESSION);#if(j9)echo'+'.__LINE__;#dev
    #elseif($_SESSION)FAP(ipf,'session',$_SESSION);//Si session mais sans support .. prend bcp de place d'ailleurs..
#vérifier une fois sur die si,conf-loaded && $fmt['conf']>filemtime($a['SCRIPT_NAME']) || ,$conf..
  unset($x);


    if(e(',r404,r301',1))die;#ne rien calculer de plus ...

    $x=memory_get_peak_usage(1)/1000000;
  
    if($x>15&&!isset($_ENV['noperf'])&&!e('noperf',1)&&!preg_match('~earthlight|zsimu|2Test|intranet|internes|revuehommage|alarmemaison|z/sql/~i',SU)){
    Db(SU.">usage:$x>".print_r($_ENV['Mem'],1));if(J9)echo"//peakus:$x Mo ram args:".$_ENV['args'];}
  #if(us=='ben'){xMail(adminemail,'shutdown',pre($_ENV['dbe']).DB2());die;}
  #av("//shut2:".$_ENV['args'],-1);#dev
  if(!e(',noperf',1)){GT('kill.4:aftermem');perf();Gt('kill.5:afterperf');}
  #if(!J9&&!preg_match("#(\.|\?)(js|css|xml)#i",U)&&!e(',noperf',1))die("<!--kill:gene:$_ENV[lasttime]ms-->");#Final
  die;# de toutes façons
}


function Db($k,$v=1,$f='debug'){//todo:Gestion globale IO+erreurs
	FB(compact('k','v'),$f);#balance in firephp
	if(in_array($v,array('£','£args'))){$_ENV['args'].=",$k";$_ENV['argswrite']=1;return;}#Db($t,'£');error log prioritaire
	if(in_array($v,array('£err','err'))||$f=='err'){File_put_contents(ERLOGS,"\n".$k,FILE_APPEND);return;}#reduce recursion
  #if(J9&& strpos($k,'homonymes.html=>/z/mini/!404')){echo'<pre>';print_r([debug_backtrace(),$k,htmlentities($v)]);die;}
	FAP(L2.$f.'.db',$k,htmlentities($v),1);
}

Function Starter(){
  if(us=='ben'||in_array(h,['cron','cli']))return;e(',starter');gt('starter');$ip=IP;$ref=cleanref(REFE);#pour le cron
  if(!STARTER or(Preg_Match("~url.data:|image/png;|base64|/!|2001/|admin|intranet|zsimu|(bg|Tag)\.php|(jsr?|css|jpg|png|ico|gif|eot|htc)\$|\.(swf|js|css|jpg|png|ico|gif|eot|htc)~is",U.REFE,$t)&&!stripos(U.REFE,"submit"))){e(',starter:return:quick');Return Array('host'=>RH,'ip'=>IP,'dlp'=>SU,'u'=>SU,'r'=>$ref,'ref'=>$ref);}#ne rien logger pour ces cas là .. retour simple de données
  if(is_file(IPF)){e(',isfile:ipf');$t=FGC(IPF);G2('ipf','Read');$t['ip']=IP;if(J9)$t['admlog']++;
  Foreach($t as $k=>$v)if(is_numeric($k)or $k=='SESSION')unset($t[$k]);#suppresion des clés numériques issues d'un bug sur FAP
    #if(in_Array(trim($t['mots'],'() '),Array('','not provided'))){unset($t['mots']);$t['motseffacés']=1;}
      if(Preg_Match("~[A-Za-z]~is",$t['host']))null;#ok
      elseif(RH!=IP&&RH){$t['host']=RH;GT('host=rh');}#correction
      #else{$x['host']=gethostbyaddr($ip);GT('host=reverse');}#correction = take to much time
      if(!is_numeric($t['hits']))$t['hits']=1;else $t['hits']=$t['hits']+1;#c,d,b,p
  }
  #New data here :)

  #need keyword on js,php,rewriting,#remplacer par des clés nouvelles
  if(!strpos(REFE,H)&&strlen($ref)>5&&!Preg_Match('~'.HOMESITE.'~',REFE)&&$t['fmt']['ref']+300<now){$t['ref']=$ref;$t['fmt']['ref']=now;}#lastref
  #if(SU!=refe&&strlen($ref)>5&&$t['fmt']['re']+1500<now){$t['fmt']['re']=now;$t['ref']=$ref;}#rem:internal referers
  if(SU!=refe&&!Preg("~/([!|\?]|cont)~",SU)&&$t['fmt']['dlp']+1500<now){$t['fmt']['dlp']=now;$t['dlp']=SU;}#dlp
  #DLP is set with a new keyword only !!!!
    if($_COOKIE['__utmz']&&$t['fmt']['kw']+3600<NOW){#Si cookie sur le domaine de moins d'une heure, on récupère ce mot clé
    #Si mot clé défini par ggtracker<>$yt[mots], le refe!=$yt[dlp]
      if(!strpos($_COOKIE['__utmz'],'not provided'))
        if(Preg_Match("~utmctr=([^;|]+)~",$_COOKIE['__utmz'],$z)){G2('utmz','>keyw');if(trim($z[1])){$t['mots']=$z[1];$t['fmt']['kw']=now;}}GT('s2');#30
    }
  #$f5=TMP."hosts/$ip";#Touch($f5,fmkt($f5)+1);GT('s1');
  GT('s4');
if(!Preg_Match("~/z/|/\?~",SU)&&Preg_Match('~gclid|aclk~i',Q.REFE)){$t['aclk']++;$t['gclid']++;Fap(LOGS.'adwords.db',now,Array(IP,u,$ref));gt('s5');}
if(Preg_Match("~googleads|doubleclick~is",REFE)){#ref
  Preg_Match_ALL("~&(url)=([^&]+)~is",refe,$y);Array_shift($y);#|okw|kw[0-9]
  Foreach($y[0] as $n=>$k){unset($y[0][$n]);$y[0][$k]=urldecode($y[1][$n]);}Array_pop($y);$y=$y[0];
  Fap(LOGS.'adwords.db','t'.now,$y);$t['ads']=$y;
}
  #gclid#si cookie utmz, alors .. fills the keywords again
  #if($t){foreach($t as $k=>$v)$x[$k]=$v;}FPC(ipf,$x,4);GT('fPcipf');
  $x=RH;if(is_numeric(RH)||!RH)$x=IP;GT('host');#$x=gethostbyaddr($ip);if(!$x)
  $t['ip']=ip;$t['host']=$x;$t['hits']=1;
  FAP(IPF,$t);GT('fPcipf2');return $t;
}

function jx($x='',$y=''){unset($_ENV['c']);av($x,$y);$z=$_ENV['dbt'];Arsort($z);unset($_ENV['dbt']);
Bmail('jx:err'+x,SU.'<hr>'.ip.'('.rh.')'.$err.':'.gt('l'.__LINE__).'<hr><pre>'.print_r($x,1).print_r(dbgt(),1).print_r($y,1).print_r($z,1).print_r($_ENV,1),ADMINEMAIL);kill();}function jk($x){jx($x);}

function echobig($x,$bufferSize=8192){$splitString=str_split($x,$bufferSize);foreach($splitString as $chunk)echo $chunk;}#todo:benchmark:augmenter taille d'émission du buffer serveur

#pour placer des variables dynamiques dans les contenus, sans pour autant utiliser autre language template, à implémenter : evaluation, fonctions
function VarCont($text){if(!strpos($text,'##'))return $text;Preg_Match_All("~##([^#]+)##~",$text,$m);if(!$m[1])return $text;#Mini-Template
  Foreach(end($m) as $var){$v2=str_replace('$','',$var);#if($GLOBALS[$v2])
    $text=str_replace('##'.$var.'##',$GLOBALS[$v2],$text);
  }
  return $text;
}


function FAP($file,$k='',$v='',$inc=0,$sofort=0 /*ForArrays*/){
  shutdown(function(){FAP(1);});
    static $t,$stime,$a,$i,$e;
    if(!$t)$t=1;
    $a=is_array($a)?$a:[];
    $e=is_array($e)?$e:[];
    $i++;if($v===0)$v='';
    if(is_array($file))extract($file);
    if(!isset($e[$file]))$e[$file]=0;$e[$file]++;#err:undefined index ..ecrire n fois dans le même fichier ..
#if($k=='lh')av($k.'='.var_dump($v,1));#FAP(ipf,'lh','!200')
#av(pre(dbgt()ce()));#
    if($file===2)return count($a);
    if($file==1 && $a){
        Foreach($a as $file=>$t)FPC($file,$a[$file]);#;Touch($file,$stime[$file]);if(j9)kill("$file,$k,$v".pre($a));
        $a=[];return;
    }
    GT("fap$i-$file");if($y=param($file,'&'))extract($y);elseif($y=param($inc,'&'))extract($y);
#FAP(dr.$db.'.db',Array($u=>$data));FAP(dr.$db.'.db',Array($score));FAP(dr.$db.'.db',$key,$data);-> titre.db or desc.db
  
    if(!isset($a[$file])  or !$a[$file]){
      $a[$file]=FGC($file);
      $stime=is_array($stime)?$stime:[];
      $stime[$file]=(is_file($file)?filemtime($file):0);
      $e=error_get_last();#fb($e,'error');
      if(strpos($e['message'],'Illegal string offset')>-1){
        FB(compact('e','file','stime'));
        if(J9){print_r(compact('e','file','stime'));die;}
      }
      if(!is_array($a[$file]))$a[$file]=[];
    }#vide
#if($e[$file]==5)Dbm('fap e file',SU.'<br>'.$file.':'.$e[$file].' times > switch to FAPD');#FAPD($file,$k,$v); deprecated
  if($v=='$')Return end(array_keys($a[$file],$k));#lecture de l'offset
  if($v=='*'){if(in_array($k,$a[$file]))return;$a[$file]=$k;}#insertion d'un nouvel offset ex: Fap($f,$mail,*)=>$a[]=$k;
	if(!is_array($v)&&substr($v,0,1)=='!')$a[$file][$k]=trim($v,'!');#forcer valeur numérique héhé

    elseif(is_array($k))Foreach($k as $k2=>$v2){if($inc&&is_numeric($v2))$a[$file][$k2]+=$v2;else $a[$file][$k2]=$v2;}
    elseif($k&&is_array($v)){#en cas de multiples dimensions ??
      Foreach($v as $k2=>$v2){$a[$file][$k][$k2]=$v2;$x=error_get_last();
        if(strpos($x['message'],'annot use a scalar value'))Dbm("$k $k2 $v2 ".__LINE__.pre($a));
      }
    }
    elseif(is_array($v))Foreach($v as $k2=>$v2)$a[$file][$k][$k2]=$v2;#2nde dimension de tableau
    elseif(is_numeric($v))$a[$file][$k]+=$v;#sinon incrémentation valeur simple
    elseif($v){$v=str_replace('"',"'",stripslashes($v));if($k)$a[$file][$k]=$v;else $a[$file][]=$v;}
    elseif($k)$a[$file][$k]++;#sinon incrémentation valeur simple
  #pas d'incrémentation de clé 'nulle'
  #[0]=Array([annuaire/Blogs.p1.12.html] => Annuaire blogs 112,[annuaire/blogs.p1.12.html] => Annuaire blogs 113);
  //todo:fapd(file,clé,0,1); -- ne transmet pas l'inc #fap(file,clé)
  if(strpos($file,'titre.db')||strpos($file,'desc.db')){
    $de=dep($a[$file]);if($de>1)dbm(SU."-> $tx (depth=$de) file:$file k:".pre($k)." v:".pre($v)." db2:".pre(DB2())." a:".pre($a));unset($a[$file][0]);
  }
  if($sofort==1)FAP(1);
}

function FPC($fil,$data='',$A=''){#alias pour file_put_contents
    if(e('erver:pre',1)&&strpos($fil,'tmp')){e(',pre:no tmp files write');return;}
    if(preg_match("~/l/[0-9]{1,3}\.~",$fil))FPC(ERLOGS,"\nfpc:$fil:".SU,4);
    #if(preg_match("~punposts~",$fil))FPC(ERLOGS,"\nfpc:$fil:".SU,4);#est fiable !!
  #if(strpos($fil,IP)&&!preg_match('~dev/shm/|perf/|block/~',$fil)){FPC(ERLOGS,"rif:".__FILE__.Preg_replace("~\r|\n|\t| {2,}|\.{2,}~",' ',print_r(dbgt(),1))."\n",1);return;}
	#if(strpos($fil,'l2/'))Pat($fil,$data);
  static $todo,$file,$in,$i=[];$in++;

  #if(US=='ben')kill('--'.print_r(dbgt(),1));
  if($fil=='fpdata'or!$fil)return;
  if(j9&&strpos($fil,'pdata/'))kill(pre(db2()));
  if($fil===2)return count($todo);#delayée#Attention à ne pas planter avant
  if($fil==1){if($todo)Foreach($todo as $f=>$v)FPC($f,$v);unset($todo);return;}#Simple
  if($A==4)$todo[$fil]=$data;#regrouper et delayer les écritures on kill;

  if(!$fil)Db('fpc:'.SU);#Controleur Principal I/O
  if(strpos($fil,'tp:/'))Block('spam?k='.$fil);#Db("fpc:$fil via ".SU);
 
  if(is_Array($data))$data=json_encode($data);#fixSer($data);
  #if(strpos(' '.$k,'tp://'))block();
  if(H=='ben'&&in_array($fil,Array(L2.'php.db',L2.'debug.db'))){echo"FPC2Ben host -> debug<li>$data";return;}
  
      $gt=GT("fpc$fil:0");$ti=round($gt/1000);
      if(!strpos($fil,'557b')&&preg_match('~array~i',$fil))Db("FPC:$fil".SU,'','prio');
      #Temporiser les écritures dans le fichier - Le faire en processus shutdown Génère plein de lignes de débug en trop !
    IF(!preg_match('~2001|admin~i',u)){
      if($file==$fil){
        if(array_key_exists($fil,$i))
          if($i[$fil]>3)Db("3times fpc :$fil");
        }$file=$fil;
        if($i[$fil])$i[$fil]++;
        else $i[$fil]=1;
      #si on tente d'écrire dans le fichier précédent
    }
  #preg_match('/\.([^\.]*$)/', $this->file_src_name, $extension);
    if((strlen($data)>70000000||$ti>10)&&!preg_match('~Test|admin|2001~i',u)&&!preg_match("~err|debug|decalees|\.size~",$fil)&&us!='ben'){$tri=1;
      Db("$ti sec,".$i[$fil]."times (FPC:$fil)".su2.print_r($_ENV,1),'','prio');}#recursion,strlen($data).#['dbe']['db']
    #&&$tri!=1
  if($A==3){$f=fmkt($fil);file_put_contents($fil,$data);if(!$f)$f=1;touch($fil,$f);return;}
  if($A==2){FAP($fil,$data);return;}
  if(in_Array($A,Array('1','app','append'))){file_put_contents($fil,$data,FILE_APPEND);return;}
  
  File_put_contents($fil,$data);GT("fpc$fil:1");
  $x=error_get_last();if(strpos($x['message'],'participation')&&!strpos($x['message'],'defined index'))Dbm('error',db2());
}

function FGC($fil,$a='',$c=''){static $file,$in;$in++;GT("fgc$fil");#alias for : file_get_contents
  if(preg_match("~[0-9]{4}/[0-9]{2}/[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}~",$fil))DbM("fpcerror",$fil.pre($_ENV).pre($_SERVER));
    if(!preg_match("~2001|admin|\?(js|css)~i",u)){
      if($_ENV['lasttime']>30)jx($fil.$i[$fil]."in".$_ENV['lasttime']);
      if($file==$fil){if($i[$fil]>4){Db($fil);kill('oh');}$i[$fil]++;}    $file=$fil;
    }
  if($c)$x=file_get_contents($fil,0,$c);
  elseif(strpos($fil,'p://'))$x=file_get_contents($fil,0,$GLOBALS['ctx']);
  elseif(is_file($fil)){$_ENV['x']=filesize($fil);$x=file_get_contents($fil);}#local
  else Return;#Ni locale, ni en ligne.. inexistante donc

  if(substr($x,0,1)==='{')$x=json_decode($x,1);# as an array
  elseif(substr($x,0,2)=='a:'&&substr($x,-1)!='}'){$p=strpos($x,'}')+1;$x=substr($x,0,$p);if(!$x)$x=[];FPC($fil,$x);$x=unserialize($x);}
  elseif(substr($x,0,2)=='a:'){$x=unserialize($x);if(isset($x[''])&&is_numeric($x['']))unset($x['']);}if($a)$x=$x[$a];
  elseif(is_string($x)){
    $c=explode(',','die;,##');Foreach($c as $v)if(stripos($x,$v)){$x=explode($v,$x);$x=$x[0];}
    if(strpos($x,'/*')||strpos($x,'<?')||strpos($x,'<!--'))$x=Preg_Replace("~<!--[^>]+-->|<\?[^\?]+\?>|/\*[^/]+\*/~is",'',$x);#retirer les commentaires
  }Return $x;
}

function ftpGet($user,$pass,$ips,$lf,$rf){if(strpos($lf,'tolkien')||!$uset||!$pass||!$ips)return;
  $c=ftp_connect($ips);$x=ftp_login($c,$user,$pass);if(!$c)return;return @Ftp_get($c,$lf,$rf,FTP_BINARY);
}


function correctpath($x,$type){#dahhhhhh - obselete, passée aux opération FGC, FPC
	switch($type){
		case'phpthumb':$x=str_replace('adm/editor/pdw/phpthumb/','',$x);
		break;#$x=dr.'y/';
	}
	return $x;
}
#if(is_file("/z/server.php"))Require_once"/z/server.php";,done otherw*ise
#if(stripos($sql,'aReferer'))Xmail(adminemail,'db',$sql.pre(dbgt()).'/'.SU);Memory_get_peak_usage
#start after ban or r301
$o=["http"=>["user_agent"=>'BMX',"timeout"=>600,'ignore_errors'=>1]];$xc=stream_context_create($o);

function strp(&$x){$x=trim(str_replace(Array("'",'"','<','>'),'',stripslashes($x)));return $x;}

function PagesAdmin($x){#pageadmin(f=);
  if(preg_match('~&|=~',$x)){if($y=param($x,'&'))extract($y);}else $f=$x;$f2=explode('/',$f);
  if(!is_file($f))Fpc($f,end($f2));
  $x=FGC($f);if(strlen($x)<3)$x="site en construction";
  return $x;
}

function ReMapTree($x){if(strpos($x,'|')){Block('| scan');return;}#construit l'arborescence manquante
  if(strpos($x,'/')){$v=explode('/',$x);$fin=array_pop($v);if(is_dir(implode('/',$v)))null;else{db("mkdir $x");Foreach($v as $w){if(!is_dir($w))mkdir($w);}}}
}
function urldom($x='',$h=''){#redirige vers le domaine ou l'url si spécifiée dans la page ( évite les accès depuis plusieurs url, quand plusieurs virtualhosts pointent vers le même controlleur )
	if($x && !stripos(' '.SU,$x))R301($x);
    if($h && h!=$h)R301(str_replace(h,$h,SU));
}


function PRC($x,$c='&'){
  switch($c){case'&':return Preg_Replace("~&[^;]+$~",'',$x);}
}
function cleanref($x){gt('cleanref');
  #$x=Preg_replace('~&()=([^&]+)?~is','',$x);#&sap|lang|mid|cid|ds|d|pm|pr|pagenum|snd&suggest=&followon=true&searchtype=searchweb&searchsource=49
  $x=str_replace(array('?','+','%20','%2b','"',"'",'%3f','%26','%3d','%3a'),Array('&',' ',' ',' ','','','&','&','=','&'),sups($x));#%3a=>:bvm
  $x=Preg_Replace("~(_yl(c|t)|(#|&)(_(ult|intl|lang|iceurl(flag)?)|hs(part|imp)|from|uuid|sign|l10n|keyno|state|ptb|tpr|ts|p2|guid|dev|lg|dblg|db|ctx|suggest|sugexp|gs_(id|sm|upl|rfai|l|nf|rn|ri)|\.(tsrc|intl|lang|sep)|bvm|bpcl|type_param|vm|adlt|adsafe|r|adrep|fexp|format|ad|nocache|output|adlh|adext|lines|cid|mid|ds|lang|pr|d|sap|tt|adlt|n|x|y|t|prevsite|aff|qsubts|oi|esrc|cts|stype|sf|escr|qscrl|srch|setmkt|tbo|sid|pf|mvs|ctbs|spellstate|xhr|u|cp|hl|ion|start-index|adpage|sr|filter|install_date|clid|gwt|sky|setlang|iesrc|PHPSESSID|sado|category|site|cnl|btn|tid|ap?|dis_corr|keap|b|pc|fp|bi(w|h)|vc|ch|go|first|ctbm|cs(k|c|t)|s_it|(self|page)search|search(SourceOrigin|button)|(ct|oct)id|gws_link_params|websrchinput|redir_esc|sig2?|source(id)?|obj|usg|ved|gbv|tab|xa|type|btng|asgo|filt|nfpr|bhv|itag|iscqry|toggle|ptag|conlogo|revid|pr(md|nt)|gl|m(shr|kt|eta)|p(qstr|vid|rofil|start|q|u)|s(rc|a|k|afe|tart|pell)|(xarg|tb|di|q|h)s|(site|ad|r)?url|(a|o)q|(p|t)n|(a|e|d)i|(i|o)e|aq(i|l)|k(gs|ls)|f(orm|r2|r|kt|sdt)|l(r|t)|(v|f|h)l|r(ct|ls|lz|d|type)|c(e|m|x|d|r|ad|of|op|lient|hannel)|as_(epq|oq|eq|ft|filetype|qdr|occt|dt|sitesearch|rights|noj|nomo)|rls|ie|oe|channel|clientcop|source|ei|btng|spell|s(c|p|cope)|resnum|sourceid|channel|filetype|vertical|babsrc|rls|(i|o)e|(aff|mntr|source|log)id|pbx|bav|uidora|x|y|ct|idc|oa|a?s|s?client|s(e|q)i|ion|pbx|bav|x_(hl|start|nr|service|imgsz|filetype|imgformat|lr|site|sort|video_lr|imgtype|color)|depart|destination|departuredate|horaire_depart|returndate|horaire_retour|num_(adults|children|babies)|type_vol|ticketclass|frm|num|pbx|cqt|rst|htf|his|maction|csll|action|ref|page|um|tbm|tbnid|imgrefurl|docid|imgurl|w|h|zoom|iact|vpx|vpy|dur|hovh|hovw|tx|ty|tbnh|tbnw|ndsp|bi|si|cc|st|pop|ilc|submit|rewrite|pintl|pcarrier|psig|ust|pm(n|c)c|f|rsv_(bp|spt)|inputt))=([^&]+)?|&v=[0-9]+~is",'',$x);#gclid,aclk,#l|o|atb|sysid|aappid|auid|auc|aq|src
  $x=str_replace(array('/do/gsa/search','/results/results.aspx','/search.aspx','refineobj%3avideo','http://','www.'),'',$x);$x=str_replace('&=&','&',$x);
  Return $x;
}

function scanex($d,$ex=''){#scandir et exclusion d'un motif précis
	$x=scandir($d);array_shift($x);array_shift($x);
	Foreach($x as $k=>$v){if($v[0]=='.')unset($x[$k]);
		if($ex){if(Preg_Match("~$ex~i",$v))unset($x[$k]);}
}Return $x;}

function preg($x,$y='',$r=''){if(!strpos(' '.$x,'`')&&!strpos(' '.$x,'~'))$x="~$x~i";$res=Preg_match_all($x,$y,$z);if($res)return $z;}#if(ereg('`c',$x))db($x);
function t2($x){if(!$x)return;if(count($x)==1 and Is_Array($x))$x=$x[0];if(is_array($x))echo(Pre($x));else echo("<textarea style=width:100%;height:100;>".htmlentities($x)."</textarea>");}
function tuer($x){if(is_Array($x)){Foreach($x as $v)t2($v);}else t2($x);kill();}

function Tidy($x){if(strpos($x,'<input'))Return $x;
  $x=strip_tags($x,'<form><input><button><label><textarea><br><div><table><tr><td><p><a><img><strong><h1><span>');$x=str_replace(array('Normal','false','FR-CH','X-NONE'),'',$x);return $x;
}

function R303($x,$nc=0){#elles passent toutes par ici
  if(J9){FB(debug_backtrace(),303);}#$bt=end($bt);
  if(strlen($x)>200||preg_match("~phpthumb|image/png|base64,|data:~i",U))return;#db3("r303urldata:");av(func_get_args());#data:;, => ne doit pas générer de r301 car .. bordel !!
  #if(J11)av(debug_backtrace());
  if(STARTER){$lh=$_ENV['yt']['lh'];$lr=$_ENV['yt']['lr'];}
	Fap(IPF,'lr',SU."=>".$x);#la concrétisation
  unset($_SESSION['st1']);$_GET['r301']=1;e(',r301,r303');#tracker
  #SU.$x
  if(starter&&$lh==301&&$lr==$x){jx($lh.$lr);db('dest'.SU);if(U)R302("/#error:301loop:$x");return;}
  if($nc==1){Header("Status: 301 Moved Permanently",1,301);Header("Location:$x");kill();}
  if(!$x){Db("emptyR2:".SU);jx('emptyr2');return;}#jx();
  if(headers_sent($f,$line)){Db("headers!$f,$line");return;}#on n'y peut rien !#@ob_clean();
  Header("Status: 301 Moved Permanently",1,301);Header("Location:$x");#av($_ENV['args'].'-'.__line__);
  kill();
}

function r301depart(){
	IF(isset($_POST['r301'])||!is_file(CR301)||e('nor301',1)||H=='cli'||strpos(U,'/sql/'))Return;
  $r1=r3p(mu);if(is_file($r1))$r301=fgc($r1);else $r301=FGC(CR301);
  if(J9&&is_file(CR301)&&fmt(CR301)<2000000000){@UNLINK(CR301);if(is_file($r1))@UNLINK($r1);}#av('a1',fmt(CR301));

  if(strlen($r301)>200||preg_match("~image/png|base64,|data:~",u)){db3("r301depart:$r301");return;}


  if(!$r301 || $r301==SU){if(is_file(CR301))unlink(CR301);if(is_file($r1))unlink($r1);return;}$hist=Array($r301);
  FB('r301depart');

    #jx('mail','r301:'.$r301."is_file(CR301):".is_file(CR301));db(SU."=>r301 file same or nul=>$r301");
      While($n<4&&GT('recursiver301')<400){$n++;$next=FGC(r3p($r301));if($next==SU){unlink(r3p($r301));$next='';}
          if($next){$hist[]=$next;FPC(CR301,$next,3);$r301=$next;}
          else $n=4;
      }if(!$r301){unlink(CR301);return;}
  #@file_get_contents($r301,'',$GLOBALS['ctx'],0,10);$x=$a=$http_response_header;$a=explode(' ',$a[0]);$a=$a[1];#jx('r'.pre($x));
      if(in_Array(SU,$hist)){db(SU."=>inArray=>$r301");jx($hist);}
      if($r301==SU){db(SU."=>same=>$r301=>unlink");unlink(CR301);return;}
      if(!$r301){db("emptyR1".SU);unlink(CR301);return;}
      if($r301){fmt(CR301);r303($r301);e(',r301');kill();}#Fmt(CR301.".count");
      #@file_get_contents($r301,'',$GLOBALS['ctx'],0,20);$a=$http_response_header;if(!strpos($a[0],'200 OK'))R301('/');
}
function h301($x){static $nbessais;$nbessais++;gt("h3$nbessais");if($nbessais>3)jx();#jx();
    @file_get_contents($x,'',$GLOBALS['ctx'],0,10);$a=$x=$http_response_header;$a=explode(' ',$a[0]);$a=$a[1];
    if($a==301){if($x[46]){db('h301err[46]:'.SU);jx();}if($x[33]){ereg('Location: (.*)',$x[33],$t);$URL=$t[1];}elseif($x[20]){ereg('Location: (.*)',$x[20],$t);$URL=$t[1];}elseif($x[7]){ereg('Location: (.*)',$x[7],$t);$URL=$t[1];}return $URL;}}
#is a pretty bad method !!
function die2(){e(',av,die,nocss,noperf');if(J9)kill(implode('#',sys_getloadavg().pre(dbgt())));}

function isgoodurl(){if(is_numeric(H))return;
  //todo:mettre un filtre positif des bonnes extensions !!!2.php?SID=hb79c58672dv1gpum3fvs48s93&agr=Ped§Gyn%E9co
  if(preg_match("~url.data:|image/png;|base64|/(adtech|iframeproxy)~is",u))Return;
  if(preg_match("~SID=|page_loaded|%3F|mBrowser|_ult|plugin~is",q))Return;
  if(preg_match("~(db_sql|2)\.php|data:image|%22|&amp;|home_studio|hf_guitare|hf_guitare|marque|_vti_bin|owssvr~is",u))Return;
  if(preg_match("~/[0-9]{1,4}\..*[0-9]{1,4}\..*|\?q=?\$|\?q=3d.*|\?(js|css|go|gclid|nb|lt|cat_id|x|3|1|sel|list)|comply|prechoix|test|login|intranet/|trackback|mentions|y/|catg_mb|register|3p3\.php|viewtopic|connect|tag|/\?|\.(dll|ico|eot|ttf|js|css|htc|woff|swf|xml|gif|png|jpe?g|bmp|flv|mp(3|4)|exe|aspx?)\$~is",u))Return;
  return 1;
  #rss|rss|

  #RLIKE '.*\(\(\\?\(\(p\).*\)\.*\|\.\(db\|css\|js\|404\|gss\|sm\)\|)'");
  #$rlike=Array("\?"=>"\\?","("=>"\(",")"=>"\)","|"=>"\|");
  #delete from p.url where url rlike'.*\?q=3D.*' sql=> doubler les échappements # str_replace("\\","\\\\",$v));
  $php2sql=Array("\?"=>"\\?");
####todo
  $sql[]="UPDATE url SET header=1 WHERE url RLIKE '.*\(\(\\?\(\(p\|nb\|lt\|cat_id\|x\|3\|1\|sel\|list\|comply\).*\)\|go.1\|rss-\|use\(t\|r\)/register\|login\.facebook\.com\|jss3\|=3D\|intranet\|mentions-legale\|a74.fr/y/\|catg_mb\|3p3\.php\).*\|\.\(db\|css\|js\|404\|gss\|sm\)\|\(rss\|test\|register\|viewtopic\|connect\|Tag\)\.php.*\|\\?q\$\)'";
  $sql[]="update url set header=1 where url rlike'.*\(/trackback/|member/signup|type_surfer|=user|\\?hi=|\\?VIEW=|q=.*=|404\\.gif|.*|.*\\?q=\$'";
}

function acc2($x){
  $x=strtolower(str_replace(Array(' ','/','.','â','à','ê','é'),Array('-','-','-','a','a','e','e'),$x));
  Return trim(preg_replace("~-{2,}~s",'-',$x),' -');
}
#function gclid($x){return ereg_replace("\?gclid=.*",'',$x);}



function MeM2($x,$db='',$ov='',$s=45,$oldk='',$type='input',$css='',$s1='',$selkeys=''){#champ mémo rapide pour backoffices
	Rem($db,$_ENV['c']['mem2defaultdb']);
    $action='http://dc10.fr/';if($css)$css=" class=$css";
  if($y=param($x,'&'))extract($y);else $champ=$x;#exploser les champs ou les conserver
  #if(!$ov && $oldk)$ov=$aa[$oldk];#MeM2('champ','divers,1107','valeur',2);if(j9)Db($oldk,$ov,'prio');
  $user=str_replace(array('bmx'),array('ben'),RU);
  $h=ceil(strlen($ov)/30)*16;if($h==0)$h=18;
  if($h>100)$h=100;
  if($selkeys){$selkeys=explode(',',$selkeys);
    Foreach($selkeys as $k)$sel.="<option value='$k'>$k</option>";
      $sel=str_replace("on value='$ov'","on selected value='$ov'",$sel);
    $z="<select$css name='v' id='$oldk' onchange=\"pn(parentNode)\">$sel</select>";#size=$s
  }
  # style="width:40px;"
  elseif(in_Array($type,Array('text','textarea')))$z="<textarea$css style=height:$h name='v' id='$oldk' size=$s onBlur=\"pn(parentNode)\">$ov</textarea>";
  else $z="<input$css name='v' id='$oldk' value=\"$ov\" size=$s onBlur=\"pn(parentNode);\">";#<input type=submit value=g style='width:1;display:none'>
return"\n<form id='$db,$champ' style=display:inline action='$action' method='post' target=ho><input type=hidden name=udbk value='$user;$db;$champ;$oldk'><input type=hidden name=ov value=\"$ov\">$z$s1</form>\n";
}#divers,3410;cons

function isaN($x){return is_numeric($x);}

function Mem3($x,$db,$ov,$oldk,$selkeys,$css,$s=''){return Mem2($x,$db,$ov,$s,$oldk,'',$css,'',$selkeys);}

function memo($x,$s=45,$a=''){Rem($a,$_ENV['c']['mem2defaultdb']);Return mem2($x,$a,'',$s,$x);}

function Gmt($k='',$e=4){static $start,$last,$lk;
    $x=microtime(1);if(!$start){$start=$last=$x;return;}
    $time=$x-$last;$_ENV['dbt'][$k]+=$time;
    $last=$x;$lk=$k;Return $x;
}
function getCpuUsage(){GT('cpu');$out=shell_exec('ps aux|awk \'NR > 0 { s +=$3 }; END {print s}\'');
    $cpuUsage=strtr(trim($out),Array("\n"=>'', "\r"=>''));Return $cpuUsage;
}

function getTime($k=''){return GT($k);}

function R302($x='',$suppr=[]){
  if(is_array($x))extract($x);
  if(!$x)$x=SU;#same url base
  formatQS($x,$suppr);
  if($replace)foreach($replace as $k=>$v)$x=str_replace($k,$v,$x);
  
  if(J9){$bt=debug_backtrace();$bt=end($bt);fb($bt,'r302');}
  if(in_array(H,['cli','cron']))return $x;
  if(!$_POST && !redirLoops($x))return;#loops on itself
  if($x==SU)$x='/#self:'.U;#wizo ??
    #if(strpos($x,'tendresse'))die(pre(debug_backtrace()));#
    if(in_array($x,array('?','??')))$x='#?';
    if(!$x)$x='/#'.U;
    
    $x=str_replace('*','http://',$x);
    FB('r302:'.$x);
    if(strpos($x,'sxxx.fr'))$x='/#s66';
    
  if(headers_sent($file,$line)){
    die("<META http-equiv='refresh' content='1;URL=".$x."'><script>location.href='$x#headersSent';</script>");
    $m='r302 headers sent:'.SU."\n".$file.':'.$line;#879:404
    db($m);dbm('headers sent',$m,1);
  }
  Header("Location:$x",1,302);
  try{}catch(Exception $e){} #Cannot modify header information - headers already sent
  $_ENV['args'].=',r302';kill();
}
#av(dbgt());if(strpos($_ENV['args'],'nor301'))return;
function perf(){static $t;unset($_ENV['header'],$_ENV['c']);GT('perf1');
    if(preg_match('~(js|css)$|(js|lastmod)\.php~',SU)||isset($_POST['ajax']))return;#
//todo:ne pas executer cette fonction si header<>200 sur la page
  $x=$GLOBALS['pi'];
  if($x['extension']){#peut être vide..
    if(in_Array($x['extension'],explode(',','php,htm,html,fr,org,com,info,ch,tv')));else return;#extension non autorisée
  }
  #cl('perf,j9:'.J9.','.$t.','.SU.','.print_r(,1));
  #if(!preg_match('~\.(html?|php)$~',U))return;
  if(Preg_Match("~glob=~",Q))$t=7;#jamais de la vie
  elseif((e(',forceperf',1)or J9))null;#car rajoute le debug sur le javascript
  elseif(is_numeric(H)||$t||RS==404||e('noperf',1)||isset($_ENV['noperf'])||
  $_GET['re'].$_GET['noperf'].$_GET['np']||strpos(U,'%2B%2B')||strlen(U)>80)$t=1;
  elseif(Preg_Match("~(js|jsr|css|rss|sm|redir)\$~",Q))$t=2;#
  elseif(preg_match("~Tag\.php|url(\.|\()data|image(/|-)png|base64|\.(png|js|css|jsx?|jpe?g|gif|bmp|gif|ico|htc|sm)\$~",U))$t=3;
  elseif(!isgoodurl())$t=4;
  elseif(Preg_Match("~editor\.php|officia|Tag|rss|data|xml|/(CIEL|admin|2001|adm)/|(gss|css.*)\$~i",SU)||(preg_Match('~/z/~i',SU)&&!preg_Match('~\/sex|video~i',U)))$t=5;
  if(preg_match("~base64|%27|\+~",u))$t=6;

    if($t){Av('t',$t);return;}#FPC(ERLOGS,"noperf:$t\n",1);
  GT('fin');
  $t=1;if(in_array(H,Array('ben','localhost','127.0.0.1'))){av('H',$_ENV);kill();}
  #even if cached,if(j9)return;
	if(q)null;#ne pas écrire
  else{
    $f0=TMP."perf/".trim(str_replace(array('http://','/'),array('','§'),SU),'§').".db";$f=TMP."perf/".mu.".db";
    if(is_file($f0))rename($f0,$f);#transition, beaucoup plus simple au final
    $x=FGC($f);#Faire correspondre avec fichier "mu" plutôt !!! @todo
    if(isset($_ENV['yt']['mots']))$x['mots']=$_ENV['yt']['mots'];
    $x['Memo']=Memuse();#;
        $def=array('tim','nb','db');foreach($def as $v)if(!isset($x[$v]))$x[$v]=0;
    if($x['tim']>9999999999)$x['tim']=$x['nb']=0;#si bug gettime
    #if(!is_numeric($x['tim']))$x['tim']=0;$x['tim']+=$time;#err
    if(!is_numeric($x['nb']))$x['nb']=1;  $x['nb']=$x['nb']+1;
  $x['avg']=ceil($x['tim']/$x['nb']);unset($x['calc'],$x['gen']);#if avg>800 db(,'prio'); et on peut créer fichier fpdata avec cette valeur avg afin de charger plus souvent, plus durablement le système de cache pour soulager les pages mettant bcp de temps à être pondues !!!!
  $x['db']=explode(',',str_replace('Array','',$x['db'])); $x['db']=Array_unique($x['db']); $x['db']=implode(',',$x['db']);
  if(function_exists('sys_getloadavg')){$sysload=implode('#',sys_getloadavg());$x['sys']=date("H:i:s").">".$sysload;}

	if(e('erver:pre',1));#jamais en local ou pré-prod
	else{FPC($f,$x);Touch($f,$x['avg']);}

  }
  $x['db'].=",fin:".$_ENV['lasttime'];
  $x['cachepath']=CACHEPATH;
  if(!j9)return;Addurl();#les urls dont on s'en tape
$edit=$y2=null;
#FAP(logs.'Vitale.db',Array('cp'=>cachepath,'sfn'=>$_SERVER['SCRIPT_FILENAME']));

  #$x=FGC(TMP.'cont/'.$mu.'.contenu');
  $f=TMP.'cont/'.MU.'.contenu';
  if(is_file($f)){$y=FGC($f);$_ENV['args'].=" :muc:$y[id],len:".$_ENV['x'];$edit.="<button onclick=\"edt('?zp=$y[id]');return false;\">e:muc:$y[id]</button>";}
  elseif(is_file(TMP.'cont/'.MU)){$y=FGC(TMP.'cont/'.MU);e("e:mu:$y");#contient l'identifiant de la page
    $t=sql5("select sql_cache * from p.zpages2 where id=$y");if($t)$edit.="<button onclick=\"edt('?zp=$y');return false;\">e:mu:$y</button>";
    else unlink(TMP.'cont/'.MU);#unlink si l'identifiant sql n'existe pas :)
  }
  elseif(isset($_POST['create'])){#£todo:bad: right, that's bad, we're checking in this function, globally, if we have some postdata to edit this page contents
    $y=sql5("select id from p.zpages2 where url=\"".SU."\"");
    if(!$y){$y=sql5("insert into p.zpages2(url)values(\"".SU."\")");if($y)FPC(TMP.'cont/'.mu,$y);}
  }
  elseif(!RU)$edit.="<form method=post><input type=hidden name=create value=1><input type=submit value=create></form>";

  if(1)$edit.="<button accesskey='e' onclick=\"edt('?sfn=1');return false;\">kod</button>";
  Arsort($_ENV['dbt']);unset($_ENV['c'],$_ENV['Adbt']);
  $x=Array_merge($_ENV,$x);if(is_file(CACHEPATH))$dif=" age:".(filemtime(CACHEPATH)-NOW)."";
  if(is_Array($x['Memo']))$x['Memo']=implode(',',$x['Memo']);
#$y=Pre($x,'nude=1');pre2console($y);
if(isset($_ENV['debug'])){$y2=Pre($_ENV['debug'],'nude=1');pre2console($y2);}
#if(J11)$y=print_r(debug_backtrace(),1).$y;

if(!strpos($_ENV['args'],'nocss') && !AJAX){
  $base=$x;
  header('Bs: '.fixSer($x),1);
  header('Cdebug: '.str_replace(array("\r","\n"),array('','*'),print_r($base,1)),1);
  echo"\n\n<script>var y='".jsonEnc($base)."';var cinfo=JSON.parse(y);console.info('cinfo',cinfo);</script>";
  //todo JS debugging into header  
}
  
    
#y.replace(/\"\"/gi,'*'),if(z2)console.info(\"%c\"+z2,'color:blue;font:10px Trebuchet MS');
#[\"Perf:$sysload:$_ENV[lasttime] ms-\"+z]
#.replace(/\\n +\(\\n/g,'(\\n').replace(/\\nArray\\n\(\\n\[/g,'\\nArray:\['),z2=\"$y2\".replace(/\\n +\(\\n/g,'(\\n').replace(/\\nArray\\n\(\\n\[/g,'\\nArray:\[');
#console.info([%cPerf:$sysload:$_ENV[lasttime] ms-\"+z,'color:blue;font:10px Consolas');
  if(e('shutd'))Null;else kill();#Si une autre fonction de shutdown a été rajoutée par dessus - sinon fin de tout ( appel à die recursif dans foncshutdown ) !
}

function pre2console(&$x){$x=str_replace(Array("\n",'"','%','&quot;',";s:0:''",),array('\\n',"\\\"",'%25',"'",''),trim($x));return $x;}#£good
Function rlike($x){
  $rlike=Array("\\?"=>"\\\\?","("=>"\(",")"=>"\)","|"=>"\|");
  Return str_ireplace(Array_keys($rlike),Array_Values($rlike),$x);
}
function cleancoms($x){#£good
	if(stripos($x,'####')){$z=explode('####',$x);$x=trim($z[0]);}#end of contents
	if(stripos($x,'##'))$x=preg_replace("~##[^\r]+~is",'',$x);#end of line
	if(stripos($x,"href='//"))$x=preg_replace("~href='//~is","href='http://",$x);#eol href='http://
	if(stripos($x,'/*')>-1)$x=preg_replace("~/\*(?:(?!\*/).)*\*/~s",'',$x);
	$x=preg_replace("~[\r\n]#[^\r\n]+\r~s",'',$x);$x=preg_replace("~>[\r\n]+<~",'><',$x);#les sauts de ligne entre balises html --
	return $x;
}


function Block($t='',$x='',$freeze=0){#raison,pregmatch
	#if(RU)return;
	if(RU||J9){#authentifié or ben
    #die('block: '.print_r(debug_backtrace(),1));
		if(0){echo'<pre>block:'.print_r($t,1).':'.print_r($x,1).'</pre>';Header('Status: 404 Not Found',1,404);kill();}
		return;
	}#die('authentifié mais bloqué par le firewall, merci de communiquer ce problème à votre administrateur : '.adminemail.' :'.ip.';'.ru);
	if(is_file(TMP.'block/'.IP.'.whitelist')||is_file(TMP.'block/'.IP.'.admin'))return;#admin
	if(J9||preg_match("~".OKURL."~is",SU)||preg_match('~chu-lyon\.fr|crawl|spider|yandex\.com~is',HOST)||(preg_match('~Google|Slurp~is',UA)&&!preg_match('~AppEngine~is',UA))||Preg_match('~Tag~i',U))return;#A ne pas blocker
	if(Preg_Match("~email .*loc~",$x))$freeze=1;
	#FPC(TMP."block/83.154.195.95','suspicious');
	Header('Status: 404 Not Found',1,404);if($t=='x')kill();
	#todo:put as an array
	$y=$_ENV['yt'];
		if(is_array($t))$y=array_merge($y,$t);else $y['t']=$t;
		if(is_array($x))$y=array_merge($y,$x);else $y['block']=$x;#possible transmission d'un array en non ou ajout simple ..
	$y['bots']=BOTS;$y['ua']=UA;
	$y=array_filter($y);
	#$y="bots?".bots."-".$t.$x."=> ".print_r($_ENV['yt'],1)." ".date("Y/m/d H:i:s")."\n".host."; ".refe."; ".SU.";".ua;
	db('block');FAP(IPF,'blocked');FPC(TMP."block/".IP,$y);
	if($freeze){Touch(TMP."block/".IP,1);}#Fap(R.'modif.db',IP,$t);
	kill();
}

function pri(&$x){
  $x=print_r($x,1);$x=Preg_replace(Array("~Array\n[ ]{2,}\(\n[ ]{2,}~","~Array\n\(~","~    \[~"),array("A:\n  ",'','['),$x);#return $x;
  $x=str_ireplace(array(' =&gt;',' =>'),':',$x);$x=trim($x,")\n");return htmlentities(trim(str_Replace(array(" => Array\n        (","        )\n\n","        "),array(">","",'  '),$x),' )'));#
}
function Pre($x,$filter=1,$se='',$mh=200,$sup=0,$close='',$log=''){$nu=0;$m2=10;$m1=0;$min=400;$nude=$leg=null;#Pre($x,'filter=3&min=300&nude=1');
  if($y=Param($filter,'&'))extract($y);
  if(is_string($x))Return $x;
  if(is_numeric($x))return'numeric:'.$x;if(!is_array($x))return $x;if(count($x)==0)return;

  if($filter==3)$m1=$m2=0;if($filter==2)$mh=2000;if($filter==4)$mh='90%';

  if($filter)$x=Array_filter($x);gt('pre');pri($x);
  #preg_replace("~Array\n\t\(~","~Array\n\(\n~"),array("\t",''),$x);
  if($se and Preg_Match("~$se~is",$x)){$x=str_ireplace($se,"<b style='background:#FF0'>$se</b>",$x);$x=explode("\n",$x);#^\[$se^\]
    Foreach($x as $k=>$v){if(Preg_Match("~$se~is",$v)){$y[$k]=$v;unset($x[$k]);}};$x=implode("\n",$y+$x);#Highlight search patterns
  }#kill("<br>".$y);#print_r($y,1));

  if($nude)Return $x;
  $mt=-10;if($sup)$mt=-4;#
    if($close||$sup)$leg="<legend style='margin-left:0'>$close$sup</legend>";else $x="\n\n".$x;#$m1=10,$m2=21
    $mem=Memuse();
    #if(J9){var_dump($x);kill();}

  if($nu)return"<pre class='dbpre'>$x</pre>";
  Return"<fieldset style='min-width:{$min}wpx;border:1px solid #444;padding:0;margin:0 0 0 $m1;' id='dbf'>$leg<pre class='dbpre' style='font:10px courier;white-space:pre-wrap;margin:$mt 0 0 $m2;max-height:$mh;overflow:auto;'$log>".$x."</pre></fieldset>";
}
function GT($k='',$m=0,$e=4){
  static $noerr,$err,$i,$prevmemusage;
    if(in_Array($k,Array('kill','cachepath:read:1')))$noerr=$k;#pas d'erreur après ces clés
    #Final-désactivation erreurs si accession au shutdown
  if(!$noerr&&($err || e(',timeerror,timerror,dead1,av',1)))Return;#empêche la récursivité de la fonction
  $now=Memuse(90);$mem=$now-$prevmemusage;$prevmemusage=$now;
  $round=Round($mem,3);Rem($k,DB2(-1),$i);#Mettre en clé la Dernière instruction du Debug Backtrace si non définie #$i++;$k='u'.$i;$_ENV['dbt']['#'.$k]=DB2(-1);}
  $x=TimeLong(1);if(is_Array($x))extract($x);else $d=$x;
  if($d)$_ENV['lasttime']=$d;$_ENV['lastkey']=$k;

  $i++;if($i>$_ENV['maxop']){$err=1;Db(SU,">".Round($d)." sec; gt-occurences:$i");jx("mail",SU,">".Round($d)." sec; gt-occurences:$i");}

  if(in_Array($k,Array('000','fin')))Return $d*1000;#Multiplions la valeur par mille : 51.4ms
  if(!is_numeric($m)&&isset($_ENV['Adbt'][$k])&&$m){$d2=$d-$_ENV['Adbt'][$k];unset($m);}#prend la différence entre les deux clés : 0.0197-0.0136
  if(!$d2)return;#Trop rapprochées&recursive? substr($_ENV['args'],-1)=GT()??
    $d2=round($d2,5);
    $d=round($d,5);

    if(!isset($_ENV['Tdbt'][$key]))$_ENV['Tdbt'][$key]=0;
    $_ENV['Tdbt'][$key]+=$d2;
  
  
    if(isset($_ENV['dbt'][$k]))$_ENV['dbt'][$k]+=$d2;#MemLeak Here##
    else $_ENV['dbt'][$k]=$d2;
    $_ENV['Adbt'][$k]=$d;#absolue
    if($round>0.1)$_ENV['Mem'][$k]=$round;#Si 100ko = significative

    if(!isset($_ENV['dbe']))$_ENV['dbe']=array('db'=>null);
    
    $d2=Round($d2*1000);$d=Round($d*1000);
    if($d2>5||$m==1)$_ENV['dbe']['db'].="$k:$d2 ";
    if($d>30000&&!ru&&!$noerr){e(',timeerror');Db(SU,"$k>".Round($d)." sec ");jx('mail','+30sec');return;}
  return $d2;#Retourne toujours l'écart & non la valeur absolue
}

function Gl($x){return $GLOBALS[$x];}
/*returns the global of this
#g1('aa[mem2defaultdb]')
#global $aa;$aa[mem2defaultdb];
#$GLOBALS('aa[mem2defaultdb]')*/


function JoindreFichier($A,$F,$i=0){if(!is_Array($A))Return;#JoinFichier($A,L2."missurl.db"); serialize array as input
  if($i){$x=FGC($F);Foreach($A as $k)$x[$k]++;FPC($F,$x);Return 1;}
  $x=FGC($F);if(is_Array($x))$x=Array_merge($x,$A);else $x=$A;FPC($F,$x);return 1;
}
function expire($t=9600,&$etag=''){
  static $fired;$headers=headers_list();foreach($headers as $v)if(stripos($v,'Etag: ')!==false)$fired=1;  
  if($fired)return;$fired=1;#if(j9)Db($t,'£');#Dump to ERLOGS
  $etag=ceil((NOW-$t)/$t)*$t;while($etag>NOW)$etag-=($t/4);
  $date=gmdate('D, j M Y H:i:s',$etag).' GMT';#sets the closest round hour
  #header('Expires: '.gmdate('D, j M Y H:i:s',NOW+$t).' GMT',1);#fur prechoix index
  header('Cache-Control: max-age='.$t,1);
  if($_SERVER['HTTP_IF_NONE_MATCH'] == $etag || $_SERVER['HTTP_IF_MODIFIED_SINCE']==$date){header('HTTP/1.1 304 Not Modified',1,304);die;}
  header("Etag: ".$etag,1);header('Last-Modified: '.$date,1);
}#header("cache-control: must-revalidate");header("expires: ".gmdate("D, d M Y H:i:s",now+$t)." GMT");

function addS(&$x){$x=preg_replace("~\\\{2,}~is",'\\',addslashes($x));return $x;}
function addSe(&$x,$s="'"){$x=preg_replace("~\\\{2,}~is",'\\',str_replace($s,'\\'.$s,$x));return $x;}

function h($x){#£good:universal headers control
    if($x != 200)e(',h!200,noperf');
  switch($x){
  case'xsl':case'gss':expire();header("Content-type: xslt+xml");break;case'200':header('status:200',1,200);break;case'jpg':expire(1200000);header("Content-type: image/jpg",1,200);break;case'rss':expire();header("Content-type: application/xml");break;case'css':expire(3600);header("Content-type: text/css");break;case'js':case'j':expire(3600);Header("Content-type: application/x-javascript");break;}}#par défaut

function R404($m=1){
  if(J9)fb(debug_backtrace(),'backtrace');
  e(',r404,die,noperf,noindex');#av(__line__);
  if(preg_match("~print.css~i",u)){Readfile(R.'!c/print.css');kill('/*php*/');}
    while($i<99){$i++;$f.='&nbsp;';}#dépasser le tampon d'IE pour page 404
    if($m==2){ob_end_clean();Header('Status: 404 Not Found',0,404);kill("<center><script>location.href='/';</script><a href='/'>404 - Page Not Found </a>".$f);}
    if(j9&&$m)FAP(LOGS."sql.decalees","update url set header=1 where url='".SU."'");#SQL for cronjob : flag this url as bad
    if(in_array(substr(U,-3),Array('jpg','png','gif','bmp')))R301('http://x24.fr/404.jpg');
        #if(Preg_Match("~\.(rar|asp|zip)$~is",u))Block('','',1);#;
        if(preg_match("~".IGNORE404."~i",u))$m=0;#très nombreuses ( hacking attempt, scans ... )
        
  if($m){FAP(L2."404.ser",SU);}
  #ob_end_clean();
  Header('Status: 404 Not Found',1,404);#headers sent here
  if(!J9&&!BOST&&in_array(H,Array('1rachat-credit.fr','creditimmo.org','dc10.fr')))$f.="<script>location.href='/';</script>";
  echo"<html><head><title>404 not found</title><style>body{background:#003;color:#AAA;}</style>
  </head><body><table width=100% height=100% border=0 align=center><tr><td><center><h1>404 - Page Non trouvée<br>".(is_string($m)?$m:'')."<br><a href='/'><img src='http://x24.fr/immologo1.png'><br>Retour à l'accueil</a></h1><br><form action='http://google.fr/search' method=get><input type=hidden name=q value='site:".H."'><input name=q><input type=submit value=rechercher></form></td></tr></table>$f</body></html>";die;
}



function rcache(){Gt('Rcache-directfun');if(is_file(cachepath)){Touch(cachepath,fmkt(cachepath+90000));Readfile(cachepath);kill();}}#ob_clean();+1 day cache

function sql($sql,$bd=null,$opt=null){
  if(is_array($opt))extract($opt);
  $param='old';if(substr($sql,-4)=='#'.$param){$sql=str_replace('#'.$param,'',$sql);${$param}=1;}#usage mysql court
#if(substr_count($sql,"'")%2==1){db('injection : '.substr_count($sql,"'").$sql);return;}
#str_replace("'",'’',$within the quoted space)
  static $status,$bdsel,$host,$conn;if($status=='dead')Return;#connexion dropped
	if($bd==1 or $opt==1){$close=1;unset($p,$nt);}
	if(strpos($sql,'.s3db')){
		Preg_match('~[^ ]+\.s3db\.~i',$sql,$m);$bd=trim($m[0],'.');
		$sql=str_replace($m[0],'',$sql);
	}
	if(strpos($bd,'.s3db'))return sqlite($sql,$bd,$close);
  
    #if(function_exists('div_sql'))av(div_sql($sql,$bd));#addition ksv1:list($sql,$bd,$a)=div_sql($sql,$bd);#fonction divergentes
  if(function_exists('div_sql'))list($sql,$bd,$a)=div_sql($sql,$bd);#addition ksv1:list($sql,$bd,$a)=div_sql($sql,$bd);#fonction divergentes
	if(!$bd&&strpos($sql,' ciel.'))$bd='ciel';
  elseif(!$bd&&strpos($sql,' p.'))$bd='p';
  elseif(!$bd&&strpos($sql,' ben.'))$bd='ben';
        ReM($bd,Array($_ENV['defaultdb'],$_GET['defaultdb'],DB,'localhost'));
    #av($sql,$bd);
  if(!$a)$a=$_ENV['c']['sql'][$bd];#si non fournie par div_sql()
  if(!$a){db("5.sqldb not defined : $bd $sql");return;}
  
  #if(J9){echo'<pre>';print_r([$sql,$sa,$bd,SIP,$a,'dfdeb'=>$_ENV['defaultdb'],'getdef'=>$_GET['defaultdb'],'db'=>DB]);die;}#,ben,aws
  #$bd=ben,SIP=aws

  if(preg_match("~(/\*|--|\(\{) '|\\x(00|1a)|;(drop|select|delete|update)|'? union select~i",$sql,$m)){av('injection match',$m);FPC(ERLOGS,"\nsql injection:$sql",4);return;}#injection tester - never add those 

  $Stamp=substr($sql,4,15)." ".substr($sql,-7);
  if(GT($Stamp)>10000 and Preg_Match("~update |insert ~i",$sql)){FAP(LOGS."sql.decalees",$sql);return;}
  #check for these ones with a cron
  
	if(!e(',sqlon',1))$bdsel='';#could have been killed .....
	if($bd!=$bdsel){GT("sqlon".$bd);$bdsel=$bd;#on recrée la connexion
        $_ENV['dbe'][]=$sql;
        if($a[0]=='94.23.226.97')return;#server offline - returns null - Db(NU.'->'.$sql,'prio');
		Rem($sa,SIP,$_ENV['server']);if(SIP==$a[0])$a[0]='127.0.0.1';#si l'on tente de connecter à une ip définie et que c'est le localhost en réalité =
		#Si seulement, au final, on a changé de host
		if($host!=$a[0]){
        $host=$a[0];
        $GLOBALS['mysqlconnection']=$_ENV['sqlconn']=$conn=mysqli_connect($a[0],$a[1],$a[2]);
        if($n=mysqli_connect_error() || !$conn){
          File_put_contents(ini_get('error_log'),"\n".SU." > $bd/$sql; pas de connexion sql : ".$n."-".str_replace("\n",'',print_r($a,1)),FILE_APPEND);
          Db(SU." > $bd/$sql; pas de connexion sql : ".$n."\n".print_r($a,1));
          return;
        }
      $n=mysqli_error($conn);
    }
    if($n)Db('sqlerror '.$sql.' '.$n);#if(j10)fb("connect:$a[0],$a[1],$a[2]");
		if(!$conn)DB("!sqlcon:$a[0],$a[1],$a[2]");
		if(!$conn || ($n && !stripos('uplicate',$n))){
			av("nc:bd:$bd/$sql; $n");rcache();$host=$bdsel='dead';Db(SU." 503>nc:bd:$bd/$sql; $n ");R503("nc:$bd/$sql; $n ".pre($a));Return;
		}
    mysqli_select_db($conn,$bd);e(",sqlon:$bd");
	}
  #e(','.$sql);;
  $_ENV['sql'][]=$sql;
  #bug:possible bug if semicolon within some field..
  if(substr_count($sql,'¤')>0 && $safe)$x=mysqli_multi_query($conn,str_replace('¤',';',$sql));
  elseif(substr_count($sql,'¤')>0){db('unsafe injection : ¤');r404('¤');}
  else $x=mysqli_query($conn,$sql);
  $_ENV['sqlquery']=$x;
  
  $_GET['nSQL']++;$n=mysqli_error($conn);#todo:add pdo, mysqli, mysqlnd
  if($n){
    $_ENV['errors'][]=$n;
    if(j10)FB($_ENV['args']);
    if(Preg_match("~server has gone away|access denied~i",$n)){rcache();$status='dead';R503($n);return;return sql($sql,$bd);}
    elseif($n and !strpos($n,"uplicate entry"))db("$sql; $n $_SERVER[SCRIPT_FILENAME] ".SU);
    elseif($n){$_ENV['error'].="sqlfail:$_SERVER[SCRIPT_FILENAME] : $sql $n";db($_ENV['error'],null,'sql');Return;}#une erreur mais ...
  }
  if(Preg_match("~(update|delete) ~i",$sql))$x=Mysqli_affected_rows($conn);
  if(Preg_match("~insert ~i",$sql))$x=Mysqli_insert_id($conn);
#ahah on nettoye les congestions
	$Temps=GT('sql:'.$_GET['nSQL'].':'.$sql);//Récupère la valeur du chrono
  If($Temps>4000 and !preg_match("~OPTIMIZE|CSF|ALTER~i",$sql)&&0){#stopped
        $x2=mysql_query("SHOW PROCESSLIST");while($t=@mysqli_fetch_assoc($x2)){
			$killed[]=$t;
			if($t["Time"]>30){mysql_query("kill $t[Id]");$Temps.="+kill $t[Id]";db("kill $Temps >$sql via $_SERVER[SCRIPT_FILENAME]".SU);}
		}
		if($killed)Bmail('sql killed',pre($killed));
  }
  #if(!Preg_match("~select ~i",$sql))av($sql."<li>".$x);
  Return $x;
  #mysqli_free_result($x);//else echo mysql_error().$SQL;
}

function sql2lite(&$sql){
    if(preg_match("~rlike~i",$sql))$sql=preg_replace("~ ([^ ]+) rlike ?'([^ ]+)'~is"," \$1 glob('\$2')",$sql);#glob
    if(strpos($sql,"`"))$sql=str_replace("`","'",$sql);return $sql;#glob
}
#$x=sqli3('adm/local.s3db.version3','select * from articles');av($x);
function sqli3($sql,$table){#av($sql,$table);
  if(!class_exists('SQLite3')){DB("noexists:SQLite3",'err');return;}
  $db=new SQLite3($table);if(!$db){DB("sqlite3err:".$db->lastErrorMsg(),'err');return;}
  sql2lite($sql);$t=$db->query($sql);
    if(substr($sql,0,6)!='select')$x=$db->changes();#$db ??
    else While($r=$t->fetchArray(SQLITE3_ASSOC))$x[]=$r;
  $db->close();
  if(count($x)==1 && count($x[0])==1)$x=end($x[0]);#unique résultat
  #elseif(count($x)==1)$x=$x[0];#ou dépile une matrice unique
  return $x;
}

function sqlite($sql,$db,$close=''){static $cur;#Essaye la version 2 d'abord ..kill($db);
  if(!function_exists('sqlite_open')&&!class_exists('SQLite3')){DB("noexists:sqlite2&3",'err');return;}
  if($_ENV['c']['defdb'])$k[]=$_ENV['c']['defdb'].'.';if($db)$k[]=$db.'.';
  if($k)foreach($k as $v)if(strpos($sql,$v))$sql=str_replace($v,'',$sql);
      return sqli3($sql,$db);
  if(!function_exists('sqlite_open')){DB("noexists:sqlite2",'err');return;}

  #if(strpos($sql,'.'))$sql=str_replace('.',"\.",$sql);


    if(!$cur[$db]){$cur[$db]=sqlite_open($db);$_ENV['db'].="open $db;";}
  #if(strpos($sql,'elete'))pat($sql,$db);
  $x=sqlite_query($sql,$cur[$db]);#pat($sql);

  $y=error_get_last();if(strpos($y['message'],'sqlite_query'))db($sql,'err');#av($sql);
  if($y=sqlite_last_error($cur[$db])){$x=sqlite_error_string($y).':'.$sql;db($x,'err');av($x);}

  if(substr($sql,0,6)!='select')$x=sqlite_changes($cur[$db]);
  else{
    $x=sqlite_fetch_all($x,SQLITE_ASSOC);
    if(count($x)==1 && count($x[0])==1)$x=end($x[0]);#un unique résultat
    elseif(count($x)==1)$x=$x[0];#matrice unique
  }
  if($close){sqlite_close($cur[$db]);unset($cur[$db]);}

  return $x;
}

function Bmail($subject,$msg='',$mail=ADMINEMAIL,$headers=0,$de=SENDEREMAIL1,$smtp='',$verif=1,$delay=1){#Db($mail);
  $mail=trim($mail);
  if(strpos($mail,'a74.fr'))$mail='admin@x24.fr';
  if(is_array($subject))extract($subject);
  if(!$as)$as=$de;
  if(!$msg){$x=['!msg',$_ENV];unset($x[1]['c']);$msg="<pre>".print_r($x,1)."</pre>";}
  if(preg_match('#identifiant#',$msg)||$mail==ADMINEMAIL||$mail==SENDEREMAIL1)$delay=0;
  $keep=Array($subject,$msg,$mail,$headers,$de,$smtp,0,1);#avant toute modification de l'envoi d'email
   
  list($user,$dom)=explode('@',$mail);
#if($GLOBALS['cons2mail']&&Array_key_exists($user,$GLOBALS['cons2mail'])){$user=$cons2mail[$user];$mail=$user.'@'.$dom;}#aliases efeco
  
  $s="\r\n";#séparateur et cela merde avec l'usage du smtp externe : BareLF found par envoi smtp 1&1
  if(Preg_Match("~@((free|libertysurf)\.fr|blue(mail|win)\.ch|aliceadsl)~is",$mail)){$s="\n";$smtp=0;}  
  $subject=Accents($subject);
  if($verif&&!ismail($mail)){$subject="mail error:$subject";$msg="bmail(error) to $mail".$msg;$mail=SENDEREMAIL1;}
  $msg.="<style>*{font:12px 'Trebuchet MS'}img{border:0px;}p{margin-left:20px;}</style>";
  
  if(!$headers)$headers="MIME-Version: 1.0{$s}Content-type: text/html; charset=iso-8859-1{$s}";#X-Priority:1\nFrom:$de{$s}Return-Path:$de{$s}Reply-To:$de{$s}
  
  if(strpos($de,'a74.fr'))$smtp='a74';
  if($smtp){
    if(strpos($smtp,','))null;elseif($_ENV['c']['smtp'][$smtp])$smtp=$_ENV['c']['smtp'][$smtp];
    list($a,$b,$c,$d,$host,$e)=explode(',',$smtp);if($as)$as.="<$as>";else $as=$c;
    $talk=SmtpMail($a,$b,$c,$d,$as,$mail,$subject,$msg,H,($headers)?1:0,$as);
    #[250 Requested mail action okay, completed] => send [250 OK] 
    if($talk['250 OK']=='quit')return 1;return 0;
  }

  if($delay){
    $f=TMP.'logs/emailsent.db';$x=FGC($f);
    if($y=$x[date('H')])if($y['fmt']<NOW-3600)$y['nb']=0;#si le registre de l'heure en cours date d'hier ( rotation )
    $y['nb']++;$y['fmt']=NOW;#Si plus de 40 emails envoyés au courant de l'heure précédente
    if($y['nb']>40){FAP('/L3/db/delayedmails.db',$mail.NOW,$keep);return;}#si plus de 40 mails envoyés dans l'heure précédente
    $x[date('H')]=$y;FPC($f,$x);
  }
  if(preg_match("~Internet Kassiopea~i",$msg))FAP(TMP.'logs/email-ref.db',$mail);
	$PHP_SELF='mail';
	return wmail($mail,Accents($subject),$msg,$headers);#Date: 19/12/2009 23:59:59\n
}

function SmtpMail($SmtpServer,$portsmtp=25,$SmtpUser='',$SmtpPass='',$from='',$to='',$sub='',$body='',$host=H,$html=0){
  if($SmtpServer=='a74')$SmtpServer='a74.fr';#correction
if(is_array($SmtpServer))extract($SmtpServer);
  $lf="\r\n";if(!$from)$from=$SmtpUser;#tout d'un block
  if(strpos($from,'@gmail.com')){return Gmail($SmtpServer,$portsmtp=25,$SmtpUser,$SmtpPass,$from,$to,$sub,$body,$host=h);}
  $body=str_replace("\n","<br>",$body);#$body=str_replace("\n","\r\n",$body);
  if($html)$body=$lf.'MIME-Version: 1.0'.$lf.'Content-type: text/html; charset=iso-8859-1'.$lf.$lf.$body;
  else $body=$lf.$lf.$body;
 
 try{
    if($x=fsockopen($SmtpServer,$portsmtp)){
      $data=["EHLO ".$host,'auth login',base64_encode($SmtpUser),base64_encode($SmtpPass),"MAIL FROM: <$SmtpUser>","RCPT TO: $to","DATA"];  foreach($data as $z){fputs($x,$z.$lf);$talk[trim(fgets($x,1024))]=$z.'_'.time();}
      fputs($x,"To: ".$to.$lf."From: ".$from.$lf."Subject:".$sub.$body.$lf.'.'.$lf);$talk[trim(fgets($x,256))]='send';
      fputs($x,"QUIT".$lf);$talk[trim(fgets($x,256))]='quit';fclose($x);
      return $talk;
    }
  }catch(Exception $e){
    return wmail($to,Accents($sub),$e->getMessage().$body);#Date: 19/12/2009 23:59:59\n
  }#
}

function Gmail($SmtpServer,$portsmtp=25,$SmtpUser='',$SmtpPass='',$from='',$to='',$sub='',$body='',$host=H,$html=1){//kill($this->SmtpServer);
#GMAIL:can't spoof current sender
  if(is_array($SmtpServer))extract($SmtpServer);
  $i=0;$lf="\r\n";if(!$from)$from=$SmtpUser;$body=str_replace("\n","<br>",$body);
  if($html)$body='MIME-Version: 1.0'.$lf.'Content-type: text/html; charset=iso-8859-1'.$lf.$lf.$body;
  #if($x=fsockopen($SmtpServer,$portsmtp,$e1,$e2,15)){
  if($x=stream_socket_client($SmtpServer.':'.$portsmtp,$e1,$e2,10)){
      $z="EHLO ".$host;fputs($x,$z.$lf);$talk[$z]=fgets($x,1024);
      while($i<15 && $y=fgets($x,1024)){$i++;$talk[time().'_'.$i]=$y;if(stripos($y,'SMTPUTF8'))$i=16;}
        $data=['AUTH LOGIN',base64_encode($SmtpUser),base64_encode($SmtpPass),"MAIL FROM: <$from>","RCPT TO: <$to>","DATA"];
      foreach($data as $z){fputs($x,$z.$lf);$talk[$z.'_'.time()]=fgets($x,1024);}
      fputs($x,"Subject: ".$sub.$lf."Date: ".date(DATE_RFC2822).$lf."To: ".$to.$lf."From: ".$from.$lf.$body.$lf);
      $z='.';fputs($x,$z.$lf);$talk[$z.'_'.time()]=fgets($x,1024);
      $z='QUIT';fputs($x,$z.$lf);$talk[$z.'_'.time()]=fgets($x,1024);
      fclose($x);
    }
    return $talk;
    #$talk=array_map('trim',$talk);return compact('talk','x','e1','e2');#
}
function xmail($mail,$suj,$msg,$d=0,$h=0,$smtp=''){
  if(!$mail)$mail=adminemail;if(!$suj)$suj='debug';if(!$d)$d=senderemail1;
  if(strpos($mail,','))$m=explode(',',$mail);else $m[0]=$mail;#Si plusieurs mails..
  Foreach($m as $mail)Bmail($suj,$msg,$mail,$h,$d,$smtp);
}

function G($k='undefined',$v=1){$_ENV['dbe'][$k]=$v;}
function G2($k,$v=''){if(is_Array($v))$v=implode(',',$v);elseif(!$v)$v=GT();$_ENV['dbe']['db'].="$k:$v ";}

function iframe($x,$y,$z,$s="'"){$y.='px';$z.='px';echo"<iframe allowtransparency=true frameborder=0 scrolling=no src='$x' style='width:$y;height:$z;border:0px;$s></iframe>";}
function IsMail($mail,$ck=0){if($_ENV['nomailcheck']||e('nomailcheck',1)||$mail==ADMINEMAIL||strpos($mail,'@a74.fr'))return 1;
    $mail=strtolower(trim($mail));
    if(!$mail OR !preg_match('~^[[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-_.]?[[:alnum:]])*\.([a-z]{2,4})$~',$mail)){G2('mail0');Return;}
    if(preg_match("~votreemail|@machin|dldl@|votrenom|@mail.com|@example.com|bob@|xxx@|sss@|aaa@|essai@|monnom@|qfq@|azerty|qwerty|@toto.com|@htm.com|test@|dudul@|sdf@|@lkj|@abc|@sdf|@hhh|@yan|fgfs@|@ff.|@1ERE.fr|@truc|gouv@~",$mail,$t)){G2('mail1',$t);Return;}
    list($user,$dm)=explode("@",$mail);
    if(strlen($mail)<9 or strlen($dm)<6 or strlen($user)<3 or is_numeric($user)){G2('mail2');Return;}
    if(Preg_match("~\\|'|\.(html|php)~i",$mail,$t)){G2('mail3',$t);Return;}#christian.frossard@free.fr
    if(Preg_Match("~[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}~",$mail)){G2('mail4');Return;}###
    if($ck){$x=@checkdnsrr($dm,"MX");if(!$x){G2('mail5');Return;}}
    if(strpos($mail,'@')>1)return 1;
    $badmail="~@(truc|mail|example|machin|toto|htm|lkj|abc|sdf|hhh|yan).\.(com|fr|info)|WHACK,|(xxx|bob|sss|aaa|essai|monnom|qfq|dldl|test|dudul|sdf|fgfs|gouv)@|@\.|@@|mailer|gpm.neuf.ld|postmaster|fre.fr|neu.fr|@phx.gbl|kundenserver|portail-patri|cgp-inve|votrenom|azerty|qwerty|@ff.|@1ERE.fr~i";
    if(Preg_match($badmail,$mail)OR strlen($mail)>44 OR strlen($mail)<9 OR !Preg_Match("~@(.*)\.~",$mail)OR Preg_Match("~.*@.*@|&|;| ~",$mail))Return;Return $mail;
}

function sups($x){return strtolower(stripslashes(str_replace(Array("\\\'","\\'","\'","\"","\\","'",'"'),'',$x)));}#
function noscript(){echo"<noscript><style>.nojs{font:bold 22px Verdana;color:#D00;}</style><a class=nojs target=js href='http://www.google.com/adsense/support/bin/answer.py?hl=fr&answer=12654'>/!\\ Activez Javascript ou employez un autre navigateur afin d'accéder au site /!\\</a><br></noscript>";}#form{display:none;}


function ArrayCleaner($Data){
  $Data=array_filter($Data);#$Data=array_map("strtolower",$Data);
  FOREACH($Data as $k=>$v){if(is_array($v)){$Out[$k]=$v;continue;}
    if(substr($v,5)=='votre' OR substr($v,-1)=='*')Continue;
    if(preg_match("~DNAT|DNAT2~",$k))$v=str_replace(array("."," ","//"),"/",$v);
    if($v)$Out[$k]=trim(htmlentities(strtolower(str_replace(array("\n","\\\"","\\'","'","\\")," ",$v))));// Let's Have Fun with Array,Slashes,Whip,Cream
  }return $Out;
}


function PregExtUrl($x){return preg_replace("~http://(?!(www\.)?(franceecolife.fr|mydevisonline.com))[^/]+/~is",'#',$x);}#good:si les urls ne respectent pas ces hosts, mettre en commentaire

function Valide($x='refhost'){#£todo:fonction globale de validation
  switch($x){
    case'refhost':
if(j9||!RH||IP==RH||BOTS)return;
if(Preg_Match("~\.(tr|pl|cn|ua|ru|m|tu)~",refe.rh))return;#banned countries
if(Preg_Match("~browser|checkparams|crawler|ava/|search\.|peoplebot|dnsdelve~is",ua)||Preg_Match("~ahrefs|static\.|reverse\.|softlayerbroadband|\.kyivstar\.net|smileweb\.com\.ua|msnbot|search\.msn\.com|googlebot\.com|\.nic\.fr|buyurl|hosted-by|inaddr|proxy|steephost|super-go|seznam|\.ovh\.net|ignorelist|hosteur|\.(tr|pl|cn|ua|ru|m|tu)$~is",rh))return;
if(Preg_Match("~prostitutki|credit_express\.php|checkparams~i",refe))return;
  }
  return 1;
}

function b404(){return PC404();}function PagesContenus404($f=''){return PC404($f);}

function RGX($file,$xp=''){GT('l'.__LINE__);
  $c=FGC($file);if(fmkt($file)>now-600000)Return $c;
  $c=stripcont($c,$xp);FPC($file,$c);GT('l'.__LINE__);Return $c;
}
function stripcont($x,$xp=''){GT('l'.__LINE__);
    if(!$xp)$xp=CONTBANNED;
    if(preg_match("~$xp~i",$x))$x=Preg_Replace("~$xp~is",'',$x);GT('l'.__LINE__);Return $x;
    #$x=explode('|',$xp);foreach($x as $v){sql('update portail.zpages2 set contenu=replace(contenu,'$v','');}#
}
function utf2a($x){
  $enc=mb_detect_encoding($x,'UTF-8,ISO-8859-1,windows-1252');e(','.$enc);#détecte d'autres encryptions :)
  if($enc=='UTF-8'){$x=str_replace("â€™","'",$x);$x=utf8_decode($x);if(substr($x,0,1)=='?')$x=substr($x,1);return $x;}#substr(,1)
  return $x;
}

function CacheInit($N=0){
static $t;timelong('cache');
  IF($_POST||e('nocache,toolong,badurl',1)||isset($_COOKIE['nocache'])or!isgoodurl(SU)||preg_match('#administrator#',U))Return;#$apc=1;#IF(ereg('!R22',u))@unlink(cachepath);
  if(headers_sent($f,$line)){e(',headersent:'.$f.'/'.$line);Db("headers!$f,$line");}#-algo de compression non reconnu car ligne 1063 #AV('cacheinti',$_POST,'nocache:'.e(',nocache',1),'headersent:'.e(',headersent',1),$_COOKIE['nocache'],'goodurl:'.isgoodurl(SU));
  if(!defined('REWRITE') && ($t && RS==404))R404();
  #Si la page doit ordinairement retourner une erreur 404 -- problème de certains rewritings sur erreur 404 --- Db("cache404".SU);-la génération de l'erreur 404 est passée par qqch[QUERY_STRING] => x=404
  if($t&&ob_get_length()==0)return;#appel de trop
  #if(ereg("go=",q)){ob_end_clean();$u=str_replace('?go=1','',SU);@unlink(cachepath);R301($u,3);}
  #$apc=1;gt('apc1');if(apc_exists($a))$apc=1;gt('apc2');
    $a=str_replace(TMP.'cache/','',CACHEPATH);
    if($apc && bots){GT('apcgetcache-bots');kill(APCG($a));}#ram
    if($apc && isgoodurl()){Gt('apcread-start');$_ENV['cacheread']=1;$x=APCG($a);Gt('apcread-get');echo $x;kill("<!--readapccache:$_ENV[lasttime]ms-->");}
  #str_replace(TMP,SHM,CACHEPATH),
  $path=Array(CACHEPATH);Array_unique($path);#Mem en préférence
  Foreach($path as $cachepath){
    if($_ENV['yt']['erasecache']&&H=='anciensinterneslyon.fr'&&!J9){e(',erasecache');@unlink($cachepath);continue;}
    if(is_file(DR.'.lastmod.db') && is_file($cachepath))
      if(filemtime(DR.'.lastmod.db')>filectime($cachepath))unlink($cachepath);#pour le joomla#cma-lib-joo-datab-datab-mysqli:391
    if(is_file($cachepath)){
      r304($cachepath);
      $fs=Filesize($cachepath);
      if(bots||(isgoodurl()&&$fs>100 &&(filemtime($cachepath)>$_ENV['expires']))){
        $_ENV['cacheread']=1;e(',cacheread,die,noperf,'.$cachepath.',cachesize:'.$fs);Gt('cachepath:read:0');#ob_end_clean();
        #if(H=='anciensinternesdelyon.fr'){$x=utf2a(file_get_contents($cachepath));echo $x;}else{
        readfile($cachepath);#78,18,25	$x=FGC($cachepath);echo$x);
        Gt("cachepath:read:1:size:$fs");header('A: cacheread:'.$_ENV['lasttime'],1);die;
      }
    }
  }#ob_end_clean(); was taking the more time
#écriture
  $cachepath=Re($_ENV['c']['htmlcache'][0],CACHEPATH);#html local override
  #e(',t:'.$t.','.$cachepath);
  #unlink $path=Array(str_replace(TMP,SHM,CACHEPATH),CACHEPATH);A
  IF($t){GT('cache:write');$page=ob_get_contents();
    #GT('flush:0');ob_flush();gt('flush:1');
  #ob_get_flush,ob_get_clean
    $exp=NOW+$_ENV['lasttime']*$_ENV['c']['cachetime'];
    e('die,noperf,cachesize:'.strlen($page).','.$_ENV['lasttime'].','.Date('Y-m-d H',$exp));

    if($_ENV['c']['htmlcache'][0]){Av($_ENV['c']['htmlcache']);#manuellement déterminé
      Foreach($path as $v)@unlink($v);#unlink tous fichiers de cache antérieurs
      $page=$_ENV['c']['htmlcache'][1].$page.$_ENV['c']['htmlcache'][2].'<?kill();?>';#Ya
    }

      if($_ENV['lasttime']>0.3 || strlen($page)>50000){#
        #$cachepath=str_replace(TMP,SHM,$cachepath);e(',shm');
        if($apc){$apc=2;APCP($a,$page);gt('apc-write');}
      }
    if($apc!=2){
      FPC($cachepath,$page);Touch($cachepath,$exp);r304($exp);
    }#if(GT()>500)Dbt();chown($cachepath,'www-data');
    #uniquement si owner = the same :)
    #if(h=='anciensinternesdelyon.fr')av(cachepath,$exp);
    #Gt('echo page');echo $page;Gt('echo page-done');
    header('Acachegen: '.$_ENV['lasttime']);die;
  }
  if(!$t){$t=1;if(!$_ENV['expires'])$_ENV['expires']=now;GT('cache:init');}#sinon initialisation du cache
}

#if(function_exists('sql'))DBhits(SU);
function bf5($dir='.',$se='*'){#shell to print by time & sort
  $s="find $dir -type f -iname '$se' -printf '%T@§%h/§%f\n'|sort -r -n";$x=explode("\n",shell_exec($s));
  foreach($x as $k=>$v){$x[$k]=explode('§',$v);}return $x;
}
function uaccent($mot){return strtr(strtolower($mot),"àáâãäåØòóôõöøèéêëçìíîïùúûüÿñ","aaaaaaOooooooeeeeciiiiuuuuyn");}
function stt($x){return strtolower(trim($x));}

function form($input,$a='',$m='post'){foreach($input as $k)$z.="<input name=$k>";return "<form style='display:inline' action='$a' method='$m'>$z<input type=submit></form>";}
Function dv($y=2,$x){echo"onkeyup=\"VF(this,'$y')\" value='$x' onfocus=\"if(this.value=='$x')this.value='';\" onblur=\"if(this.value=='')this.value='$x';\"";}

function ToNum($x){return ereg_replace("[^[:digit:]]",'',$x);}
function Rj($v){kill("location.href='$v';");}#
function R503($x=''){if(j9)kill('503:'.$x);Header('Status: 503 Service Temporarily Unavailable',1,503);header('Retry-After:400');kill("503 Server Busy - Veuillez Reactualiser dans 3 sec .. merci :)<script>setTimeout('location.reload(true)',3000);</script>");}
function lw($x){return strtolower(ytrim($x));}
function ytrim($x){$x=preg_replace('@ {2,}@is',' ',$x);return trim($x,'.,;[](){}/\ ');}
function incfile(){
  $x=get_included_files();
  Foreach($x as $k=>$v){if(Preg_match("~append|variable|auto|fun|2lib|ggtracker|footer|header|!0~",$v))unset($x[$k]);}
  return $x;
}

function ToLetters(&$x){$x=Preg_replace('~[[:digit:]]~','',$x);return $x;}
function ToNumber(&$x){$x=Preg_replace("~[^[:digit:]]~",'',$x);return $x;}
function ToNumber2($str){$str=str_replace(",",".",$str);$str=MrPropre($str,1);$str=str_replace("-","",$str);return $str;}
function ToNumber3(&$t,$keys=[]){foreach($keys as $k=>$v){$t[$v]=ToNumber2($t[$v]);}return $t;}

function sql1($sql){$x=mysql_query($sql);$n=mysql_error();if($n)echo"<li>".htmlentities("$n : $sql");return $x;}# and !strpos($n,'uplicate entry')
function sql2($sql,$bd=''){$t=sql3($sql,$bd);if(count($t)==1){return $t[0];}return $t;}
function sql3($sql,$bd=''){$x=sql($sql,$bd);if(is_numeric($x))return $x;while($t[]=@mysqli_fetch_assoc($x))null;$t=array_filter($t);return $t;}
function sql4($sql,$bd=''){$x=sql($sql,$bd);$Z=null;while($t=mysqli_fetch_assoc($x)){$id=$t['id'];unset($t['id']);$Z[$id]=$t;}if(!$Z)return null;$Z=array_filter($Z);return $Z;}
function sql5($sql,$p='',$nt=''){
  static $i,$Acache;$i++;
  if(is_array($sql))extract($sql);#
  if(isset($Acache[md5($sql)]))return $Acache[md5($sql)];
  #if(j9&&strpos(u,'607b'))av('DB:'.DB);
	if($p==1 or $nt==1){$close=1;unset($p,$nt);}
	if(strpos($sql,'.s3db')){
		Preg_match('~[^ ]+\.s3db\.~i',$sql,$m);$p=trim($m[0],'.');
		$sql=str_replace($m[0],'',$sql);
	}
	if(strpos($p,'.s3db'))return sqlite($sql,$p,$close);
	#no=1,bd=ben,pile=id,np=0
  if($p){if($y=param($p))extract($y);}
  gt('0:sql5'.$i.__line__);
  $_ENV['sql'][]=$sql;

  $x=sql($sql,$bd,$p);
  gt('1:sql5'.$i.__line__);
  if(is_numeric($x))Return $x;
  if(!$x)return;#retour de Num_rows quand update

  $nr=mysqli_num_rows($_ENV['sqlquery']);if($nr<1)Return;#Si resultat vide#Seulement sur un select
  #$if($len>30000000)
  $mem=memory_get_usage();if($mem>30000000){$len=array_sum(mysqli_fetch_lengths($x));DBM('debugmem',"sql:$sql, len:$len, mem:$mem");}
  gt('0:sql5while'.$i.__line__);
  while($t=mysqli_fetch_assoc($x)){#Memleak Here ///
    #@mysql_volume_kilobytes:sizeof($R)>90.000.000 ????
    #if($mem>40000000)DBM('debugmem',$sql.pre($t).$mem);
    If($nc){$R[]=$t;continue;}#2dim Array for 1D Array, no collapse, original form switch
    if($nr==1 && $np){$R=$t;break;}#Single Array for Result
    if($pile){$id=$t[$pile];unset($t[$pile]);$R[$id]=$t;continue;}//Replaces the key with some value(id)
    if($nr==1 && count($t)==1 && !$no){$R=end($t);break;}#1single results return a string
    if($nr==1 && !$no){$R=$t;break;}#1 column returns 1 dimension Array
    if(count($t)==1 AND !$no){$R[]=end($t);Continue;}#2dim-1single value//Un seul élément => Dépilé !
    $R[]=$t;//todo:MemError allocation here
  }
  #if(j10){print_r(compact('R','t'));die;}
  
  if($_ENV['sqlcache'] || $cache)$Acache[md5($sql)]=$R;
  #if(strpos(U,'webcam.php')){print_r(compact('R','sql'));die;}
  
  gt('1:sql5while'.$i.__line__);#14ms dans le while
  mysqli_free_result($x);
  if(is_array($R))$R=array_filter($R);
  return $R;
  gt('1:sql5freeres'.$i.__line__);
}

function Tridecoder($mots){
  $mots=strtolower($mots);$x=preg_split("~Ð|Ä°|us\.mg|1rachat|i2b con|creditimmo\.o|dc10\.fr|sex66\.fr|#~",$mots);if($x[0])$mots=$x[0];
  $mots=preg_replace("~\.?(ch|be|it)\.?\$~",'',$mots);
  while(Preg_Match("~%~",$mots)AND $i<2){$mots=Urldecode($mots);$i++;}
  while(Preg_Match("~â|ã|±|€|©|ª~i",$mots)AND $n<3){$mots=utf8_decode($mots);$n++;}
    $a=Array('â‚¬','à¨','Ã©');$b=Array('€','è','é');$mots=str_ireplace($a,$b,$mots);
  #Foreach($a as $v)if(stripos($mots,$v))//3rd pass
  return ytrim($mots);
}

function APCG($k){if(!apc_exists($k))return;global $apc;$apc[$k]=Apc_fetch($k);
$apc['size'][$k]=count($apc[$k]);gt('apcg:'.$k);return $apc[$k];}
function APCP($k,$v,$s=''){if($s)$s=",$s modifs";Apc_store($k,$v);gt("apcP:$k $s");}
#global $apc;if(!$apc[$k]){$apc[$k]=$v;$apc['size'][$k]=count($apc[$k]);}


function trimc(&$x){#£good:trim data from cms ( copy-pasted )
  $x=str_ireplace(Array('&nbsp;','  ','"'),array(' ',' ',"'"),$x);
  $x=preg_replace(Array("~<(xml)>.*?<\/(xml)>~is","~<!-?-?\[endif\]-->~is","~<!--[^>]+>~is"),'',$x);#Trim comments & office CP
  $x=preg_replace("~<(p|div)>[ |\n|\r|\t|&nbsp;]+</(p|div)>~is",'<br />',$x);#"~<(xml)>.*?<\/(xml)>~is"
  #<br[^>]+> is assumed as default
  #"~^<(div|p)>|</(div|p)>$~is" Is standard for beginnings or ends
  #<br style='color: rgb(51, 51, 51); font-family: verdana, arial, sans-serif; line-height: 16px; ' />
  #$x=PregExtUrl($x);#$x=preg_replace("~Quelle Energie~is",'France Eco Life',$x);$x=str_replace('"',"'",$x);
  $x=trim($x," \n\r\t\0\x0B()");return $x;
}

function Sesserrors($i=''){$i=explode(',',$i);$i[]='form';$i[]='k';$i[]='p';
  if($_SESSION['infos'])Foreach($_SESSION['infos'] as $k=>$v){if(in_array($k,$i)or !trim($v))Continue;echo"\$x(\"$k\",'0',\"$v\",'0');";}
  if($_SESSION['errs'])Foreach($_SESSION['errs'] as $v){if(in_array($v,$i))Continue;echo"RedAlert(\"$v\");";}
}

function T4($x){return substr($x,0,4);}

Function Addurl(){return;if(!isgoodurl()||$_ENV['noindex']||strpos($_ENV['args'],'noindex')||ru)return;#En amont
  $y=sql("update url set hits=hits+1 where url=\"".SU."\"");
  if(!$y)sql("insert into url(url,header,up)values(\"".SU."\",200,'1999-05-18')");return;
}

function linkthis($x,$t='',$p=''){if($t)$t=" target='$t'";
  $in=array('~((?:https?|ftp)://\\S+)(\\s|\\z)~');#,'~([[:alnum:]]([-_.]?[[:alnum:]])*@[[:alnum:]]([-_.]?[[:alnum:]])*\.([a-z]{2,4}))~'
  $out=array($p.'<a href="$1"'.$t.'>$1</a>$2');#'<li><a href="mailto:$1">$1</a>'
  return preg_replace($in,$out,$x);
}

function CorrectMu($x){return Preg_replace('~(\.(info|com|org|ch|fr))/~',"\$1",$x);}#pour calcul depuis dc10-admin-3616.php

function gtd($x=''){gt();echo $x."<div class=gtd style='position:fixed;#position:absolute;bottom:0;right:0;color:#333;'>".round($_ENV['lasttime']*1000,1).'ms</div>';}#border:1px solid #AAA;background:#DDD;
function fb($x,$y=''){#$y='{"Type":"WARN"}'
  static $i;if(!$i)$i=0;
  if(J9){$i++;header("A$i$y: ".str_replace(["\n","\r","    "],['','',''],print_r($x,1)),1);}

return;
#{"Type":"LOG","File":" ... Test.php","Line":3}
    if(headers_sent())return;#symfony
	static $t,$inc;$inc++;if(!strpos(UA,'FirePHP/0.7')&&!J9)return;
	if(!$t){header('X-Wf-Protocol-1: http://meta.wildfirehq.org/Protocol/JsonStream/0.2');header('X-Wf-1-Plugin-1: http://meta.firephp.org/Wildfire/Plugin/FirePHP/Library-FirePHPCore/0.3');header('X-Wf-1-Structure-1: http://meta.firephp.org/Wildfire/Structure/FirePHP/FirebugConsole/0.1');$t=1;}#43|[{"Type":"LOG","File":"","Line":""},"else"]|
	#$x=str_replace(array('{','}','(',')','='),' ',$x);strp($x);#escapeJsonString($x);
	#$x=str_replace(array("\n","\t",' '),' ',$x);
	$j=jsonEnc($x);#if($j=='null')die($j.'<li>'.$x.pre(debug_backtrace()));
	$z="[".$y.",$j]";$len=strlen($z);
	header("X-Wf-1-1-1-$inc: $len|".$z."|");
	header("X-Wf-1-Index: $inc",1);#en mode replace
}

function apc($k,$v=null){
    $ram='/run/shm/apc/';
    if($v)$v=igbinary_serialize($v);
    if(function_exists('apc_store')){//php>5.4 no more apc..
        if($v && $k){apc_store($k,$v);return $v;}
        if(apc_exists($k))return igbinary_unserialize(apc_fetch($k));
        return;
    }
    //else igb->to $ram
    $k=$ram.str_replace('/','-',$k);
    if($v && $k){file_put_contents($k,$v,LOCK_EX);return $v;}
    if($k && is_file($k))return igbinary_unserialize(file_get_contents($k));
}

function ser($file,$contents=null,$mode=METHOD){
    if($contents){
        switch($mode){#igb is better because of disk autocache
            case'igb':$contents=igbinary_serialize($contents);break;
            case'apc':
                $contents=apc($file,$contents);#+persitence sur le disque au cas où =)=)
                break;
            case'ser':$contents=serialize($contents);break;
        }
        file_put_contents($file,$contents,LOCK_EX);return;
    }
    /*** lecture **/
    if($x=apc($file))return $x;
    if(!is_file($file))return array();
    $s=file_get_contents($file);

    if(stristr($s, '{' ) != false && stristr($s, '}' ) != false && stristr($s, ';' ) != false && stristr($s, ':' ) != false){
        return unserialize($s);
    }
    return igbinary_unserialize($s);
}

function accents(&$x,$filter='reg',$chars=''){
  static $ansi=null;
  if(!$ansi){
    $chr=[193=>'A',192=>'A',194=>'A',196=>'A',195=>'A',197=>'A',199=>'C',201=>'E',200=>'E',202=>'E',203=>'E',205=>'E',207=>'I',206=>'I',204=>'I',209=>'I',211=>'N',210=>'O',212=>'O',214=>'O',213=>'O',218=>'O',217=>'U',219=>'U',220=>'U',221=>'U',225=>'a',224=>'a',226=>'a',228=>'a',227=>'a',229=>'a',231=>'c',233=>'e',232=>'e',234=>'e',235=>'e',237=>'i',236=>'i',238=>'i',239=>'i',241=>'n',243=>'o',242=>'o',244=>'o',246=>'o',245=>'o',250=>'u',249=>'u',251=>'u',252=>'u',253=>'y',255=>'y'];
    foreach($chr as $k=>$v)$ansi[chr($k)]=$v;#apply upon ansi encoded strings
  }
  $base=$x;
  if($filter=='mail'){$x=strtr($x,'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ','a@aaaaceeeeiiiinooooouuuuyy');if($x==$base)$x=strtr(array_keys($ansi),array_values($ansi));return $x;}
  $x=strtr($x,'ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüýÿÑñ€','AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyyNnE');#utf8 encoded ...
  if($x==$base && !isUTF($x))$x=str_replace(array_keys($ansi),array_values($ansi),$x);
  if($chars)$x=strtr($x,"(){}[]$%@!?:,/\|+_'~*^¨°`´²§µ£=<>&;–%","                                   ");
  return $x;
}

function isUTF($x){
#if (strpos($x,chr(226))!==false)return 1;#â gâteau-- ordinary, used with € symbol
  if (strpos($x,chr(194))!==false)return 1;#Â
  if (strpos($x,chr(195))!==false)return 1;#Ã
}
function isAnsiWithAccents($x){
  if(isUTF($x))return;
  #$x=range(192,255);if chr between 192 && 255  #http://us2.php.net/manual/fr/function.utf8-encode.php*/
  $accents=[224,232,233,234,239,244,249];
  Foreach($accents as $v)if(strpos($x,chr($v))!==false)return 1;
}
function Ansi2UTF(&$x){if(isAnsiWithAccents($x))$x=utf8_encode($x);return $x;}
function UTF2Ansi(&$x){if(isUTF($x))$x=utf8_decode($x);return $x;}

function mysqlesc(&$x){#
  if(is_array($x))return array_map(__METHOD__,$x);
  if(!empty($x) && is_string($x))$x=str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'),$x);
  return $x;
}

function pretitle($n=0){/* Minimalistic Headers : Basic stylesheet & title for quick & dirty scripts */
  @ob_start();echo"<title>".preg_replace("~[^a-z0-9 ]~i",' ',U)."</title><link rel='icon' type='image/png' href='/favicon.png'><script src='/?js'></script><link href='/?css' rel='stylesheet'><link rel='stylesheet' type='text/css' href='//fonts.googleapis.com/css?family=Raleway'><pre id=pre><a href='/'>home</a>";
}

function mkdirs($file,$finalDir=''){/**creates recursive missing directories as copying, moving, creating some file**/
  $dirs=explode('/',$file);$filename=array_pop($dirs);$directories=$finalDir.implode('/',$dirs);
  if(is_dir($directories))return 1;
  foreach($dirs as $dir){$finalDir.=$dir.'/';if(!is_dir($finalDir))mkdir($finalDir);}
}

function out($x,$logFile=null){global $out;if(is_array($x))$x=json_encode($x);echo $x;$out.=$x;if($logFile)file_put_contents($logFile,$x,FILE_APPEND);}$out='';#real time dumping script to file, cumulates echo && logfile -- when you cant pipe a cron to a logfile, or need having separate logfiles, knowing exactly where you script is -- allows to kill it later ..

$unlinks=[];
function lockfile($f){global $unlinks;
  if(substr($f,0,1)!='/'){$cwd=getcwd();$f=$cwd.'/'.$f;}#from the script for reference
  if(is_file($f))kill("locked $f");touch($f);$unlinks[]=$f;
}

function Array2QS($a){#simple array only : todo : extends for multidimensionnal
  $qs='?';
  foreach($a as $k=>$v)$qs.="&$k=$v";
  return $qs;
}

function Qs2Array($qs=''){
  $params=[];$qs=trim(str_replace('?','&',$qs),'& ');$qs=explode('&',$qs);
  foreach($qs as $kw){if(!$kw)continue;list($k,$v)=explode('=',$kw);$params[$k]=$v;}
  return $params;
}

function Params2b64($params){
  amr('utf8_encode',$params);#if utf8 file, or utf8 string, don't have to encode i
  $params=json_encode($params);
  return base64_encode($params);
}

function b642Params($b64){return json_decode(base64_decode($b64),1);}









