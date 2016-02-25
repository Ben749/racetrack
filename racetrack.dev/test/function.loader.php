<?
$funmapper=new funmap;$funmapper->map();#creates the function map

$f=new f;#global functions loader .. uses the fun.map.sdb
echo $f->funmaptest();
echo":loaded";