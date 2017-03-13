<?php
/**
 * Custom display of What We Do for Frontpage.
 *
 */

?>
<h1 class="entry-title small-8 small-offset-1">what we do</h1>

<div class="frontpage-what-slider small-10 small-offset-1 hide-for-medium-down">

	<?php
	$args = array(
		'category_name' => 'slider',
		'numberposts' => -1,
		'suppress_filters' => true
	);
	$show_posts = get_posts( $args );
	foreach ( $show_posts as $post ) : setup_postdata( $post ); ?>
		<div class="slide-panel">

			<div class="slide-image"><?php the_post_thumbnail('what-we-do-thumb'); ?></div>
			<div class="slide-content">
				<!--<div class="slide-title"><?php the_title(); ?></div>-->
				<?php the_content(); ?>
			</div>
		</div>
	<?php endforeach;
	wp_reset_postdata();?>

</div>

<script>
	jQuery(document).ready(function(){
		jQuery('.frontpage-what-slider').slick({
			autoplay: true,
			autoplaySpeed: 8000,
			speed:600,
		});
	});
</script>



