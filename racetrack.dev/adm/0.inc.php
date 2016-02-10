<?
redef('ADMIN_USERNAME','user');
redef('ADMIN_PASSWORD','pass');

if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) && $_SERVER['PHP_AUTH_USER'] == ADMIN_USERNAME && $_SERVER['PHP_AUTH_PW'] == ADMIN_PASSWORD); #http auth okay allready provided && okay
elseif(1){Header("WWW-Authenticate: Basic realm=\"racetrack\"");Header("HTTP/1.0 401 Unauthorized");die;}#ask password htpasswd like

else{#ask password with session && form
  session_start();
  if(!$_SESSION['logged']){
    if($_POST['login'] && $_POST['pass'] && $_POST['login']==ADMIN_USERNAME && $_POST['pass']==ADMIN_PASSWORD)$_SESSION['logged']=1;
    else die("<form method=post><input name=login><input name=pass><input type=submit></form>");
  }
}

    