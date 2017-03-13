<?php
/**
 * The custom template used for displaying front page content
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
?>

<?php if ( is_front_page() || is_home() ) : ?>
<div class="row">
	<div id="front-page-tab-left" class="small-6 show-for-medium-only columns">
		<?php include get_template_directory() . '/includes/services-list.php'; ?>
	</div>
	<div id="front-page-tab-right" class="small-6 show-for-medium-only columns">
		<?php echo do_shortcode('[display-posts order="DESC" category="blog" offset="1" posts_per_page="2" wrapper="div" wrapper_class="blog-main" include_excerpt="true" excerpt_size="20" image_size="story-thumb" columns="1"]'); ?>

		<div class="entry-content">
			<div style="margin:20px 20px 40px; text-align:center; display:block;">
				<a href="<?php echo site_url('/blog/buzz'); ?>" class="full-read-more">View More Blog Posts</a>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div id="front-page-what" class="small-12 hide-for-medium-down columns">
		<?php include get_template_directory() . '/includes/frontpage-what.php'; ?>
	</div>
</div>

<div class="row">
	<div id="front-page-who" class="small-12 hide-for-medium-down columns">
		<?php include get_template_directory() . '/includes/frontpage-who.php'; ?>
	</div>
</div>

<?php else : ?>

<div class="row small-collapse medium-uncollapse">
	<div id="front-page-separator" class="hide-for-small medium-12 columns">

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<?php the_content(); ?>
				<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'zfwpbase' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'zfwpbase' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );
				?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->

	</div>

</div>

<?php endif; ?>

<div class="show-for-large-up">&nbsp;</div>
