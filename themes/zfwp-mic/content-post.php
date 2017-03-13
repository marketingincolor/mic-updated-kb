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
$cs_client_name = get_post_meta( $post->ID, 'client_name', true );
$cs_client_position = get_post_meta( $post->ID, 'client_position', true );
$cs_client_testimonial = get_post_meta( $post->ID, 'client_testimonial', true );
$cs_client_image = get_post_meta( $post->ID, 'client_image', true );
$cs_client_since = get_post_meta( $post->ID, 'client_since', true );
$cs_sample_gallery = get_post_meta( $post->ID, 'work_sample_gallery', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'columns' ); ?>>
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

		<?php if ($post->post_type == 'case-study') : ?>
		<div class="entry-meta">
			<div class="row">
				<div>
					<hr class="midline"></hr>
				</div>
			</div>
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
					by <span class="author_name"><?php the_author_link(); ?></span>
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

		<div class="show-for-medium-down" style="margin-top:10px;">
			<?php //dd_twitter_generate('Compact','twitter_username') ?>
			<?php //dd_fblike_generate('Like Button Count') ?>
			<?php //dd_fbshare_generate('Compact') ?>
			<?php //dd_google1_generate('Compact') ?>
			<?php //dd_linkedin_generate('Compact') ?>
		</div>

		<?php the_content(); ?>

		<?php if ($post->post_type == 'case-study') : ?>
		<div class="entry-case-study-right small-12 medium-6 columns">
			<?php if ( !empty($cs_sample_gallery) ) : ?>
			<div class="entry-samples">
				<h2>Work Samples</h2>
				<?php echo do_shortcode($cs_sample_gallery) ;?>
			</div>
			<?php endif; ?>
			<?php if ( !empty($cs_client_testimonial) ) : ?>
			<div class="entry-testimonial">
				<h2>Client Testimonial</h2>
				<div style="float:left;margin-right:10px;"><?php echo wp_get_attachment_image($cs_client_image, 'list-thumb') ;?></div>
				<h4><?php echo $cs_client_name ;?></h4>
				<h5><?php echo $cs_client_position ;?></h5>
				<br clear="all" />
				<i class="fa fa-quote-left"></i><?php echo $cs_client_testimonial ;?>"
			</div>
			<?php endif; ?>
		</div>
		<?php endif; ?>

	</div><!-- .entry-content -->
    </div>
    </div>
</article><!-- #post-## -->
