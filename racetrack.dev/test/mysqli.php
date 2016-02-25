<?
$fun=new f;new sql6;
ini_set('max_execution_time',2);set_time_limit(2);ini_set('display_errors',1);#set_error_handler("myErrorHandlerMysqli");
register_shutdown_function(function(){sqlp('close');sqlO('close');});#print_r($_ENV);

$_ENV['titre']='mysqli object && flat php prepared statements, transactions';
require_once'../header.c.php';echo'<pre>';

$x=sqlO('select id,id_season from articles order by id desc limit 1');
if($x['#']){#has errors
  if($x['0']['error']=='No database selected'){print_r($x);die;}
  $fun->r302('sql6-cache.php?r=mysqli.php#migrations required');
}
/** creates required database && tables **/
  
print_r(['sqlTransaction1:select']+compact('x'));
#ERRORS:$x['#"] && $x[$index][0]=is_numeric(ERRORLINE);

$x=sqlp('SELECT id,title,id_season from articles order by id desc limit ?',[1]);
print_r(['sqlp2']+compact('x'));

$x=sqlO(['select id,id_season from articles order by id desc limit ?','insert into test.articles (title,id_season)values(?,?)',],[[1],['--new2',26]]);
print_r(['sqlTransaction2:select']+compact('x'));#fails & fails select as well !

$x=sqlO('insert into articles (title,id_season)values(?,?)',[['--new1',24],['--new2',25],['fail',26]]);print_r(['sqlTransaction1']+compact('x'));#fails !

$x=sqlO('insert into articles (title,id_season)values(?,?)',[['--new1',24],['--ok',25]]);print_r(['sqlTransaction3']+compact('x'));#ok



$x=sqlp([
"insert into articles(title,id_season)values(?,?)","insert into articles(title,id_season)values(?,?)",
"update articles set title=? where title=?",
'SELECT id,title,id_season from articles order by id desc limit ?',
],
[
['a--new6',24],['b--new7',24],['--new'.date('YmdH:i:s'),'--new7'],[7]
],1);
print_r(['sqlP4']+compact('x'));die;#*ù***************************************


/*** pour updates, insertions, deletion multiples Transaction Orientée objet ***/
function sqlO($sql,$parameters=[]){
  static $mysqli;global $sqlconn;#$_ENV['db'][]=&$ret;
  if($sql=='close'){if($mysqli){$mysqli->close();$mysqli=null;}return 1;}
  if(!$mysqli){
    sqlp('close');
    #$class=new ReflectionClass('mysqli');$mysqli2=$class->newInstanceArgs($sqlconn);
    $mysqli = new mysqli($sqlconn[0],$sqlconn[1],$sqlconn[2],$sqlconn[3]);
    $mysqli->select_db($sqlconn[3]);
    #print_r(compact('mysqli','mysqli2'));
  }
  if(!$mysqli || !$mysqli->stat)return['#'=>[__line__,'no connection']];
  $mysqli->autocommit(0);$ok=1;
  if(!is_array(reset($parameters))){$sql=[$sql];$parameters=[$parameters];}#single operations
  elseif(is_array(reset($parameters))&& !is_array($sql))$sql=array_fill(0,count($parameters),$sql);#single sql multilple values
  
  try {
  #print_r($sql);
    foreach($sql as $k=>$query){
      $ret[$k]=null;
      $fakeKeys=[];$types='';$params=[&$types];
      $param=$parameters[$k];
      
      if(!$stmt = $mysqli->prepare($query)){
          $ret['#']=1;$line=__line__;$error=$mysqli->error;$ret[$k]=compact('line','error');$ok=0;Continue;
        }
      
      if(count($param)){
        foreach($param as $k2=>$v){
          if(is_numeric($k2)){#bind to vars
            unset($param[$k2]);$i=$k2;$k2='z'.$i;
            while(in_array($k2,$fakeKeys)){$i++;$k2='z'.$i;}$param[$k2]=$v;
          }
          if(is_integer($v))$types.='i';elseif(is_double($v))$types.='n';elseif(is_string($v))$types.='s';else $types.='s';
          $$k2=$v;$params[$k2]=&$$k2;
        }
        
        if(!$x=call_user_func_array([$stmt,'bind_param'],$params)){
          $ret['#']=1;$ret[$k]=[__line__]+compact('x','params','param','z0');$ok=0;continue;
        }
      }

      if (!$stmt->execute()){
        $ret['#']=1;$ret[$k]=[__line__,$query,$param,$mysqli->error];$ok=0; 
      }
      
      else{
        if(stripos($query,'select ')>-1){
            preg_match('#select (.*) from#i',$query,$m);
            if(!$m[1]){$ret['#']=1;$ret[$k]=[__line__,$query,'cant match fields'];Continue;}
            $x=explode(',',trim($m[1]));
            foreach($x as $v)$fields[$v]=&$$v;
            # dynamic mysqli_stmt_bind_result && mysqli_stmt_fetch
            if(!call_user_func_array([$stmt,'bind_result'],$fields)){
            $ret['#']=1;$ret[$k]=[__line__,$query,'cant bind params'];continue;}
            while (mysqli_stmt_fetch($stmt)){
              $t=[];foreach($fields as $k3=>$v)$t[$k3]=$v;
              $res[]=$t;
              #foreach($fields as $v)$v=null;
            }
            if(count($res)==1)$res=reset($res);
            $ret[$k]=$res;
        }
        elseif(stripos($query,'insert into ')>-1)$ret[$k]=$mysqli->insert_id;
        else $ret[$k]=$mysqli->affected_rows;#update or delete
      }
      $stmt->close();
    }
    $ok?$mysqli->commit():null;#$mysqli->rollback()
    #$mysqli->autocommit(1);
  }
  catch(exception $retrr){
    $mysqli->rollback();$ret['#']=1;
  }
  return $ret;
}



