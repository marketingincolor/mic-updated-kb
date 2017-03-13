<?php
/**
 * Custom display of Case Studies for Services Page, as UL for reuse as needed.
 *
 */
?>
<h1 class="green">case studies</h1>
<ul id="studies-list" class="">
<?php
$query = new WP_Query( array('post_type' => 'case-study', 'posts_per_page' => 3 ) );
while ( $query->have_posts() ) : $query->the_post();
	echo '<li>';
	if ( has_post_thumbnail() ) {
		echo '<span id="studies-list-img"><a href="' . get_permalink() . '">';
		the_post_thumbnail() ;
		echo '</a></span>';
	}
	echo '<span id="studies-list-title">';
	the_title( sprintf( '<a href="%s">', esc_url( get_permalink() ) ), '</a>' );
	echo '</span>';
	echo '<span id="studies-list-excerpt">';
	the_excerpt();
	echo '</span>';
	echo '</li>';
	wp_reset_postdata(); ?>
<?php endwhile; ?>
</ul>
<div class="case-studies">
	<?php echo '<a class="read-more" href="'.esc_url( home_url( '/case-study' ) ).'">More Case Studies</a>' ;?>
</div>
