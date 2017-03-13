<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'columns' ); ?>>

	<div class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
		endif;
		?>
	</div><!-- .entry-header -->

	<div class="entry-content">

		<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail('full'); ?>
		</div>
		<?php endif; ?>

		<?php if ( has_category() ) : ?>
			<div class="entry-meta">
				<img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/hdl-grfx-meta-ico-cal.png">
				&nbsp;<time datetime="<?php echo the_time('Y-m-j'); ?>"><?php echo the_time(get_option('date_format')); ?></time>
				&nbsp;<img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/hdl-grfx-meta-ico-fold.png">
				&nbsp;<a href="#" rel="category"><?php the_category(', '); ?></a>
			</div>
		<?php endif; ?>
			<div class="show-for-medium-down" style="margin-top:10px;">
				<?php dd_twitter_generate('Compact','twitter_username') ?>
				<?php dd_fblike_generate('Like Button Count') ?>
				<?php dd_linkedin_generate('Compact') ?>
				<?php dd_google1_generate('Compact') ?>
			</div>
		<?php the_content(); ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
