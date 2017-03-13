<?php
/**
 * The footer template
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="site-info">

		<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'zfwpbase' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'zfwpbase' ), 'WordPress' ); ?></a>
	</div><!-- .site-info -->
</footer><!-- .site-footer -->

<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation/foundation.topbar.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/foundation/foundation.dropdown.js"></script>
<script>
	$(document).foundation();
</script>

</body>
</html>