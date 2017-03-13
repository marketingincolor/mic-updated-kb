<?php
require_once ('admin/index.php');
$pl_data = $smof_data;
require_once ('libs/multiple_sidebars.php');
require_once ('libs/really-simple-captcha/really-simple-captcha.php');
require_once ('libs/metaboxes/class-usage.php');
require_once ('libs/metronet-reorder-posts/index.php');
require_once ('libs/shortcodes/shortcodes.php');
require_once ('libs/custom_functions.php');
require_once ('libs/aq_resizer.php');
require_once ('libs/likethis.php');

// Widgets
require_once ('libs/widgets/tabs.php');
require_once ('libs/widgets/recent_posts.php');
require_once ('libs/widgets/ads.php');
require_once ('libs/widgets/flickr.php');
require_once ('libs/widgets/facebook_box.php');
require_once ('libs/widgets/social.php');
require_once ('libs/widgets/tweet.php');
require_once ('libs/widgets/newsletter.php');


$theme_url = get_template_directory_uri();
global  $pl_data, $theme_url;

// Localization
load_theme_textdomain('presslayer', get_template_directory() . '/languages/');

// Get scripts
add_action('wp_enqueue_scripts','theme_scripts_function');

function theme_scripts_function() {
	global $post, $pl_data, $theme_url;
	
	//CSS
	wp_enqueue_style('Roboto-Condensed', 'http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300');
	wp_enqueue_style('reset', $theme_url . '/css/reset.css');
	wp_enqueue_style('font-awesome.min', $theme_url . '/css/font-awesome.min.css');
	wp_enqueue_style('flexslider', $theme_url . '/css/flexslider.css');
	wp_enqueue_style('superfish', $theme_url . '/css/superfish.css');
	wp_enqueue_style('mediaelement', $theme_url . '/js/mediaelement/build/mediaelementplayer.min.css');
	wp_enqueue_style('style', get_bloginfo('stylesheet_url'));
	wp_enqueue_style('fancybox', $theme_url . '/js/fancybox/jquery.fancybox-1.3.4.css');
	
	//JS
	wp_enqueue_script('jquery');
	wp_enqueue_script('easing', $theme_url . '/js/jquery.easing-1.3.js',array('jquery'), '1.0', true);
	//wp_enqueue_script('masonry', $theme_url . '/js/jquery.masonry.min.js',array('jquery'), '1.0', true);
	wp_enqueue_script('masonry', site_url() . '/wp-includes/js/masonry.min.js',array('jquery'), '1.0', true);
	wp_enqueue_script('masonry_shim', site_url() . '/wp-includes/js/jquery/jquery.masonry.min.js',array('jquery'), '1.0', true);
	wp_enqueue_script('imagesloaded', $theme_url . '/js/jquery.imagesloaded.min.js',array('jquery'), '1.0', true);
	wp_enqueue_script('infinitescroll', $theme_url . '/js/jquery.infinitescroll.min.js',array('jquery'), '1.0', true);
	wp_enqueue_script('superfish', $theme_url . '/js/superfish.js',array('jquery'), '1.0', true);
	wp_enqueue_script('hoverIntent', $theme_url . '/js/hoverIntent.js',array('jquery'), '1.0', true);
	wp_enqueue_script('mediaelement', $theme_url . '/js/mediaelement/build/mediaelement-and-player.min.js',array('jquery'), '1.0', true);
	wp_enqueue_script('fancybox', $theme_url . '/js/fancybox/jquery.fancybox-1.3.4.pack.js',array('jquery'), '1.0', true);
	wp_enqueue_script('mobilemenu', $theme_url . '/js/jquery.mobilemenu.js',array('jquery'), '1.0', true);
	wp_enqueue_script('fitvids', $theme_url . '/js/jquery.fitvids.js',array('jquery'), '1.0', true);
	wp_enqueue_script('flexslider', $theme_url . '/js/jquery.flexslider-min.js',array('jquery'), '1.0', true);
	wp_enqueue_script('placeholder', $theme_url . '/js/jquery.placeholder.min.js',array('jquery'), '1.0', true);
	wp_enqueue_script('jflickrfeed', $theme_url . '/js/jflickrfeed.min.js',array('jquery'), '1.0', true);
	wp_enqueue_script('custom', $theme_url . '/js/custom.js',array('jquery'), '1.0', false);
	
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	
	
}

