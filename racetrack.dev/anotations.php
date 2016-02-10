<?
$anotations=['vars'=>['r304'=>[__FILE__],'version'=>2]];#enables 304 response as the document is not modified, might add other dependancies, a new version overrides the anotation cache path

require_once'../rt/prepend.php';
echo'<pre>'.Date('Y-m-d H:i:s').' <b><= is 304 response when date frozen</b>?';
print_r(compact('a','_SERVER'));die;
