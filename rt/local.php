<?#here are your local settings
#redef('J9',($_COOKIE['J9']=='your secret user agent key or cookie',?1:0);
redef('J9',strpos($_SERVER['USER_AGENT'],'your secret user agent key or cookie')?1:0);

redef('ADMIN_USERNAME','user1');
redef('ADMIN_PASSWORD','pass1');