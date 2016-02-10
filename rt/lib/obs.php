<?
class obs{}
if(!function_exists('igbinary_serialize')){
  function igbinary_serialize($x){return serialize($x);}
  function igbinary_unserialize($x){return unserialize($x);}
}