<?php 
if(have_posts()){
	while(have_posts()) { 
		the_post();
		do{
			//日志
			if(has_post_format('aside')){
			?>
			<?php
				//break;
			}
			//相册
			if(has_post_format('gallery')){
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php echo get_post_gallery(); ?>
				</div>
				<h1 style="text-align:center;"><a href="<?php the_permalink(); ?>">相册 - <?php the_title(); ?></a>&nbsp;&nbsp;</h1>
			</article>
			<?php
				break;
			}			
			//链接
			if(has_post_format('link')){
			?>
			<section>
				<div class="alert alert-info" style="margin:0px 10px;line-height: 27px;">
					链接分享&nbsp;<i class="icon-share"></i>&nbsp;<a href="<?php the_excerpt();?>" title=""><?php the_excerpt();?></a>
				</div>
			</section>
			<?php
				break;
			}
			//图像
			if(has_post_format('image')){
			?>
			<section class="suspended" style="padding:10px;"> 				
				<div class="row-fluid">
					<div class="span2">						
						<a href="<?php the_permalink(); ?>" class="thumbnail">
							<img src="<?php echo catch_that_image($post->ID); ?>" alt="" />
						</a>
					</div>
					<div class="span10">
						<div>
							<span style="margin-right:14px;"><i class="icon-picture"></i>&nbsp;<?php echo catch_that_image_count($post->ID); ?></span>
							<span style="margin-right:14px;"><i class="icon-calendar"></i>&nbsp;<?php echo the_time('Y-m-d h:i'); ?></span>
							<span style="margin-right:14px;"><i class="icon-pencil"></i>&nbsp;<?php echo the_author_posts_link();?></span>
							<span style="margin-right:14px;"><i class="icon-comment"></i>&nbsp;<?php comments_popup_link('0', '1', '%','','-');?></span>
						</div>
						<div>
							<span style="margin-right:14px;"><i class="icon-book"></i>&nbsp;<?php echo the_category(',');?></span>
							<span style="margin-right:14px;"><?php the_tags('<i class="icon-tags"></i>&nbsp;'); ?></span>
						</div>

						<div class="standardtitle pull-right">——<strong><a href="<?php the_permalink(); ?>">《<?php the_title(); ?>》</a></strong>&nbsp;&nbsp;</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</section>
			<?php
				break;
			}
			//引语
			if(has_post_format('quote')){
			?>
			<section class="suspended" style="background-color:#333;padding:20px;">
				<blockquote>
					<?php the_content();?>
				</blockquote>
			</section>
			<?php
				break;
			}
			//状态
			if(has_post_format('status')){
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">
					<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>' ) ); ?>
				</div>
			</article>
			<?php
				break;
			}
			//视频
			if(has_post_format('video')){
			?>
			<section class="suspended" style="padding:10px;"> 		
				<div class="row-fluid">
					<div class="span2">						
						<a href="<?php the_permalink(); ?>" class="thumbnail" style="width:128px;height:128px;">
							<img src="<?php echo get_template_directory_uri(); ?>/images/big_play.png" alt=""/>
						</a>
					</div>
					<div class="span10">
						<div>
							<span style="margin-right:14px;"><i class="icon-calendar"></i>&nbsp;<?php echo the_time('Y-m-d h:i'); ?></span>
							<span style="margin-right:14px;"><i class="icon-pencil"></i>&nbsp;<?php echo the_author_posts_link();?></span>
							<span style="margin-right:14px;"><i class="icon-comment"></i>&nbsp;<?php comments_popup_link('0', '1', '%','','-');?></span>
						</div>
						<div>
							<span style="margin-right:14px;"><i class="icon-book"></i>&nbsp;<?php echo the_category(',');?></span>
							<span style="margin-right:14px;"><?php the_tags('<i class="icon-tags"></i>&nbsp;'); ?></span>
						</div>
						<div class="text-error">
							<span style="margin-right:14px;"><i class="icon-facetime-video"></i>&nbsp;说：“<?php the_excerpt();?>”</span>
						</div>
						<div class="standardtitle pull-right">——<strong><a href="<?php the_permalink(); ?>">《<?php the_title(); ?>》</a></strong>&nbsp;&nbsp;</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</section>
			<?php
				break;
			}
			//音频
			if(has_post_format('audio')){
			?>
			<?php
				//break;
			}
			//聊天
			if(has_post_format('chat')){
			?>
			<?php
				//break;
			}
			//标准
			?>
			<section class="suspended">
				<p>
					<?php the_excerpt();?>
				</p>
				<div class="standardtitle pull-right">——<strong><a href="<?php the_permalink(); ?>">《<?php the_title(); ?>》</a></strong>&nbsp;&nbsp;</div>
				<div class="clearfix"></div>
				<div class="well well-small muted meta">
					<span><i class="icon-book"></i>&nbsp;<?php echo the_category(',');?></span>
					<span><i class="icon-calendar"></i>&nbsp;<?php echo the_time('Y-m-d h:i'); ?></span>
					<span><i class="icon-pencil"></i>&nbsp;<?php echo the_author_posts_link();?></span>
					<span><i class="icon-comment"></i>&nbsp;<?php comments_popup_link('0', '1', '%','','-');?></span>
					<span><?php the_tags('<i class="icon-tags"></i>&nbsp;'); ?></span>
				</div>
			</section>
			<?php
		}while(false);
	}
	//分页位置
	global $wp_query;
	$big = 999999999; // need an unlikely integer
	?>
	<div class="pagination pagination-centered">
	<?php
	echo paginate_links( array(
		'base'         => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'       => '?page=%#%',
		'total'        => $wp_query->max_num_pages,//总页数
		'current'      => max( 1, get_query_var('paged') ),//当前页码
		'show_all'     => False,
		'end_size'     => 1,
		'mid_size'     => 3,
		'prev_next'    => True,
		'prev_text'    => __('上一页'),
		'next_text'    => __('下一页'),
		'type'         => 'list',
		'add_args'     => False,
		'add_fragment' => ''
	) );
	?>
	</div>
	<?php
}
?>