// Custom styles
add_action('wp_head', 'theme_css_function');
function theme_css_function() {
	global $post, $pl_data, $theme_url;
	
	echo '<style type="text/css">';
	if($pl_data['custom_bg']!='') echo 'body{ background-image: url('.$pl_data['custom_bg'].')}';
	if($pl_data['body_background']!='') echo 'body{ background-color: '.$pl_data['body_background'].'}';	
	
	// Custom page background 
	if(is_page() or is_single()){
	$background = get_post_meta($post->ID, 'pl_background', true);
	$bg_align = get_post_meta($post->ID, 'pl_bg_align', true);
	$bg_attachment = get_post_meta($post->ID, 'pl_bg_attachment', true);
	$bg_repeat = get_post_meta($post->ID, 'pl_bg_repeat', true);
	$bg_size = get_post_meta($post->ID, 'pl_bg_size', true);
	
		if($background!='') {
			echo 'body.page-id-'.$post->ID.'{ background-image: url('.$background.'); background-position: '.$bg_align.'; background-repeat: '.$bg_repeat.'; background-attachment: '.$bg_attachment.';';
			if($bg_size!='none') echo 'background-size: '.$bg_size.'!important';
			echo '}';
		}
	}
	
	if(!empty($pl_data['custom_css'])) echo stripslashes($pl_data['custom_css']);
	echo '</style>';
}

// Menu
register_nav_menu('navigation', 'Navigation'); 

// Add theme support
add_theme_support('post-thumbnails');
add_image_size('thumb', 710);
add_image_size('slider', 710, 400, true);
add_theme_support('custom-background');
add_theme_support('automatic-feed-links');
add_theme_support( 'post-formats', array( 'audio','video', 'quote') );

if ( ! isset( $content_width ) ) $content_width = 800;


/*-----------------------------------------------------------------------------------*/
/*	Custom Post Types
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'create_post_types' );
function create_post_types() {
	
		
	// Slider Post Type
	register_post_type( 'slider',
		array(
		  'labels' => array(
			'name' => __( 'Slider','presslayer' ),
			'singular_name' => __( 'Slider','presslayer' )
		  ),
		  'public' => true,
		  'supports' => array('title','editor','thumbnail')
		)
	);
	
}

/*-----------------------------------------------------------------------------------*/
/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ){

	// Default sidebar
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar',
		'description' => 'Widgets in this area will be shown in the sidebar on the blog and regular posts.',
		'before_widget' => '<div id="%1$s" class="widget %2$s white_box">',
		'after_widget' => '<div class="clear"></div></div>',
		'before_title' => '<h3 class="widget_title">',
		'after_title' => '</h3>',
	));
	
} //function_exists('register_sidebar')


add_filter('next_posts_link_attributes', 'posts_link_next_class');
function posts_link_next_class() {
    return 'class="button gray full"';
} 


