<?#Racetrack by Ben - Framework Basics#524ko - prepend gateway
function redef($k,$v){$k=strtoupper($k);if(!defined($k))define($k,$v,1);}

$_ENV=[];
redef('RT',__DIR__.'/');#replaces all define
redef('CWD',getcwd().'/');#script_path
redef('DR',$_SERVER['DOCUMENT_ROOT'].'/');#script_path
$a['root']=RT;

$f=RT.'local.php';if(is_file($f))require_once $f;#+redef


if(!defined(__FILE__)){
  redef(__FILE__,1);#avoids auto prepend + requires several times
  redef('TMP',__DIR__.'/../tmp/');#always used in mios before kernel loads ..
  function args($x,$c=0){#kernel.php e equivalent
    $k='args';$match=0;
    if(strpos($_ENV[$k],$x)!==false)$match++;
    elseif(!$c)$_ENV[$k].=$x;
    return $match;
  }

  $null=['HTTP_REFERER','HTTPS','REMOTE_USER','REMOTE_HOST','REDIRECT_QUERY_STRING','REDIRECT_STATUS'];
  foreach($null as $k)if(!isset($_SERVER[$k]))$_SERVER[$k]='';$a=$_SERVER;
  
  if(isset($_GET['e'])&&$_GET['e']==500)die('+500');
  if(isset($a['REDIRECT_URL']))$a['redirurl']=$a['REDIRECT_URL'];

  #if(IP=='127.0.0.1')?XDEBUG_PROFILE=1
  #$D=Array('nu'=>preg_replace("~(\?|&).*~",'',U));
  $loadKernel=1;
  if(is_file('/conf.php'))require_once'/conf.php';#injection var via racine serveur
  if(is_file(CWD.'0.inc.php'))require_once CWD.'0.inc.php';#Per Directory variations, please note kernel is not loaded yet and this single file can prevent its loading

  if(defined('R'))$loadKernel=null;#z/sql|(frameworks)/|/drupal|
  elseif(Preg_match("~(sql2|pma|phpmyadmin)/~is",$a['REQUEST_URI']))$loadKernel=null;
  elseif($nofun||Preg_match("~-\.php|composer|console|apc\.php|nofun|ajax\.php|%C2%A3|£~is",$a['REQUEST_URI']) || strpos($a['args'],'nofun')||strpos($a['args'],'-fun'))$loadKernel=null;

  /*url specials or filename arguments*/
  if(strpos('-.php',$a['REQUEST_URI']))args(',noheaderscheck');

  $_ENV['args']=$a['args'];if(!$loadKernel)args(',nofun');

  require_once'lib/obs.php';#obselete or missing extensions like igbinary
  require_once'mios.php';#Minimalist Input/output system
  if($loadKernel)require_once'kernel.php';
  /* Loads the racetrack kernel then */
}
