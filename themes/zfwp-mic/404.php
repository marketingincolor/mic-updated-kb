<?php
/**
 * The 404 template file
 *
 * This is the 404 error template file
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */

get_header(); ?>
<div id="main-content" class="small-10 small-offset-1 columns">
	<div class="small-12">
		<?php
		if ( have_posts() ) :
			get_template_part( 'content', 'none' );
		else :
			get_template_part( 'content', 'none' );
		endif;
		?>

	</div>
</div>

<?php get_footer(); ?>