/*-----------------------------------------------------------------------------------*/
/*	Custom Navigation Walker
/*-----------------------------------------------------------------------------------*/
class custom_walker_nav_menu extends Walker_Nav_Menu {
// add main/sub classes to li's and links
 function start_el( &$output, $item, $depth, $args ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
    // depth dependent classes
    $depth_classes = array(
        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
    // passed classes
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
    // build html
    $output .= $indent . '<div id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '"><div class=" large_thumb thumb_hover">';
  
    // link attributes
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

	$navpage = get_page_by_title($item->title);
	if ($args->menu_id == 'big') {
		//$navpageimg = get_the_post_thumbnail($navpage->ID, array(240,320), array('class' => "post_top_element") );
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($navpage->ID), 'full');
		$md_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($navpage->ID), 'medium');
		$navpageimg = '<img src="'.$md_image_url[0].'" class="post_top_elementz wp-post-image" style="width:200px; height:267px;">';
	} else {
		//$navpageimg = get_the_post_thumbnail($navpage->ID, array(100,133), array('class' => "post_top_element") );
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($navpage->ID), 'full');
		$md_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($navpage->ID), 'medium');
		$navpageimg = '<img src="'.$md_image_url[0].'" class="post_top_elementz wp-post-image" style="width:160px; height:213px;">';
	}
	$themefeatures = '<div class="icon_bar for_link"><a href="'. $item->url .'" rel="bookmark" title="'.$item->attr_title.'" class="icon link"></a></div>';
	$themefeatures .= '<div class="icon_bar for_view"><a href="'. $large_image_url[0] .'" class="icon view fancybox"></a></div>';
    $bio_title = get_post_meta($navpage->ID, 'bio_title', true);
	$bio_fb = get_post_meta($navpage->ID, 'bio_fb', true);
	$bio_tw = get_post_meta($navpage->ID, 'bio_tw', true);
	$bio_li = get_post_meta($navpage->ID, 'bio_li', true);
	$bio_gp = get_post_meta($navpage->ID, 'bio_gp', true);
	$bio_social = !empty($bio_fb) ? '<a href="'.$bio_fb.'"><img src="'.get_template_directory_uri().'/images/social_icons/facebook.png" style="background-color: #6F85AE; padding:4px;"></a>' : '';
	$bio_social .= !empty($bio_tw) ? '&nbsp;<a href="'.$bio_tw.'"><img src="'.get_template_directory_uri().'/images/social_icons/twitter.png" style="background-color: #23B6C6; padding:4px;"></a>' : '';
	$bio_social .= !empty($bio_li) ? '&nbsp;<a href="'.$bio_li.'"><img src="'.get_template_directory_uri().'/images/social_icons/linkedin.png" style="background-color: #006699; padding:4px;"></a>' : '';
	$bio_social .= !empty($bio_gp) ? '&nbsp;<a href="'.$bio_gp.'"><img src="'.get_template_directory_uri().'/images/social_icons/google+.png" style="background-color: #DD3d3d; padding:4px;"></a>' : '';
	
	$item_output = sprintf( '%1$s <div class="img_wrapper"><a %2$s > %7$s </a></div></div>%3$s %4$s %5$s <h5>%8$s</h5> %6$s <div class="bio_sc">%9$s</div> </div>',
        /*$args->before*/ $themefeatures,
        $attributes,
        $args->link_before,
        apply_filters( 'the_title', $item->title, $item->ID ),
        $args->link_after,
        $args->after,
		$navpageimg,
		$bio_title,
		$bio_social
    );
  
    // build html
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}
}

function sb_shortcode() {
    global $post;
	$bio_fb = get_post_meta($post->ID, 'bio_fb', true);
	$bio_tw = get_post_meta($post->ID, 'bio_tw', true);
	$bio_li = get_post_meta($post->ID, 'bio_li', true);
	$bio_gp = get_post_meta($post->ID, 'bio_gp', true);
	$bio_social = !empty($bio_fb) ? '<a href="'.$bio_fb.'"><img src="'.get_template_directory_uri().'/images/social_icons/facebook.png" style="background-color: #6F85AE; padding:4px;"></a>' : '';
	$bio_social .= !empty($bio_tw) ? '&nbsp;<a href="'.$bio_tw.'"><img src="'.get_template_directory_uri().'/images/social_icons/twitter.png" style="background-color: #23B6C6; padding:4px;"></a>' : '';
	$bio_social .= !empty($bio_li) ? '&nbsp;<a href="'.$bio_li.'"><img src="'.get_template_directory_uri().'/images/social_icons/linkedin.png" style="background-color: #006699; padding:4px;"></a>' : '';
	$bio_social .= !empty($bio_gp) ? '&nbsp;<a href="'.$bio_gp.'"><img src="'.get_template_directory_uri().'/images/social_icons/google+.png" style="background-color: #DD3d3d; padding:4px;"></a>' : '';
return $bio_social;
}
add_shortcode('bio_social_media', 'sb_shortcode');

function biotitle_shortcode() {
	global $post;
	$bio_title = get_post_meta($post->ID, 'bio_title', true);
	return $bio_title;
}
add_shortcode('bio_title', 'biotitle_shortcode');
	
?>