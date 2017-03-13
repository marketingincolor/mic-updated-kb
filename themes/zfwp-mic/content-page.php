<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage zfwp-base
 * @since ZFWP Base 1.0
 */
global $post;
$the_parent_id = wp_get_post_parent_id( $post_ID );
$the_parent_post = get_post($the_parent_id);

if ( ($post->post_parent > 0 ) && ( $the_parent_post->post_name == 'about' )) :
	$link_user = get_post_meta( $post->ID, 'link_user_id', true );
	$user_position = get_user_meta( $link_user, 'position', true );
	$user_bio = get_user_meta( $link_user, 'description', true );
	$user_firstname = get_user_meta( $link_user, 'first_name', true );
	$user_facebook = get_user_meta( $link_user, 'facebook', true );
	$user_twitter = get_user_meta( $link_user, 'twitter', true );
	$user_linkedin = get_user_meta( $link_user, 'linkedin', true );
	$user_gplus = get_user_meta( $link_user, 'gplus', true );
	$user_video = get_user_meta( $link_user, 'video', true );
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php ( is_page('services') ) ? post_class( 'not-columns hide-for-small' ) : post_class( 'not-columns' ); ?>>
	<header class="entry-header">
		<?php if ( ($post->post_parent > 0 ) && ( $the_parent_post->post_name == 'about' )) :
			echo '<h1 class="entry-title-about purple"><i>' . strtolower( get_the_title() ) . '</i></h1>';
			echo '<h4 class="silver"><b>' . $user_position . '</b></h4><br><br>';
		else :
			echo '<h1 class="entry-title ' . $post->post_name . '"><i>' . strtolower( get_the_title() ) . '</i></h1>';
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-cat-nav">
		<?php if ( is_page('blog') ) :
			$idObj = get_category_by_slug('our-blog');
			$id = $idObj->term_id;
			$args = array(
					'child_of' => $id,
					'title_li' => '',
					'depth' => '-1'
			);
			echo '<ul class="blog-category-list">';
			wp_list_categories( $args );
			echo '</ul>';
		endif; ?>

	</div>

	<div class="entry-content<?php echo ' '.$the_parent_post->post_name; ?>">

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail<?php echo '-'.$the_parent_post->post_name; ?>">
				<?php if ( ($post->post_parent > 0 ) && ( $the_parent_post->post_name == 'about' ) ) :
					the_post_thumbnail('full');
				else :
					the_post_thumbnail();
				endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( has_category() ) : ?>
		<div class="entry-meta">
			<img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/hdl-grfx-meta-ico-cal.png">
			&nbsp;<time datetime="<?php echo the_time('Y-m-j'); ?>"><?php echo the_time(get_option('date_format')); ?></time>
			&nbsp;<img class="icon" src="<?php echo get_template_directory_uri(); ?>/img/hdl-grfx-meta-ico-fold.png">
			&nbsp;<a href="#" rel="category"><?php the_category(', '); ?></a>
		</div>
		<?php endif; ?>

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'zfwpbase' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'zfwpbase' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>

		<?php if ( is_page('about') ) :
			echo '<div class="team" style="display:inline-block;" data-equalizer data-options="equalize_on_stack:true">';
			include get_template_directory() . '/includes/team-list.php';
			echo '</div>';
		endif; ?>

		<?php if ( ($post->post_parent > 0 ) && ( $the_parent_post->post_name == 'about' ) ) :
			echo '<h4 class="silver">Connect with '.$user_firstname.'&nbsp;&nbsp;';
			if ( $user_twitter != '' ) {
				echo '&nbsp;<a href="'.$user_twitter.'" class="sm-tw"><i class="fa fa-twitter"></i></a>&nbsp;';
			};
			if ( $user_facebook != '' ) {
				echo '&nbsp;<a href="'.$user_facebook.'" class="sm-fb"><i class="fa fa-facebook-square"></i></a>&nbsp;';
			};
			if ( $user_linkedin != '' ) {
				echo '&nbsp;<a href="'.$user_linkedin.'" class="sm-li"><i class="fa fa-linkedin-square"></i></a>&nbsp;';
			};
			echo '</h4>';
			echo '<br clear="both"><br>';
			if ( $user_video != '' ) {
				echo '<h4 class="orange">'.$user_firstname.'\'s Favorite Video</h4>';
				echo '<div class="embed-container"><iframe frameborder="0" width="100%" allowfullscreen="" src="' . $user_video . '"></iframe></div>';
			};

			//echo 'do post display shortcode for author with user_id='.$link_user;
			$this_author = get_user_by( 'id', $link_user );
			$user_post_count = count_user_posts( $this_author->id );
			$author_display_name = $this_author->user_nicename;
			if ( $user_post_count > 0 ) {
				echo '<h4 class="orange">' . $user_firstname . '\'s Latest Blog Posts</h4>';
				echo do_shortcode( '[display-posts posts_per_page="2" wrapper="div" wrapper_class="inline-display-staff" image_size="thumbnail" include_excerpt="true" author="'.$author_display_name.'" columns="2"]' );
			};

		endif; ?>

</div><!-- .entry-content -->

</article><!-- #post-## -->
