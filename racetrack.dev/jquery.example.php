<?
require_once'header.c.php';
echo"<pre>Jquery is not yet loaded but will .. red background , dashed green header\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n</pre>";
require_once'footer.c.php';
?>
<script>
//jquery not yet loaded - wraps anonymous functions, launched once jquery's in
$(function(){$('#headermenu').css({border:'3px dashed #0F0'})});
$(function(){$('body').css({background:'#F00'})});
</script>