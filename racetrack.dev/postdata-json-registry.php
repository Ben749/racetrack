<?
require_once"../rt/prepend.php";

Rem($_ENV['titre'],$def['titre']);
Rem($_ENV['desc'],$def['desc']);
Rem($_ENV['keyw'],$def['keyw']);

if($_POST['value']){
    $x=json_decode(file_get_contents('post.json'));
    $x->$_POST['key']=$_POST['value'];
    file_put_contents('post.json',json_encode($x));
}
else $x=json_decode(file_get_contents('post.json'));
#print_r($x);die;

new fun;gt('timer');
?><!DOCTYPE HTML><html><head><title><?=$_ENV['titre']?></title><meta name=description value="<?=$_ENV['desc']?>"><meta name=keywords value="<?=$_ENV['keyw']?>"><meta name="viewport" content="width=device-width, minimum-scale=0.1, maximum-scale=1.0"><meta http-equiv='Content-Type' content='text/html;charset=ISO-8859-1;'><link rel='shortcut icon' src='/favicon.ico'><meta name='robots' content='noarchive'><?=$header?>
<script src='./?js<?=$jsh#!c/js.php?js,jq19,jquery-ui.min,jquery.bxslider.min,img,textshadow,blur.min,?>'></script><link href="./?css<?#/!c/jquery.bxslider.css?>" rel="stylesheet"><link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Raleway'>
</head><body><div id=top><?#="bg : ".$bg.$bgs?></div><div id=bot></div>

Some contents<hr>
<form method=POST>Post data : key : <input name=key value=''> value : <input name=value value=''><input class='button' type=submit accesskey=s value='submit this form'></form>
<hr><pre>Key / Values registry contents : 
<?=($x)?print_r($x,1):'empty'?>
<?="generated in : ".($_ENV['lasttime']*1000).'ms -- $_ENV contains : '.pre($_ENV);?>
<?die;#require"footer.php";?>
#comments