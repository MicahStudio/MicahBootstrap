<?php 
if (post_password_required()) {
	?>
	<div class="alert alert-block">
		<h4>Warning!</h4>
		<?php _e( 'This post is password protected. Enter the password to view comments.' ); ?>
	</div>
	<?php
    return;
}
?>
<div class="text-right" style="padding:10px;">
	<?php comments_number('<span style="color:#EF7901;">来抢沙发吧</span>', '沙发刚刚被占了', '回应(<span id="comments-title" style="color:#EF7901;">%</span>)'); ?>
</div>
<article id="comments">
	<ul class="commentlist unstyled">
	<?php 
		wp_list_comments("avatar_size=80&callback=themes_comment_style&max_depth=2"); 
	?>
	</ul>
	<div id="comments_pages" class="pagination pagination-centered pagination-small">
		<ul>
			<?php paginate_comments_links('prev_text=上一页&next_text=下一页');?>
		</ul>
	</div>
</article>
<?php
	if(comments_open()){
		?>
		<div id="respond">
			<div class="cancel-comment-reply text-right">
				<small><?php cancel_comment_reply_link(); ?></small>
			</div>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
					<div class="row-fluid">
						<div id="smilies" class="well" style="background-color: #fff;">
								<a onclick="javascript:grin(':mrgreen:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_mrgreen.gif" style="width:32px;height:32px;" title="皇受君" alt="皇受君" /></a>
								<a onclick="javascript:grin(':oops:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_redface.gif" style="width:32px;height:32px;" title="惊" alt="惊" /></a>
								<a onclick="javascript:grin(':smile:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_smile.gif" style="width:32px;height:32px;" title="笑" alt="笑" /></a>
								<a onclick="javascript:grin(':???:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_confused.gif" style="width:32px;height:32px;" title="晕" alt="晕" /></a>
								<a onclick="javascript:grin(':evil:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_evil.gif" style="width:32px;height:32px;" title="睡觉" alt="睡觉" /></a>
								<a onclick="javascript:grin(':sick:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_sick.gif" style="width:32px;height:32px;" title="生病" alt="生病" /></a>
								<a onclick="javascript:grin(':play:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_play.gif" style="width:32px;height:32px;" title="自娱自乐" alt="自娱自乐" /></a>
								<a onclick="javascript:grin(':mad:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_mad.gif" style="width:32px;height:32px;" title="怒" alt="怒" /></a>
								<a onclick="javascript:grin(':cry:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_cry.gif" style="width:32px;height:32px;" title="哭" alt="哭" /></a>
								<a onclick="javascript:grin(':gun:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_gun.gif" style="width:32px;height:32px;" title="躺着也中枪" alt="躺着也中枪" /></a>
								<a onclick="javascript:grin(':twisted:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_twisted.gif" style="width:32px;height:32px;" title="狂" alt="狂" /></a>
								<a onclick="javascript:grin(':cool:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_cool.gif" style="width:32px;height:32px;" title="酷" alt="酷" /></a>
								<a onclick="javascript:grin(':lol:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_lol.gif" style="width:32px;height:32px;" title="奸" alt="奸" /></a>
								<a onclick="javascript:grin(':!:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_exclaim.gif" style="width:32px;height:32px;" title="调皮" alt="调皮" /></a>
								<a onclick="javascript:grin(':sad:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_sad.gif" style="width:32px;height:32px;" title="悲" alt="悲" /></a>
								<a onclick="javascript:grin(':?:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_question.gif" style="width:32px;height:32px;" title="疑问" alt="疑问" /></a>
								<a onclick="javascript:grin(':roll:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_rolleyes.gif" style="width:32px;height:32px;" title="求包养" alt="求包养" /></a>
								<a onclick="javascript:grin(':wink:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_wink.gif" style="width:32px;height:32px;" title="吃" alt="吃" /></a>
								<a onclick="javascript:grin(':idea:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_idea.gif" style="width:32px;height:32px;" title="贪" alt="贪" /></a>
								<a onclick="javascript:grin(':neutral:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_neutral.gif" style="width:32px;height:32px;" title="吐了" alt="吐了" /></a>
								<a onclick="javascript:grin(':anmo:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_anmo.gif" style="width:32px;height:32px;" title="按摩" alt="按摩" /></a>
								<a onclick="javascript:grin(':maobang:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_maobang.gif" style="width:32px;height:32px;" title="逗猫棒" alt="逗猫棒" /></a>
								<a onclick="javascript:grin(':heixiu:')"><img src="<?php echo get_template_directory_uri(); ?>/images/smilies/icon_heixiu.gif" style="width:32px;height:32px;" title="嘿咻" alt="嘿咻" /></a>
						</div>
						<textarea aria-required="true" class="input-block-level" name="comment" id="comment" cols="45" rows="10" ></textarea>
					</div>
					<?php 
					if ( $user_ID ) {
						?>
						<div class="row-fluid">
							<div class="span12 text-right">
								<span class="badge badge-info"><?php echo $user_identity; ?>，谢谢你来到这里。 </span>&nbsp;&nbsp;&nbsp;&nbsp;<input name="submit" class="btn" type="submit" id="commentSubmit" tabindex="5" value="感谢您的点评" >
							</div>
						</div>
						<?php
					}else{
					?>
					<div class="input-prepend">
						<span class="add-on">&nbsp;<i class="icon-user"></i>&nbsp;</span>
						<input id="prependedInput" type="text" placeholder="输入您的大名" name="author" id="author" aria-required="true" value="<?php echo esc_attr($comment_author); ?>" style="width:117px;">
					</div>
					<div class="input-prepend">
						<span class="add-on">&nbsp;<i class="icon-envelope"></i>&nbsp;</span>
						<input id="prependedInput" type="email" placeholder="输入您的邮件" name="email" id="email" aria-required="true" value="<?php echo esc_attr($comment_author_email); ?>" style="width:117px;">
					</div>
					<div class="input-prepend">
						<span class="add-on">&nbsp;<i class="icon-globe"></i>&nbsp;</span>
						<input id="prependedInput" type="text" placeholder="输入您的网址" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" style="width:117px;">
					</div>
					<div class="input-prepend input-append pull-right" id="comment_tooltip">
						<span class="add-on"><i class="icon-hand-right"></i>&nbsp;<input type="checkbox" id="r" name="r" aria-required="true" >&nbsp;</span>
						<input name="submit" class="btn" type="submit" id="commentSubmit" tabindex="5" value="发表">
					</div>
					<div class="clearfix"></div>
					<?php
					}
					?>
					<?php comment_id_fields(); ?>
					<?php do_action('comment_form', $post->ID); ?>
			</form>
		</div>
		<?php
	}else{
		//关评
	}
?>
