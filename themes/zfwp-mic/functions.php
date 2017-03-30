<?php
/**
 * ZFWP Base Theme functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * @link http://codex.wordpress.org/Plugin_API
 *
 */
if ( ! function_exists( 'theme_setup' ) ) :
	/**
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 */
	function theme_setup() {
		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		// Enable support for Post Thumbnails, and declare three additional sizes.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 600, 260 );
		add_image_size( 'story-thumb', 600, 260, true );
		add_image_size( 'list-thumb', 250, 250, true );
		add_image_size( 'what-we-do-thumb', 390, 250, true );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
			'primary'   =>  'Header menu',
			'secondary' => 'Footer menu'
		) );
		//Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );
		//Enable support for Post Formats. See http://codex.wordpress.org/Post_Formats
		add_theme_support( 'post-formats', array(
			'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
		) );
		//Creating custom theme settings
		require get_template_directory() . '/includes/custom-settings.php';
	}
endif;
add_action( 'after_setup_theme', 'theme_setup' );

require get_template_directory() . '/includes/foundation-wp-navwalker.php';
require get_template_directory() . '/includes/custom-wp-navwalker.php';

//Initialize and Register sidebars for theme
function theme_widgets_init() {
	register_sidebar(array(
		'name' => __( 'Primary Sidebar', 'zfwpbase' ),
		'id' => 'sidebar-1',
		'description' => __( 'Main sidebar content for site', 'zfwpbase' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Secondary Sidebar', 'zfwpbase' ),
		'id' => 'sidebar-2',
		'description' => __( 'Alternate sidebar content for site', 'zfwpbase' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __('Tertiary Sidebar', 'zfwpbase' ),
		'id' => 'sidebar-3',
		'description' => __( 'Alternate sidebar content for site', 'zfwpbase' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __( 'Footer One', 'zfwpbase' ),
		'id' => 'sidebar-4',
		'description' => __( 'Footer area content for site', 'zfwpbase' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __( 'Footer Two', 'zfwpbase' ),
		'id' => 'sidebar-5',
		'description' => __( 'Footer area content for site', 'zfwpbase' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name' => __( 'Footer Three', 'zfwpbase' ),
		'id' => 'sidebar-6',
		'description' => __( 'Footer area content for site', 'zfwpbase' ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));
}
add_action( 'widgets_init', 'theme_widgets_init' );
// Enqueue scripts and functions specific for theme
//function theme_scripts () {
//	wp_enqueue_script( 'devtheme-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140319', true );
//}
//add_action( 'wp_enqueue_scripts', 'theme_scripts' );

// Alter User Contact Methods to include other social media services
function modify_user_contact_methods( $user_contact ) {
	$user_contact['twitter'] = __( 'Twitter URL' );
	$user_contact['facebook']   = __( 'Facebook URL' );
	$user_contact['gplus'] = __( 'Google+ URL' );
	$user_contact['linkedin']   = __( 'LinkedIn URL' );
	unset( $user_contact['aim'] );
	unset( $user_contact['yim'] );
	unset( $user_contact['jabber'] );
	unset( $user_contact['googleplus'] );
	return $user_contact;
}
add_filter( 'user_contactmethods', 'modify_user_contact_methods' );

// Shortcode for display of Custom Contact Forms [ccf id="##"]
function ccf_shortcode ( $atts ){
	$val = shortcode_atts( array(
		'id' => '0'
	), $atts );
	$form_id = $val['id'];
	return ccf_output_form( $form_id );
}
add_shortcode('ccf_display', 'ccf_shortcode');

//Create custom display for Company Address
function display_co_address() {
	$custom_option = get_option('custom_option_name');
	echo $custom_option['ad_info'];
}
add_action( 'co_address', 'display_co_address', 10);

//Create custom display for Company Phone Number
function display_co_phone() {
	$custom_option = get_option('custom_option_name');
	echo $custom_option['ph_info'];
}
add_action( 'co_phone', 'display_co_phone', 10);

//Create custom display for Company Email
function display_co_email() {
	$custom_option = get_option('custom_option_name');
	echo $custom_option['em_info'];
}
add_action( 'co_email', 'display_co_email', 10);

//Create custom display for SharpSpring Login
function display_co_sharpspring() {
	$custom_option = get_option('custom_option_name');
	echo $custom_option['ss_info'];
}
add_action( 'co_sharpspring', 'display_co_sharpspring', 10);

//Create custom display for Social Media icons as grouped set.
function display_social_media_icons( $pagelocation ){
	$custom_option = get_option('custom_option_name');
	$stringfix = ($pagelocation == 'header' ? 'right' : 'center');
	echo '<div class="social-icons" itemscope itemtype="http://schema.org/Organization">';
	echo '<a itemprop="url" href="http://www.marketingincolor.com" class="hide"></a>';
	echo '<p style="text-align:' . $stringfix . ';" >' ;

	if ($custom_option['fb_link']) :
		echo '&nbsp;<a itemprop="sameAs" href="'.$custom_option['fb_link'].'" target="_blank"><i class="fa fa-facebook-square"></i></a>&nbsp;';
	endif;

	if ($custom_option['tw_link']) :
		echo '&nbsp;<a itemprop="sameAs" href="'.$custom_option['tw_link'].'" target="_blank"><i class="fa fa-twitter"></i></a>&nbsp;';
	endif;

	if ($custom_option['ig_link']) :
		echo '&nbsp;<a itemprop="sameAs" href="'.$custom_option['ig_link'].'" target="_blank"><i class="fa fa-instagram"></i></a>&nbsp;';
	endif;

	if ($custom_option['li_link']) :
		echo '&nbsp;<a itemprop="sameAs" href="'.$custom_option['li_link'].'" target="_blank"><i class="fa fa-linkedin-square"></i></a>&nbsp;';
	endif;

	if ($custom_option['pi_link']) :
		echo '&nbsp;<a itemprop="sameAs" href="'.$custom_option['pi_link'].'" target="_blank"><i class="fa fa-pinterest"></i></a>&nbsp;';
	endif;

	echo '</p></div>';
}
add_action( 'social_icons', 'display_social_media_icons', 10, 1 );

//Register the Excerpt for all Page post types
function add_excerpt_support_for_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
add_action( 'init', 'add_excerpt_support_for_pages' );

// Alter length of the Excerpt.
function custom_excerpt_length( $length ) {
	return 8;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Alter the more of the Excerpt.
function new_excerpt_more( $more ) {
	return ' ...';
	//return '... <div><a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( ' Read More', 'fwp-base' ) . '</a></div>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//Enable Shortcodes in Widgets
add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

//Enable PHP in Widgets
function php_execute($html){
	if(strpos($html,"<"."?php")!==false){ ob_start(); eval("?".">".$html);
		$html=ob_get_contents();
		ob_end_clean();
	}
	return $html;
}
add_filter('widget_text','php_execute',100);

// get_id_by_slug('any-page-slug','any-post-type');
function get_id_by_slug($page_slug, $slug_page_type = 'page') {
	$find_page = get_page_by_path($page_slug, OBJECT, $slug_page_type);
	if ($find_page) {
		return $find_page->ID;
	} else {
		return null;
	}
}

//Check if page is direct child, by ID, slug or title
function is_child( $parent = '' ) {
	global $post;
	$parent_obj = get_post( $post->post_parent, ARRAY_A );
	$parent = (string) $parent;
	$parent_array = (array) $parent;
	if ( in_array( (string) $parent_obj['ID'], $parent_array ) ) {
		return true;
	} elseif ( in_array( (string) $parent_obj['post_title'], $parent_array ) ) {
		return true;
	} elseif ( in_array( (string) $parent_obj['post_name'], $parent_array ) ) {
		return true;
	} else {
		return false;
	}
}

// Check if page is an ancestor, by ID
function is_ancestor($post_id) {
	global $wp_query;
	$ancestors = $wp_query->post->ancestors;
	if ( in_array($post_id, $ancestors) ) {
		return true;
	} else {
		return false;
	}
}

// Tests if any of a post's assigned categories are descendants of target categories
function post_is_in_descendant_category( $cats, $_post = null ) {
	foreach ( (array) $cats as $cat ) {
		// get_term_children() accepts integer ID only
		$descendants = get_term_children( (int) $cat, 'category' );
		if ( $descendants && in_category( $descendants, $_post ) )
			return true;
	}
	return false;
}

// custom category shortcode, if passed a slug will return categories of its children
function ccat_shortcode ( $atts ){
	$val = shortcode_atts( array(
		'slug' => ''
	), $atts );
	$slug_name = $val['slug'];
	$idObj = get_category_by_slug($slug_name);
	$id = $idObj->term_id;
	$args = array(
		'child_of' => $id,
		'title_li' => '',
		'depth' => '-1'
	);
	return wp_list_categories( $args );
}
add_shortcode('ccat-display', 'ccat_shortcode');

function rename_post_formats($translation, $text, $context, $domain) {
    $names = array(
        'Gallery'  => 'Infographic'
    );
    if ($context == 'Post format') {
        $translation = str_replace(array_keys($names), array_values($names), $text);
    }
    return $translation;
}
add_filter('gettext_with_context', 'rename_post_formats', 10, 4);





// Specific function to show the categories of a Post Type, including any custom
add_filter ( 'wp_list_categories', 'custom_filter_link_list_categories' );
function custom_filter_link_list_categories( $list ) {
	$cats = get_categories();
	foreach($cats as $cat) {
		$find = '>'.$cat->name.'</a>';
		$replace = ' data-filter="'.$cat->slug.'" >'.$cat->name.'</a>';
		$list = str_replace( $find, $replace, $list );
	}
	return $list;
}

// Specific function to show the categories of a Post Type, including any custom
function wp_list_categories_for_post_type($post_type, $args = '') {
	$exclude = array();

	// Check ALL categories for posts of given post type
	foreach (get_categories() as $category) {
		$posts = get_posts(array('post_type' => $post_type, 'category' => $category->cat_ID));

		// If no posts found, ...
		if (empty($posts))
			// ...add category to exclude list
			$exclude[] = $category->cat_ID;
	}
	// Set up args
	if (! empty($exclude)) {
		$args .= ('' === $args) ? '' : '&';
		$args .= 'exclude='.implode(',', $exclude);
	}
	// List categories
	;
	wp_list_categories($args);
}


function sample_js_sort() {
	echo '<!-- comment code -->';
	echo '<script>';

	echo 'jQuery(function($) {
			var posts = $(\'.listing-item\');
			$(\'.sample-list-cats li a\').click(function (e) {
				e.preventDefault();
				var customType = $(this).data(\'filter\');
				console.log(customType);
				console.log(posts.length);

				posts
					.hide()
					.filter(function () {
						return $(this).data(\'cat\') === customType;
					})
					.show();
			});
		})
	';
	echo '</script>';

	echo '<ul class="sample-list-cats">';
	wp_list_categories_for_post_type('portfolio', 'title_li=');
	echo '</ul>';
};
add_shortcode('custom-sample-js', 'sample_js_sort');



// Add Custom Inline Aside Shortcode
function custom_entry_inline_aside_h2() {
	return '<h2>You May Also Like</h2>';
};
add_shortcode('entry_inline_aside_h2', 'custom_entry_inline_aside_h2');

// Remove dropcap used by previous theme from old content
function ignore_dropcap() {
	echo '';
};
add_shortcode('dropcap', 'ignore_dropcap');

// Add Column Classes to Display Posts Shortcodes
// Usage: [display-posts columns="2"]
function be_display_post_class( $classes, $post, $listing, $atts ) {
	if( !isset( $atts['columns'] ) )
		return $classes;

	$columns = array( '', '', 'one-half', 'one-third', 'one-fourth', 'one-fifth', 'one-sixth' );
	$classes[] = $columns[$atts['columns']];
	if( 0 == $listing->current_post || 0 == $listing->current_post % $atts['columns'] )
		$classes[] = 'first';
	return $classes;
}
add_filter( 'display_posts_shortcode_post_class', 'be_display_post_class', 10, 4 );

// Site Specific Customizations for Display Posts Shortcodes, for 'alt', 'round', and 'gallery' layouts
function display_posts_change_order( $output, $atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class ) {
	if ( $atts['layout'] == 'alt' ) {
		$excerpt = '<span class="excerpt"> ' . get_the_excerpt() . '</span>';
		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $title . $image . $date . $excerpt . $content . '</' . $inner_wrapper . '>';
	} else if ( $atts['layout'] == 'round' ) {
		$categories = get_the_category();
		$catname = $categories[0]->cat_name;
		$catslug = $categories[0]->slug;
		$clean_cat_name = preg_replace('/\s+/', '', $catname);
		$category = '<span class="title">' . $catname . '</span>';
		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . ' ' . strtolower($clean_cat_name) . '" data-cat="' . $catslug. '">' . $image . $title . $category . '</' . $inner_wrapper . '>';
	} else if ( $atts['layout'] == 'gallery' ) {
		global $post;
		$categories = get_the_category();
		$catname = $categories[0]->cat_name;
		$catslug = $categories[0]->slug;
		$clean_cat_name = preg_replace('/\s+/', '', $catname);
		$title = '<span class="title">' . get_the_title() . '</span> ';
		$category = '<span class="title">' . $catname . '</span>';
		$image_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		$image =  get_the_post_thumbnail($post->ID, 'list-thumb');
		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . ' ' . strtolower($clean_cat_name) . '" data-cat="' . $catslug . '"><a href="' . $image_url . '" data-rel="lightbox">' . $image . '</a>' . $title . $category . '</' . $inner_wrapper . '>';
	} else {
		if ( $atts['excerpt_length'] ) {
			$more = '... <div><a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( ' Read More', 'fwp-base' ) . '</a></div>';
			$excerpt = '<span class="excerpt"> ' . wp_trim_words(get_the_content_feed(), $atts['excerpt_length'], $more ) . '</span>';
		}
		$output = '<' . $inner_wrapper . ' class="' . implode( ' ', $class ) . '">' . $image . $title . $date . $excerpt . $content . '</' . $inner_wrapper . '>';
	}
	return $output;
}
add_filter( 'display_posts_shortcode_output', 'display_posts_change_order', 10, 9 );

add_filter( 'display_posts_shortcode_output', 'display_posts_custom_readmore', 9, 7 );
function display_posts_custom_readmore( $output, $atts, $image, $title, $date, $excerpt, $inner_wrapper ) {
	if ( $atts['include_excerpt'] ) {
		$more = '...<div><a class="read-more" href="' . get_permalink( get_the_ID() ) . '">' . __( ' Read More', 'fwp-base' ) . '</a></div>';
		$new_excerpt = '<span class="excerpt"> ' . wp_trim_words(get_the_content_feed(), 25, $more ) . '</span>';
	} else {
		$new_excerpt = '';
	}
	$output = '<' . $inner_wrapper . ' class="listing-item">' . $image . $title . $date . $new_excerpt . '</' . $inner_wrapper . '>';
	return $output;
}

//Fix for missing author, entry title, and updated in GSC
////add hatom data
function add_suf_hatom_data($content) {
    $t = get_the_modified_time('F jS, Y');
    $author = get_the_author();
    $title = get_the_title();
if (is_home() || is_singular() || is_archive() ) {
        $content .= '<div class="hatom-extra" style="display:none;visibility:hidden;"><span class="entry-title">'.$title.'</span> was last modified: <span class="updated"> '.$t.'</span> by <span class="author vcard"><span class="fn">'.$author.'</span></span></div>';
    }
    return $content;
    }
add_filter('the_content', 'add_suf_hatom_data');

// GOOGLE TAG MANAGER CUSTOM DIMS.

/**
 * Author - Adam Doe
 * Date   - 02-08-2016
 * Index - 3
 * Custom Dimension - Author
 */
    
function custom_add_author_custom_dimension()
{
    if (is_singular('post'))
    {
        $this_post = get_queried_object();
        $author_id = $this_post->post_author;
        
    
    echo "<script>

	window.dataLayer = window.dataLayer || [];
	dataLayer.push({

	'micAuthor' : '" . get_the_author_meta('display_name', $author_id) . "',
	'event' : 'Author Pushed'

	});
	</script>";

	}
}
add_action ('wp_head', 'custom_add_author_custom_dimension');

/**
 * Author - Adam Doe
 * Date   - 02-08-2016
 * Index - 3
 * Custom Dimension - Post Length
 */

function custom_add_post_length_custom_dimension()
{
	if ( is_single() ) {
		//global $post;
		$word_count = str_word_count( strip_tags( $post->post_content ) );
		if ( is_int( $word_count ) ) {
			if ( $word_count < 500 ) {
				$word_count_range = '< 500';
			} elseif ( $word_count < 1000 ) {
				$word_count_range = '500 - 999';
			} elseif ( $word_count < 1500 ) {
				$word_count_range = '1000 - 1499';
			} elseif ( $word_count < 2000 ) {
				$word_count_range = '1500 - 1999';
			} else {
				$word_count_range = '2000+';
			}

			echo "<script>

				window.dataLayer = window.dataLayer || [];
				dataLayer.push({

					'micPostLength' : '" . $word_count_range . "',
					'event' : 'Post Length Push'

				});
			</script>";
		}
	}
}
add_action ('wp_head','custom_add_post_length_custom_dimension');

function bamboo_request($query_string )
{
    if( isset( $query_string['page'] ) ) {
        if( ''!=$query_string['page'] ) {
            if( isset( $query_string['name'] ) ) {
                unset( $query_string['name'] );
            }
        }
    }
    return $query_string;
}
add_filter('request', 'bamboo_request');

add_action('pre_get_posts','bamboo_pre_get_posts');
function bamboo_pre_get_posts( $query ) { 
    if( $query->is_main_query() && !$query->is_feed() && !is_admin() ) { 
        $query->set( 'paged', str_replace( '/', '', get_query_var( 'page' ) ) ); 
    } 
}