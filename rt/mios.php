<?#mios
#1:wrappers: allows intercepting calls to essential standard functions : mail, headers, redirections ..
if(!function_exists('wmail')){
  function wmail($to,$sub,$msg,$head=null,$params=null){#global mail wrapper
    #if(function_exists('bmail')){Bmail($sub,$msg,$to,$head);#$de=SENDEREMAIL1,$smtp='',$verif=1,$delay=1}
    return mail($to,$sub,$msg,$head,$params);
  }
}

if(isset($_GET['e'])){#simple error pages -> errorpages.php
  $e=['403'=>'/*Access Denied*/','500'=>'/*Error*/'];
  if(isset($e[$_GET['e']]))die($e[$_GET['e']]);
}

$d=array('ip'=>'127.0.0.1','HTTP_HOST'=>'cli');
foreach($d as $k=>$v){if(!isset($a[$k]))$a[$k]=$v;}#default values for php CLI !!!
#define basic variables U && CWD here..
if(!$a['QUERY_STRING'] && $a['REoDIRECT_QUERY_STRING'])$a['QUERY_STRING']=$a['REDIRECT_QUERY_STRING'];#passing RQS for 404


$D=['SN'=>$a['SCRIPT_NAME'],'SFN'=>$a['SCRIPT_FILENAME'],'H'=>str_replace(array(':81',':80'),'',strtolower($a['HTTP_HOST'])),'DR'=>str_replace('Program Files','Progra~1',$a['DOCUMENT_ROOT']),'nu'=>substr($a['SCRIPT_NAME'],1),'u'=>substr(Preg_replace("~(\?|&)(go=|gclid=).*|www\.~is",'',$a['REQUEST_URI']),1),'cwd'=>str_replace('/home/www','/z',getcwd()).'/','server'=>$a['ip'],'sip'=>$a['ip'],'sa'=>$a['ip'],'status'=>$a['REDIRECT_STATUS'],'rs'=>$a['REDIRECT_STATUS'],'rqs'=>$a['REDIRECT_QUERY_STRING'],'rh'=>$a['REMOTE_HOST'],'host'=>$a['REMOTE_HOST'],'q'=>$a['QUERY_STRING'],'ru'=>$a['REMOTE_USER'],'ip'=>$a['REMOTE_ADDR'],'ua'=>$a['HTTP_USER_AGENT'],'refe'=>strtolower($a['HTTP_REFERER']),'now'=>time(),'DATE'=>date('YmdHis')];
Foreach($D as $k=>$v)redef($k,$v,1);

$d=array('args','DB','root','tracker','starter','obstart','REDIRECT_QUERY_STRING','REDIRECT_STATUS','REMOTE_HOST','REMOTE_USER','HTTP_REFERER');
foreach($d as $k){if(!isset($a[$k]))$a[$k]=null;}#set to null if not set

redef('PATHANOT',TMP.'anot/'.str_replace('/','-',H.SN).'.igb');$anotations=[];
redef('SR','http'.(($a['HTTPS'])?'s':'').'://'.H.'/',1);redef('SURL',SR.U,1);redef('SU',SR.U,1);

if(is_file(PATHANOT)){
  $anotations=igbinary_unserialize(file_get_contents(PATHANOT));
  if($anotations['vars'])extract($anotations['vars']);
  if($r304){
    $max=1;
    foreach($r304 as &$time){
      if(!is_numeric($time)&&is_file($time))$time=filemtime($time);
      if(!is_numeric($time))continue;
      if($time>$max)$max=$time;
    }unset($time);
    #die('-'.$max.'/'.($max-time()));
    require_once('lib/304.php');r304($max);
  }
}

$shutdown=[];
register_shutdown_function(function(){
  global $noshutdown,$anotations;
  if($noshutdown || args(',nofun',1))return;#for media thumbnails dynamic generation
  if(args(',headerssentcheck',1)){
    if(headers_sent($file,$line))wmail('error@x24.fr','headers sent',SU."\n".$file.':'.$line);#404 - normal car ob_get_clean
    else{
      if(J8||J9)header("Cache-Control: private",1);#cumulé depuis J9 à J11
      if(function_exists('GT') && defined('J9') && J9)gt('die');
      header('A: shutdowns: '.$_ENV['lasttime'],1);
    }
  }
  
  if($anotations && filemtime(SFN)>filemtime(PATHANOT)){#si fichier changé depuis dernier cache anotations
    file_put_contents(PATHANOT,igbinary_serialize($anotations));
  }  
  myErrorHandler();myErrorHandler(1);shutdown(1);myErrorHandler(1);#si jamais des erreurs se sont produites dans le cycle de shutdown
});#global handler

