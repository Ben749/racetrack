<?
#$f=new f;echo $f->pretitle();
new fun;
if(AJAX)die("{\"success\":true,\"qs\":\"".Q."\"}");#fake ajax responses :)

echo'<html><head>'.str_replace('<pre','</head><body>',pretitle());
?><button onclick='startIntervals()'>Start Intervals</button>
<fieldset id=form>billing:use_for_shipping_yes : <input id='billing-use_for_shipping_yes' type=checkbox>
<fieldset class=sp-methods><legend>Shipping Methods :</legend>
Free shipping : <input id='s_method_freeshipping_freeshipping' type=checkbox>
Shipping Method #2 : <input id='s_method_owebiashipping1_gls' type=checkbox>
<div id=shipping-method-buttons-container><button>SaveShipping</button></div>
</fieldset>
p_method_accountpayment: <input id='p_method_accountpayment' type=checkbox>
I do agree to the terms and conditions: <input id='agreement-1' type=checkbox>

</fieldset>
<div id=output></div>

<script>
var billing=billing || null,shippingMethod=shippingMethod || null;startIntervals.t=0;

function startIntervals(){
  if(startIntervals.t)return;startIntervals.t=1;
  listenAjax();
  
sii(function(){
  billing={save:function(){$.get('?prevStep=billing');}};
  shippingMethod={saveWithColissimo:function(){$.get('?saveShippingMethod');}};
  payment={save:function(){$.get('?prevStep=payment');}};
  review={save:function(){$.get('?confirm');}};//Post action for the complete form  
  return'billing set';},1,'ante2',500);
//waits 0.5s to set the fake loaded object from some json  
  
$(function(){//waits for jquery to be loaded
  
sii(function(){
  jQuery('#output').append("<li>Jquery loaded");
  return'jquery loaded';},function(){if($ && $.fn && $.fn.jquery)return 1;},'isJqueryLoaded ?',10);

sii(function(){
  jQuery('#billing-use_for_shipping_yes').prop('checked',true);
  jQuery('#output').append("<li>billing -> checked");
  billing.save();
  return'billing saved';},

function(){if(!search(sii.ret,'jquery loaded') || !billing || typeof(billing)!='object')return 0;return 1;} ,'i0',100);

sii(function(){//I1
    if(jQuery('#s_method_freeshipping_freeshipping').length)jQuery('#s_method_freeshipping_freeshipping').prop('checked',true);//fdp gratuits
    else jQuery('#s_method_owebiashipping1_gls').prop('checked',true);
    shippingMethod.saveWithColissimo();
    jQuery('#output').append("<li>shipping -> checked");
    return'shipping method ok';
},
function(){//condition
    if(!search(sii.ret,'billing saved') || !shippingMethod || typeof(shippingMethod)!='object')return;
    if(completed.string.indexOf('?prevStep=billing')<0)return;
    spm=jQuery('.sp-methods');if(!spm)return;spm=spm[0];if(!spm)return;$spm=jQuery(spm);if(!$spm)return 0;
    if(
      spm.parentNode/*Check it has a parent :: currently displayed and not replaced */
      && $spm.find('#s_method_owebiashipping1_gls').length && jQuery('#shipping-method-buttons-container').length)return 1;}   ,'i1',100);

sii(function(){//I2
    jQuery('#p_method_accountpayment').prop('checked',true);
    payment.save();
    jQuery('#output').append("<li>payment -> saved");
    return'payment saved';
}
,function(){if(!search(sii.ret,'shipping method ok'))return;return completed.string.indexOf('?saveShippingMethod');}   ,'i2',100);//I2

sii(function(){
  jQuery('#agreement-1').prop('checked',true);review.save();
  jQuery('#output').append("<li>review submitted -> all steps completed");
  return'review submitted';
  },
    function(){
      if(!search(sii.ret,'payment saved') || completed.string.indexOf('prevStep=payment')<0 || completed.string.indexOf('?prevStep=payment')<0)return;
    return jQuery('#agreement-1').length;} ,'i3',100);

});//loads the Jquery thing
    
}//search(ssi.ret,'')object ssi.ret.indexOf
</script>

