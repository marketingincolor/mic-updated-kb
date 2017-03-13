<?php
/**
 * Created by PhpStorm.
 * User: Edd
 * Date: 3/6/2016
 * Time: 9:43 PM
 */

global $theme_url;
$auth_email = get_the_author_meta('user_email');
if( (is_single()) && (get_the_author_meta('description')) ) {
	?>
	<div class="author-meta small-12 columns">
		<h4 class="am-title"><?php _e('About The Author','zfwp-base'); ?></h4>
		<div class="am-content clearfix">
			<div style="padding:10px; display:inline-block; float:left;">
				<?php echo get_avatar( $auth_email, 96 ); ?>
			</div>
			<div style="padding: 10px 0px;">
				<?php the_author_meta('description'); ?>
				<br />
				See all posts by <?php the_author_posts_link(); ?>
			</div>
		</div>
	</div>
<?php } ?>