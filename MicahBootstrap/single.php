<?php 
get_header(); 
if(have_posts()) {
	the_post();
	do{
			//日志
			if(has_post_format('aside')){
			?>
			<?php
				break;
			}
			//相册
			if(has_post_format('gallery')){
			?>
				<article class="content">
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>					
					<div class="meta">
						<span><i class="icon-calendar"></i>&nbsp;<?php echo the_time('Y-m-d h:i'); ?></span>
						<span><?php the_tags('<i class="icon-tags"></i>&nbsp;'); ?></span>
					</div>
				</article>
				<ul class="pager" style="padding:0px 10px 10px 10px;">
					<li class="previous">
						<?php previous_post_link( ' %link' , '&laquo;上一篇' , true ) ?>
					</li>
					<li class="next">
						<?php next_post_link( '%link ' , '下一篇&raquo;' , true ) ?>
					</li>
				</ul>
			<?php
				comments_template('', true);
				break;
			}			
			//链接
			if(has_post_format('link')){
			?>
			<div class="well" style="margin:10px;">
				<blockquote class="pull-right">
					<?php the_content();?>
				</blockquote>
			</div>
			<?php
				break;
			}
			//图像
			if(has_post_format('image')){
				$szPostContent = $post->post_content; 
				$szSearchPattern = '~<img [^>]* />~'; // 搜索所有符合的图片 
				preg_match_all( $szSearchPattern, $szPostContent, $aPics ); 
				$iNumberOfPics = count($aPics[0]);
				?>
				<article class="content">
				<div class="alert alert-error ">
					<?php the_excerpt(); ?>
				</div>
				<?php
				if($iNumberOfPics==1){
					the_content();
				}else if ( $iNumberOfPics > 0 ) {?>
				<div class="row-fluid">
					<ul class="thumbnails">
					<?php 
					for ( $i=0; $i < $iNumberOfPics ; $i++ ) {
						  echo '<li class="span6">
						  <a href="#" class="thumbnail">
						      '.$aPics[0][$i].'
						    </a>
						  </li>';			 
					}
					?>
					</ul>
				</div>
					<?php			
				}else{
					?>
					<div class="hero-unit" style="margin:10px;">
						<h1>
							<p>附件丢失= =|||</p>
						</h1>
						<p class="text-right">
							——<?php echo the_time('Y年m月d日 h:i'); ?>
						</p>
					</div>
					<?php
				}
			?>
				<div class="meta">
					<span><i class="icon-calendar"></i>&nbsp;<?php echo the_time('Y-m-d h:i'); ?></span>
					<span><?php the_tags('<i class="icon-tags"></i>&nbsp;'); ?></span>
				</div>
			</article>
			<ul class="pager" style="padding:0px 10px 10px 10px;">
				<li class="previous">
					<?php previous_post_link( ' %link' , '&laquo;上一篇' , true ) ?>
				</li>
				<li class="next">
					<?php next_post_link( '%link ' , '下一篇&raquo;' , true ) ?>
				</li>
			</ul>
			<?php
				comments_template('', true);
				break;
			}
			//引语
			if(has_post_format('quote')){
			?>
			<div class="well" style="margin:10px;">
				<blockquote style="padding-top:10px;">
					<?php the_content(); ?>
				</blockquote>
			</div>
			<?php
				break;
			}
			//状态
			if(has_post_format('status')){
			?>
			<div class="hero-unit" style="margin:10px;">
				<h1>
					<p><?php the_title(); ?></p>
				</h1>
				<?php the_content(); ?>
				<p class="text-right">
					——<?php echo the_time('Y年m月d日 h:i'); ?>
				</p>
			</div>
			<?php
				break;
			}
			//视频
			if(has_post_format('video')){
			?>
			<article class="content">
				<div class="alert alert-error">
					<?php the_excerpt(); ?>
				</div>
				<?php the_content(); ?>
				<div class="meta">
					<span><i class="icon-calendar"></i>&nbsp;<?php echo the_time('Y-m-d h:i'); ?></span>
					<span><?php the_tags('<i class="icon-tags"></i>&nbsp;'); ?></span>
				</div>
			</article>
			<ul class="pager" style="padding:0px 10px 10px 10px;">
				<li class="previous">
					<?php previous_post_link( ' %link' , '&laquo;上一篇' , true ) ?>
				</li>
				<li class="next">
					<?php next_post_link( '%link ' , '下一篇&raquo;' , true ) ?>
				</li>
			</ul>
			<?php
				comments_template('', true);
				break;
			}
			//音频
			if(has_post_format('audio')){
			?>
			<?php
				break;
			}
			//聊天
			if(has_post_format('chat')){
			?>
			<?php
				break;
			}
			//标准
			?>
			<article class="content">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<div class="bdlikebutton" style="margin:0 autl;"></div>	
				<div class="meta">
					<span><i class="icon-calendar"></i>&nbsp;<?php echo the_time('Y-m-d h:i'); ?></span>
					<span><?php the_tags('<i class="icon-tags"></i>&nbsp;'); ?></span>
				</div>
			</article>
			<ul class="pager pagination-small" style="padding:0px 10px 10px 10px;">
				<li class="previous">
					<?php previous_post_link( ' %link' , '&laquo;上一篇' , true ) ?>
				</li>
				<li class="next">
					<?php next_post_link( '%link ' , '下一篇&raquo;' , true ) ?>
				</li>
			</ul>
			<?php
			comments_template('', true);
		}while(false);
}
get_sidebar();
get_footer(); ?>