<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
get_header(); ?>

<div class="row collapse medium-uncollapse">
	<div class="small-10 small-offset-1 columns">

		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			/*
			 * Include the post format-specific template for the content. If you want to
			 * use this in a child theme, then include a file called called content-___.php
			 * (where ___ is the post format) and that will be used instead.
			 */
			//get_template_part( 'content', get_post_format() );
			get_template_part( 'content', 'post' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				//comments_template();
			endif;

			// End the loop.
		endwhile;
		?>

		<?php get_template_part( 'includes/about-author'); ?>

		<?php
		$this_category = get_the_category( $post_id );
		//$cat_parent = get_the_category_by_id($this_category[0]->parent);
		$cat_parent = get_category_link( $this_category[0]->parent );

		if ($cat_parent != '') {
			//$cat_path = site_url().'/'.$cat_parent[0]->slug.'/'.$this_category[0]->slug;
			$cat_path = esc_url($cat_parent).$this_category[0]->slug;
		} else {
			$cat_path = site_url().'/'.$this_category[0]->slug;
		}

		if ($this_category) :
		?>
			<div class="small-12 columns" style="text-align:left; font-size:0.75em; margin-bottom:1em; display:none;"> &laquo;&laquo; <a href="<?php echo $cat_path;?>">Back to <?php echo $this_category[0]->cat_name;?></a></div>
		<?php else : ?>
			<div class="small-12 columns" style="text-align:left; font-size:0.75em; margin-bottom:1em; display:none;"> &laquo;&laquo; <a href="/blog">Back to Blog</a></div>
		<?php endif; ?>

		<div class="small-6 columns" style="text-align:left; font-size:0.88em; padding-bottom: 3.45em"><?php previous_post_link('%link', '%title', TRUE ); ?></div>
		<div class="small-6 columns" style="text-align:right; font-size:0.88em; padding-bottom: 3.45em"><?php next_post_link('%link', '%title', TRUE ); ?></div>

	</div>
</div>

<?php get_footer(); ?>
