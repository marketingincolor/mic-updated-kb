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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

<?php if ( has_post_thumbnail() ) : ?>
	<div class="entry-thumbnail">
		<a class="thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
	</div>
<?php endif; ?>

	<div class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		endif;
		?>
	</div><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( is_single() ) :
			the_content( sprintf(
				__( 'Continue reading %s', 'zfwpbase' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
		else :
			the_excerpt();
		endif;


		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'zfwpbase' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'zfwpbase' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div><!-- .entry-content -->

	<div class="entry-footer">

	</div><!-- .entry-footer -->

</article><!-- #post-## -->