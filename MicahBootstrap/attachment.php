<?php get_header(); ?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<article class="content">
			<?php if ( ! empty( $post->post_parent ) ) : ?>
				<h1 class="post_title"><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php echo esc_attr( sprintf( __( 'Return to %s', 'twentyten' ), strip_tags( get_the_title( $post->post_parent ) ) ) ); ?>" rel="gallery"><?php printf( __( '<span class="meta-nav">back to </span> %s' ), get_the_title( $post->post_parent ) ); ?></a></h1>
			<?php endif; ?>
			<?php if ( wp_attachment_is_image() ): ?>
			<div class="wp-caption aligncenter">
			<a href="<?php echo wp_get_attachment_url(); ?>" title="<?php echo strip_tags(the_title());?>"><?php echo wp_get_attachment_image( $post->ID, array( 600, 600 ) ); ?></a>
			<p class="wp-caption-text"><?php the_title(); ?></p>
			</div>
			<?php
				@$exif = exif_read_data(wp_get_attachment_url(), "IFD0");
				if($exif===false){
					
				}else{					
					$exif = exif_read_data(wp_get_attachment_url(), 0,true);
				?>
				<div class="exif">
					<fieldset>
						<legend>
						<?php
							if($exif[EXIF][ExifVersion]){
								printf(__('<strong>%1$s：<small>%2$s</small></strong>'),'Exif版本',$exif[EXIF][ExifVersion]);
							}
							if($exif[IFD0][Make]){
								printf(__('<strong>%1$s：<small>%2$s</small></strong>'),'制造商',$exif[IFD0][Make]);
							}
							if($exif[IFD0][Model]){
								printf(__('<strong>%1$s：<small>%2$s</small></strong>'),'型号',$exif[IFD0][Model]);
							}
						?>
					</legend>
					<?php
						if($exif[COMPUTED][ApertureFNumber]){
							printf(__('<strong>%1$s：<small>%2$s</small></strong>'),'光圈',$exif[COMPUTED][ApertureFNumber]);
						}
						if($exif[EXIF][ExposureTime]){
							printf(__('<strong>%1$s：<small>%2$s</small></strong>'),'快门',$exif[EXIF][ExposureTime]);
						}
						if($exif[EXIF][FocalLength]){
							printf(__('<strong>%1$s：<small>%2$s</small></strong>'),'焦距',$exif[EXIF][FocalLength]);
						}
						if($exif[EXIF][ISOSpeedRatings]){
							printf(__('<strong>%1$s：<small>%2$s</small></strong>'),'ISO',$exif[EXIF][ISOSpeedRatings]);
						}
						if($exif[EXIF][DateTimeOriginal]){
							printf(__('<strong>%1$s：<small>%2$s</small></strong>'),'拍摄日期',$exif[EXIF][DateTimeOriginal]);
						}
					?>
					</fieldset>
				</div>
			<?php }
			endif?>
				<dl>
					<dd>
						<span>标题：</span><?php echo strip_tags(the_title());?>
					</dd>
					<dd>
						<span>上传：</span>by <?php echo the_author_posts_link();?> <?php edit_post_link( __( 'Edit'),' &raquo; '); ?>
					</dd>
					<dd>
						<span>说明：</span><?php echo strip_tags($post->post_excerpt);?>
					</dd>
					<dd>
						<span>描述：</span><?php echo strip_tags($post->post_content);?>
					</dd>
					<dd>
						<span>文件类型：</span><?php echo strip_tags($post->post_mime_type); ?>
					</dd>
					<?php if(wp_attachment_is_image()){$metadata = wp_get_attachment_metadata();?>					
					<dd>
						<span>分辨率：</span><?php echo $metadata['width'].'&times;'.$metadata['height']?> pixels.
					</dd>
					<?php }else{ ?>
					<dd>
						<span>下载地址：</span><a href="<?php echo wp_get_attachment_url(); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">点此下载</a>
					</dd>
					<?php }?>
					<dd>
						<span>更新时间：</span><?php echo get_the_date('Y年m月d日').' '.get_the_time('h:i');?>
					</dd>
				</dt>
				<div class="clear"></div>
			</article>
		<?php comments_template('', true); ?>
		<?php endwhile; // end of the loop. ?>
	</div><!-- container end -->
<?php get_sidebar();get_footer(); ?>