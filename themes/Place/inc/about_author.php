<?php
global $theme_url;
$auth_email = get_the_author_meta('user_email');
if( (is_single()) && (get_the_author_meta('description')) ) {
?>
<div class="related_posts white_box">
	<h3 class="rp_title"><?php _e('About The Author','presslayer'); ?></h3>
	<div class="rp_col_wrapper clearfix">
		<div style="padding:10px; display:inline-block; float:left;">
			<?php echo get_avatar( $auth_email, $size = '96', $default = '<path_to_url>' ); ?>
		</div>
		<div style="padding: 10px 0px;">
			<?php the_author_meta('description'); ?>
			<br />
			See all posts by <?php the_author_posts_link(); ?>
		</div>
	</div>
</div>
<?php } ?>