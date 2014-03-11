<?php 
//主题更新检测
require_once(TEMPLATEPATH . '/theme-updates/theme-update-checker.php'); 
$update_checker = new ThemeUpdateChecker(
	'MicahBootstrap', //主题名字
	'https://raw.github.com/MicahStudio/MicahBootstrap/master/info.json'  //info.json 的访问地址
);
register_nav_menus(array('primary' => __( '导航菜单' ),));
if (!is_admin()) {  
    remove_action( 'init', '_wp_admin_bar_init');
}
remove_action( 'wp_head', 'wp_generator');
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'pre_post_update','wp_save_post_revision'); 
remove_filter( 'the_content', 'wptexturize');
remove_filter( 'the_excerpt', 'wpautop' );
add_filter( 'pre_option_link_manager_enabled', '__return_true' );
add_filter( 'use_default_gallery_style', '__return_false' );
//文章形式
add_theme_support( 'post-formats', 
		   array( 
			'aside', //日志
			'gallery',//相册
			'link',//链接
			'image',//图像
			'quote',//引语
			'status',//状态
			'video',//视频
			'audio',//音频
			'chat'//聊天
 ) );
//加载库和CSS
function footer_script(){
	//注册css
	wp_register_style('bootstrap.min', get_template_directory_uri() . '/bootstrap/css/bootstrap.css' );
	wp_register_style('bootstrap-responsive.min', get_template_directory_uri() . '/bootstrap/css/bootstrap-responsive.min.css' );
	wp_register_style('docs', get_template_directory_uri() . '/bootstrap/css/docs.css' );
	wp_register_style('colorbox', get_template_directory_uri() . '/colorbox.css' );
	//加载css
    wp_enqueue_style('bootstrap.min');
    wp_enqueue_style('bootstrap-responsive.min');
    wp_enqueue_style('docs');
    wp_enqueue_style('colorbox');
	//注册script
	//wp_register_script('less',get_template_directory_uri().'/bootstrap/js/less-1.4.2.min.js', false, '', false );
	wp_register_script('jquery.mini',get_template_directory_uri().'/jquery/jquery-1.10.1.min.js', false, '', true );
	wp_register_script('jquery.lazyload.mini',get_template_directory_uri().'/jquery/jquery.lazyload.min.js', array('jquery.mini'), '', true );
	wp_register_script('bootstrap.mini',get_template_directory_uri().'/bootstrap/js/bootstrap.min.js', array('jquery.mini'), '', true );
	wp_register_script('application',get_template_directory_uri().'/jquery/application.js', array('jquery.mini','bootstrap.mini'), '', true );
	wp_register_script('jquery.colorbox.mini',get_template_directory_uri().'/jquery/jquery.colorbox-min.js', array('jquery.mini'), '', true );
	//加载script
	wp_deregister_script('jquery'); 
	//wp_enqueue_script('less'); 
    wp_enqueue_script('jquery.mini'); 
    wp_enqueue_script('jquery.lazyload.mini'); 
    wp_enqueue_script('bootstrap.mini'); 
    wp_enqueue_script('application'); 
    wp_enqueue_script('jquery.colorbox.mini');
    
}
add_action('wp_enqueue_scripts', 'footer_script');
//主题版本号
function e_version(){
	_e('Version 1.5.2 20030809');
}
//关闭自动保存
add_action('wp_print_scripts','disable_autosave'); 
function disable_autosave(){
	wp_deregister_script('autosave'); 
}
//延迟加载广告
include(TEMPLATEPATH . '/ad/lazyAd.php');
//自动摘要
function new_excerpt_length($length) {
	return 400;
}
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
add_filter('excerpt_length', 'new_excerpt_length');
//自定义搜索框
function new_search_form( $form ) {
    return '
	<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<div class="input-append">
			<input type="text" x-webkit-speech value="' . get_search_query() . '" name="s" id="s" />
			<button type="submit" class="btn btn-inverse">'. esc_attr__( 'Search' ) .'</button>
		</div>
    </form>';
}
add_filter( 'get_search_form', 'new_search_form' );
//随机文章
function get_rand_posts($count = 15){
	query_posts(array('orderby' => 'rand', 'showposts' => $count));
	if (have_posts()) {
		printf(__('<ul class="unstyled rand_post_comments text-right">'));
		while (have_posts()){
			the_post();
			?>
			<li><a class="brand" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo mb_strimwidth(get_the_title(), 0, 33, '...'); ?></a></li>
			<?php
		}
		printf(__('</ul>'));
	}
}
function show_media($postID){
	$attachments = get_children(array('post_parent' => $postID,  'post_type' => 'attachment'));
	//var_dump($attachments);
}
//文章中的第一张图
function catch_that_image($postID) {
	$images = get_children(array('post_parent' => $postID,  'post_type' => 'attachment', 'post_mime_type' => 'image'),ARRAY_A);
	if($images){
		$arr = array_values($images);
		$attachment = $arr[0];
		return wp_get_attachment_thumb_url($attachment['ID']);
	}
}
//相册预览
function gallery_preview($postID){
	$images = get_children(array('post_parent' => $postID,  'post_type' => 'attachment', 'post_mime_type' => 'image'));
	if($images){
		foreach ($images as $attachment) {
			?>
			<a href="#" class="thumbnail span1">
				<img src="<?php echo wp_get_attachment_thumb_url($attachment->ID);?>" />
			</a>
			<?php
		}
	}
}
//文中图片数
function catch_that_image_count($postID) {
	return count(get_children(array('post_parent' => $postID,  'post_type' => 'attachment')));
}

