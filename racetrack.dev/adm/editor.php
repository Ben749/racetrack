<?
new fun;
$f='editor.json';$x=fgc($f);if(!$x)$x=['post'=>[],'maxid'=>0];

if($_POST){
#<p>&nbsp;</p>
  $_POST['content']=trim(str_ireplace(['<p>&nbsp;</p>','<br />','&nbsp;','<\/p><p>','<iframe style="display: none;"></iframe>','<p></p>','alt="" ',"\r"],['<br>','<br>',' ','','','','',''],$_POST['content']));
  $_POST['content']=preg_replace("~<p>/s+</p>~is",'',$_POST['content']);
  if(!$_POST['content'] && !trim($_POST['title'])){extract($_POST);$error=' empty contents  ';goto edit;}
#die(htmlentities($_POST['content']));
  if($id=$_POST['id']);else{$x['maxid']++;$id=$x['maxid'];}#new id
  unset($_POST['id']);
  $_POST['url']=$id.'.'.trim(preg_replace('~-{2,}~','-',preg_replace("~[^a-z0-9]~i",'-',$_POST['title'])),'-');
  $x['post'][$id]=$_POST;
  fpc($f,$x);
  r302('?id='.$id.'#saved');
}

$id=$title=$content='';$id=$_GET['id'];
if($id && $x['post'] && $x['post'][$id])extract($x['post'][$id]);
#print_r(compact('id','x'));
edit:
foreach($x['post'] as $k=>$t){$options.="<option value='$k'>".$t['title']."</option>";$list[]="<a href='?id=$k'>".$t['title']."</a>";}
?>
<html><head><title>racetrack editor - <?=$title?></title>
<link rel="shortcut icon" type="image/png" href="/favicon.ico">
<link href="/style.css" rel="stylesheet"><link href="/?css" rel="stylesheet">
<script src="//cdn.ckeditor.com/4.5.7/standard<?#basic|full?>/ckeditor.js"></script>
<title>ckeditor</title></head>
<body>
<div class=w50><div class=w50><form method=post>
<input name=id type=hidden value='<?=$id?>'>
Title : <input name=title value='<?=$title?>'><?=($url)?" - url : <a target=1 href='/$url'>$url</a> ":''?>
Contents : <?=($error)?"/!\ $error /!\\":''?><textarea id=ckeditor name=content><?=$content?></textarea>
background : <input name=bg value='<?=$bg?>'>
<br><input type=submit value=go accesskey=s style='width:99%;'>
</form>
List : <a href='?'>Create new post</a> - <?=implode(' - ',$list)?> - <select onchange="location.href='?id='+this.value" class=select2><option>Select or create new post</option><?=$options?></select></div></div>

<script>var sel='';
window.onload=function(){
config={height:'50%',toolbarCanCollapse:true,language:'fr',uiColor:'#000000',customConfig:'/adm/ck.js',toolbar:'ben'};
CKEDITOR.replace('ckeditor',config);//c.contentsCss='/style.css';
}
</script><style></style></body></html><?die;?>

//x24.fr/drone/beauregard-009.jpg à 1
confins-001.jpg
