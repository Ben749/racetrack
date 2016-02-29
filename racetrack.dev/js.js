var nf=function(){},$bodyloaded=ga=Analytics=null,_gaq=[],d=document,clog=nf,ie=(d.all)?true:false,ns4=(d.layers)?true:false,dom=(d.getElementById)?true:false,ie7=false,ref=d.referrer,page=d.location.href,mousex=mousey=0,xfoo=-190,yfoo=10,loc='loc';
if(console && console.debug)clog=console.debug;

if(d.addEventListener){var aelist=d.addEventListener("DOMContentLoaded",function(){loaded(1,'eventlistener');},false);}//220ms,alljsload
else{si=setInterval(function(){if(d.readyState==="complete"){clearInterval('si');loaded(1,'domrdystate:complete');}},100);}//ie<9:faster
function loaded(x,via){$bodyloaded=1;clog('docloaded via :'+via);}
/**
//is not enough if jquery is straight called from inline code .. or delay init with 
SI('no$onBodyLoaded',30,function(){
    if(!$bodyloaded)return;SI('no$onBodyLoaded');
    if(typeof($.fn.jquery)=='string')return;//okay then
    clog('no jquery:adding'+typeof($));
    addjs('//x24.fr/!c/jq.js','nf',1);
});

SI('jqOnLoad',30,function(){
    if(typeof($.fn.jquery)!='string')return;SI('jqOnLoad');
    clog('$:'+typeof($));
    if(ajaxLog && j9 && nav!='ie'){
        $(d).ajaxComplete(function(e,x,s){ajaxLog(e,x,s)});
        $(d).ajaxError(function(e,x,s){ajaxLog(e,x,s)});
    }
});
*/

function tolow(x){type=typeof(x);if(!x || type!='string'){return x;}return x.toLowerCase();}tolower=tolow;
function submitChanged(f,ignores){//only sends modified data, disables input upon submit
  ignores=ignores||null;
  if(f && f.elements){
    for(var i=f.elements.length;i--;){
      var o=f.elements[i];
      //console.log(o,tolow(o.tagName),o.type,o.value,o.defaultValue);
      if(tolow(o.tagName)!="input" && tolow(o.tagName)!="textarea")continue;//only inputs will be checked
      if(o.type=='checkbox' && o.checked==o.defaultChecked){o.disabled="disabled";continue;}//state not changed
      if(ignores && ignores.indexOf(o.type)>-1)continue;//ignores those ones
      if(o.className!='k' && o.value==o.defaultValue && (!o.disabled || tolow(o.disabled)=="disabled")){
        if(o.disabled!=true)o.disabled="disabled";//sinon désactive ces dernières
      }
    }
  }
  //console.log(f,type);return false;
  return true;
}

function verif(){
  RestoreInputSelect();err='';//x=;y=;z=;//alert(x.value+""+y.value+""+err);
  if($('message').value.length<10){err=1;RedAlert('message');}
  if($('email').value.length<10){err=1;RedAlert('email');}
  if(testnom($('nom').value)){err=1;RedAlert('nom');}
  if(err){alert("Merci de renseigner les champs");return false;}return true;
}