//评论样式
function themes_comment_style($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	?>
	<?php 
	do{
		//Pingback样式
		if('pingback'==$comment->comment_type){
			break;
		}
		//trackback样式
		if('trackback'==$comment->comment_type){
			break;
		}
		//默认评论样式
		//是否是父级评论
		$parent=('0' == $comment->comment_parent)?true:false;
		?>

		<li <?php comment_class(); ?>>
		<div class="row-fluid">
			<div class="<?php echo $parent?'suspended span12':'comment_content span11 offset1';?>" style="padding:10px;">
				<a href="#comment-<?php comment_ID(); ?>" class="thumbnail pull-left span2 hidden-phone" style="<?php echo $parent?'width:86px;height:86px':'width:57px;height:57px'?>;">
					<?php echo '<img class="avatar" src="'.get_template_directory_uri().'/images/loading.gif" alt="" data-original="' . preg_replace(array('/^.+(src=)(\"|\')/i', '/(\"|\')\sclass=(\"|\').+$/i'), array('', ''), get_avatar($comment)) . '" />'; ?>
				</a>
				<ul class="span10 comment_content unstyled pull-left">
					<li id="comment-<?php comment_ID(); ?>" style="border-width: 1px;border-color: #ccc;border-style: none none dotted none;">
						<cite class="fn badge badge-important"><i class="icon-globe"></i>&nbsp;<?php echo  get_comment_author_link();?></cite>
						<?php comment_date();?>
						<?php if($comment->comment_parent){
							$comment_parent_href = htmlspecialchars(get_comment_link( $comment->comment_parent ));
							$comment_parent = get_comment($comment->comment_parent);
						?>
							<span class="comment-author">
								<a href="<?php echo $comment_parent_href;?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $comment_parent->comment_content)), 0, 100,"..."); ?>"><i class="icon-share-alt"></i><?php echo $comment_parent->comment_author;?></a>
							</span>
						<?php }?>
						<?php if ($depth == get_option('thread_comments_depth')) : ?> 
							<a class="reply pull-right badge badge-info" onclick="return addComment.moveForm( 'comment-<?php comment_ID(); ?>','<?php echo $comment->comment_parent; ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' )" href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow">回复</a>
						<?php else: ?>
						    <a class="reply pull-right badge badge-info" onclick="return addComment.moveForm( 'comment-<?php comment_ID(); ?>','<?php comment_ID(); ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' ) " href="?replytocom=<?php comment_ID() ?>#respond" class="comment-reply-link" rel="nofollow">回复</a>
						<?php endif; ?>
					</li>
					<li>
						<article class="comment_text" style="padding:5px;">
							<?php comment_text() ?>
						</article>
					</li>
				</ul>
				<div class="clearfix"></div>
		<?php
	}while (0);
	?>
	<?php
}

