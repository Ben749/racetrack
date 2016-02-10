<?Timelong('start');
#copyright 2016 - benjaminfontaine.fr - this shall never be sold or be part of a bundle, or either copied or stripped
if(strlen(NU)>250){Db('Url too long:'.NU,'err');e(',badurl,toolong');}

defin('AJAX',((!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')?1:0));

#on utiliser $_env comme superglobale
#ces variables peuvent être poussées depuis le .htaccess ou définies ici   ###  ex : SetEnv root "Y:/web/www/"
$pi=pathinfo(__FILE__);$rt=$pi['dirname'].'/';$x=explode('.',$a['ip']);
if(!$x[0])$x[0]='127';#racetrack's folder is the one where this file is located at !!

$x=Array($rt.'conf/'.$x[0].'.inc.php',$rt.'conf/'.H.'.inc.php');#',CWD.'0.inc.php',DR.'adm/0.inc.php'
Foreach($x as $v)if(is_file($v))require_once($v);#Custom configuration Overrides : 1:ip,2:domain,3:adm folder,4:CWD

e('server:'.$a['server'].',');#Flexible Kernel 

#en résultent l'extraction de ces variables
if(is_array($a['vars']))extract($a['vars']);
elseif($a['vars']){$x=param($a['vars']);extract($x);}#on extrait toutes ces variables sur le contexte global

#pat($x,$a);##function débug =)
#puis passage aux choses les plus sérieuses : définition des chemins d'accès
#défini {$k} avec la premiere valeur donnée valide : priorité au définition via setenv, puis variables extraites@3
#default or pre-defined constants
  $k='ROOT,R';defin($k,$a['root'],$root,'/z/');#racine absolue de travail
  $k='DB';defin($k,$a[$k],${$k},DR.'adm/3.s3db');#database or local sqlite db
  #if($a=='DB')av(func_get_args());#db,,s3db
  $k='RT';defin($k,$a[$k],${$k},R.'rt/lib/');#racetrack root for require_once .. functions
  #$k='edt';defin($k,$a[$k],${$k},R.'editor/');#editor/cms
  $k='tmp';defin($k,$a[$k],${$k},R.'tmp/');#fichiers temporaires & bases de données
   $k='shm';defin($k,$a[$k],${$k},TMP);#fichiers temporaires & bases de données
   $k='ipstore';defin($k,$a[$k],${$k},SHM.'ip/');#SHM peut être égal à TMP si on décide de ne pas utiliser la mémoire
   $k='logs';defin($k,$a[$k],${$k},TMP.'logs/');#fichiers de logs, debug
    $k='l2,dbp';defin($k,$a['l2'],$l2,TMP.'logs/');#logs level 2=debug
    $k='erlogs';defin($k,$a[$k],${$k},LOGS.'er.logs');#debug special avec bcp I/O

  $k='adminemail';defin($k,$a[$k],${$k},'ben@a74.fr');
  $k='senderemail1';defin($k,$a[$k],${$k},'admin@a74.fr');
  $k='homesite';defin($k,$a[$k],${$k},'x-x-x');

if(!isset($_ENV['c']['sql']))#si elles ne sont pas définies, alors on va tenter les valeurs du htaccess
  $_ENV['c']['sql'][$a['sqlhost']]=Array(Rem($a['sqlhost'],$sqlhost,'localhost'),Rem($a['sqluser'],$sqluser,'root'),def($a['sqlpass'],$sqlpass));

def($preload,Array(param($a['preload']),array('null.php'),'###fichiers'));#,'ksv1.php':ben devs
if($preload1)$preload=array_merge($preload1,$preload);
if($preload2)$preload=array_merge($preload,$preload2);
def($conf,Array(param($a['conf']),'###client'));#av(param($a['preload']),$preload,$a['preload']);
#Av(__LINE__,$a['preload'],'pre:'.$preload,'def:'.def($preload,Array(param($a['preload']),'fichiers')));
#csf as sqlite database
#Définitions - variables de base du framework - FIN DE LA CUSTOMISATION !!!!

setlocale(LC_ALL,'fr_FR');date_default_timezone_set('Europe/Berlin');#php.ini => date.timezone = "Europe/Whatever"
Rem($ndate,UcFirst(strftime("%A %d %B %Y %T")),date("Y m d H:i:s"));
#pat(PHP_OS,,strftime("%A %d %B %Y %T"));
#Vendredi 27 Septembre 2013 16:49:36
$D=Array('ndate'=>"<a id=ndate>".$ndate."</a>",'deblockurl'=>'!*%$%M',#url whitelister
'vit'=>LOGS.'Vitale.db','starter'=>$starter,'logs'=>$a['logs'],'tmp'=>$a['tmp'],'rt'=>$a['rt']);Foreach($D as $k=>$v)redef($k,$v,1);
  e(RU.H.U.$a['args']);
#note surl is obselete
$D=Array('bots'=>isbot(),'mu'=>mu(H.U),/*base:path for db files*/'u2'=>Preg_Replace("~(\?|&).*~",'',U),'ipf'=>IPSTORE.IP.".db",'fkeyword'=>TMP.'keyw/'.IP,'u3'=>BadQ(U));Foreach($D as $k=>$v)redef($k,$v,1);

$D=Array('hu3'=>H.'/'.U3,'hu4'=>'//'.H.'/'.U3,'seed'=>alpha2num(u2),'su2'=>SR.U2,'CACHEPATH'=>TMP.'cache/'.MU.'.ca');/**/Foreach($D as $k=>$v)redef($k,$v,1);
#$_ENV
$_ENV['c']['cachetime']=3600*100;#100h par seconde de calcul-1h pour 10ms
$D=Array('lasttime'=>0,'lastmemusage'=>0,'lastkey'=>0,'maxop'=>4000,'mu'=>MU,'script'=>$a['SCRIPT_FILENAME'],'Mem'=>Array(),'dbt'=>Array(),'yt'=>Array('host'=>RH,'ip'=>IP,'dlp'=>SU,'u'=>SU,'r'=>REFE,'ref'=>REFE));Foreach($D as $k=>$v)$_ENV[$k]=$v;

$pi=pathinfo(SU);$pi['extension']=extension(SU);
#pour la suite, extensions mauvaises etc..


#identification utilisateurs ou serveurs de prod;||in_Array(ip,array('46.14.5.130')

if(J10){#destroys cache
  if(is_file(CACHEPATH)){unlink(CACHEPATH);e(',j10,CACHEPATH');}
  if(is_file(str_replace(TMP,SHM,CACHEPATH))){unlink(str_replace(TMP,SHM,CACHEPATH));e(',j10,shmCACHEPATH');}
}

IF(in_array($a['USER'],array('www-data','ben','root')))redef('US','ben',1);#cron localhost
elseIF($ipsa[SIP])redef('US',$ipsa[SIP],1);

if($_GET['e']==404)$_ENV['status']=404;#£todo:404 redirigé depuis htaccess, mais constante RS=404 déjà définie ..

$cgp=$bck=TMP."block/".IP;redef('block',$bck);redef('elevation',elevation());

$banblock=BKW;$dr=DR;$u=U;$h=H;$ip=IP;$r=R.'A74/';$ips=SIP;
$r301=r3p(SU);redef('CR301',$r301,1);#not for cronjobs !! calcul du fichier théorique contenant la redirection 301


####peut tout overrider !!!!
$f=TMP."perf/".MU.".db";if(is_file($f)){#$_ENV['eval'].="\$preload=Array('autrechose.php');";  ###peut également modifier la variable preload=array('ce,que,je veux') !!!!
  $_ENV['mtime']['fmtpdata']=filemtime($f);$x=unserialize(file_get_contents($f));
  if($x['eval'])eval($x['eval']);if($x['vars'])extract($x['vars']);//todo:nettoyer l'evaluation de code pour éviter hacking par pré-chargement de fichiers..
  #notice:comportement individuel par fichier en inscrivant dedans : 
    #$_ENV['vars']=Array($_ENV=>Array('bob'=1),'racine'=>'autre');$_ENV['eval']="\$var=1;function bidon($x){return $x*2;}";
}

#Keep:$a['SCRIPT_FILENAME
#URI=http+host+url
#clenaup vars
$x=explode(',',"MIBDIRS,MYSQL_HOME,OPENSSL_CONF,PHP_PEAR_SYSCONF_DIR,PHPRC,CONTEXT_DOCUMENT_ROOT,TMP,SystemRoot,COMSPEC,PATHEXT,WINDIR,REMOTE_PORT,PHP_AUTH_USER,PHP_AUTH_PW,SERVER_ADDR,SERVER_ADMIN,SERVER_NAME,SERVER_PORT,SERVER_PROTOCOL,SERVER_SOFTWARE,AUTH_TYPE,GATEWAY_INTERFACE,HTTP_ACCEPT,HTTP_ACCEPT_ENCODING,HTTP_ACCEPT_LANGUAGE,HTTP_CACHE_CONTROL,HTTP_CONNECTION,HTTP_DNT,PATH,REMOTE_USER,QUERY_STRING,REDIRECT_STATUS,REMOTE_ADDR,REMOTE_HOST,DOCUMENT_ROOT,HTTP_HOST,HTTP_USER_AGENT,REQUEST_METHOD,REQUEST_TIME,HTTP_COOKIE,SERVER_SIGNATURE,argv,argc,preload,vars,HTTP_X_FIRELOGGER,HTTP_X_INSIGHT,SCRIPT_URI,SCRIPT_URL,rk17,ip,server,HTTP_REFERER");$x=Array_flip($x);$a=array_diff_key($a,$x);###
Foreach($a as $k=>$v){if(strpos($k,'EDIRECT_')){$a[str_replace('REDIRECT_','',$k)]=$v;unset($a[$k],$_SERVER[$v]);}if(!$v)unset($a[$k]);}


$D=$k=$v=$x=$root=$rt=$sqluser=$sqlpass=$sqlhost=$tmp=$logs=$a['rk17']=null;#REDIRECT_URL,on purge les variable non intéressantes

if(RQS && RQS!=Q){$x=explode('&',RQS);if($x){Foreach($x as $v){$z=explode('=',$v);$_GET[$z[0]]=$z[1];}}}#£good:Pousser les variables GET sur une page non trouvée (404) sans rqs

Timelong('preload');
if($preload)Foreach($preload as $file){
  if(is_file($file))Require_once $file;
  $file=__dir__.'/lib/'.$file;if(is_file($file))Require_once $file;
  Timelong('load:'.$file);
}
unset($preload,$file);

$_ENV['yt']=$yt=[];

if(in_array(H,['cron','cli']));
else{
#si les functions sont bien chargées
  if(function_exists('r301depart'))r301depart();#301 écrites sur le disque prioritaires
  if(function_exists('starter')){$_ENV['yt']=$yt=starter();timelong('starteron');}#attention uniquement si cron de suppression des vieux fichiers !!!
  if(function_exists('ggtracker'))ggtracker();
  if(function_exists('fap')&& strpos(' '.U.Q.RQS,'go=1')||$_GET['cc']){
    if(1){
      Fap(VIT,Array('cp'=>CACHEPATH,'sfn'=>$a['SCRIPT_FILENAME']));
      if(is_file(CR301))unlink(CR301);if(is_file(CACHEPATH))unlink(CACHEPATH);
    }
    Header("location:".str_replace(['?cc='.$_GET['cc'],'?go='.$_GET['go'],'&cc='.$_GET['cc'],'&go='.$_GET['go']],'',SU),1,301);kill();
  }
  if(isset($obstart)){ob_start();timelong('obstart');}#had a ob get_level-if(ob_get_level()&&j10)die(''.ob_get_level());
  if(isset($session) && !$nosession && !session_id()){
    $_ENV['ss'][]=__FILE__.__LINE__;
    session_start();timelong('session');
  }
}
#1:fun,2:starter,3:ggtracker
if(H!='cron' && $cacheinit && function_exists('CacheInit'))CacheInit();
###s'assurer que les fonctions sont bien chargées ---ensuite préchargements dynamiques
if(H=='sex66.fr'&&preg_match("~\.(html)~i",U))Require_once RT."localcache.php";#git:rm|(\.php|html?)$

if(J10&&0){e(',nocache');#équivalent lead-dev => lecture pré-prod, ne jamais générer de cache sur le mode normal
	$f=str_replace(DR,DR.'!dev/',$_ENV['script']);#die($f);#mieux que basée sur une URL = rewriting = null
	if(strpos(CWD,DR)>-1){#si le DR est contenu dans le CWD
		if(is_file($f)){
			#si jamais CWD va devenir celui de destination de l'alias, si jamais ....
			$x=str_replace(DR,DR.'!dev/',CWD);chdir($x);#change the current working dir - pour changer les includes
			Require_once $f;kill();
		}
	}
}
#if(H=='sex66.fr'&&preg_match("#\.php#i",U));#Add to shutdown => une fonction : RT."localcache.php";#|(\.php|html?)$
####ou php, mais sans connaitre les variations de query string de ces dernières ????
#tous ces fichiers générés auront la même signature au début
#if(strpos())




#Ob_Start();cacheinit();gt('obstart');????




#if(j9){echo pre($x).pre($_ENV);echo $f.$zob;die;}

#### fonctions de base
#av(func_get_args());
function db3($x,$f=''){Rem($f,ERLOGS);$y=print_r(dbgt(),1);
  $y=Preg_replace("~\r|\n|\t| {2,}|\.{2,}~",' ',$y);$y=Preg_replace("~  \[|\] |=> /home/www/~",'',$y);
  FPC($f,$x.$y."\n",1);
}

function dbgt(){if(e(',dbgt',1))return;e(',dbgt');
	$y=debug_backtrace();$y=Array_Reverse($y);#unset($y[0]);krsort($y);
	foreach($y as $k=>$t){
		if(in_array($t['function'],Array('include','require','require_once','av','pat','dbgt'))){unset($y[$k]);continue;}
		$z[$k]=$t['file'].':'.$t['line']."\t".$t['function'];
		$z[$k].=gettype($t['args'])=='array'?implode(',',$t['args']):gettype($t['args']);#retourner un print_r nettoyé ?
	}
	return $z;
}
function dbkt(){#premiere ligne
  $y=debug_backtrace();#trop gros parfoisdbgt()
  while(count($y)>1){$x=array_pop($y);if($x['function']!='require_once'){$y[]=$x;Return $y;}}Return $y;
}
function av($x='',$y='',$a='',$b='',$c='',$d='',$e=''){if(!J9)return;pat($x,$y,$a,$b,$c,$d,$e);}
function pat(){
  $z=$_ENV['args'];e(',noperf,av');gt('pat');
  $a=func_get_args();$a=array_filter($a);if(!$a)kill('-a');
  $x=get_defined_constants(1);$a[]=dbgt();$a[]=$x['user'];e(',getdef');
  Foreach($a as $k=>$t){if(is_array($t))$z.="\n".print_r($t,1);else $z.="\n¤".$t;}
  $z=str_replace(Array("\t","\n",'"','%'),array(' ','\\n',"\\\"",'%25'),trim($z));#
  kill();
}
function DB2($lv=0){
  $i=0;static $err;if($err)return;$err=1;$x=dbgt();
  if($lv<0&&0);#$x=str_replace('/home/ovh/','',$x[0]['file'].'@'.$x[0]['line']);#the first origin line
  else{while($i<$lv){array_pop($x);$i++;}$x=print_r($x,1);}#if(j9)av($x);
$x=str_replace(Array("\n","\t",' ','Array(',')',l2.'debug.db','=>[file]=>/home/ovh/append.php[line]=>5[args]=>=>/home/ovh/auto.php[function]=>require_once=>','[function]','=>shutdown[args]=>','=>db2[args]=>'),'',$x);#gitrm
$x=Preg_replace("~\[[0-9]\]~",'',$x);
$x=str_replace(array('[line]=>','=>[file]','=>=>'),array('@','<br>','=>'),$x);Return $x;}

function r3p($x){if($x==='http:///')return;return substr(TMP."r301/".trim(str_replace(array('http://','www.','?go=1','/','Â§','%20',' '),'!',$x),'1§!'),0,150);}

function p3($x){$x=Preg_replace("~\s~is",' ',$x);$x=Preg_replace("~ {2,}~is",' ',$x);$x=trim(str_replace(explode(';',"Array ( );Array ( "),explode(';','a();a:('),$x));return $x;}
#fap(R.'debug.db','',$dbvalue);

function MemL($x='',$y=90){static $i;$i++;if(!$x)$x=$i;return Memuse($y,$x);}#$_SESSION[][$line]=$y.Memory_get_usage(1);
function MemLog($y=''){$x=dbkt();$line=p3(print_r($x,1));$_ENV['Memlog'][]=$line;}#$_SESSION[][$line]=$y.Memory_get_usage(1);
function Memuse($limit=65,$sup=''){if(e(',dead1',1))return;static $i;if(!$sup)$i++;$sup=$i;#if(j9){echo"+";return;}#dev
  #Timelong();no recursion#if(j9)kill("+$mem>$limit $_ENV[args]");#dev
  $mem=Round(Memory_get_usage(1)/1000000,2);if($mem==$_ENV['lastmemusage'])return;$_ENV['lastmemusage']=$mem;
  $db="Erreur : usage mémoire : $mem mo cause $sup";if($sup)$_ENV['Mem'][$sup]=$mem;
  if($mem>$limit){e(',dead1');dbm("MemLeak:$mem@$sup@".SU.pre($_ENV));$x=dbkt();$line=p3(print_r(end($x),1));db($line);Return $mem;kill($line);}Return $mem;}

function Timelong($array=0){
  static $start,$last,$i,$prevmemusage;if(e(',timerror,timeerror,dead1,av',1))Return;#recursive guard, car rappellé lors de Pre->GT->Timelong par exemple en gestion d'erreur
  $now=Round(microtime(1),4);#list($u,$s)=explode(' ',microtime());$now=bcadd($u,$s,4);
  if(!$start){$last=$start=$now;if($array)Return Array('d'=>0,'d2'=>0,'d3'=>0);return;}
  $r=round($now-$start,6);$r2=round($now-$last,5);$last=$now;
  /*.DB2(2)trigger error on, so not recursive - dernier temps complet de calcul puis en ms*/
  if($array==1)$r=Array('d'=>$r,'d2'=>$r2);elseif($array){$_ENV['Tdbt'][$array]+=$r2;$_ENV['dbt'][$array]=$r2;$_ENV['Adbt'][$array]=$r;}#au départ ..
  Return $r;#si n'est pas un array retourne le temps depuis la première execution
}
function e($x,$checkonly=0){$match=0;if($z=Param($checkonly,'&'))extract($z);Rem($k,'args');#y->return 1 check if value exists#if(j9){var_dump($arr);$_ENV['args'].=',exit';}#e(',exit')
  $arr=str2Array($x);Foreach($arr as $v){if(stripos($_ENV[$k],$v))$match++;elseif(!$checkonly)$_ENV[$k].=$v;}return $match;
}
function rep($x,$y,&$var){$var=preg_replace($x,$y,$var);return $var;}
function str2Array($x,$ad=',',$s=','){if(substr_count($x,$s)>1){$x=trim($x,$s);$a=explode($s,$x);Foreach($a as $v)if($v)$arr[]=$ad.$v;}else $arr[]=$x;return $arr;}
function GM($l=200,$s=''){return memuse($l,$s);}

function alpha2num($a='',$ext=-4,$max=14){Rem($a,h);$r=0;
  $a=preg_replace("~http://|www\.|/|\.(php|htm|html)~is",'',$a);
  if(strlen($a)>$max)$a=substr($a,0,$max);$l=strlen($a);
  for($i=0;$i<$l;$i++)$r+=ord($a[$i]);#for($i=0;$i<$l;$i++){$r+=pow(26,$i)*(ord($a[$l-$i-1])-0x40);}$r=abs($r-1);
  $max=strlen(intval($r));if($max>18)$r=substr($r,-19);return (int)$r;#19 derniers chiffres si exposant présent
}


#Ces fonctions sont primordiales à définir le CACHEPATH, déterminer si le document est différent ou non, nettoyer la base canonique ainsi que le titre d'une page - Racetrack greyhound really begins here !!!
function RQ($GP){if(Preg_Match("~[?|&](?!($GP))(([^=]+)=([^&]+))?~is",SU))R301(Preg_replace("~[?|&](?!($GP))(([^=]+)=([^&]+))?~is",'',SU));}#Redirects Anything not matching those parameters
function BadQ($x){Rem($GoodPatterns,$_ENV['GP'],'x|e|t|q|p|lt|aid|nb|v|letter|web|css|js|rss|gss');#Utilisées, donc acceptés par défaut
  $x=Preg_replace("~[?|&](([0-9]+|".badqueries.")(=[^&]+)?)~is",'',$x);$x=Preg_replace("~\?(.*)/$~i","?\\1",$x);#paramètres étranges ..
  if(!strpos($x,'=')&&$_ENV['soloQ']){$GoodPatterns.='|'.$_ENV['soloQ'];#et on les ajoute aux good patterns as well :)
    $x=Preg_replace("~\?(?!({$_ENV['soloQ']}))[^&]+~is",'',$x);#Si valeur attendues toutes declarées $_ENV['soloQ']="css|js";
  }
  Return trim(Preg_replace("~[?|&](?!($GoodPatterns))([^=]+)=([^&]+)~is",'',$x),'?& ');#Remove Bad things out of here
}
function mu($x,$y=0){$x=BadQ($x);#GT();#surl!=h.u
  $x=trim(str_replace(array("/",'http:--'),array("-",''),$x),' -');
  if($y)$x=preg_replace('~-~','',$x,1);return $x;
}

function elevation(){
  IF(j10)$x=5;elseIF(j9)$x=4;
  elseIF($_ENV['yt']['admlog'])$x=3;#whitelisted
  elseIF(Is_file(block.".whitelist"))$x=2;#whitelisted
  elseif(is_file(block)){
    if(j9||preg_match("~".deblockurl."~is",SU)){unlink(block);return 1;}
    if(ru){unlink(block);return 1;}#kill("Bloquage firewall - Merci de copier ce message et de l'envoyer par mail à votre administrateur (".adminemail.") :".ip."<br>".print_r(file_get_contents(block)).'<br>'.ru);
    if(is_file(BLOCK)){Fmt(BLOCK.'!!');Header('Status: 404 Not Found',1);die;}#block-404
    $x=0;#blocké
  }
  else $x=1;return $x;
}
function isBot(){static $x;if($x)return $x;$x=0;
  Timelong('1:isBot?');#if(is_file(block))$x=1;
if(Preg_Match("~^(64\.233\.1|66\.102\.(0-15)\.|66\.249\.(6-9)\.|72\.14\.(192-255)\.|74\.125\.|209\.85\.(128-255)\.|216\.239\.(32-63)\.)~",IP))$x=1;#ggbot
elseif(Preg_Match("~^(64\.4\.(0-63)\.|65\.52\.|131\.253\.(21-47)\.|157\.(54-60)\.|207\.46\.|207\.68\.(128-207)\.)~",IP))$x=1;#msnbot
elseif(Preg_Match("~^(8\.12\.144\.|66\.196\.(64-127)|66\.228\.(160-191)\.|67\.195\.|68\.142\.(192-255)\.|72\.30\.|74\.6\.|202\.160\.(176-191)\.|209\.191\.(64-127)\.)~",IP))$x=1;#yahoo  
  elseif(Preg_Match("~^(65\.5(2|5)\.|157\.(5[4-9]|60)\.|66\.249\.(6[4-9]|[7-8][0-9]|9[0-5])|207\.46\.|72\.30\.186|131\.253\.(2[1-9]|3\d|4[0-7])|64\.233\.|209\.85\.|72\.14\.|77\.88\.)~i",IP))$x=1;#le plus précis- most updated
  elseif(Preg_Match("~^(msnbot|google|ahrefs\.com)~i",RH))$x=1;#fin du remote host
  #elseIF(preg("~msnbot|sitema|bot|slurp|google|archive|amazona|crawl|yandex~",rh))$x=1;
  elseif(Preg_Match("~(ey|gg)-in-f|1e100|(search\.msn\.com|googlebot\.com|yandex\.com)|rate-limited-proxy|whois|ahrefsovh|yasni|ia_archiver|amazonaws|/bot|majestic|crawl|spider|security|chello|choopa|justquac|kimsufi|amazon|yandex|wowrack|yahoo|google|altus|msnbot|romtelec|weaz|server|client|ekk\.bg|googlebot~i",UA.$a['HTTP_FROM'].RH))$x=1;#beaucoup moins fiable
  Timelong('2:isBot?');return $x;
}
function fmt($f){
  $f2=fmkt($f);if($f2==2000000000)null;else $f2++;
  if(Touch($f,$f2))return $f2;else Db("touch:$f",null,'1');}
function fmkt($f){if(!is_file($f))Return;$f=filemtime($f);if($f==2000000000)null;elseif($f>1351137449)$f=1;return $f;}#si ce dernier est trop grand = timestamp réel, on le place à 1 puis on l'incrémente, les valeurs atime & ctime seront alors utilisées pour déterminer l'age du fichier :)
function dep(array $x){
  array_walk_recursive($x,'strtolower');
  $longest=0;$exploded=explode(',',json_encode($x,JSON_FORCE_OBJECT)."\n\n");
  foreach($exploded as $row)$longest=(substr_count($row, ':')>$longest)?substr_count($row, ':'):$longest;
  return $longest+1;
}

function param($x,$sep='&',$equals='=',$av=0){
    if(is_array($x))return $x;
    $re=array();
    if(!$x)return;if(!stripos($x,$equals))return;#if(!strpos($x,$s))return;
    $separators=Array($sep,',');
    Foreach($separators as $s){
    if(stripos($x,$s)){$x=trim($x,$s.' ');$x=explode($s,$x);Foreach($x as $v){
        $y=explode($equals,$v);
        Foreach($y as $k=>$v2){if($k==0)continue;if(!isset($re[$y[0]]))$re[$y[0]]=null;if($k>1)$re[$y[0]].=$equals;$re[$y[0]].=$y[$k];}#si plusieurs valeurs de =
      }return $re;
    }
    }
    if(stripos($x,$equals)){$s=$equals;$x=explode($equals,trim($x,$equals.' '));if(isset($re[$x[0]]))$re[$x[0]].=$x[1];else $re[$x[0]]=$x[1];}#1 seul & unique argument (failback)
    return $re;#if($av){echo "delim:".$s.print_r($re,1);}Return;#x=champ=cons,
}


function defin($a,$b=',',$c='',$d='',$e='',$f='',$g='',$h='',$i='',$j=''){
  if(strpos($a,','))$a=explode(',',$a);elseif(!is_array($a))$a=Array($a);#pat($a,$b,$c,$d);
  if(!is_array($b))$b=Array($b,$c,$d,$e,$f,$g,$h,$i,$j);
  $b=array_map('trim',$b);$b=array_filter($b);$b=array_shift($b);
  Foreach($a as $v)redef($v,$b,1);return $b;
    $a=re($a,$b,$c,$d,$e,$f,$g,$h,$i,$j);#newer:caution a is an array:multiple values passed
}
function def(&$var,$a='',$sep='§'){
  if(!$var)$var=Re($a,$sep);return $var;#obs
  if(!is_array($a)){if(strpos($a,$sep))$a=explode($sep,$a);else{$var=$a;return $var;}}$a=array_filter($a);$a=array_shift($a);$var=$a;return $var;
}
/*
function Rem(&$var,$a='',$b='',$c='',$d='',$e='',$f='',$g='',$h='',$i='',$j=''){
  if(!$var)$var=Re($a,$b,$c,$d,$e,$f,$g,$h,$i,$j);Return $var;
  if(!is_array($a))$a=Array($a,$b,$c,$d,$e,$f,$g,$h,$i,$j);#obs  #obs  #obs  
  $a=array_filter($a);$a=implode($a,'§');return def($var,$a);
}
*/
function Rem(&$var,$possibleValues=[]){
  $x=get_defined_vars();array_shift($x);
  if(is_array($possibleValues));
  elseif(count($x>1))$possibleValues=$x;##
  elseif(!is_array($possibleValues))$possibleValues=[$possibleValues];#singlestring
  
  if($var)return $var;$possibleValues=array_filter($possibleValues);
  foreach($possibleValues as $k=>$v){
    #if(is_array($v))die("$k => ".print_r($v,1));
    if(trim($v)){$var=trim($v);return $var;}
  }
}

function Re($v,$a='§',$b='',$c='',$d='',$e='',$f='',$g='',$h='',$i='',$j=''){
  #echo"<pre>".print_r(debug_backtrace(),1);kill();
  if($v&&is_string($v)){
    if($a&&is_string($a)&&strlen($a)<3&&strpos($v,$a))$v=explode($v,$a);
    else return $v;#1:string, pas de séparateur trouvé  
  }
  if(is_array($v)){$x=prio($v);if($x)return $x;}#du coup ..
#si le premier paramètre, ni le séparateur, ni le array ne fonctionnent ...
  $x=prio($a,$b,$c,$d,$e,$f,$g,$h,$i,$j);if($x)return $x;return;
}

function prio($v='',$a='',$b='',$c='',$d='',$e='',$f='',$g='',$h='',$i='',$j=''){
  if(!is_array($v)){
    if(trim($v))return $v;
    $v=Array($a,$b,$c,$d,$e,$f,$g,$h,$i,$j);
  }#retourne le premier enregistrement valable
  $v=array_filter($v);array_walk_recursive($v,'trim');
  #if(dep($v)<2)$v=array_map('trim',$v);#else Av($v,dep($v),debug_backtrace());#( sinon trop de dimensions pour array_map
  $v=array_shift($v);return $v;
}

function reold(){
  #savoir si l'on retourne première string, array ou ..
  #si ce sont toutes de strings, nous les assemblons
    $v=Array($v,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);#car v peut être un Array !!
    
  if(!is_array($v))$v=explode(',',$v);$v=array_map('trim',$v);$v=array_filter($v);$v=array_shift($v);Return $v;
  if(!is_array($a)){if(strpos($a,$sep))$a=explode($sep,$a);else{$var=$a;return $var;}}
    #if(is_null($var)&&strpos($a,'§debug'))pat('null:var:'.var_dump($var,1),$a);
    #$a=array_map('trim',$a);#ne s'applique pas aux éléments array  #$x=error_get_last();if(strpos($x['message'],'rim'))av($a);
    $a=array_filter($a);$a=array_shift($a);$var=$a;return $var;#Sinon vides les élements vides et retourne le premier valide :) 
    #Si a='titre1,titre2'; reforme le tableau
}

function cl($x){echo"<script>console.log(\"%c".str_replace("\n","\\n",$x)."\",'color:blue;font:10px Trebuchet MS');</script>";}
function extension($x){$q=strpos($x,'?');if($q!==false)$x=substr($x,0,$q);$x=pathinfo($x,PATHINFO_EXTENSION);return $x;} 
?>