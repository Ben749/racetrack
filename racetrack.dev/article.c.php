<?#article
/** templateengine **/
$name='custom var : $name injected';
function customfunction($a,$b){$args=get_defined_vars();return'customfunction:done:arguments:'.json_encode($args);}

$x=FGC('adm/contents/articles.json');
if($t=$x['post'][$id]){

  if(U!=$t['url'])r302('/'.$t['url'].'#unique');
/*mini template engine*/
  preg_match_all("~\{\{\\$([^\}]+)\}\}~s",$t['content'],$vars);
  preg_match_all("~\{\{([^\}]+)\(([^\)]*)\)\}\}~s",$t['content'],$fun);
  #if(count($vars[1]) or count($fun[1]))die('<pre>'.print_r(compact('vars','fun'),1));
  if(count($vars[1])){
    foreach($vars[1] as $index=>$var){
      if(${$var})$t['content']=str_replace($vars[0][$index],${$var},$t['content']);
    }
  }
  if(count($fun[1])){
    foreach($fun[1] as $index=>$func){
      $args=explode(',',$fun[2][$index]);
      if(function_exists($func))$t['content']=str_replace($fun[0][$index],call_user_func_array($func,$args),$t['content']);
    }
  }
  
  $_ENV['titre']=$t['title'];
  require_once'header.c.php';
  
  if($t['bg'])echo"<style>body{background:url('".$t['bg']."') no-repeat fixed center top / cover;}</style>";
  $prev=$id-1;$next=$id+1;

  echo"<pre>";
  $url='/';$title='home';
  if(isset($x['post'][$prev])){$url=$x['post'][$prev]['url'];$title=$x['post'][$prev]['title'];}
  echo"<a href='".$url."' accesskey=a>".$title."</a> - ";
  
  $url='/';$title='home';
  if(isset($x['post'][$next])){$url=$x['post'][$next]['url'];$title=$x['post'][$next]['title'];}
  echo"<a href='".$url."' accesskey=z>".$title."</a> - ";
  echo $t['content'].'</pre>';
  
  require_once'footer.c.php';
  die;
}
else{
  header('nf',1,404);
  require_once'header.c.php';
  echo"<pre>article not found - <a href='/#nf'>back to home</a></pre><style>body{background:url('//x24.fr/lake.mouette.stjo.winter.jpg') no-repeat fixed center top / cover;}</style></body></html>";die;
}
#continues to 404.php



