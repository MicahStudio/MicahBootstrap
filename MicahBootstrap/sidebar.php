</div>
<!--左侧正文结束-->
<!--右侧工具条开始-->
<div class="span3 hidden-phone">
	<div class="sidebar">
		<ul class="unstyled">
			<li>
				<div class="widget" id="seacher">
					<?php get_search_form('查询'); ?>
				</div>
			</li>
			<li>
				<div class="widget">
					<div class="ad"><script type="text/javascript">
/*250*250，创建于2012-5-13*/
var cpro_id = "u893848";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>
					</div>
				</div>
			</li>
			<?php
			wp_reset_query();
			if(!is_404()&&function_exists('get_recent_comments')){
			?>
			<li>
				<div class="widget">
					<h4>最新评论</h4>
					<div>
						<?php get_recent_comments(10); ?>
					</div>
				</div>
			</li>
			<?php
			}
			if(function_exists(get_rand_posts)){
				?>
			<li>
				<div class="widget">
					<h4>随机文章</h4>
					<div>
						<?php get_rand_posts(7); ?>
					</div>
				</div>
			</li>
				<?php
			}
			wp_reset_query();
			if(!is_404()){
			?>
			<li>
				<div class="widget">
					<div id="nuffnangad" class="ad"></div>
				</div>
			</li>
			<li>
				<div class="widget">
					<div id="alivvad" class="ad"></div>
				</div>
			</li>
			<li>
				<div class="widget">
					<div id="alimama" class="ad"></div>
				</div>
			</li>
			<?php
			}
			wp_reset_query();
			if(is_home()){
			?>
			<li>
				<div class="widget">
					<h4>友情邻居</h4>
					<div>
						<ul class="unstyled roll">
						<?php wp_list_bookmarks(array('title_li' => '',
													'title_before' => '',
													'title_after' => '',
													'categorize' => 0,
													'orderby' => 'rand',
													'class' =>'badge badge-important',
													'category_before' =>'<li id=%id class=%class><i class="icon-globe"></i>&nbsp;',
													'category_after' =>'</li>'));?>
						</ul>
					</div>
				</div>
			</li>
			<?php
			}
			?>
		</ul>
	</div>
</div>
<!--右侧工具条结束-->