/** mysqli parameter queries the flat way **/
function sqlp($sql,$parameters=[],$rollback=0){
  static $link;#$_ENV['db'][]=&$ret;
  if($sql=='close'){if($link){mysqli_close($link);$link=null;}return 1;}
  if(!$link){sqlO('close');#avoid double connexions
    global $sqlconn;$link=call_user_func_array(mysqli_connect,$sqlconn);
    if(!$link)return['#'=>[__line__,'no connection']];
  }
   #if($rollback)mysqli_autocommit($link,0);  
  if(!is_array(reset($parameters))){$sql=[$sql];$parameters=[$parameters];}#single operations
  elseif(is_array(reset($parameters))&& !is_array($sql))$sql=array_fill(0,count($parameters),$sql);#single sql multilple values
  
  foreach($sql as $k=>$query){
    $fakeKeys=$res=[];$types='';
    $stmt=mysqli_prepare($link,$query);
    if(!$stmt){$ret['#']=1;$ret[$k]=[__line__,'error:'.mysqli_error($link)]+compact('query');continue;}
    if($stmt->error){$ret['#']=1;$ret[$k]=[__line__,'error:'.$stmt->error]+compact('query');continue;}
    
    $params=[$stmt,&$types];#to bind
    $param=array_filter($parameters[$k]);#to extract
    
    foreach($param as $k2=>$v){
      if(is_numeric($k2)){//$$var
        unset($param[$k2]);$i=$k2;$k2='z'.$i;
        while(in_array($k2,$fakeKeys)){$i++;$k2='z'.$i;}
        $param[$k2]=$v;#ré-affectation
      }
      $$k2=$v;$params[$k2]=&$$k2;
      if(is_integer($v))$types.='i';elseif(is_double($v))$types.='n';elseif(is_string($v))$types.='s';else $types.='s';
    }
    
    if(!call_user_func_array(mysqli_stmt_bind_param,$params)){
      $ret['#']=1;$ret[$k]=[__line__,'error:'.mysqli_error($link)]+compact('query','params','param','z0','z1','z2','z3','z4','z5');continue;
    }
    
    if(!mysqli_stmt_execute($stmt)){
      if($stmt->error){$ret['#']=1;$ret[$k]=[__line__,$stmt->error];Continue;}
      if($stmt->errorno){$ret['#']=1;$ret[$k]=[__line__,$stmt->errorno];Continue;}
      mysqli_stmt_close($stmt);
      $ret['#']=1;$ret[$k]=[__line__,$query,mysqli_error($link)];continue;
    }
    
##select
    $params=[$stmt];
    if(stripos($query,'select ')>-1){
      preg_match('#select (.*) from#i',$query,$m);if(!$m[1]){
      $ret['#']=1;$ret[$k]=[__line__,$query,'cant match fields'];continue;}
      $x=explode(',',trim($m[1]));
      foreach($x as $v)$fields[$v]=&$$v;
      # dynamic mysqli_stmt_bind_result && mysqli_stmt_fetch
      #re-writes the variables
      $params=array_merge($params,$fields);
      if(!call_user_func_array(mysqli_stmt_bind_result,$params)){
      $ret['#']=1;$ret[$k]=[__line__,$query,'cant bind params'];continue;}
      while (mysqli_stmt_fetch($stmt)){
        $t=[];foreach($fields as $k3=>$v)$t[$k3]=$v;
        $res[]=$t;
        #foreach($fields as $v)$v=null;
      }
      if(count($res)==1)$res=reset($res);
      $ret[]=$res;
    }
    elseif(stripos($query,'insert into ')>-1)$ret[]=mysqli_insert_id($link);
    else $ret[]=mysqli_affected_rows($link);# -1 => error update or delete
    mysqli_stmt_close($stmt);
  }
  #if($rollback && !$ret['#'])mysqli_commit($link); 
  if(count($ret)==1)$ret=reset($ret);
  return $ret;
}

function myErrorHandlerMysqli($no, $msg=null, $file=null, $line=null) {
  static $errors;
  if($no===1 && $errors){
  foreach($errors as $k=>$v)$s.=$k.' '.$v."\n";$errors=[];
  echo $s;return 1;}
  
  $errorType =[E_DEPRECATED=>0,E_NOTICE=>0,E_USER_NOTICE=>0,E_STRICT=>0,
  
  E_ERROR=>'ERROR',E_WARNING=>'WARNING',E_PARSE=>'PARSING ERROR',E_CORE_ERROR=>'CORE ERROR',E_CORE_WARNING=>'CORE WARNING',E_COMPILE_ERROR=>'COMPILE ERROR',E_COMPILE_WARNING=>'COMPILE WARNING',E_USER_ERROR=>'USER ERROR',E_USER_WARNING=>'USER WARNING',E_RECOVERABLE_ERROR=>'RECOVERABLE ERROR'];
  
  if (array_key_exists($no, $errorType))$no=$errorType[$no];
  else $no = 'others';
  if(in_array($no,[0,null,'ignore']))return 1;
  if(!$msg)return 0;#stand error handler continues here :) $msg=SU;
  $errors[str_replace('/home/www/','',$file).':'.$line]=$no.' : '.$msg;
}
