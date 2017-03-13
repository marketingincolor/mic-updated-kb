<?php
/**
 * The default template for displaying content
 *
 * Used for showing tagcontent.
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */

get_header(); ?>
	<div class="not-row">
		<div class="small-10 small-offset-1 columns">
			<?php
			$args = array( 'hide_empty' => 0 );

			$terms = get_terms( 'post_tag', $args );
			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
				$count = count( $terms );
				$i = 0;
				$term_list = '<p class="my_term-archive">';
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
				echo $term_list;
			}

			?>
			<?php if ( have_posts() ) : ?>

				<?php
				// Start the loop.
				while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );

					// End the loop.
				endwhile;

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

		</div>
	</div>

<?php get_footer(); ?>
