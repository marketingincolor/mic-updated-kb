<?php
/**
 * Custom display of the Team List Component, meant for multiple uses.
 *
 */
$parent_id = get_id_by_slug('about');
$args = array( 'post_type' => 'page', 'post_parent' => $parent_id, 'orderby' => 'menu_order', 'order' => 'ASC' );
$show_team = get_children( $args );
foreach ( $show_team as $team ) { ?>
	<?php
	$current_id = get_post_meta( $team->ID, 'link_user_id', true );
	//$current_email = get_the_author_meta( 'user_email', $current_id );
	$current_page = $team->post_name;
	$current_position = get_the_author_meta( 'position', $current_id );
	$current_tw = get_the_author_meta( 'twitter', $current_id );
	$current_li = get_the_author_meta( 'linkedin', $current_id );
	$current_fb = get_the_author_meta( 'facebook', $current_id );
	$current_tw = get_the_author_meta( 'twitter', $current_id );
	$current_tw = get_the_author_meta( 'twitter', $current_id );
	$alt_image = get_the_author_meta( 'alternate', $current_id );
	?>
	<div class="team-member" data-equalizer-watch>
		<div class="team-member-item team-image">

			<?php echo get_the_post_thumbnail($team->ID); ?>
			<?php if ( ! empty( $alt_image ) ) {
				echo wp_get_attachment_image( $alt_image, 'post-thumbnail');
			} else {
				echo get_the_post_thumbnail($team->ID);
			} ?>

		</div>
		<div class="team-member-item">
			<h5><?php echo $team->post_title; ?></h5>
			<h6><i><?php if ( ! empty( $current_position ) ) { echo $current_position; } ?></i></h6>
		</div>
		<div class="team-member-item">
			<?php if ( ! empty( $current_page ) ) {
				echo '<a class="round-button" href="'.site_url('/').$current_page.'">Read Bio</a>';
			} ?>
		</div>
		<div class="team-member-item social-links">
			<?php if ( ! empty( $current_tw ) ) {
				echo '<a href="'.$current_tw.'" target="_blank"><i class="fa fa-twitter"></i></a>&nbsp;';
			} ?>
			<?php if ( ! empty( $current_fb ) ) {
				echo '<a href="'.$current_fb.'" target="_blank"><i class="fa fa-facebook-square"></i></a>&nbsp;';
			} ?>
			<?php if ( ! empty( $current_li ) ) {
				echo '<a href="'.$current_li.'" target="_blank"><i class="fa fa-linkedin-square"></i></a>&nbsp;';
			} ?>
			<?php if ( empty( $current_li ) ) {
				echo '<i class="fa fa-ellipsis-h"></i>&nbsp;';
			} ?>
		</div>
	</div>
<?php } ?>