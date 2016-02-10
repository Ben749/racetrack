<?namespace arrayedit;#namespace vallières;
####oath
function UnsetArrayPath(&$arr,$path){
	$dest=&$arr;$finalKey=array_pop($path);
    foreach($path as $key)$dest=&$dest[$key];
    unset($dest[$finalKey]);
}
function getValueFromPath($arr,$path){// todo: add checks on $path
    $dest=$arr;$finalKey=array_pop($path);
    foreach($path as $key)$dest=$dest[$key];
    return $dest[$finalKey];
}
function setValueFromPath(&$arr, $path, $value){// we need references as we will modify the first parameter
    $dest=&$arr;$finalKey = array_pop($path);
    foreach($path as $key)$dest=&$dest[$key];
    $dest[$finalKey]=$value;
}

 function array_dig_key($array,$key){
	if(!preg_match_all('#\[(.+)\]#U',$key, $match))return;$keys=$match[1];
	while(count($keys)){
		$key = array_shift($keys);
		if(!array_key_exists($key, $array))return;
		$array=$array[$key];
	}
	return $array;
}
#echo array_dig_key($x, $k);

function arrstyle(){
return"<meta http-equiv='Content-Type' content='text/html;charset=windows-1252'><style>*{font:9px verdana;}.imin{width:20px}label{border:1px dashed #F07;}.but{cursor:pointer}table td{white-space:nowrap;}
	body{margin:auto;background:#000;}body,pre,body,form,label{color:#FFF;}
	table,textarea,input{width:100%;background:#222;color:#AEA;}
.td1{width:110px;}	
</style><script>
function submitChanged(f){
  if(f && f.elements){
    for(var i=f.elements.length;i--;){var o=f.elements[i];
      if(o.tagName.toLowerCase()!='input' && o.tagName.toLowerCase()!='textarea')continue;
      if(o.className=='dc' && o.value==o.defaultValue && (!o.disabled || o.disabled.toLowerCase()=='disabled')){if(!(o.disabled=true))o.disabled='disabled';}
    }
  }
  return true;
}</script>";
}
if($_POST){
	$_SESSION['post']=serialize($_POST);fb($_SESSION['post']);#fpc('post',$_SESSION['post']);
}

if($_POST['y']&&!$_POST['chk1'])$_POST['chk1']='off';
  $_SESSION['chk1']=Rem($chk1,$_POST['chk1'],$_SESSION['chk1']);#$_po
  if($chk1=='on')$_ENV['filternullarray']=1;

if(($_POST['a']||$_POST['newval'])&&$_POST['f']){
	#die("<pre>".print_r($x,1).print_r($_POST,1));
	
	$_GET['fe']=$_POST['f'];#f=file,y=1,newkey,newval,a=Array();
	$_ENV['array_filter']=1;
	$x=postarray($_POST['a']);#die(print_r($_POST));
	if($_POST['newval']){
		if(!$_POST['newkey']||$x[$_POST['newkey']]){
			if(e(',SimpleArray',1))$x[9999]=$_POST['newval'];
			else$x[]=$_POST['newval'];
		}#vide ou existante
		else $x[$_POST['newkey']]=$_POST['newval'];
	}

	$_POST['a']=$x;
	#if($_POST['chkey'])die(pre($_POST['chkey']).pre($_POST));
		
	if(e(',SimpleArray',1)){
		$c=array_count_values($x['key']);
		foreach($x['val']as $k=>$v){
			if($k!=$x['key'][$k]){$k=$x['key'][$k];While($c[$k]>1)$k++;}#echo"<li>$k->$v";}#not that one
			$x[$k]=$v;
		}
		unset($x['key'],$x['val']);ksort($x,SORT_NUMERIC);$x=array_values($x);#die(pre($x));
	}
	else{if($_POST['chkey'])swapkeysinarray($_POST['chkey'],$x);ksort($x);}#IF Some Swap is defined ....
		#echo pre($x);die;
	
	if(e(',fpcback',1))rename($_GET['fe'],$_GET['fe'].'.back');
	FPC($_GET['fe'],$x);FPC(1);
	#changes:action to complete after ..
	#return;R302('?fe='.$_GET['fe']);FPC(1);#flushed-not delayed for next time --- raaahhhh
}
###############################################################
function swapkeysinarray($Array,&$x,$r=Array()){#recursive subkey, transmitted as array
	#if(count($r)>2)die("recursion:".pre($Array).pre($r));
	foreach($Array as $k=>$v){
		$r[]=$k;
		if(is_array($v))swapkeysinarray($v,$x,$r);#recursion+1 niveau, mais ne pas conserver son historique ...
		else{#$Array{$r}
			$k2='['.implode('][',$r).']';
			if($k2!=$v){#changement de clé !!
				if(0){#array swap keys
					if(count($r)==1){#unique dimension
						#$y=$x[$k];if($x[$v]);
						setValueFromPath($x,$r2,getValueFromPath($x,$r));UnsetArrayPath($x,$r);
					}
				}
				$parent=substr($v,0,strrpos($v,'['));
				eval("\$w=\$x$v;");
				if($w)$_ENV['db'][]="exists:\$x$v:$w";
				else{
					eval("\$w=gettype(\$x$parent);");
					if($w!='array'&&$w!='NULL')$_ENV['db'][]="parent is :\$x$parent:".$w;#empeche d'effacer des dimensions
					#cannot unset string offset
					else{
						$r2=explode('][',trim($v,'[]'));
						setValueFromPath($x,$r2,getValueFromPath($x,$r));UnsetArrayPath($x,$r);
						$_ENV['db'][]="SWAP:\$x$v=\$x$k2";
					}
				}
				#$x[1][3]=$x[0][3] -> 0 devient une branche vide ...
			}
		}
		array_pop($r);#dépiler à chaque boucle
	}
}
##~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
function postarray($x){if(!is_array($x))return;
	foreach($x as $k=>$v){
		if(is_array($v)){$x[$k]=postarray($v);continue;}
		if($v=='[]')$x[$k]=Array();
	}
	if($_ENV['array_filter'])$x=array_filter($x);
	return $x;
}
###############################################################
function editarray($x,$sk='',$lvl=0){
  if(!is_array($x))return;echo count($x).'values';
  foreach($x as $k=>$v){$dis='';
    if(is_array($v)&&count($v)==0)continue;##empty array
    elseif(is_array($v)){$lvl++;$z.=editarray($v,$sk.'['.$k.']',$lvl);continue;}#raise 1 level
		$k2="a$sk"."[$k]";
    #$lvl=substr_count($k2,'[')-1;while($lvl){$lvl--;$space.=' &nbsp; ';}#$spaceun espace par niveau de recursion
    if((!$v||$v=='[]')&&$_ENV['filternullarray'])$dis=" style='display:none'";#class=dc 
		if(e(',SimpleArray',1))$z.="<tr$dis><td class=td1><input name='a[key][$k]' value=".(($k+1)*10)." style='width:30px'></td><td class=td2>
		<input name='a[val][$k]' value=\"".stripslashes(str_replace(Array('<','>'),Array('&lt;','&gt;'),$v))."\"></td></tr>";
		
		else $z.="<tr$dis><td class=td1>".((e(',swapkeys',1))?"{$sk}[$k]<input class=dc name='chkey{$sk}[$k]' value='{$sk}[$k]' style='width:30px'>":$k2)."</td><td class=td2>
		<input name='$k2' title='$k2' value=\"".stripslashes(str_replace(Array('<','>'),Array('&lt;','&gt;'),$v))."\"></td></tr>";#$k2 onclick -> populate form
    if(0&&strlen($v)>120)$z.="<textarea name='$k2' title='$k2'>".stripslashes(htmlentities($v))."</textarea></td></tr>";
    #<input disabled value=\"\" style='width:80px'>
  }
  return $z;
}
###############################################################
#+function array filter or do not display empty data
#$_ENV['filternullarray']=1;# 
function ArrayEditor($x='',$file=''){
	#<script>console.log(\"".str_replace("\n","\\n",print_r($x,1))."\");</script>
	Rem($file,$_GET['fe']);
	if(!$x)$x=FGC($file);#die($x.$file);
  if(is_array($x)){
#serialized array printing or adding :):)
	ksort($x);#f=file,y=1,newkey,newval
	#<title>shell arrayedit ".substr(Q,strrpos(Q,'/')+1)."</title>
    if(e(',viewasserialized',1))$z.="<textarea title=serialized style=height:30px>".serialize($x)."</textarea>";
	$z.="<form method=post style='border-bottom:1px dashed #090' autocomplete='off'><input type=hidden name=f value=\"$file\"><input name='y' value=1 type=hidden><label>value : $chk1 <input onclick='this.parentNode.parentNode.submit()' name=chk1 class=imin id=i1 type=checkbox ".(($chk1=='on')?'checked':'').">Do not display empty values</label></form>

	<form onsubmit='return submitChanged(this);' autocomplete='off' method=post style='border-bottom:1px dashed #090'><input type=hidden name=f value=\"$file\">
		<table><tr><td style='width:70px'>NewKey: <input name='newkey' style='width:70px'></td><td>Value:<input name='newval' style='width:93%'><input type=submit value=add style='width:40px'></td></tr></table>
	<table>".editarray($x)."</table>";#</form><form method=post><input type=hidden name=f value=\"$_GET[fe]\">
  }
  else $z.="<form method=post autocomplete='off'><input type=hidden name=f value=\"$file\"><textarea name=fgc style=height:40%>".print_r($x,1)."</textarea><br>";
  $z.="<input class=but type=submit accesskey=s></form><title>Arrayedit:".str_replace(Array('/z/A74/adm/'),'',$file)."</title>\n\n";
  return $z;#$Arrayedit;
}

?>