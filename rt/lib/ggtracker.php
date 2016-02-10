<?php #KEYWORDS ENGINE V2.22
#G2('ggt');#IF NO PREVIOUS SESSIONS :)
function ggtracker(){
rem($ref,$_ENV['yt']['ref'],refe);#.refe  Car déjà enregistré
    $files="ico|eot|ttf|js|css|htc|woff|swf|xml|gif|png|bmp|flv|mp(3|4)|exe|jpe?g|aspx?";#bad extensions
  $bp="~\?(jsr?|css|rss)|Final|visuall|zsimu|contact2?\.php|suivi|s74.fr|4Test|(zsimu|2001|admin|intranet|sql)/|z/\!|/!|/y/|\.($files)\$~i";#bad url
  $bR="~(a74|xzxzx|dc10)\.fr|frontaliers\.info|yahooapi|url=|\.(s?html|$files)\$~i";#bad referer : can't be the referer,ex:referal spam
#shall be recorded on first step !
if(stripos(' '.$ref.refe,'<a href'))Block(Array('badref',$ref.refe));
elseif(h=='cli')$x='cli';elseif(bots)$x='bots';elseif(!$GLOBALS['tracker'])$x='!tracker';elseif($GLOBALS['notracker'])$x='notracker';
  elseif($_ENV['yt']['lw']+600>now)$x='lw<600';#dernière écriture du mot clé < 10 minutes  G2('smotclé');
  elseIF(Preg_Match('~SID|css|js|jsr~is',q))$x='badq';elseif(Preg_Match("~\.($files)\$~is",u))$x='badfiletype';#bad url
  elseIF(Preg_Match("~yandsearch|saihm|seoheap|internesdedijon|(a74|xzxzxz)\.fr~is",REFE.Q.$ref))$x='badref';#bad referer
  elseif(Preg_Match("~(Tag|2|zsimu|qform|contact2?)\.php|Final|dev3|/(3p|mut|!r|\?|sql|2001|intranet)~is",u))$x='badurl';
#||in_Array(ip,Array('86.200.149.26','46.14.23.116','82.244.25.233','86.193.235.81','86.197.132.220','46.14.64.142','83.197.37.154')
  elseIF(Preg_Match($bp,$ref,$t))$x='ref:badpat(u)';elseif(Preg_Match($bp,u,$t2))$x='url:badpat';elseif(Preg_Match($bR,refe.$ref,$t3))$x='ref:badpat(R)';
  elseif(preg_match("~\.(php|s?html?)\$~",u))$x=11;#et maintenant valider les php
  elseif(strpos(substr($v,-5),'.')>-1)$x='is not php or shtml : other filetype';#et non le reste (bad extensions==files)
  else $x=12;#unknown
if(!is_numeric($x))null;#DB("ggtracker:$x",'err');
else{
  G2('k1');
#si le fichier existe déjà sur le serveur, cette valeur est récupérée, puis inserée de nouveau pour marquer l'autre site avec le meme mot clés
#$y=Preg_replace('`&(babsrc|affid|mntrid|channel|client|clientcop|source|gs_rfai|ei|btng|spell|resnum|sourceid|channel|filetype|vertical|_iceurlflag|_iceurl)=([^&]+)`is','',$y);
$y=str_replace(Array('search/z/results/','/fr/results/index/q/','search/','search?w=tot','as_q=','custom&q=','&aqa=','&aqp=','/web/','rdata=','lts/&q='),'&q=',$ref);
$y=str_replace(Array('search/srpcache','linkdoctor','toggle=1','sa=n','ei=','prmd=mc','hl=fr','rls=','org.mozilla:fr',':official','firefox-a','http://','www.','fr.','search.','aq=','oq=','aqi=','fkt=','fsdt=','fr=yfp-t-703','meta=lr','source=hp','aql=','hs=','tbo=s','rlz=','searchal','utf-8','ie=','oe=','sourceid=','nabclient','gfns=','/bottomnavigation','/relevance','%22','recherche google','ved=','ct=','sa=x','oi=spell','rlz=','hl=fr','oq=','linkdoctor','safari','redir_esc=','ie=','oe=','utf-8','aq=','rls=','org.mozilla:','fr:official','meta=','gs_rfai=','aqi=','ql=','navclient','usg=','vc=','safe=','active','com.microsoft','en-gb','searchbox','ecofree.org/search.php','pid=','search.daum.net','results&','itag=ody','search&','&hl=fr','topnavigation/','relevance/','iq=true/','zoom=off/','=7','&oq=','&aq=','&cx=','partner-','mb-','pub-',),'&',$y);$y=trim(Preg_replace("~[&]{2,}~",'&',$y),' &');
  $mots=kwd($y);#travaux de nettoyage du referrer =)
  
  if($mots&&!strpos($mots,'provided')&&!in_Array($mots,array('',':'))){
    $mots=Tridecoder($mots);$mots=Preg_replace("~((google|yahoo|bing|yandex|gooofullcom|vizzeo|.?chiadah|find\.eu|ke\.voila|voila|seexie|askpeter|iadah|yougoo|yhs4|ecosia)\.|search;|cx=|goooful|(\.fr)?iadah\.com).*|\.it$~is",'',$mots);
    $trop=explode(',',"_,</a>,< a>,<a href=,refineobj:video,google.ca,google.ci,google.co.uk ,url ,google.fr ,google.com ,search ,hl=en,sa=t,spider.htm");
    $mots=trim(str_replace($trop,'',$mots));#synchronisation des bibliothècas,maintenance
    if(preg_match("~^.(ttp&%2f%2f|ttp:)~is",$mots)or strlen($mots)<3)Null;  
    elseif($_ENV['yt']['mots']==$mots||$_ENV['yt']['fmt']['kw']+600>NOW)null;#dernier keyword < 10 minutes
    else{#Nouveau mot clé
      if(preg_match("~q=([^&]+)~is",$mots,$t))$mots=$t[1];
      IF(Preg_Match_ALL("~".BKW."~i",$mots,$t))Block($t[0],$mots);#blockage de l'IP et throw 404
      if(Preg_Match("~bestof~is",U))$mots='';#cancel
    if($mots){
      #if(!$_ENV['yt']){$_ENV['yt']=Array();DBM('!yt',"<pre>".STARTER."-$mots</pre>",'a6');}$i=$_ENV['yt'];
      $yt2=Array('lw'=>NOW,'date'=>date("Y/m/d H:i:s"),'mots'=>$mots,Array('fmt'=>array('kw'=>NOW)));
      if($_ENV['yt']['mots'])$yt2['mots-1']=$_ENV['yt']['mots'];
      
        #DBM('ggt',"<pre>$mots,".print_r($_ENV['yt'],1).'</pre>','gg9');
      
      if(Preg_Match("~gclid=|aclk\?~is",$_ENV['yt']['ref']))$yt2['adwords']=$mots;#do not log these ones, but store them separetely
      elseif(0){#insertions sql //todo:file_append puis écriture en lots
  $x2=sql5("UPDATE CSF set site='".H."',hits=hits+1,ip='".IP."',time=".NOW.",date=now(),Ref=\"$ref\" $s1 where url=\"".SU."\" and keyword=\"$mots\" order by id ASC limit 1");
  if($x2<1)sql5("INSERT INTO CSF(ip,Ref,site,keyword,url,position,time,date)VALUES('".IP."',\"$ref\",'".H."',\"$mots\",\"".SU."\",'$pos',".NOW.",NOW())");
#INSERT INTO CSF SET key = 'key', generation = 'generation' ON DUPLICATE KEY UPDATE key = 'key', generation = (generation + 1);
      }
      #$_SESSION['st1']=$magic;#$_SESSION['mots']=$mots;
      $magic="$mots;".$_ENV['yt']['dlp'].";".$_ENV['yt']['ref'];
      setcookie('kw',$mots,1484045758);setcookie('dlp',$magic,1484045758);
      }
    }
  if(is_array($yt2)){$_ENV['yt']=Array_merge($_ENV['yt'],$yt2);FAP(IPF,$_ENV['yt']);}redef('motcle',$mots);
}
}
}

