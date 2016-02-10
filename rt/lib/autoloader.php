<?
spl_autoload_register('load1');
function load1($name) {/*__autoload*/
  static $loaded;if(is_array($loaded)&& in_array($name,$loaded))return;
  $f = __DIR__.'/'. $name .".php";
  if(is_file($f)){require_once($f);}#but the globals remains nested here forever ..
  else{
      eval("class {$name} extends notfound{};");#;echo',nf:'.$name;
      #file_put_contents('/home/500.clog',"\n".date('YmdHis').':'.__FILE__.__LINE__.':'.$name,FILE_APPEND);
  }
  $loaded[]=$name;
}


class notfound{
    public $data=[];#fs, mais individuelles
#appels functions not set
    function __call($name,$args){
        #die("\n__CALL:".$name.":\n".print_r(compact('args'),1));
        $name=strtolower($name);
        if(array_key_exists($name,$this->data))return $this->data[$name];#obj->name();
#failsafe for _ method differences
        $name=strtolower(str_replace('_','',$name));
        $matches=[$name,'get'.$name,'set'.$name];
        foreach($matches as $method)
            if(method_exists($this,$method))return $this->$method($args);
#aliases
        $aliases=['gettitre'=>'getnom'];
        foreach($aliases as $souhait=>$exists)
            if($name==$souhait && method_exists($this,$exists))return $this->$exists($args);
#getters, setters not found
        $reste=substr($name,3);
        if(substr($name,0,3)=='get')return $this->$reste;
        if(substr($name,0,3)=='set')$this->$reste=reset($args);
#global namespaces functions
if(in_array($name,['ajoutsessionpubaffiliation','create_centre_fiches_offre_fiche']))return;
if(function_exists($name))return call_user_func('\\'.$name,$args[0]);
#$f=__FILE__.':'.__LINE__;die('<pre>'.print_r(compact('f','name','args'),1));       
       
        return $this;#anyways
    }

    /*private function __construct(){}*/
    function __construct($p=[]){
        if(is_array($p))foreach($p as $k=>$v)$this->$k=$v;#register those parameters if passed
        #$class=static::class;if(!isset(static::$instances[$class]))static::$instances[$class]=$this;else static::$additional[$class][]=$this;
    }#register him anyways, la seconde construction ne sera pas bindée..
}
