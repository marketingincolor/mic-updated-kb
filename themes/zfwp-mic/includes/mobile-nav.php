<?php
/**
 * Custom display for Mobile Navigation.
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
?>
<div class="mobile-nav small-10 small-offset-1">

	<div class="row collapse">
		<div id="logo" class="small-12 columns">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/img/MIC Mobile Website Logo 004.png" alt="Company Logo" /></a>
		</div>
	</div>

	<div class="row collapse">
		<div class="small-12">
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'primary',
				'menu'            => 'main-menu',
				'container_class' => 'con-class',
				'container_id'    => 'con-id',
				'menu_class'      => 'ul-class main-mobile-menu',
				'menu_id'         => 'mob-circle-nav',
				'fallback_cb'     => 'wp_page_menu',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'depth'           => 1,
				'walker'          => new custom_walker_nav_menu
			) );
			?>
		</div>
	</div>
	<br /><br />
	<div class="row">
		<div class="small-6 columns rsplit">
			<a href="tel:<?php do_action( 'co_phone' ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-ftr-ico-ph.png"><strong><?php do_action( 'co_phone' ); ?></strong></a>
		</div>
		<div class="small-6 columns" >
			<?php do_action( display_social_media_icons('body') );?>
		</div>
	</div>
	<br /><br />
</div>
