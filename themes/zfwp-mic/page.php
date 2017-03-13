<?php
/**
 * The template for displaying pages, with NO sidebar
 *
 * This is the template that displays all pages by default, the standard template.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */

get_header(); ?>
<div class="row collapse medium-uncollapse">
	<div class="small-10 small-offset-1 columns">
<div id="main-content"><!--classSmall12Columns-->
    <section class="scroll-container" role="main">
        <div class="small-12 columns">
            <?php
            // Start the loop.
            while ( have_posts() ) : the_post();
                // Include the page content template.
                get_template_part( 'content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                // End the loop.
            endwhile;
            ?>
        </div>
    </section>
</div>
    </div>
</div>

<?php get_footer(); ?>