function kwd($ref){GT('k2');
  if(Preg_match("~utmctr=([^;|]+)~",$_COOKIE['__utmz'],$t))Return tridecoder($t[1]);#adwords failsafe on cookie
  #if($_ENV['yt']['mots']&&$_ENV['yt']['lw']&&$_ENV['yt']['lw']<(now-120)){$x=FGC(ipf,'mots');if(j9==1)Db("ipfmot:$x");Return $x;}
  
IF(preg_match("~&[q|p]=([^&]+)~i",$ref,$t)){$mots=ask($t);}ELSEIF(Preg_match("~cgi-bin.*x_query=([^&]+)~i",$ref,$t))$mots=$t[1];elseIF(Preg_match("~FORID%3A([^&]+)~i",$ref,$t))$mots=$t[1];elseIF(Preg_match("~fr/go.*/([^/]+)~i",$ref,$t))$mots=$t[1];elseIF(Preg_match("~fr/q/(.*).html~i",$ref,$t))$mots=$t[1];elseIF(Preg_match("~&text=([^&]+)~i",$ref,$t))$mots=$t[1];elseIF(Preg_match("~xeoo.*&k=([^&]+)~i",$ref,$t))$mots=$t[1];ELSEIF(Preg_match("~&(q|p|cx)=([^&]+)~i",$ref,$t))$mots=ask($t);ELSE{$ref=preg_replace('~&(searchfor|eingabe|l|key|text|itag|OVRAW|wd|recherche|rds|rch|data|uery|for|str|ing|qs|qt|req|k|q|p)=~is','MX=',$ref);preg_match_all("~MX=([^&]+)~is",$ref,$t);if($t[1])$mots=str_replace('MX=','',$t[0][0]);}
  if(strlen($mots)>3){
    GT('k3');$mots=trim(Preg_replace("~[ ]{2,}~",' ',str_replace(Array('/','search&q=','http:','http',"\\\'","\\'","\'",'\\',"'",'"','+','-','-','&','|','{','}','(',')',',','...','ggmain.jhtml ','searchfor=',''),' ',$mots)));$mots=Preg_replace("~'|\"|\[|\]~",'',$mots);
  if(is_numeric($mots))Return'';
  Return strtolower(cleankeyword(Tridecoder($mots)));#"@'|\"|[\\]@"
  }
}

function ask($t){Unset($t[0]);asort($t);return end($t);}
function ValidRef($ref){if(strlen($ref)<3 OR Preg_Match("~/domain/|xzxz\.f|frontalier|portail-|-consulting|etasearch|vizzeo|sfr\.fr|moteur\.php|sorry\.|mail\.|free.fr|lo.st.fr|s74.fr|google|209.85.135.104|cooliris|127\.0~is",$ref))return 0;return 1;}##ggtracker

function cleankeyword($x){$x=str_replace(array("\\\'","\\'","\'",'Ã'),array("'","'","'",'à'),$x);$x=ytrim(str_replace(array('*','†','%20','http:','www.','%22','"','...','www.','%c3%a9','&q=','+','%2520','?','|','{','}','(',')','&','/'),' ',$x));return str_replace('  ',' ',$x);}
?>