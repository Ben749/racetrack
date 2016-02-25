<?
/* creates the "functions" map */
class funmap{
  public $var='funmap';
  function map(){
    $cwd=getcwd();chdir(__DIR__);
    #chdir('../rt/lib/');
    $x=glob('*.php');
    foreach($x as $v){
      if(in_array($v,['autoloader.php']))Continue;
      $z=file_get_contents($v);
      $z=preg_replace('~\/\*[^\*]+\*\/~','',$z);
      preg_match_all('~function ([^\( ]+)\(~i',$z,$m);
      if($m[1])
        foreach($m[1] as $v2){
          $v2=strtolower($v2);
          $res[$v2]=$v;
        }
    }
    file_put_contents('fun.map.json.php',json_encode($res));
    chdir($cwd);
    return $res;
  }
}

