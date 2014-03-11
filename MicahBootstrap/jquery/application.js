var i = 0, got = -1, len = document.getElementsByTagName('script').length;
while ( i <= len && got == -1){
	var js_url = document.getElementsByTagName('script')[i].src;
			got = js_url.indexOf('application.js'); i++ ;
}
wp_images_url = js_url.substr(0, js_url.indexOf('application.js')).replace('jquery','images');
function grin(tag) {
	var $comment = $('#comment');
	tag = ' '+tag+' ';
	if(!comment)return;
	if(document.selection){
		comment.focus();
		sel = document.selection.createRange();
    	sel.text = tag;
		comment.focus();
	}else if(comment.selectionStart || comment.selectionStart == '0'){
		var startPos = comment.selectionStart;
		var endPos = comment.selectionEnd;
		var cursorPos = endPos;
		comment.value = comment.value.substring(0, startPos)
					  + tag
					  + comment.value.substring(endPos, comment.value.length);
		cursorPos += tag.length;
		comment.focus();
		comment.selectionStart = cursorPos;
		comment.selectionEnd = cursorPos;
	}else{
		comment.value+=tag;
		comment.focus();
	}
}
$(function(){
	var $window = $(window);
    // Disable certain links in docs
	$('section [href^=#]').click(function (e) {
		e.preventDefault();
	});
	$('.wp-caption.aligncenter').wrap(function(){
		return '<div class="row-fluid" style="margin:10px 0px;"></div>';
	}).addClass('span8 offset2 thumbnail').removeAttr('style');
	
	$('.comment-author,.add-on,#toolbar,#copyright,#boottom-toolbar,input').tooltip({
      selector: "a[data-toggle=tooltip]"
    });
	if(navigator.userAgent.toLowerCase().match(/msie ([\d.]+)/)){
		$('article.content object').wrap(function(){
			return '<div class="row-fluid" style="margin:10px 0px;"><div class="span10 offset1"></div></div>';
		}).addClass('thumbnail');
	}else{
		$('article.content object embed,article.content embed').wrap(function(){
			return '<div class="row-fluid" style="margin:10px 0px;"><div class="span10 offset1"></div></div>';
		}).addClass('thumbnail');
	}
	$('#comments_pages ul .page-numbers').wrap(function(){
		return '<li></li>';
	});
	$("img.avatar").lazyload();
	$('.post-edit-link').addClass('btn');
	$('article a[href$=".jpg"],article a[href$=".jpeg"],article a[href$=".png"],article a[href$=".gif"],a.colorbox').colorbox();
	$("div.gallery a").colorbox({rel: 'gal', title: function(){
		var url = $(this).attr('href');
		return '<a href="' + url + '" target="_blank">查看原图</a>';
	}});
	$('a.download').addClass('btn btn-warning').prepend('<i class="icon-download-alt"></i>&nbsp;');
	$('a#up').click(function(){
		$('html,body').animate({scrollTop:'0px'},650);
	});
	$('a#down').click(function(a){
		$('html,body').animate({scrollTop:$('#footer').offset().top},650);
	});
	$('a#to_comments').click(function(a){
		$('html,body').animate({scrollTop:$('#comments').offset().top},650);
	});
	$('a#to_respond').click(function(a){
		$('html,body').animate({scrollTop:$('#respond').offset().top},650);
	});
	$('#commentform').submit(function(){
		$('#commentSubmit').attr('disabled','disabled');
		$('#comment_tooltip').tooltip('destroy');
		$('#comment_tooltip').tooltip({animation:true,placement:'top',title:'<img src="'+wp_images_url+'/loading.gif" />',trigger:'focus',html:true});
		$('#comment_tooltip').tooltip('show');
		$.ajax({
			url:$(this).attr('action'),
			type:$(this).attr('method'),
			data:$(this).serialize(),
			success:function(data,status,xhr){
				$('#comment_tooltip').tooltip('destroy');
				$('textarea').each(function() {this.value = ''});
                var num = 1;
                var parent = document.getElementById('comment_parent');
                var temp = document.getElementById('wp-temp-form-div');
                var respond = document.getElementById('respond');
                var cancel = document.getElementById('cancel-comment-reply-link');
                new_comment_html = (parent == '0')?('<ul style="clear:both;" class="commentlist unstyled" id="new_comment_' + num + '"></ul>'):('\n<ul class="children" id="new_comment_'+num+'"></ul>');
                $('#respond').before(new_comment_html);
				$('#new_comment_' + num).hide().append(data);
				$('#new_comment_' + num).fadeIn(2000);
				num++;
				document.getElementById('comment_parent').value = '0';
				cancel.style.display = 'none';
				cancel.onclick = null;
				if ( temp && respond ) {
					temp.parentNode.insertBefore(respond, temp);
					temp.parentNode.removeChild(temp)
				}
				waitSubmit();
			},
			error:function(request){
			$('#commentSubmit').removeAttr('disabled')
				$('#comment_tooltip').tooltip('destroy');
				$('#comment_tooltip').tooltip({animation:true,placement:'top',title:$(request.responseText).prevAll().first().text(),trigger:'focus',html:true});
				$('#comment_tooltip').tooltip('show');
				setTimeout(function(){$('#comment_tooltip').tooltip('destroy');},3000);
			}
		});
		return false;
	});
});
var wait = 13,stext = $('#commentSubmit').val();
function waitSubmit(){
	if(wait > 0){
		wait--;
		$('#commentSubmit').val('稍等'+wait+'秒');
		setTimeout(waitSubmit,1000);
	}else{
		$('#commentSubmit').removeAttr('disabled')
		$('#commentSubmit').val(stext);
	}
}
addComment = {
    moveForm : function(commId, parentId, respondId, postId) {
        var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');

        if ( ! comm || ! respond || ! cancel || ! parent )
            return;

        t.respondId = respondId;
        postId = postId || false;

        if ( ! t.I('wp-temp-form-div') ) {
            div = document.createElement('div');
            div.id = 'wp-temp-form-div';
            div.style.display = 'none';
            respond.parentNode.insertBefore(div, respond);
        }

        comm.parentNode.insertBefore(respond, comm.nextSibling);
        if ( post && postId )
            post.value = postId;
        parent.value = parentId;
        cancel.style.display = '';

        cancel.onclick = function() {
            var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

            if ( ! temp || ! respond )
                return;

            t.I('comment_parent').value = '0';
            temp.parentNode.insertBefore(respond, temp);
            temp.parentNode.removeChild(temp);
            this.style.display = 'none';
            this.onclick = null;
            return false;
        }
        try { t.I('comment').focus(); }
        catch(e) {}
        return false;
    },

    I : function(e) {
        return document.getElementById(e);
    }
}