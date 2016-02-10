<?
function cssrd($p){if($p){if($y=param($p,'&'))extract($y);}$z.="-moz-border-radius:{$r};border-radius:{$r};";echo"$id{ $s $z#behavior:url(/PIE.htc);}";}#rounded
function cssbk($id,$d='',$x='',$y='',$r='',$s='',$n=''){#rounded + grad + pie
  if(strpos($id,'&')){if($y=param($id,'&'))extract($y);}#si injection de paramètres en premier argument
  if($y)$x.=",$y";if($d)$x=$d.','.$x;
  if($r)$z.="-moz-border-radius:{$r};border-radius:{$r};";
  echo"$id{".$s.$z."background:-moz-linear-gradient($x);background:-webkit-linear-gradient($x);background:-webkit-gradient($x);background:-ms-linear-gradient($x);background:-o-linear-gradient($x);background:linear-gradient($x);#-pie-background:linear-gradient($x);#behavior:url(/PIE.htc);}\n";}

function grad($c1,$c2,$dir='top'){$c1=trim($c1,'#');$c2=trim($c2,'#');$c1b=substr($c1,-6);$c2b=substr($c2,-6);
  if(strlen($c1)<7)$a1=$a2='FF';else{$a1=substr($c1,0,2);$a2=substr($c2,0,2);}
  $a1b=$a1;$a2b=$a2;if($a1=='FF')$a1b=100;if($a2=='FF')$a2b=100;
  $a=hex2rgb($c1b).','.($a1b/100);$b=hex2rgb($c2b).','.($a2b/100);
  #if($c1=='00e6e6e6')die("</style>startColorstr='#$a1$c1b',endColorstr='#$a2$c2b'");
  return"background:-webkit-gradient(linear,left $dir,left bottom,from(rgba($a)),to(rgba($b)));background:-moz-linear-gradient(rgba($a) 0%,rgba($b) 100%);background:-ms-linear-gradient($dir,rgba($a) 0%,rgba($b) 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#$a1$c1b',endColorstr='#$a2$c2b',GradientType=0);";
}
?>