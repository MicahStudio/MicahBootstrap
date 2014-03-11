<?php get_header(); ?>
<section class="suspended">
	<div class="hero-unit">
		<h1>走错路了啊？</h1>
		<h1>没关系，按下它吧！</h1>
		<p class="text-right">
			<?php $rand_post=get_posts('numberposts=1&orderby=rand'); 
				foreach($rand_post as $post) : ?>
				<a class="btn btn-primary btn-large" title="随机进入一篇文章"href="<?php the_permalink(); ?>">
				试试手气,随机进入一篇文章!
				</a>
				<?php endforeach; ?>
		</p>
	</div>
</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>