//评论表情
if(!isset($wpsmiliestrans )) {
		$wpsmiliestrans = array(
		':mrgreen:' => 'icon_mrgreen.gif',
		':oops:' 	=> 'icon_redface.gif',
		':?:' 		=> 'icon_question.gif',
		':???:' 	=> 'icon_confused.gif',
		':sick:' 	=> 'icon_sick.gif',
		':play:' 	=> 'icon_play.gif',
		':mad:' 	=> 'icon_mad.gif',
		':cry:' 	=> 'icon_cry.gif',
		':gun:' 	=> 'icon_gun.gif',
		':twisted:' => 'icon_twisted.gif',
		':cool:' 	=> 'icon_cool.gif',
		':lol:' 	=> 'icon_lol.gif',
		':arrow:' 	=> 'icon_arrow.gif',
		':!:' 		=> 'icon_exclaim.gif',
		':sad:' 	=> 'icon_sad.gif',
		':roll:' 	=> 'icon_rolleyes.gif',
		':wink:' 	=> 'icon_wink.gif',
		':smile:' 	=> 'icon_smile.gif',
		':idea:' 	=> 'icon_idea.gif',
		':neutral:' => 'icon_neutral.gif',
		':evil:' 	=> 'icon_evil.gif',
		':anmo:' 	=> 'icon_anmo.gif',
		':maobang:' 	=> 'icon_maobang.gif',
		':heixiu:' 	=> 'icon_heixiu.gif',
		//老表情
		'/01' => 'icon_mrgreen.gif',
		'/02' => 'icon_redface.gif',
		'/03' => 'icon_question.gif',
		'/04' => 'icon_confused.gif',
		'/05' => 'icon_sick.gif',
		'/06' => 'icon_play.gif',
		'/07' => 'icon_mad.gif',
		'/08' => 'icon_cry.gif',
		'/09' => 'icon_gun.gif',
		'/10' => 'icon_twisted.gif',
		'/11' => 'icon_cool.gif',
		'/12' => 'icon_lol.gif',
		'/13' => 'icon_arrow.gif',
		'/14' => 'icon_exclaim.gif',
		'/15' => 'icon_sad.gif',
		'/16' => 'icon_rolleyes.gif',
		);
}
function custom_smilies_src($src, $img)
{
	return get_bloginfo('template_directory').'/images/smilies/' . $img;
}
add_filter('smilies_src', 'custom_smilies_src', 10, 2);
//评论回复邮件发送
function comment_mail_notify($comment_id){
    $comment = get_comment($comment_id);//根据id获取这条评论相关数据
    $content = $comment->comment_content;
    //对评论内容进行匹配
    $match_count=preg_match_all('/<a href="#comment-([0-9]+)?" rel="nofollow">/si',$content,$matchs);
    if($match_count>0){//如果匹配到了
        foreach($matchs[1] as $parent_id){//对每个子匹配都进行邮件发送操作
            SimPaled_send_email($parent_id,$comment);
        }
    }else if($comment->comment_parent!='0'){//以防万一，有人故意删了@回复，还可以通过查找父级评论id来确定邮件发送对象
        $parent_id=$comment->comment_parent;
        SimPaled_send_email($parent_id,$comment);
    }else return;
}
add_action('comment_post', 'comment_mail_notify');

