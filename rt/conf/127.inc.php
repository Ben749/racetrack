<?e(',noperf');#127.0.0.1 is a fallback if no IP are defined in server confs
$a['server']='pre';$a['ip']='127.0.0.1';
$ipsa=Array('127.0.0.1'=>'localhost');

$_ENV['c']['sql']['test']=Array('127.0.0.1','root','a');#database connection

redef('J9',strpos(UA,'J9')&&!strpos(RH,'cloudflare')?1:0,1);
redef('J10',strpos(UA,'J10')&&!strpos(RH,'cloudflare')?1:0,1);#définir les élevations depuis qquechose

$host=127;
if(!function_exists('sys_getloadavg')){function sys_getloadavg(){return Array(1,0,0);}}#

date_default_timezone_set('Europe/Paris');

rem($a['preload'],'0=autoloader.php,1=fun.php,2=debug53.php,3=fundev1.php');#&1=deprecated.php&2=ksv1-div.php&3=ksv1-auto.php&4=crypt.php&5=autor301.php&6=ggtracker.php&7=css.php
$a['vars']="root=/l/debshared/racetrack&logs/l/debshared/racetrack&l2=/l/debshared/racetrack&obstart=1&cacheinit=0&starter=0&tracker=0";
$erlogs='/l/debshared/racetrack/er.logs';

#die(dr.'adm/local.s3db');
redef('LOGLEVEL',6);#6:écrire tout les petits fichiers
redef('SHELL','shell.php');

Rem($DB,[$_GET['ho'],'ben',DR.'adm/local.s3db']);#localhost,Y:/web/www/

$thumbsh=array(80);#$thumbsw=array(120);#genérer chaque miniature..

$ga='UA-939697-14';#'''google analytics code :::
$adwordstag="<img height=1 width=1 src='http://www.googleadservices.com/pagead/conversion/989090452/?label=gtPZCKzJsQzIQlKXR1&amp;value=31&amp;guid=ON&amp;script=0'>";

$def=array('titre'=>'titre défault','desc'=>'desc défault','keyw'=>'mots clés défault');
#l'ordre est décisif !!!

#obstart=1&cacheinit=1&session=1
$ftp=Array('ftphost','ftpuser','ftppass');#for backups
#$_ENV['c']['sql']['127.0.0.1']=Array('localhost','root','');
$_ENV['c']['mem2defaultdb']=R.'z/serializedpath.db';
$_ENV['c']['smtp']['efe']='smtp.1und1.de,25,info@-.ch,-,-.info,E-o';#smtp sendmail settings

function db1($x,$lv=3,$die=0){
    static $t,$i;$i++;
    if(!$t){
        echo"<link rel=stylesheet href='http://x24.fr/!c/syntax.css'><script src='http://x24.fr/!c/syntax.js'></script>";$t=1;
    }
    #if(!is_array($x))$x=[$x];
    #@ob_start();var_debug($x);$x=ob_get_clean();
    $x=var_debug($x);
    #\Doctrine\Common\Util\Debug::dump($x, $lv)
    echo"<pre class=pre id='predb$i'>".$x."</pre>";
    $_ENV['js'][]="var x=document.getElementById('predb$i');window.onload=x.innerHTML=syntaxHighlight(x.innerHTML);";
    if($die)die;
}

