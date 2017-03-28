<?php
/**
 * The header template
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
$header_class = 'header-base';
	if ( is_front_page() ) {
		$header_class = 'header-base';
	} elseif ( is_page('about') ) {
		$header_class = 'header-base-about';
	} elseif ( is_page('services') || is_child('services') ) {
		$header_class = 'header-base-serv';
	} elseif ( is_page('downtown') || is_child('downtown') ) {
		$header_class = 'header-base-down';
	} elseif ( is_post_type_archive('case-study') || is_singular('case-study') ) {
		$header_class = 'header-base-serv';
	} elseif ( is_category('blog') || in_category( array('blog','technology','buzz','news','downtown-stories') ) ) {
		$header_class = 'header-base-blog';
	} elseif ( is_404() ) {
		$header_class = 'header-base-404';
	}
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php bloginfo('name'); ?> </title>
	<meta name="google-site-verification" content="YtcOKQDwGTKB4KJyQLt97XAipBb9kaAA_e7tnMjlzso" />
	<link rel="alternate" href="http://www.marketingincolor.com" hreflang="en-us" />
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans|Arvo|Lato' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/foundation.min.css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/slick/slick-theme.css"/>
	<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr.js"></script>


	<?php wp_head(); ?>

	<script type="text/javascript">
		jQuery(function($){
			$('.search-link').click(function () {
				$('.header-search').toggleClass('close');
			});
		})
	</script>
	<script type='text/javascript' src='http://smartzonessva.com/tag?171'></script>
	<script type="text/javascript">
		var _ss = _ss || [];
		_ss.push(['_setDomain', 'https://koi-UUHGVW.sharpspring.com/net']);
		_ss.push(['_setAccount', 'KOI-YU6QP0']);
		_ss.push(['_trackPageView']);
		(function() {
			var ss = document.createElement('script');
			ss.type = 'text/javascript'; ss.async = true;
			ss.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'koi-UUHGVW.sharpspring.com/client/ss.js?ver=1.1.1';
			var scr = document.getElementsByTagName('script')[0];
			scr.parentNode.insertBefore(ss, scr);
		})();
	</script>
</head>

<body <?php body_class(); ?>>	
	<div class="<?php echo $header_class; ?> NOTorange-bg NOTcontain-to-grid NOTrow NOTlarge-collapse">
        <header id="masthead" class="site-header" role="banner">
			<div class="row">
				<div id="logo" class="small-12 columns" itemscope itemtype="http://schema.org/Organization">
					<a itemprop="url" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img itemprop="logo" src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-header-logo.png" alt="Company Logo" /></a>
				</div>
            </div>
            <div class="row">
				<div id="description" class="small-12 columns">
					<h3><?php bloginfo( 'description' ); ?></h3>
				</div>
            </div>
		</header>
	</div>
    <div id="site-cta" class="contain-to-grid green-bg">
        <div class="row">
            <div class="small-12 columns">

			        <div class="mic-breadcrum">
			            <?php echo kbe_breadcrumbs(); ?>
			        </div>
	

	            <script type="text/javascript">
		            var __ss_noform = __ss_noform || [];
		            __ss_noform.push(['baseURI', 'https://app-UUHGVW.marketingautomation.services/webforms/receivePostback/MzQ1sAAA/']);
		            __ss_noform.push(['endpoint', '0c57b7a3-a1c0-4e79-a1a9-76dd0d2afc72']);
	            </script>
	            <script type="text/javascript" src="https://koi-UUHGVW.marketingautomation.services/client/noform.js?ver=1.24" ></script>

            </div>
        </div>
    </div>