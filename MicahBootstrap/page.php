<?php 
get_header(); 
if(have_posts()) {
	the_post();
	?>
	<article class="content">
		<h1><?php the_title(); ?></h1>
		<?php the_content(); ?>				
		<div class="meta">
			<span><i class="icon-calendar"></i>&nbsp;<?php echo the_time('Y-m-d h:i'); ?></span>
		</div>
	</article>
	<?php
	comments_template('', true);
}
get_sidebar();
get_footer(); ?>