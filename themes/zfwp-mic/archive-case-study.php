<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */

get_header(); ?>

	<div class="not-row">
		<div class="small-10 small-offset-1 columns">
          <div class="show-for-small-only blog-main read-more">
			<?php echo do_shortcode('[display-posts order="DESC" post_type="case-study" include_excerpt="true" posts_per_page="10" wrapper="div" image_size="fullsize" excerpt_length="125"]'); ?>
            </div>  
            
            <!--/For Small Screens-->
            
            <!--Hide Main Elements From Small Screen -->
            
            <div class="show-for-medium-up read-more blog-top">
		    <?php echo do_shortcode('[display-posts order="DESC" post_type="case-study"  posts_per_page="1" wrapper="div" include_excerpt="true" image_size="fullsize" columns="1"]'); ?>
            </div>
            
            <div class="show-for-medium-up read-more blog-main">
                <?php echo do_shortcode('[display-posts order="DESC" post_type="case-study"  offset="1" posts_per_page="99" wrapper="div" include_excerpt="true" image_size="story-thumb" columns="2"]'); ?>
            </div>
            <!--/Hide Main Elements From Small Screen -->

        <?php //echo do_shortcode('[display-posts order="DESC" post_type="case-study" include_excerpt="true" posts_per_page="1" wrapper="div" wrapper_class="blog-top" 	image_size="fullsize" excerpt_length="125"]'); ?>

		<?php //echo do_shortcode('[display-posts order="DESC" post_type="case-study" offset="1" posts_per_page="99" wrapper="div" wrapper_class="blog-main" include_excerpt="true" image_size="story-thumb" columns="2"]'); ?>

		
			
			<?php if ( have_posts() ) : ?>

				<?php

				
				// Start the loop.
                		while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */

					//get_template_part( 'content', get_post_format() );

					// End the loop.
				endwhile;

				// Previous/next page navigation.
				//the_posts_pagination( array(
					//'prev_text'          => __( '&laquo; Previous', 'zfwpbase' ),
					//'next_text'          => __( 'Next &raquo;', 'zfwpbase' ),
					//'screen_reader_text' => __( ' ', 'zfwpbase' )
				//) );

			// If no content, include the "No posts found" template.
			else :
				//get_template_part( 'content', 'none' );

			endif;
			?>

		</div>
	</div>

<?php get_footer(); ?>