<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#" xmlns:fb="https://www.facebook.com/2008/fbml">
<head>
	<title><?php wp_title('|', true, 'right'); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/style.css" />
	
	<!--[if lt IE 9]>
		<script src="<?php bloginfo('template_directory'); ?>/js/html5shiv.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/ie.css" />
	<![endif]-->
	
	<?php if (have_posts()):while(have_posts()):the_post(); endwhile; endif;?>
	<meta property="fb:app_id" content="350352811668809" />

	<?php if (is_single()) { ?>
		<meta property="og:url" content="<?php the_permalink() ?>"/>
		<meta property="og:title" content="<?php single_post_title(''); ?>" />
		<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
		<meta property="og:type" content="article" />
		<meta property="og:image" content="<?php if(has_post_thumbnail()) { echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); } else { echo get_bloginfo('template_directory') . '/img/saraste-logo-facebook.jpg'; } ?>" />
	<?php } else { ?>
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
		<meta property="og:description" content="<?php bloginfo('description'); ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:image" content="<?php echo get_bloginfo('template_directory') . '/img/saraste-logo-facebook.jpg'; ?>" />
	<?php } ?>
	
	<?php wp_head(); ?>
	<?php wp_enqueue_script('social', get_bloginfo('template_directory') . '/js/social.js'); ?>
	<script src="<?php bloginfo('template_directory'); ?>/lib/bootstrap/js/bootstrap.min.js"></script>
	<?php wp_enqueue_script('flickrCarousel', get_bloginfo('template_directory') . '/js/flickrCarousel.js', array('jquery'), '1.0'); ?>
</head>

<body <?php body_class($class); ?>>
	<div id="fb-root"></div>
	<div id="responsive-grid" class="container">
		<div id="flickrCarousel" class="carousel slide">
			<div class="carousel-inner">
				<div class="item active placeholder"></div>
			</div>
		</div>
		<header>
			<a id="logo" href="<?php echo home_url(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/img/saraste-logo-badge.png" alt=""></a>
			<a id="tagline" href="<?php echo home_url(); ?>"><h1><span class="visible-desktop">Saraste, </span>Pääkaupunkiseudun Partiolaisten piirileiri<span class="hidden-phone"><br>Evo, Hämeenlinna 30.7.&ndash;7.8.2012</span></h1></a>
			<nav>
				<div class="navbar">
					<div class="navbar-inner">
						<div class="container">

							<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
							<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</a>

							<!-- Be sure to leave the brand out there if you want it shown -->
							<a class="brand" href="<?php echo home_url(); ?>"><img src="<?php bloginfo( 'template_directory' ); ?>/img/saraste-logo-nav.png" alt="Saraste 2012"></a>

							<!-- Everything you want hidden at 940px or less, place within here -->
							<div class="nav-collapse">
								<?php wp_nav_menu(
												array(
													'theme_location' => 'nav',
													'container' => false,
													'menu_class' => 'nav',
													'depth' => 2,
													'walker' => new bootstrap_menu()
													)
												);
								?>
								<form class="navbar-search pull-right" action="<?php echo home_url(); ?>" method="get">
									<i class="icon-search icon-white"></i> <input type="text" name="s" class="search-query" placeholder="Etsi sivustolta...">
								</form>
								<!-- .nav, .navbar-search, .navbar-form, etc -->
							</div>
						</div>
					</div>
				</div>
			</nav>
		</header>

		<section id="content">
