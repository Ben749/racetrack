<?
if(!function_exists('ereg_replace')){#php7 compactibility :)
  function ereg_replace($x,$y,$s){$x=trim($x,'~');return preg_replace("~".$x."~s",$y,$s);}
  function eregi_replace($x,$y,$s){$x=trim($x,'~');return preg_replace("~".$x."~is",$y,$s);}
  function ereg($p,$s,$m=null){$p=trim($p,'~');preg_match("~".$p."~s",$s,$m);if(!$m)return;return $m;}
  function eregi($p,$s,$m=null){$p=trim($p,'~');preg_match("~".$p."~is",$s,$m);if(!$m)return;return $m;}
  function split($x,$y){return explode($x,$y);}
}
if (function_exists('xdebug_disable')) {
 xdebug_disable();
}