function SimPaled_send_email($parent_id,$comment){
    $admin_email = get_bloginfo ('admin_email');//管理员邮箱
    $parent_comment=get_comment($parent_id);//获取被回复人（或叫父级评论）相关信息
    $author_email=$comment->omment_author_email;//评论人邮箱
    $to = trim($parent_comment->comment_author_email);//被回复人邮箱
    $spam_confirmed = $comment->comment_approved;
    if ($spam_confirmed != 'spam' && $to != $admin_email && $to != $author_email) {
		$wp_email = 'wordpress@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME']));//发件人e-mail地址
		$to = trim(get_comment($parent_id)->comment_author_email);
		$subject = '您在['.get_option("blogname").']的留言有了回复';
        $message = '
			<div style="margin:0 auto;width:750px;">
				<div style="border:1px solid black;color:white;padding:15px;background:black;margin:0 auto;width:100%;border-radius:8px 8px 0 0;-moz-border-radius: 8px 8px 0 0;border-radius: 8px 8px 0 0;-webkit-border-radius: 8px 8px 0 0;">
					您在[<a href="http://luacloud.com" style="text-decoration:none;color:#66ff00" target="_blank">月亮云</a>]的留言有了回复
				</div>
				<div style="line-height:25px;border-radius:0 0 8px 8px;width:100%;background:#3ea4d5;margin:0 auto;padding:0 15px;border:1px solid black">
					<p>'.trim(get_comment($parent_id)->comment_author).', 您好!</p>
					<p>这是您在《'.get_the_title($comment->comment_post_ID).'》中的留言:</p>
						<p style="background:white;margin:0 25px;padding:5px 15px;border-radius:5px;">'.trim(get_comment($parent_id)->comment_content).'</p>
					<p>以下是 '.trim($comment->comment_author).' 给您的回复:</p>
						<p style="background:white;margin:0 25px;padding:5px 15px;border-radius:5px;">'.trim($comment->comment_content).'<br /></p>
					<p>您可以<a href="' . htmlspecialchars(get_comment_link($parent_id)) . '">点击这里查看回复的完整内容.</a></p>
					<p>欢迎再度光临 <a href="http://luacloud.com">月亮云</a></p>
					<p>此邮件由[<a href="http://luaclou.com">http://luaclou.com</a>]自动发出,请不要回复。</p>
				</div>
			</div>';
		$message = convert_smilies($message);
		$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
		$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
        wp_mail( $to, $subject, $message, $headers );
    }
}
//后台编辑器表情
add_action('admin_menu', 'aioseop_meta_box_add');
function aioseop_meta_box_add() {
	if ( function_exists('add_meta_box') ) {
		if( function_exists('get_post_types')){
			$mrt_aioseop_pts=get_post_types('','names');
			$aioseop_options = get_option('aioseop_options');
			$aioseop_mrt_cpt = $aioseop_options['aiosp_enablecpost'];
			foreach ($mrt_aioseop_pts as $mrt_aioseop_pt) {
				if($mrt_aioseop_pt == 'post' || $mrt_aioseop_pt == 'page' || $aioseop_mrt_cpt){
					add_meta_box('smiley',__('表情'),'aiosp_meta',$mrt_aioseop_pt);
				}
			}
		}
	}
}
function aiosp_meta() {
?>
	<script type="text/javascript">
	function clinsertsmilies(keycode) {
		tinyMCE.execCommand('mceInsertContent', false, ' ' + keycode + ' ');
	}
	</script>
	<a onclick="javascript:grin(':mrgreen:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mrgreen.gif" title="皇受君" alt="皇受君" /></a>
	<a onclick="javascript:grin(':oops:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_redface.gif" title="惊" alt="惊" /></a>
	<a onclick="javascript:grin(':smile:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_smile.gif" title="笑" alt="笑" /></a>
	<a onclick="javascript:grin(':???:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_confused.gif" title="晕" alt="晕" /></a>
	<a onclick="javascript:grin(':evil:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_evil.gif" title="睡觉" alt="睡觉" /></a>
	<a onclick="javascript:grin(':sick:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_sick.gif" title="生病" alt="生病" /></a>
	<a onclick="javascript:grin(':play:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_play.gif" title="自娱自乐" alt="自娱自乐" /></a>
	<a onclick="javascript:grin(':mad:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mad.gif" title="怒" alt="怒" /></a>
	<a onclick="javascript:grin(':cry:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cry.gif" title="哭" alt="哭" /></a>
	<a onclick="javascript:grin(':gun:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_gun.gif" title="躺着也中枪" alt="躺着也中枪" /></a>
	<a onclick="javascript:grin(':twisted:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_twisted.gif" title="狂" alt="狂" /></a>
	<a onclick="javascript:grin(':cool:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cool.gif" title="酷" alt="酷" /></a>
	<a onclick="javascript:grin(':lol:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_lol.gif" title="奸" alt="奸" /></a>
	<a onclick="javascript:grin(':!:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_exclaim.gif" title="调皮" alt="调皮" /></a>
	<a onclick="javascript:grin(':sad:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_sad.gif" title="悲" alt="悲" /></a>
	<a onclick="javascript:grin(':?:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_question.gif" title="疑问" alt="疑问" /></a>
	<a onclick="javascript:grin(':roll:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_rolleyes.gif" title="求包养" alt="求包养" /></a>
	<a onclick="javascript:grin(':wink:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_wink.gif" title="吃" alt="吃" /></a>
	<a onclick="javascript:grin(':idea:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_idea.gif" title="贪" alt="贪" /></a>
	<a onclick="javascript:grin(':neutral:')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_neutral.gif" title="吐了" alt="吐了" /></a>
<?php
}
//最新评论
function get_recent_comments($limit = 15){
	$comments = get_comments(array('number' =>$limit ,'status'=>approve,'user_id'=>0 ));
	_e('<ul class="unstyled recent_comments">');
	foreach ($comments as $comment) {
		_e('<li><a class="badge badge-important" href="'.get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID.'" title="于'.$comment->comment_date_gmt.'">'.$comment->comment_author.'</a>：'.$comment->comment_content.'</li>');
	}
	_e('</ul>');
}
//暗箱效果
add_filter('the_content', 'moesora_pic_replace');
function moesora_pic_replace ($content) {
	global $post;
	$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="attachment"$6>$7</a>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}
//编辑器中的下载按钮
function downlink($atts,$content=null){
    extract(shortcode_atts(array("href"=>'http://'),$atts));
     return '<a class="download" href="'.$href.'" target="_blank" rel="attachment download">'.$content.'</a>';
 }
