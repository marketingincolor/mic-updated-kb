<?php
/**
 * Template Name: Left Sidebar
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
$custom_fields = get_post_custom();
$show_left_sidebar = (is_page('services') || is_page('downtown')) ? 'display:initial;' : '' ;
$services_layout = (is_page('services') || is_page('downtown')) ? 'small-10 small-offset-1 medium-4 medium-offset-1 columns' : '';
$about_layout = (is_page('about')) ? 'small-10 small-centered columns' : '';
$services_samples = (is_page('services') || is_page('downtown')) ?  'small-10 small-offset-1 medium-6 medium-offset-0 columns' : 'small-12 columns';
$team_page = ( is_page('about') ? 'small-10 small-offset-1 columns': ' ' );
get_header(); ?>

<div id="lt-sidebar-separator" style="<?php echo $show_left_sidebar ?>" class="<?php echo $services_layout; echo $about_layout;?>">
    <?php get_sidebar(); ?>
</div>

<div id="main-content" class="<?php echo $team_page; ?>">
    <section class="scroll-container" role="main">
        <div class=""><!--row collapse medium-uncollapse-->
            <div class="<?php echo $services_samples; ?>">
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
                <?php
                    if ( is_page('downtown') ) :
                        echo '<div class="downtown"><div>';
                        echo '<a class="full-read-more" href="'.site_url('/blog/downtown-stories/').'">More Downtown Stories</a>';
                        echo '</div></div>';
                    endif;
                ?>
            </div>
        </div>
    </section>

</div>


<?php get_footer(); ?>