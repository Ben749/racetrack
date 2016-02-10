<?#article
$x=FGC('adm/editor.json');
if($t=$x['post'][$id]){
  if(U!=$t['url'])r302('/'.$t['url'].'#unique');
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
  echo $t['content'].'</pre></body></html>';

  die;
}
else{
  header('nf',1,404);
  require_once'header.c.php';
  echo"<pre>article not found - <a href='/#nf'>back to home</a></pre><style>body{background:url('//x24.fr/lake.mouette.stjo.winter.jpg') no-repeat fixed center top / cover;}</style></body></html>";die;
}
#continues to 404.php