add_shortcode('Downlink','downlink');
add_filter( 'admin_print_footer_scripts', 'quicktagsbuttons', 100 );
function quicktagsbuttons(){
?>
	<script type="text/javascript">
		QTags.addButton( 'id_6', '下载按钮', '[Downlink href="http://"]','[/Downlink]');
	</script>
<?php
}
//防垃圾评论
function preprocess_comment_handler($commentdata){
	//var_dump($commentdata);
	if(!is_user_logged_in()){
		if ((strtolower(trim($commentdata['comment_author'])) == 'luacloud')|| (strtolower(trim($commentdata['comment_author_email'])) == 'luacloud@gmail.com')){
			wp_die('你用错了名字或邮箱，还是换一个吧。');
		}
		if(!isset($_POST['r'])||empty($_POST['r'])||trim($_POST['r']) == ''){
			wp_die('下面有个复选框看到了吗？勾上它。');
		}
	}
	return $commentdata ;
}
add_filter('preprocess_comment', 'preprocess_comment_handler');

add_action('comment_post', 'ajaxcomments', 20, 2);
function ajaxcomments($comment_ID, $comment_status){
	$comment = &get_comment($comment_ID);
	//var_dump($comment);
	if( !$user->ID ){
		setcookie('comment_author_' . COOKIEHASH, $comment->comment_author, time() + 30000000, COOKIEPATH, COOKIE_DOMAIN);
		setcookie('comment_author_email_' . COOKIEHASH, $comment->comment_author_email, time() + 30000000, COOKIEPATH, COOKIE_DOMAIN);
		setcookie('comment_author_url_' . COOKIEHASH, clean_url($comment->comment_author_url), time() + 30000000, COOKIEPATH, COOKIE_DOMAIN);
	}
	$parent=('0' == $comment->comment_parent)?true:false;
	if($parent){
	?>
	<li <?php comment_class(); ?>>
	<div class="row-fluid">
		<div class="<?php echo $parent?'suspended span12':'comment_content span11 offset1';?>" style="padding:10px;">
			<a href="#comment-<?php echo $comment->comment_ID; ?>" class="thumbnail pull-left span2 hidden-phone" style="<?php echo $parent?'width:86px;height:86px':'width:57px;height:57px'?>;">
				<?php echo '<img class="avatar" src="'.get_template_directory_uri().'/images/loading.gif" alt="" data-original="' . preg_replace(array('/^.+(src=)(\"|\')/i', '/(\"|\')\sclass=(\"|\').+$/i'), array('', ''), get_avatar($comment->comment_author_email)) . '" />'; ?>
			</a>
			<ul class="span10 comment_content unstyled pull-left">
				<li id="comment-<?php echo $comment->comment_ID; ?>" style="border-width: 1px;border-color: #ccc;border-style: none none dotted none;">
					<cite class="fn badge badge-important"><i class="icon-globe"></i>&nbsp;<?php echo  get_comment_author_link();?></cite>
					<?php _e($comment->comment_date);?>
					<?php if($comment->comment_parent){
						$comment_parent_href = htmlspecialchars(get_comment_link( $comment->comment_parent ));
						$comment_parent = get_comment($comment->comment_parent);
					?>
						<span class="comment-author">
							<a href="<?php echo $comment_parent_href;?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $comment_parent->comment_content)), 0, 100,"..."); ?>"><i class="icon-share-alt"></i><?php echo $comment_parent->comment_author;?></a>
						</span>
					<?php }?>
					<?php if ($depth == get_option('thread_comments_depth')) : ?> 
						<a class="reply pull-right badge badge-info" onclick="return addComment.moveForm( 'comment-<?php echo $comment->comment_ID; ?>','<?php echo $comment->comment_parent; ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' )" href="?replytocom=<?php echo $comment->comment_ID ?>#respond" class="comment-reply-link" rel="nofollow">回复</a>
					<?php else: ?>
					    <a class="reply pull-right badge badge-info" onclick="return addComment.moveForm( 'comment-<?php echo $comment->comment_ID; ?>','<?php echo $comment->comment_ID; ?>', 'respond','<?php echo $comment->comment_post_ID; ?>' ) " href="?replytocom=<?php echo $comment->comment_ID ?>#respond" class="comment-reply-link" rel="nofollow">回复</a>
					<?php endif; ?>
				</li>
				<li>
					<article class="comment_text" style="padding:5px;">
						<?php _e($comment->comment_content); ?>
					</article>
				</li>
			</ul>
			<div class="clearfix"></div>
	<?php
	}else{
	?>
	<span class="ajax_comment text-right" style="padding:10px;">
		<?php _e($comment->comment_content); ?>
	</span>
	<?php
	}
	die();
}
?>