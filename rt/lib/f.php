<?
class f{
  static $loaded=[];
  function __call($name,$args){
    $name=strtolower($name);
    $f=__DIR__.'/fun.map.json.php';#so apc might cache it
    if(!$_ENV['funmap'] && is_file($f)){
      $_ENV['funmap']=file_get_contents($f);
      $_ENV['funmap.unser']=json_decode($_ENV['funmap'],1);
    }
    if(stripos($_ENV['funmap'],'"'.$name.'"')){
        if(array_key_exists($name,$_ENV['funmap.unser'])){
            $file=str_replace('.php','',$_ENV['funmap.unser'][$name]);
            $loaded[]=$file;
            new $file;#autoloads ..
            if(function_exists($name)){
                return call_user_func('\\'.$name,$args[0]);
            }
        }
    }
    return $this;
  }
}#__call if in array_map -> require_once then return \$name($args[0]
