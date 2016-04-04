<?
#consumes 2 list files and tries downloading missing files over http, could also be some scp command injected via shell_exec or directly bash script
$basepath='/home/devsite/';#base local path
#find $basepath/media > media.prod.list;#1
$prodlist=$basepath.'media.prod.list';
#find $basepath/media -type f > medias.list;#2
$devlist=$basepath.'medias.list';
$distantDomain='http://productionwebsite.com/';
/**********************************************/
new fun;
pretitle(1);#assumes : +ob_start();
if(!is_file($prodlist) or !is_file($devlist))kill("missing parameters");


$copied=[];
$lf=__file__.'.log';
$a=explode("\n",fgc($prodlist));
$b=explode("\n",fgc($devlist));
$missing=array_diff($a,$b);

$c=['a'=>count($a),'b'=>count($b),'missing'=>count($missing)];
out($c,$lf);

foreach($missing as $url){
  if(strpos($url,'.')===FALSE)Continue;
  $targetFile=$basepath.$url;#str_replace(' ','%20',$url);
  if(is_file($targetFile)){out("\nallready copied:$url",$lf);continue;}  
  $x=@file_get_contents($distantDomain.$url);/*htaccesses : ahaha */
  if(!$x){out("\nMissing:$url",$lf);continue;}
  mkdirs($targetFile);#mkdirs($url,'/home/ecdist/');
  $ok=file_put_contents($targetFile,$x);
  if($ok){
    $copied[]=$url;
    out("\nCopied:$url",$lf);
  }
}

if($copied){
#appends to the local dev list of files :)
  file_put_contents($devlist,"\n".implode("\n",$copied),FILE_APPEND);
}

#print_r($missing);