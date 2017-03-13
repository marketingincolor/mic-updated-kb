<?php
/**
 * Template Name: Right Sidebar
 *
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */

get_header(); ?>

<div id="main-content" class="small-10 small-offset-1 medium-6 medium-offset-1 columns">
    <section class="scroll-container" role="main">
        <div class="row collapse medium-uncollapse">
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
        </div>
    </section>
</div>

<div id="rt-sidebar-separator" class="small-10 small-offset-1 medium-4 medium-offset-0 columns">
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>