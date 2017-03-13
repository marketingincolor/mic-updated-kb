<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
?>

<section class="no-results not-found four-o-four">
	<header class="page-header">
		<h1 class="page-title orange">
			<?php if ( is_search() ) :
				_e( 'Nothing Found', 'zfwpbase' );
			else :
				_e( '404 error', 'zfwpbase' );
			endif; ?>
		</h1>
	</header><!-- .page-header -->

	<div class="page-content">

		<?php if ( is_search() ) : ?>

			<h3><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'zfwpbase' ); ?></h3>
			<?php get_search_form(); ?>

		<?php else : ?>

			<h3 class="sub-title-four-o-four"><?php _e( 'Oops! Took a wrong turn?', 'zfwpbase' ); ?></h3>
			<div class="show-for-medium-up centered">
				<img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-404.gif" alt="unhappy faces" style="width:100%;"/>
				<img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-404-selector.png" alt="pick an option"/>
			</div>
			<div class="row">
				<div class="four-o-four-post show-for-medium-up large-4 columns">
					<h3 class="centered">Check Out Our<br />Latest Blog Posts!</h3>
				<?php echo do_shortcode('[display-posts wrapper="div" wrapper_class="four-o-four-post-grid" image_size="thumbnail" include_excerpt="true" posts_per_page="3"]'); ?>
					<div style="text-align:center;">
						<?php echo '<a class="read-more" href="'.esc_url( home_url( '/blog' ) ).'">More Blog Posts</a>' ;?>
					</div>
				</div>
				<div class="medium-12 large-4 columns" style="text-align:center;">
					<h3 class="centered">Return To Our Homepage</h3>
					<a href="<?php echo site_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-404-lg-home-icon.png" alt="large home icon" /></a>
					<h3 class="centered">Connect with Us!</h3>
					<?php do_action( display_social_media_icons('error') );?>
				</div>
				<div class="four-o-four-story show-for-medium-up large-4 columns">
					<h3 class="centered">Take A Look at<br />What We Do</h3>
					<?php echo do_shortcode('[display-posts category="samples" wrapper="div" wrapper_class="four-o-four-story-grid" image_size="story-thumb" include_excerpt="true" posts_per_page="2"]'); ?>
					<div style="text-align:center;">
						<?php echo '<a class="read-more" href="'.esc_url( home_url( '/case-study' ) ).'">More Case Studies</a>' ;?>
					</div>
				</div>
			</div>

		<?php endif; ?>
	<br />
	</div><!-- .page-content -->
</section><!-- .no-results -->