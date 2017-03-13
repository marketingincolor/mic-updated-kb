<?php
/**
 * The custom template used for displaying front page content
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
get_header(); ?>

	<div class="row collapse medium-uncollapse">
		<div class="small-12 hide-for-small-down columns">
            
			<?php
				// Include the page content template.
				get_template_part( 'content', 'frontpage' );
			?>
            
            <?php
			// Start the loop.
			//while ( have_posts() ) : the_post();
				// End the loop.
			//endwhile;
			?>
		</div>
	</div>

<?php get_footer(); ?>