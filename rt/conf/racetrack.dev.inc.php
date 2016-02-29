<?#Per domain config : cumulative
$sqlconn=['127.0.0.1','root','a','test'];
$ga='UA-111-1';#analytics code
$DB='ciel';#DR.'adm/3.s3db';#replace this value now !!
$def=array('titre'=>'racetrack default title','desc'=>'desc default','keyw'=>'default keywords');

rem($a['preload'],'0=autoloader.php&1=r304.php');
$a['preload']='0=autoloader.php&1=r304.php';
$a['rt']=$a['root'].'rt/';
$a['rt']=$a['root'].'tmp/';
#,1=debug53.php,2=fundev1.php&1=deprecated.php&2=ksv1-div.php&3=ksv1-auto.php&4=crypt.php&5=autor301.php&6=ggtracker.php&7=css.php

register_shutdown_function(
  function(){
    if($_ENV['errorshutdown'])return;
    $e=error_get_last();if($e && $e['type']!=8){print_r($e);}$_ENV['errorshutdown']=1;
  }#displays 500 inline typo errors
);

header('Content-Type: text/html; charset=utf-8');#ie displays :#ï»¿ 
 