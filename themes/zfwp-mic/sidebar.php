<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
global $post;
$the_parent_id = wp_get_post_parent_id( $post_ID );
$the_parent_post = get_post($the_parent_id);
?>
<div class=""> <!--sidebarcolumns-->
	<?php if ( is_page( 'about' ) ) :
		$display_id = get_id_by_slug('about');
		$partner = get_post_meta( $display_id, 'otc_partner', true );
		$growth = get_post_meta( $display_id, 'otc_growth', true );
		$creative = get_post_meta( $display_id, 'otc_creative', true );
		$give = get_post_meta( $display_id, 'otc_give', true );
		$prosper = get_post_meta( $display_id, 'otc_prosper', true );
		echo '<div class="columns show-for-medium-up">';
		echo '<div class="otc-sidebar">';
		echo '<h1 class="otc-sidebar orange">our true colors</h1>';
		echo '<img class="otc-sidebar-img" src="' . get_template_directory_uri() . '/img/Be A Partner.png" alt="Be a partner">' . $partner;
		echo '<img class="otc-sidebar-img" src="' . get_template_directory_uri() . '/img/Cultivate Growth.png" alt="Cultivate Growth">' . $growth;
		echo '<img class="otc-sidebar-img" src="' . get_template_directory_uri() . '/img/Stay Creative.png" alt="Stay Creative">' . $creative;
		echo '<img class="otc-sidebar-img" src="' . get_template_directory_uri() . '/img/Give Back.png" alt="Give Back">' . $give;
		echo '<img class="otc-sidebar-img" src="' . get_template_directory_uri() . '/img/Prosper.png" alt="Prosper">' . $prosper;
		echo '</div>';
		echo '</div>';
	endif; ?>

	<?php if ( ($post->post_parent > 0 ) || ( $the_parent_post->post_name == 'services' )) :
		echo '<div class="">'; #columns
		include get_template_directory() . '/includes/services-list.php';
		include get_template_directory() . '/includes/case-studies-list.php';
		echo '</div>';
	endif; ?>

	<div id="secondary" class="secondary columns show-for-medium-up">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
			<div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
			<div id="widget-area" class="widget-area" role="complementary">
				<?php dynamic_sidebar( 'sidebar-3' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>
	</div><!-- .secondary -->
</div>