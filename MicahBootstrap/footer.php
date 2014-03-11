			</div>
		</div>
		<!--正文结束-->
		<!--底部区域开始-->
		<div id="footer" class="navbar navbar-fixed-bottom">
			<div class="navbar-inner">
				<div class="container">
					<div id="copyright" class="pull-left">
						Copyright <abbr title="<?php echo  get_num_queries().'次，用了'. timer_stop().'s';?>">©</abbr> 1985-? <a href="<?php echo home_url(); ?>" title="" data-toggle="tooltip" data-placement="top" data-original-title="<?php bloginfo('description');?>"><i class="icon-leaf"></i>&nbsp;<?php bloginfo('name');?></a>&nbsp;&nbsp;Themes By <a href="http://luacloud.com" title="<?php e_version();?>" data-toggle="tooltip" data-placement="top"><i class="icon-fire"></i>&nbsp;有生之年</a>&nbsp;&nbsp;<a href="http://adf.ly/X8HSE" title="草榴社区" data-toggle="tooltip" data-placement="top" target="_blank">你看这是啥</a>&nbsp;&nbsp;ICP备案号：<a href="http://www.miitbeian.gov.cn/" rel="external nofollow" target="_blank"><?php echo get_option( 'zh_cn_l10n_icp_num' );?></a>

					</div>
					<div class="btn-toolbar pull-right">
							<div id="boottom-toolbar" class="btn-group">
							<a id="up" class="btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="去顶部"><i class="icon-chevron-up"></i></a>
							<?php 
								if(is_singular()){
									?>												
									<a id="to_comments" class="btn"  data-toggle="tooltip" data-placement="top" title="" data-original-title="查看评论"><i class="icon-comment"></i></a>
									<a id="to_respond" class="btn"  data-toggle="tooltip" data-placement="top" title="" data-original-title="去评论"><i class="icon-plus"></i></a>
									<?php
								}
							?>
							<a id="down" class="btn"  data-toggle="tooltip" data-placement="top" title="" data-original-title="下翻一屏 or 到底部（这是不确定的）"><i class="icon-chevron-down"></i></a>
						</div>
					</div>
				</div>
			</div>
		</div>		
		<div class="hidden-phone hidden-tablet hidden-desktop">
		<script type="text/javascript">var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F98c420e0d7e5b6ec4b0377cf3e9b5022' type='text/javascript'%3E%3C/script%3E"));</script>
		</div>
		<!--底部区域结束-->
<!-- JQuery and Bootstrap -->
		<?php
		wp_footer();
		if(function_exists(lazyloadAd)){
			lazyloadAd();
		}
		?>
	</body>
</html>