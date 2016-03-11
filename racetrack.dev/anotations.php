<?$f=new f;
$anotations=['vars'=>['r304'=>[__FILE__],'version'=>2]];#enables 304 response as the document is not modified, might add other dependancies, a new version overrides the anotation cache path
#require_once'../rt/prepend.php';
require_once'header.c.php';
echo'<pre>'.Date('Y-m-d H:i:s')." <b><= would be a 304 response when date frozen</b>- clear cache to skip 304 response\n";
print_r(compact('a','_SERVER'));
echo"</pre>";
require_once'footer.c.php';
$f->kill();die;
