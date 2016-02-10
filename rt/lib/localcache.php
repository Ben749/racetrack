<?
#Weird method to replace generation files with real cache
#if(J10){die(pre($_GET));}
#recrée le fichier html - appelé depuis chaque fichier en cache html local
#et donc, si le fichier appelle un header, le fichier html final mérite bien de charger le localcache
expire('90000');e(',localcache');#,Av($a,U,is_file($x));
$x=DR.U;
/*$_ENV['c']['htmlcache']=Array($x,'<?require_once RT."localcache.php";?>','<!--cache:localhtml-->');*/
#av(__FILE__.__LINE__,preg_match("~\.(html?)~i",U));

if(is_file($x)&&(preg_match('#\.html?#',U))){#pour les fichiers php qui n'acceptent aucun paramètre - sauf qu'on ne le sait qu'à la fin !!!!
	if(is_file($x.'.inc')){unlink($x);rename($x.'.inc',$x);require_once($x);kill();}#if included file
	else unlink($x);#or else it has nothing to do here !!
  #Av($a['SCRIPT_FILENAME'],$x);
  if(0){
	  #||$_ENV['htmlcache']=1
	  if(filemtime($x)<NOW && filesize($x)<15000){#expiré
		if(is_file($x)){e(",$x is file");#L'url correspond bien un fichier physique de Génération HTML
			  if($a['SCRIPT_FILENAME']==$x && !is_file($x.'.inc')){e(',rename');rename($x,$x.'.inc');}
			  if(is_file($x.'.inc')){e(',inc:required');Require_once($x.'.inc');kill();} 
		}
		else{#cela vient d'un rewriting éhéh - et le fichier doit être détecté en tant que tel dans l'auto-load
		 
		}
	  }
	if($a['SCRIPT_FILENAME']!=$x && is_file($x)){
    e(',gen!=file');require_once $x;
    }#Si le générateur est différent du fichier - on charge le fichier comme un fichier de cache et fini par un die;
	}
}

?>