function shutdown($x=null,$top=0){
#$e=error_get_last();fb($e);
  global $shutdown;
  if(!is_array($shutdown))$shutdown=[];
  if($x===1){#fired once but allows other functions to be fired & allows second pass, third pass etc...   
    $shutdown=array_filter($shutdown);
    if(!count($shutdown))return;
    #print_r($shutdown);die;
    foreach($shutdown as $fun){
      if(gettype($fun)=='string' && function_exists($fun))$fun();
      elseif(gettype($fun)=='object')$fun();#closure
    }
    $shutdown=[];return 1;
    #arrêtera au prochain die rencontré
  }
  #echo gettype($x);$x();die;
  
  if($x and $top)array_unshift($shutdown,$x);
  elseif(!in_array($x,$shutdown))$shutdown[]=$x;
  if($x)return 1;#ajouts :)
}

set_error_handler("myErrorHandler");#['class','function'] ini_set('log_errors',0);
#restore_error_handler();
function myErrorHandler($no=null,$msg=null,$file=null,$line=null,$plus=null){
  $no1=$no;
  if(!$no){#called as shutdown function
    $error=error_get_last();if($error!==NULL && $error["type"]==1){$no=E_ERROR;$msg=$error['message'];$file=$error['file'];$line=$error['line'];}
  }
  static $errors;
  if($no===1 && $errors){$s='';
    foreach($errors as $k=>$v)$s.='-'.$k.' '.$v."\n";$errors=[];
    file_put_contents(ini_get('error_log'),$s,FILE_APPEND);return;/*records all encountered errors*/
  }
  
  $errorType =[E_DEPRECATED=>0,E_NOTICE=>0,E_USER_NOTICE=>0,E_STRICT=>0,
  E_ERROR=>'ERROR',E_WARNING=>'WARNING',E_PARSE=>'PARSING ERROR',E_CORE_ERROR=>'CORE ERROR',E_CORE_WARNING=>'CORE WARNING',E_COMPILE_ERROR=>'COMPILE ERROR',E_COMPILE_WARNING=>'COMPILE WARNING',E_USER_ERROR=>'USER ERROR',E_USER_WARNING=>'USER WARNING',E_RECOVERABLE_ERROR=>'RECOVERABLE ERROR'];
   
  if(array_key_exists($no,$errorType))$no=$errorType[$no];else $no='others';
  #if($error){echo in_array($no,[null,'ignore']);print_r(compact('no','error','msg'));}
  if(in_array($no,[null,'ignore']))return;#0 matches all string
#specials
  if(strpos($msg,'annot redeclare'))Dbm(SU.' fun defined '.$msg,db2());
  if(!$msg)return 0;#stand error handler continues here :) $msg=SU;
  if(strpos($msg,"\n")!==false){$msg=explode("\n",$msg);$msg=reset($msg);}#no stack trace !!
  $errors[str_replace('/z/','',$file).':'.$line]=$no.' : '.$msg;
#if($no=='WARNING')throw new \Exception($msg,$no1);#no catch: uncaught exception ..
  if($no=='ERROR'){#fatal, no more would be handler
    if(stripos($error['message'],'Call to undefined function')!==false){
        $f='lib/fun.map.php';if(!$_ENV['funmap'] && is_file($f)){
           $_ENV['funmap']=unserialize(file_get_contents($f));
          #tion r302 -> fun.php
        }
        if(preg_match('#function ([^\(]+)\(\) #',$error['message'],$m)){
            if(array_key_exists($m[1],$_ENV['funmap'])){
                $load=new $m[1];#requires autoload.php
            }
        }
    }
    myErrorHandler(1);ob_end_clean();header("HTTP/1.0 500 Internal Server Error",1,500);
    if(AJAX)die('/*500*/');#js or css
echo"<html><head><title>500 error</title><style>body{background:#003;color:#AAA;}</style></head><body><table width=100% height=100% border=0 align=center><tr><td><center><h1>500 - une erreur est survenue<br>".(is_string($m)?$m:'')."<br><a href='/'><img src='http://x24.fr/immologo1.png'><br>Retour a l'accueil</a></h1><br><form action='http://google.fr/search' method=get><input type=hidden name=q value='site:".H."'><input name=q><input type=submit value=rechercher></form></td></tr></table>".$f."</body></html>";die;return 1;
  }
  return compact('msg','file','line');#for try catch block
}
