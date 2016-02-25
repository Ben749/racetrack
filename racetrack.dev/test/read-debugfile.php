<?
new debug53;
new wunserializer;#since the serialized file was modified :)

if(Q)$q=Q;
else $q='debug.sdb';
if(!is_file($q))die('not a file : ' .$q);

$debug=file_get_contents($q);
$debug=fix_serialized($debug);
wUnserializer($debug);#need two unserialization passes
?><style>body{background:#000;color:#EEE;}pre{white-space:pre-wrap}
body{background:#000;color:#FFF;}
.mar{display:inline-block;border:1px dashed rgba(255,0,0,0.2);margin-left:5px;padding-left:5px;}
.s30{background:#fff;color:#000;}.s28{background:#eee;color:#000;}.s26{background:#ddd;color:#000;}.s24{background:#CCC;color:#000;}.s22{background:#BBB;color:#000;}.s20{background:#AAA}.s18{background:#999}.s16{background:#888}.s14{background:#777}.s12{background:#666}.s10{background:#555}.s8{background:#444}.s6{background:#333}.s4{background:#222}.s2{background:#111}  
</style><pre><?
#print_r($debug);die;
die(debug2html($debug));#that's one function