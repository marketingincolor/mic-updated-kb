<?php
/**
 * The header template
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php bloginfo('name'); ?> </title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans' type='text/css' />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/foundation.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr.js"></script>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="row large-collapse">
		<div class="small-12">
			<nav class="top-bar" data-topbar>
				<ul class="title-area">
					<li class="name"><!-- Leave this empty --></li>
					<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
				</ul>
				<section class="top-bar-section">
					<?php
					wp_nav_menu( array(
						'theme_location'  => 'primary',
						'menu'            => 'main-menu',
						'container'       => false,
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'main-menu',
						'menu_id'         => 'mid',
						'fallback_cb'     => 'wp_page_menu',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 3,
						'walker'          => new foundation_walker_nav_menu
					) );
					?>
				</section>
			</nav>
		</div>
    </div>
    <div class="row default large-collapse">
        <div class="small-12 columns">
			<section class="scroll-container" role="main">