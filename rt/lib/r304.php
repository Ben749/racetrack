<?
class r304{}
function r304($x){
  if(defined(J10) and J10)return;
#if($_SERVER['REMOTE_ADDR']=='82.244.25.233')file_put_contents('/z/'.time().'.ser',print_r($_SERVER,1));#array_merge(compact('v','date'),['server'=> print_r($_SERVER,1)


  $now=time();
  if(!is_array($x))$x=[$x];
  foreach($x as $y){
    $v2=$y;
    if(!is_numeric($y)&&is_file($y))$v2=filemtime($y);
    if($v2>$v)$v=$v2;
    #ne peut expirer dans le futur
  }
  
  while($v>$now)$v-=86000;
  #  if(!$v || !is_numeric($v))$v=$now;
  if(!is_numeric($v) oR $v>$now){
    db('bad expiration: '.SU);header('Afmtime: '.$v,1);return;
  }#1432307270  can't accept this
  $date=gmdate('D, j M Y H:i:s',$v).' GMT';#die;
#header('Expires: '.gmdate('D, j M Y H:i:s',$now+86000).' GMT',1);
  header('Cache-Control: max-age=86000',1);#1 jour maximal, si expiration futur, nécessaire pour prochain passage !!!!
  if($_SERVER['HTTP_IF_NONE_MATCH'] == $v || $_SERVER['HTTP_IF_MODIFIED_SINCE']==$date){ #if(J9)die($_SERVER['HTTP_IF_MODIFIED_SINCE'].'/'.$date.'<br>'.$_SERVER['HTTP_IF_NONE_MATCH'].'/'.$v);
    header('HTTP/1.1 304 Not Modified',1,304);die;
  }
  header('Etag: '.$v,1);header('Last-Modified: '.$date,1);#si rafraichi entre temps
  #header('Expires: '.gmdate('D, j M Y H:i:s',$now+120000).' GMT',1);# is sasha birthday date
  #if(IP=='82.244.25.233'){print_r([getenv('HTTP_IF_MODIFIED_SINCE'),$_SERVER]);die;}
}
