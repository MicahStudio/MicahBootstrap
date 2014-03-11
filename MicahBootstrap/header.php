<!DOCTYPE html>
<html dir="ltr" lang="zh-CN">
	<head>
		<title><?php wp_title('&#124;', true, 'right'); ?><?php bloginfo('name'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' )?>" />
		<?php wp_head();?>
	</head>
	<body>
		<!--导航开始-->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<?php 
					if (is_user_logged_in()){
						?>
						<a class="brand" href="<?php echo wp_logout_url(); ?>">退出</a>
						<?php
					}else{
						?>
						<a class="brand" href="<?php echo wp_login_url(); ?>">登录</a>
						<?php
					}
					?>
					<div class="nav-collapse collapse">
						<?php wp_nav_menu(array(
								'theme_location' => 'primary',
								'container'=>false,
								'menu_class' => 'nav',
								'menu_id' => 'navbar',
								'fallback_cb'=>'<a href="/">首页</a>')); ?>
					</div>
				</div>
			</div>
		</nav>
		<!--导航结束-->
		<!--Banner开始-->
		<header class="jumbotron subhead" id="overview">
			<div class="container">
				<a href="/" class="brand"><h1><?php bloginfo('name');?></h1></a>
				<p class="lead text-right" id="description"><?php bloginfo('description');?></p>
			</div>
		</header>
		<!--Banner结束-->
		<!--正文开始-->
		<?php if(is_user_logged_in()){ ?>
		<div class="affix btn-toolbar hidden-phone" style="margin:10px;">
			<div id="toolbar" class="btn-group btn-group-vertical">			
				<a href="/wp-admin/" class="btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="后台面板"><i class="icon-home"></i></a>
			<?php 
				if(current_user_can('manage_options')||current_user_can('publish_pages')){
					?>
					<a href="/wp-admin/post-new.php" class="btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="新建文章"><i class="icon-pencil"></i></a>
					<?php
				}
			?>
			<?php 
				if(current_user_can('manage_options')){
					?>
					<a href="/wp-admin/link-add.php" class="btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="新建链接"><i class="icon-globe"></i></a>
					<a href="/wp-admin/media-new.php" class="btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="新建媒体"><i class="icon-film"></i></a>
					<a href="/wp-admin/user-new.php" class="btn" data-toggle="tooltip" data-placement="right" title="" data-original-title="新增用户"><i class="icon-user"></i></a>
					<?php
				}
			?>
			<?php if ( is_singular() ){
					edit_post_link('<i class="icon-edit"></i>', '', ''); 
				}
			?>
			</div>
		</div>
		<?php }?>
		<div id="container" class="container">
			<div class="row">
				<!--左侧正文开始-->
				<div class="span9">