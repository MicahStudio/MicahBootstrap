<?php get_header(); ?>
			<div class="content">
			<?php
				if(isset($_GET['author_name'])) :
					$curauth = get_userdatabylogin($author_name);
				else :
					$curauth = get_userdata(intval($author));
				endif;
			?>
			<h2>关于作者: <?php echo $curauth->nickname; ?></h2>
			<dl>
				<dt>作者资料</dt>
				<?php if($curauth->aim){ ?>
				<dd>
					<span>AIM：</span><?php echo $curauth->aim; ?>
				</dd>
				<?php } ?>
				
				<?php if($curauth->last_name&&$curauth->first_name){ ?>
				<dd>
					<span>真实姓名：</span><?php echo $curauth->last_name.' '.$curauth->first_name; ?>
				</dd>
				<?php } ?>
				
				<?php if($curauth->nickname){ ?>
				<dd>
					<span>笔名：</span><?php echo $curauth->nickname; ?>
				</dd>
				<?php } ?>
				
				<?php if($curauth->jabber){ ?>
				<dd>
					<span>Jabber或GTalk：</span><?php echo $curauth->jabber; ?>
				</dd>
				<?php } ?>
				
				<?php if($curauth->user_email){ ?>
				<dd>
					<span>EMail：</span><?php echo $curauth->user_email; ?>
				</dd>
				<?php } ?>
				
				
				<?php if($curauth->user_registered){ ?>
				<dd>
					<span>注册日期：</span><time datetime="<?php echo $curauth->user_registered; ?>"><?php echo $curauth->user_registered; ?></time>
				</dd>
				<?php } ?>
				
				<?php if($curauth->yim){ ?>
				<dd>
					<span>YIM：</span><?php echo $curauth->yim; ?>
				</dd>
				<?php }
				if($curauth->user_url){ ?>
				<dd>
					<span>个人站点：</span><a href="<?php echo $curauth->user_url; ?>" style="background:url('http://www.google.com/s2/favicons?domain=<?php echo $curauth->user_url; ?>') no-repeat;padding-left:24px;">
						<?php echo $curauth->user_url; ?>
					</a>
				</dd>
				<?php }
				if($curauth->user_description){ ?>
				<dt>个人说明</dt>
				<dd>
					<?php echo $curauth->user_description; ?>
				</dd>
				<?php } ?>
			</dl>
			</div>
			<div class="content">
				<h2><?php echo $curauth->nickname; ?>的文章:</h2>
				<ul style="margin:20px;padding-bottom:20px;">
			<!-- The Loop -->
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<li style="border-width:1px;border-style:none none dotted none;border-color:#CCC;">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
						<?php the_title(); ?></a>
						<span style="float:right;margin-right:20px;"><?php the_time('Y年m月d日 h:i'); ?> in <?php the_category('&');?></span>
					</li>
				<?php endwhile; else: ?>
					<p><?php _e('No posts by this author.'); ?></p>

				<?php endif; ?>
			<!-- End Loop -->

				</ul>
			</div>
			<div class="content">
				<h2>所有作者:</h2>
				<div style="padding:20px;">
				<?php wp_list_authors('show_fullname=0&exclude_admin=0&hide_empty=0&optioncount=1&style='); ?>
				</div>
			</div>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>