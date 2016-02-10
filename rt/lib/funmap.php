<?
class funmap{
  public $var='funmap';
  function map(){
    #chdir('../rt/lib/');
    $x=glob('*.php');
    foreach($x as $v){
      if(in_array($v,['autoloader.php']))continue;
      $z=file_get_contents($v);
      $z=preg_replace('~\/\*[^\*]+\*\/~','',$z);
      preg_match_all('~function ([^\( ]+)\(~i',$z,$m);
      if($m[1])
        foreach($m[1] as $v2){
          $v2=strtolower($v2);
          $res[$v2]=$v;
        }
    }
    file_put_contents('fun.map.sdb',serialize($res));
    return $res;
  }
}

