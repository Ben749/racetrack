﻿<?
$_ENV['keyw']=$_ENV['desc']=$_ENV['titre']='racetrack :: contact';

if($_SERVER["HTTP_X_FORWARDED_FOR"])redef('IP',$_SERVER["HTTP_X_FORWARDED_FOR"]);
elseif($_SERVER["REMOTE_ADDR"])redef('IP',$_SERVER["REMOTE_ADDR"]);

new fun;
extract($_GET);

$mail=$from=$dest=$de=$exp=ADMINEMAIL;##not as permitted sender .... dns records
$subject="Racetrack Contact Form";$s="\r\n";
#$x=wmail(ADMINEMAIL,'subject','msg',$headers);

if($_POST){
  if($_POST['city'] or $_POST['adress'] or $_POST['mail'] or $_POST['zip'])die('mail sent');#false confirmation :)
  
  $_POST=Array_Map('stripslashes',$_POST);extract($_POST,EXTR_SKIP,'u');
  if(in_array($email,['scanner@ptsecurity.com'])){block('scanner');r404();die;}
  Adds($nom);Adds($tel);Adds($email);Adds($ms);Adds($k);
	#if(ereg("seflow.it",HOST)or(ereg("email@",$email))or
  if(Preg_Match("#(\[url|href)=#i",$message))r404();

  $ms="Nom: $nom ($tel) <br>email : $email<br>$city<br>$message<br><br>--- $k $t".IP;$ms=str_replace('"','',$ms);#if(admin)die($ms);
 #SQL5("insert into ben.contact(`nom`,`tel`,`email`,`message`,`key`,`date`)values(\"$nom\",\"$tel\",\"$email\",\"$ms\",\"$k\",NOW())");
	
  $as=$de=$email;/*email renseigné dans form*/
  $headers="MIME-Version: 1.0{$s}Content-type: text/html; charset=iso-8859-1{$s}From:$as{$s}Return-Path:$as{$s}Reply-To:$as{$s}";
  
  $msg=$ms;
  
  $x=wmail($mail,$subject,$msg,$headers);
  if(!$x){$subject.=' (try#2 -> bmail)';$x=Bmail(compact('subject','msg','mail','de','as'));}
  if(!$x){
    $subject.=' (try#3 ->  swap the sender with admin)';$de=$as=ADMINEMAIL;
    $x=Bmail(compact('subject','msg','mail','de','as'));
  }
  #die('<pre>'.print_r(compact('_POST','umail','email','as','de','mail','subject','msg','headers'),1));
  
  die("<script>location.href='?ok=1';</script><a href='?ok=1'>Thanks for your message</a>");
}


if($ok==1)$t2="Thanks for your message";
if(!$but){
switch($k){default:$but="Get more information";break;}}
$but=stripslashes($but);
if($_GET['b2']){$but=str_replace('.',' ',$_GET['b2']);$b1=str_replace('.',' ',$_GET['b1']);}
if(is_array($t2))$t2='';#

require_once'header.c.php';
noscript();?><center>

<form action='' method="post" onsubmit="console.log(verif());return false;return verif();return false;" class=contactform>

<fieldset><?=$t2?><div id=geo></div>
<table class="I194">
  <td>Nom:</td><td><input name="nom" onkeyup=VF(this,'nom')></td>
  <td nowrap="nowrap">Téléphone : </td><td><input name="tel" onkeyup=VF(this,'tel')></td>
</tr><tr>
    <td colspan="2">Votre Message : </td><td>Email : </td><td><input name="email" onkeyup=VF(this,'mail')></td>
    </tr><tr><td colspan="4">
    <textarea id=mess name="message" onkeyup='VF(this,5)'></textarea></td>
</tr><tr><td colspan="4" align="center">
<button accesskey='s' class='submit' id='submit' type='submit' onmouseover="this.className='submit-h'" onmouseout="this.className='submit'"><img src="http://x24.fr/tick.png" width="16" height="16"> » <?=$but?> « <img src="http://x24.fr/tick.png" width="16" height="16"></button>
</td>
</tr></table>
</fieldset>

<s><input name='t' value="<?=$t?>"><input name='k' value='<?=$k?>'><input id=city name='city'><input name="adress"><input name="mail"><input name="zip"></s>
</form>

</center><?require_once'footer.c.php';die;?>

<div id='dee'></div>

<script type='text/javascript' src='http://j.maxmind.com/app/geoip.js'></script><script>
try{v=geoip_city();r=geoip_region_name();}catch(xy){}if(v){$("city").value=v+","+r;}</script>

<input id="b1" value="" accesskey="s" type="submit">
