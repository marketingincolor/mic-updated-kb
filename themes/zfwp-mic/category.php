<?php
/**
 * The default template for displaying content
 *
 * Used for showing category content.
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
get_header(); ?>

<!--<div class="NOTrow">-->
	<div class="small-10 small-offset-1 columns">
		<h1 class="entry-title blog"><?php single_cat_title(); ?></h1>
		<div class="entry-cat-nav">
			<?php
			//$catID = get_cat_ID( 'blog' );
			$ancestors = get_ancestors( $cat, 'category' );
			$ancestorID = $ancestors[0];

			if (isset($ancestorID)) {
				$id = $ancestorID;
			}
			else {
				$id = $cat;
			}
			$args = array(
					'child_of' => $id,
					'title_li' => '',
					//'depth' => '-1'
					'hierarchical' => 0
			);
			echo '<ul class="blog-category-list">';
			wp_list_categories( $args );
			echo '</ul>';
			?>
		</div>
		<?php //echo get_category_parents( $cat, true, ' = ', false ); ?>

	<?php if( is_category('blog') ) : ?>
        
         <!-- For Small Screens-->
		<div class="show-for-small-only blog-main read-more">
			<?php echo do_shortcode('[display-posts order="DESC" category="blog" include_excerpt="true" posts_per_page="4" wrapper="div" image_size="fullsize" excerpt_length="125"]'); ?>
		</div>
        <!--/For Small Screens-->
        <!--Hide Main Elements From Small Screen -->
        <div class="show-for-medium-up blog-main read-more blog-top">
		<?php echo do_shortcode('[display-posts order="DESC" category="blog" include_excerpt="true" posts_per_page="1" wrapper="div" image_size="fullsize" excerpt_length="125"]'); ?>
        </div>
        
        <div class="show-for-medium-up blog-main read-more blog-main">
		<?php echo do_shortcode('[display-posts order="DESC" category="blog" offset="1" posts_per_page="4" wrapper="div" wrapper_class="blog-main" include_excerpt="true" image_size="fullsize" columns="2"]'); ?>
        </div>
        <!--/Hide Main Elements From Small Screen-->
		<div class="entry-content">
			<div style="margin:20px 20px 40px; text-align:center; display:block;">
				<a href="<?php echo site_url('/blog/buzz'); ?>" class="full-read-more">View More Blog Posts</a>
			</div>
		</div>

		<?php //echo do_shortcode('[display-posts order="DESC" category="blog" include_excerpt="true" posts_per_page="1" wrapper="div" wrapper_class="blog-top" image_size="fullsize" excerpt_length="125"]'); ?>

		<?php //echo do_shortcode('[display-posts order="DESC" category="blog" offset="1" posts_per_page="4" wrapper="div" wrapper_class="blog-main" include_excerpt="true" image_size="story-thumb" columns="2"]'); ?>

		<!--<div class="entry-content">
			<div style="margin:20px 20px 40px; text-align:center; display:block;">
				<a href="<?php echo site_url('/blog/buzz'); ?>" class="full-read-more">View More Blog Posts</a>
			</div>
		</div>-->

	<?php else : ?>

		<?php
		//echo $cat;
		$idObj = get_category_by_slug('blog');
		$id = $idObj->term_id;

		$args = array( 'hide_empty' => 1, 'child_of'=> $id, 'name_like'=>'blog' );
		$taxonomies = array ('post_tag', 'category');

		$terms = get_terms( $taxonomies, $args );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			$count = count( $terms );
			$i = 0;
			$term_list = '<p class="term-list">';
			foreach ( $terms as $term ) {
				$i++;
				$term_list .= '<a href="' . get_term_link( $term ) . '" title="' . sprintf( __( 'View all post filed under %s', 'zfwp-base' ), $term->name ) . '">' . $term->name . '</a>';
				if ( $count != $i ) {
					$term_list .= ' &middot; ';
				}
				else {
					$term_list .= '</p>';
				}
			}
			//echo $term_list; //----<---- REMOVES FROM DISPLAY!!!
		}
		?>

		<?php if ( have_posts() ) : ?>
			<div class="row" data-equalizer data-options="equalize_on_stack:true">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				echo '<div class="small-12 medium-6 columns" data-equalizer-watch>';
				get_template_part( 'content', get_post_format() );
				echo '</div>';
				// End the loop.
			endwhile;
			?>
			</div>
			<?php
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( '&laquo; Previous', 'zfwpbase' ),
				'next_text'          => __( 'Next &raquo;', 'zfwpbase' ),
				'screen_reader_text' => __( ' ', 'zfwpbase' )
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );
		endif;
		?>

	<?php endif; ?>

	</div>
<!--</div>-->

<?php get_footer(); ?>
