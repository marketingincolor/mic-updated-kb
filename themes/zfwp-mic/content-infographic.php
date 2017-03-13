<?php
/**
 * Custom template for displaying Infographic content
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'infographic columns' ); ?>>
    <div class="row">
    <div class="small-12 columns">
	<div class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title gray">', '</h1>' );
		else :
			the_title( sprintf( '<h1 class="entry-title purple"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' );
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
			<div class="row">
				<div class="hide-for-small-down medium-3 columns">
					<hr class="midline">
				</div>
				<div class="small-12 medium-6 columns">
					<time datetime="<?php echo the_time('Y-m-j'); ?>"><?php echo the_time(get_option('date_format')); ?></time>
					by <?php the_author_link(); ?>
					<br />
					<?php
					$categories = get_the_category();
					$separator = ', ';
					$output = '';
					if ( ! empty( $categories ) ) {
						foreach( $categories as $category ) {
							$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
						}
						if ($post->post_type != 'portfolio') :
							echo trim( $output, $separator );
						endif;
					}
					?>
					<br>
					<?php //echo get_the_term_list( $post->ID, 'post_tag', '', '&#44; ' , '' ); ?>
				</div>
				<div class="hide-for-small-down medium-3 columns">
					<hr class="midline">
				</div>
			</div>

		</div>
		<?php endif; ?>

		<?php the_content(); ?>

	</div><!-- .entry-content -->
    </div>
    </div>
</article><!-- #post-## -->
