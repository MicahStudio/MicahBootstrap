<?php 
/*
Template Name: 广告
*/
function lazyloadAd(){ ?>
	<!--ad lazyload-->
<script id="bdlike_shell"></script>
<script>
var bdShare_config = {
	"type":"medium",
	"color":"blue",
	"uid":"626946",
	"likeText":"有用",
	"likedText":"谢谢",
	"share":"yes"
};
document.getElementById("bdlike_shell").src="http://bdimg.share.baidu.com/static/js/like_shell.js?t=" + Math.ceil(new Date()/3600000);
</script>
	<div id="baiduads" style="display:none"> 
		<script type="text/javascript">/*250*250，创建于2012-5-13*/ var cpro_id = 'u893848';</script><script src="http://cpro.baidu.com/cpro/ui/c.js" type="text/javascript"></script>
	</div>	
	<div id="nuffnangads" style="display:none"> 
		<!-- nuffnang -->
		<script type="text/javascript">
		nuffnang_bid = "1430e0cc4854252206c25549ea9646ad";
		document.write( "<div id='nuffnang_sq'></div>" );
		(function() {	
		var nn = document.createElement('script'); nn.type = 'text/javascript';    
		nn.src = 'http://synad2.nuffnang.com.cn/sq2.js';    
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(nn, s.nextSibling);
		})();
		</script>
		<!-- nuffnang-->
	</div>
	<div id="alivvads" style="display:none">
		<a href="http://www.alivv.com/?uid=YHulVQpEztk=" target="_blank"><img src="http://www.alivv.com/union/alivv_250x250.jpg" alt="阿里微微" style="border:0;"/></a>
	</div>
	<div id="alimamas" style="display:none">
		<!-- alimama -->
		<script type="text/javascript">
		     document.write('<a style="display:none!important" id="tanx-a-mm_27766252_2407978_13198887"></a>');
		     tanx_s = document.createElement("script");
		     tanx_s.type = "text/javascript";
		     tanx_s.charset = "gbk";
		     tanx_s.id = "tanx-s-mm_27766252_2407978_13198887";
		     tanx_s.async = true;
			    tanx_s.src = "http://p.tanx.com/ex?i=mm_27766252_2407978_13198887";
			    tanx_h = document.getElementsByTagName("head")[0];
			    if(tanx_h)tanx_h.insertBefore(tanx_s,tanx_h.firstChild);
		</script>
		<!-- alimama -->
	</div>
<?php if(is_singular()){ ?>	
	<script id="bdlike_shell"></script>
<?php } ?>
	<script type="text/javascript"> 
		//延迟baiduad
		if(document.getElementById("baiduad")!= null){document.getElementById("baiduad").innerHTML = document.getElementById("baiduads").innerHTML};
		if(document.getElementById("nuffnangad")!= null){document.getElementById("nuffnangad").innerHTML = document.getElementById("nuffnangads").innerHTML};
		//延迟alivv
		if(document.getElementById("alivvad")!= null){document.getElementById("alivvad").innerHTML = document.getElementById("alivvads").innerHTML};
		//延迟阿里妈妈
		if(document.getElementById("alimama")!= null){document.getElementById("alimama").innerHTML = document.getElementById("alimamas").innerHTML};
		<?php if(is_singular()){ ?>	
		//baidu分享
		var bdShare_config = {
			"type":"medium",
			"color":"blue",
			"uid":"626946",
			"share":"yes"
		};
		document.getElementById("bdlike_shell").src="http://bdimg.share.baidu.com/static/js/like_shell.js?t=" + new Date().getHours();		
		<?php } ?>
	</script>
	<!--end ad lazyload-->	
	<script type="text/javascript">
	$(document).reader(function($){
		$("img").lazyload({
			placeholder : "<?php bloginfo('template_url');?>/images/loading.gif",
			effect : "fadeIn"
		});
	});
	</script>
<?php 
}
 ?>