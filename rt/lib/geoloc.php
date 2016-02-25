<?
#require_once('/z/rt/geoloc.php');geoloc::i();
class geoloc{
  static $date,$plusYear,$ip,$prefix,$f,$instance;
  #self::$var #$this->var
  /** singleton SQL::getInstance() instead of new SQL */
  public static function i(){if(!self::$instance)self::$instance = new self();return self::$instance;}
  function __construct(){$this->geoloc();}#new lance le traitement
  function init(){
      if(!$this->init){
        $this->date=date('Ymd');$this->plusYear=time()+3600*24*356;$this->ip=IP;
        $this->prefix=TMP."/geoloc/";
        $this->f=$this->prefix.'ip.igb';
        $this->ipPerSiteAndDay=$this->prefix.H.$this->date.'.ips.fap';
      }
  }
  
  function geoloc(){
    if(BOTS || H=='cli' || !IP || IP=='127.0.0.0')return;
    $this->init();
    if(!isset($_COOKIE['lastconnexion']) || $_COOKIE['lastconnexion']!=$this->date){
      $x='';
      if(is_file($this->ipPerSiteAndDay))$x=file_get_contents($this->ipPerSiteAndDay);
      if(!strpos($x,$this->ip))file_put_contents($this->ipPerSiteAndDay,"\n".$this->ip,FILE_APPEND);
      setcookie("lastconnexion",$this->date,$this->plusYear,'/');
    }
    if(!$_COOKIE['loc']){setcookie("loc",$this->MaxMind(),$this->plusYear,'/');}//without dying
  }
  
  function rod($val,$dies){if($dies)die($val);return $val;}
  function MaxMind($dies=0){
    $deja=file_get_contents($this->prefix.'maxmind.queried.ips.fap');
    if(strpos($deja,$this->ip)){$x=igbinary_unserialize(file_get_contents($this->f));$x=$x[$this->ip];
    return $this->rod("$x[0],$x[1]",$dies);}
    $x=@file_get_contents('http://geoip1.maxmind.com/b?l=JmgjCCOsPHOO&i='.$this->ip);
    file_put_contents($this->prefix.'maxmind.queried.ips.fap',"\n".$this->ip,FILE_APPEND);    
    if(!$x || strpos($x,'IP_NOT_FOUND'))$x=[0,0];else{$x=explode(',',$x);$x=[$x[4],$x[3]];}
    $this->addIpCoordinates($this->ip,$x);return $this->rod("$x[0],$x[1]",$dies);
  }

  function addIpCoordinates($ip,$cords){
      $x=igbinary_unserialize(file_get_contents($this->f));$x[$ip]=$cords;
      file_put_contents($this->f,igbinary_serialize($x));
  }
  
}