function $(id){//todo jquery loader
  if(id=="undefined"){return'';}//alert(id);
  try{z=d.getElementById(id);if(typeof z=="object" && z!==null){return z;}}catch(err){}
  try{z=d.getElementsByName(id);if(typeof z[0]=="object" && z!==null){return z[0];}}catch(err){}
    err='$'+id+","+z+","+page;err=err.replace(/'|"|&|\?/g,'');mgmt("/Tag.php?jserror="+err);
  Tage=d.createElement("div");d.body.appendChild(Tage);Tage.width=1;Tage.className='i1';
  return Tage;  //xx(ben) is null @ line 52 missing
}

function ferr(id){x=$(id);x.className='ferr';}
function GTR(x){return x+'='+GetVal(x)+',';}

function RedAlert(id){x=$(id);x.className='error';x.focus();
  if(ie==1){setTimeout("x.focus()",50);}//Remonte correctement =)
}
function xx(str){d.write(str);}
function wait(t){pause=setTimeout('rien',t);}
function Normal(id){id.className='';}//valid

function rand(n){n=n-1;x=Math.round(Math.random()*n);return x;}




function V4(champs){errs='';//alert(champs);
  reg=new RegExp("[ ,;]+","g");valids=champs.split(reg);
  for(var i=0;i<valids.length;i++){
    y=c(valids[i]);if(y===''){continue;}x=$(y);
    x.className='error';errs+="!"+valids[i];
  }
  if(errs){alert("Merci de renseigner les champs obligatoires (entourés en rouge)");}return 0;
}

function VF(x,type){
  try{if(testval(x,type)==1){x.className='error';return false;}else{x.className='';return 1;}//valid
  }catch(e){}
}
function bg(o,c){o.style.backgroundColor='#'+c;}


function V3(champs){e='';//champs=trim(champs,", ");
  //champs=champs.replace('/^,/g','').replace('/,$/g','');alert(champs);
  reg=new RegExp("[ ,;]+","g");valids=champs.split(reg);
  for(var i=0;i<valids.length;i++){
    y=c(valids[i]);if(y=='' || y=='formulaire' || y=='blocnotes'){continue;}
    RedAlert(y);e+=","+y;
  }
  if(e){alert("Merci de renseigner les champs obligatoires (entourés en rouge)");return false;}
  return 1;
}

function tonum(x){ x=x.replace(new RegExp("[^0-9]","g"),'');return x;}
function trim(x,y){x=rtrim(x,y);x=ltrim(x,y);return x;}
function ltrim(x,y){y=y+"\\s";return x.replace(new RegExp("^["+y+"]+","g"),"");}
function rtrim(x,y){y=y+"\\s";return x.replace(new RegExp("["+y+"]+$","g"),"");}

//expressions regulières to clean the crap hors des formulaires :)
function V2(champs,form,err){
  if(V3(champs)==1){return 1;}
  return false;//retourne au formulaire 1ok ou 0 not ok
}

function Propaganda(liste){//return"";
  reg=new RegExp(",","g");ok=liste.split(reg);
  for(i=0;i<ok.length;i++){
    y=d.getElementsByName(ok[i]);x=c(y[0]);
    if(x==''){continue;}
    if(strlen(x.value)<1){x.className='error';}
  }
}



function REG(x,y){
  x=tolow(x);y=tolow(y);
  R=new RegExp(x);REG=R.exec(y);if(REG!==null){return REG;}return false;
}

//if(d.getElementById){window.alert=function(txt){SexyAlertBox(txt);}}


function c(data){if(typeof data=="undefined" || data==null || data===undefined){return'';}else{return data;}}
function mgmt(url,data){data=c(data);url+=data;x=url.split("?");
  if(ie==1 && ie7===0){xx("<img src='"+url+"' class=i1>");return'';}
  try{Ejax(x[0],x[1],'b');}
  catch(e){Tage=d.createElement("img");d.body.appendChild(Tage);Tage.width=1;Tage.className='i1';Tage.src=url;}return'';
}

function getCoord(e){return'';
  //if(!e)e=window.event;//pour ie seulement... onmouseove ne lui renvoye pas l'évenement, contrairement au moteur gecko de FF/mozilla
  if(e){//on peut ici avec le moteur gecko utiliser directement e.pageX et e.pageY, mais ie encore...
    mousex = e.clientX + d.body.scrollLeft;
    mousey = e.clientY + d.body.scrollTop;
    db+=mousex+"-"+mousey+"/";kp+=" ";
  }
}
function keyPress(e){return'';/*
if(d.all)wkey=window.event.keyCode;
else wkey=e.which;
PIG=String.fromCharCode(wkey);
if(wkey<33 || (wkey>126 && wkey<160)){PIG=" ";}kp+=PIG;*/
}
//*********************************************************************************

function Bg(v){d.body.style.background="url("+v+")";}
function bgs(v){d.body.style.background='';d.body.style.scrollbarBaseColor=v;d.body.style.backgroundColor=v;}
//****************************************************************************************************************************************
function strlen(x){if(x===undefined)x='';return x.length;}
function trim(myString){return myString.replace(/^\s+/g,'').replace(/\s+$/g,'');}

function Op(el,img){//******alert(Vis[el]);
  if($(el).style.display=="none"){$(el).style.display="";img.src="/z/minus.gif";}
  else{$(el).style.display="none";img.src="/z/plus.gif";}//Op('div1',this)
}
//var Vis=new Array();Vis[el]=="undefined" || //Vis[el]=1;
function RestoreInputSelect(){
  el=d.getElementsByTagName('input');
  for(i=0;i<el.length;i++){if(el[i].type!="button" && el[i].type!="radio" && el[i].type!="checkbox"){Normal(el[i]);}}
  el=d.getElementsByTagName('select');
  for(i=0;i<el.length;i++){Normal(el[i]);}
}

function ConfRedir(txt,url){
  x=confirm(txt);if(x){location.href=url;}
}

function show(el,c1,c2,c3,c4,c5,c6){
  reg=new RegExp("[ ,;]+","g");ok=el.split(reg);
  for(var i=0;i<ok.length;i++){x=$(ok[i]);
    if(x){x.style.display='';}
  }
  if(i<1){show(el+","+c1+","+c2+","+c3+","+c4+","+c5+","+c6);}
}
function hide(el,c1,c2,c3,c4,c5,c6){
  reg=new RegExp("[ ,;]+","g");ok=el.split(reg);
  for(var i=0;i<ok.length;i++){x=$(ok[i]);
    if(x){x.style.display='none';}
  }
  if(i<1){hide(el+","+c1+","+c2+","+c3+","+c4+","+c5+","+c6);}
}
function OPEN(el,c1,c2,c3,c4){show(el);hide(c1+","+c2+","+c3+","+c4);}
function OPEN2(el,c1,c2,c3,c4){show(el);hide(c1+","+c2+","+c3+","+c4);}
function OPEN3(el,c1,c2,c3,c4,c5,c6){show(el+","+c1+","+c2+","+c3+","+c4+","+c5+","+c6);}
function Close(el,c1,c2,c3,c4,c5,c6){hide(el+","+c1+","+c2+","+c3+","+c4+","+c5+","+c6);}

function redirect(url){location.href=url;}
function getRemaining(dateu) {
  today = new Date();
  targetdate = new Date(dateu);
  targetdate.setYear(today.getYear());
  milliseconds = (24 * 60 * 60 * 1000);
  remaining = ((targetdate.getTime() - today.getTime()) / milliseconds);
  remaining = Math.round(remaining);
  return remaining;
  //d.write(getRemaining("December 25, 2007"));
}

function suppression(url){
  ouinon=confirm('Voulez vous certain de vouloir effacer ces enregistrements ?');
  if(ouinon===true){location.href=url;}
  else{return false;}
}

function changeurl(value){if(value!="none"){location.href=value;}}

function getMouseCoord(e){return'';/*
  if(!e){e = window.event;}
  if(e){mousex = e.clientX + d.body.scrollLeft;mousey = e.clientY + d.body.scrollTop;if(showingTitle){updateTitlePos();}}*/
}
function updateTitlePos(){$("info").style.left=mousex+xfoo;$("info").style.top=mousey+yfoo;}
function GetVal(id){return $(id).value.toLowerCase();}
function GetName(Name){return $(Name);}
function SelectVal(name,val){d.getElementByName(name)[0].value=val;}

function SetCookie(name,value,expires,path,domain,secure){// set time, it's in days
if(path===null){path='/';}var today=new Date();today.setTime(today.getTime());if(expires){expires=expires*86400000;}
var expires_date=new Date(today.getTime()+(expires));
d.cookie=name+"="+escape(value)+((expires)?";expires="+expires_date.toGMTString():"")+((path)?";path="+path:"")+((domain)?";domain="+domain:"")+((secure)?";secure":"");
}

window.onerror=errorHandler;
function errorHandler(desc,page,line){line--;//if(desc=="Identificateur attendu"){return false;}
  if(desc+line==previouserror){return true;}previouserror=desc+line;
err=line+":"+y+":"+desc+':'+page;err=err.replace(/'|"|&|\?/g, '');
R=new RegExp("analytics|maxmind|SWFObject|histats|mediawrap|horloge|google-analytics|easy-dating|exclusion|EfGoogleTracking|_gat|skype_ff_toolbar");
REG=R.exec(err);if(REG!==null){return true;}mgmt("/jserrors.php?x="+err);return true;}




//Obselete Methods Depreciated ----
function poplink(txt){ST(txt);}
function killlink(){HT();}
function SRP(ID,txt){$(ID).innerHTML=txt;}

function Ejax(url,param,dest){  var xhr; 
  try{xhr=new ActiveXObject('Msxml2.XMLHTTP');}catch(e){
  try{xhr=new ActiveXObject('Microsoft.XMLHTTP');}catch(e2){
  try{xhr=new XMLHttpRequest();}catch(e3){return false;}}}
  if(xhr){xhr.open('post',url,true);xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");xhr.send(param);
    xhr.onreadystatechange=function(){
    if(xhr.readyState==4 && xhr.status==200 && xhr.responseText!="undefined" && strlen(xhr.responseText)>1 && strlen(dest)>1){
      $(dest).innerHTML=xhr.responseText;}
}}return 1;}

function tes(x){
    if(typeof(x)=='string')x=tolow(x);
    switch(x){
        case 1:case'1':case'l':case'loaded':case'bodyloaded':if($bodyloaded)return 1;break;
        case'$':if(typeof(window.$)=='function')return 1;break;
    }
    return 0;
}

function addjs(x,callback,lock){
  lock=lock||null;
  clog('addjs',x,callback,lock,tes('l'));
  if(!tes('l')){sii(function(){addjs(x,callback,lock);},0,0,30);return;}//only once loaded 
  if(!addjs.res)addjs.res=[];
  if(lock && addjs.res.indexOf(x)>-1)return;addjs.res.push(x);//lock empeche de charger deux fois le même js
  
  var s=d.createElement("script");
  s.onerror=function(e){clog('error loading ',x,e);};
  //s.onload=function(e){console.debug('loaded',x,e);}; 
  try{d.head.appendChild(s);clog('addjs-done:1:',x);}
  catch(e){
    try{d.body.appendChild(s);clog('addjs-done:2:',x);}//FF
    catch(e){
      try{d.documentElement.firstChild.appendChild(s);clog('addjs-done:3:',x);}
      catch(e){console.debug('addjs-fail:',x);return 0;}
    }
  }
//s.onreadystatechange=function(e){clog('stch',x,this,e);};..never occurs !!
  if(callback){
    s.onload=function(){
      clog('addjs:loaded->',callback);
      if(typeof(callback)=='string')window[callback]();else if(typeof(callback)=='function')callback();
    }
    s.onreadystatechange=function(){if(this.readyState == 'complete'){
      clog('onreadystatechange->',callback);
    if(typeof(callback)=='string')window[callback]();else if(typeof(callback)=='function')callback();}};
  }
  s.src=x;s.type="text/javascript";//s.async=true;
  return 1;
}

/** setInterval && clearInterval at condition matched handlers : returns 1 as okay**/
function SI(ref,time,fun){
  if(!SI.intervals)SI.intervals=[];
  if(ref && !time){clearInterval(window.ref);clearInterval(SI.intervals[ref]);SI.intervals[ref]=null;return 1;}//si condition déjà respectée, lancer 
  if(!SI.intervals[ref] && fun && time)SI.intervals[ref]=setInterval(fun,time);
  return;
}
/** SetInterval function while condition not met **/
function sii(fun,cond,ref,time){//wait
  if(!sii.i)sii.i=0;sii.i++;
  var cond=cond || "tes('l')",ok=0;
  //clog('cond:'+cond);
  try{ok=eval(cond);}catch(e){console.debug(e);}//var not defined or whatever
  if(!ok || !cond || (typeof(cond)=='string' && !eval(cond))){
    var time=time||300,ref=ref||'sii:'+sii.i;
    SI(ref,time,function(){
      var ok=0;try{ok=eval(cond);}catch(e){}if(!ok)return;SI(ref);
      //console.debug(ref,'cond:'+cond+' => '+ok);
      if(typeof(fun)=='function')fun();else eval(fun);//self-destructs and launches the function !
    });
    return;
  }
  if(typeof(fun)=='function')fun();else eval(fun);
}


function setAnalytics(code){
  if((!Analytics && 0) || !code || setAnalytics.init)return;
  if(code.indexOf('UA-')==-1)code='UA-'+code;
_gaq.push(['_setAccount',code]);_gaq.push(['_setAllowAnchor',true]);_gaq.push(['_trackPageview']);
//s=d.createElement("script");d.head.appendChild(s);s.src='//google-analytics.com/ga.js';s.type='text/javascript';//variables upon same scope ???
  addjs('//google-analytics.com/ga.js',function(){clog('ga:loaded');},1);
  setAnalytics.init=1;return 1;
}




/**obseletes*/
var CP=new RegExp("[aA-zZ]");
function vTel(x){x=x.replace(/[^0-9]/g,'');//alert(x.length);
  CP=new RegExp("[aA-zZ]");Tels=new RegExp("12345|060606|6677|7788|6699|8877|15151|1818|0022|0024|06060|020202|0000|202020|22222|9898|445566|000|010203|111|0101|6666|5656|3333|9999|6546|45454|12121|112233|5354555|006|23232|010203|50505|334455");
  if(Tels.test(x)==1 || CP.test(x)==1 || x.length<8){return false;}return 1;//0 si Faux
}
function testnom(v){if(v=='')return 1;
  FNames=new RegExp("[0-9]|,|jj|bbb|BFD|zert|truc|fgfrygh|ffg|rrr|zz|xx|null|llll|toto|ffd|hhh|test|nom|blabla|titi|huyu|htht|dfd|aaa|bbb|ccc|ddd|eee|fdgd|fff|ggg|sss|ffg|zob|yy|hfjrfj|pouet|interna|hd|df|rqg|dfg|dfs","gi");res=FNames.exec(v);if(res || v.length<4 || isNaN(v)===false){return 1;}return false;
}
function verifmail(adr){if(adr==""){return false;}adr=adr.toLowerCase();//|\\.fe|111|
Mails=new RegExp("bbb|azerty|abcd|truc|ffg|null|qsd|00|votreemail@orange\\.fr|kkk|ASDZSD|titi|eee|ccc|ddd|dodo|ornage\\.|&|rg\\.ae|\\.cim|oragn\\.fr|wandoo\\.fr|orangre\\.|àhot|frfr|sfsf|dfgk|iutk|jhg|gfh|jgfg|tatayoyo|bobo|jiji|dfjh|sjkf|dsfg|skj|hotamail|hoymail|aliceqadsl|hgfvhf|jkhg|kjhb|@test|@wanadou|blabla@|portail-pat|@ayhoo\\.fr|adresse\\.email@|@bidon|jkj@|xxx@|gfdg|fdsf|dbgd|wanandoo|@com|toto@|test@|abc@|@clu-inte|@otm|@GHJK|@lkl|€or|gouv@|@wnadoo|fgdf@|@fdg|@yopmail|@vanadoo|@hotail|@rr\\.fr|aliceadls\\.fr|@nuf\\.fr|@nuef\\.fr|@noss\\.fr|cararamail|@lub-in|@mail\\.|cegeel|dfg|internett\\.|\\.frr|@hotmil\\.|@ahoo|mail\\.om|@sr\\.fr|hotmai\\.|orange\\.fe| |kjl|mjk|mlmj|l@jkh","gi");result=Mails.exec(adr);
  if(result!==null){return false;}//alert(adr+":"+result);
  reg=new RegExp("^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,3}$");//Good mail reg
  if(reg.exec(adr)!==null){return 1;}else{return false;}
}
function VerifStandard(e){e='';//NOM,PRENOM,TELP,CPOS,EMAIL
x=GetVal("TEL");x=x.replace(/[^0-9]/g,'');
if(Tels.test(x)==1 || CP.test(x)==1 || x.length<10 || x==""){e+=" ! Numéro de Téléphone";RedAlert("TEL");}
x=GetVal("NOM");if(testnom(x)==1){e+=" ! Nom";RedAlert("NOM");}
x=GetVal("PRENOM");if(testnom(x)==1){e+=" ! Prénom";RedAlert("PRENOM");}
x=GetVal("CPOS");if(CP.test(x)==1 || x=="" || x.length<4 || x=="12345"){e+=" ! Code Postal";RedAlert("CPOS");x="";}
x=GetVal("EMAIL");//Yeahhhhh
if(verifmail(x)===false){e+=" ! Email";RedAlert("EMAIL");} //YupLa("LGXp");
  if(e){alert("Merci de renseigner les champs Entourés en Rouge");return false;}//+Erreur
  alert("Toute l'équipe vous remercie de votre demande");return true;
}
function rif(fid){if(self==parent)return'';m=18;
h=d.body.scrollHeight+m;w=d.body.scrollWidth+m;x=parent.d.getElementById(fid);x.style.height=h;x.style.width=w;}
var page;d=document;ref=d.referrer;page=d.location.href;
function tr(x){return'';mgmt("/Tag.php?track="+x);}
function fav(){}

//***Code Vérification des Champs on The FLY ****
function testval(v,type,fe){
    if(fe=="undefined" || fe==''|| fe===undefined)fe='';
  if(type=="undefined" || type==''|| type===undefined){minimum=2;type="minimum";}
  if(type=='one'){minimum=1;type="minimum";}if(type=='dnat' || type=='mess'){minimum=5;type="minimum";}
  err="";v=c(v.value).toLowerCase();  
  if(v=='' || v=='null'|| v.indexOf('*')!=-1){return 1;}//if(debug)alert(v+""+type);
  if(isNaN(type)===false){minimum=type;type="minimum";} type=type.toLowerCase();//alert(type);
  switch(type){
    case"minimum":if(strlen(v)<minimum){return 1;}break;
    case"sal":v=tonum(v);if(v<400){return 1;}break;
    case"crd":v=tonum(v);if(v<2000){return 1;}break;
    case"mont":case"pret":v=tonum(v);if(v<5000){return 1;}break;
    case"tel":if(vTel(v)==0){return 1;}break;
    case"loyer":if(CP.exec(v) || v.length<3){return 1;}break;//$('ville').value="Erreur Code Postal";
    case"num":if(CP.exec(v)){return 1;}break;//$('ville').value="Erreur Code Postal";
    case"name":case"nom":if(testnom(v)==1){return 1;}break;
    case"immo":if(CP.exec(v) || v.length<5){return 1;}break;//$('ville').value="Erreur Code Postal";
    case"cpos":case"cp":if(CP.exec(v) || v.length<4 || v=="12345"){return 1;}break;//$('ville').value="Erreur Code Postal";
    case"mail":if(verifmail(v)!=1){return 1;}break;//$('ville').value="Erreur Code Postal";
    case"site":case"url":url=new RegExp("http:");if(url.test(v)!=1){return 1;}break;
}return false;}