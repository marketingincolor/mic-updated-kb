<?php 
/*
Template Name: Team List Page
*/
get_header();?>
<div id="leftContent">
	<div class="inner">
		<div class="post_item post_single white_box">
			<?php if (have_posts()) : while (have_posts()) : the_post(); 
			$title_top_class = ' post_top_element';
			$video_embed = get_post_meta($post->ID, 'pl_video_embed', true) ;
			if($video_embed!=''){
			$title_top_class = '';
			?>
				<div class="fit post_video_wrapper"><?php echo $video_embed;?></div>
			<?php 
			} else { 
				$title_top_class = ' post_top_element';
				if ( has_post_thumbnail()){
				$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fulls-size');
				$new_image = aq_resize( $image[0], 800, NULL, FALSE, FALSE );
				$title_top_class = '';
				?>
				<div class="large_thumb xthumb_hoverx">
						<!--<div class="icon_bar for_link">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="icon link"></a> 
						</div>
						<div class="icon_bar for_view">
							<a href="<?php echo $image[0];?>" class="icon view fancybox"></a> 
						</div>
						
						<div class="img_wrapper"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo $new_image[0];?>" width="<?php echo $new_image[1];?>" height="<?php echo $new_image[2];?>" alt="<?php the_title_attribute();?>" class="post_top_element thumb" /></a></div>-->
						<div class="img_wrapper"><img src="<?php echo $new_image[0];?>" width="<?php echo $new_image[1];?>" height="<?php echo $new_image[2];?>" alt="<?php the_title_attribute();?>" class="post_top_element thumb" /></div>
				</div>
				
				<?php } ?>
				
				<?php get_template_part( 'content', 'audio'); ?>
				
			<?php } // if(video_embed) ;?>	
			<div class="social_share <?php echo $title_top_class ;?>">
			<?php social_share();?>
			</div>
			
			<div class="post_single_inner">
			<h1><?php the_title(); ?></h1>
			
			
			<div class="post_entry">
			<?php //the_content(); ?>
			<?php //wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
			<?php //edit_post_link('Edit this entry','<p>','</p>'); ?>
			</div>
			<div class="clear"></div>
			</div>	
		<?php endwhile; endif; ?>

		<?php
		$teammenu = array(
			'theme_location'  => '',
			'menu'            => 'partners',
			'container'       => 'div',
			'container_class' => 'bio-navigation',
			'container_id'    => 'bio-navigation-primary',
			'menu_class'      => 'bio-menu',
			'menu_id'         => 'big',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '<h3 style="margin:0;">',
			'link_after'      => '</h3>',
			'items_wrap'      => '<div id="%1$s" class="%2$s">%3$s</div>',
			'depth'           => 1,
			'walker'          => new custom_walker_nav_menu
		);
		wp_nav_menu( $teammenu );
		?>
		<br /><br /><br />
		<?php
		$teammenu = array(
			'theme_location'  => '',
			'menu'            => 'team',
			'container'       => 'div',
			'container_class' => 'bio-navigation',
			'container_id'    => 'bio-navigation-primary',
			'menu_class'      => 'bio-menu',
			'menu_id'         => 'small',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '<h3 style="margin:0;">',
			'link_after'      => '</h3>',
			'items_wrap'      => '<div id="%1$s" class="%2$s">%3$s</div>',
			'depth'           => 1,
			'walker'          => new custom_walker_nav_menu
		);
		wp_nav_menu( $teammenu );
		?>
		<br /><br /><br />
		</div><!-- post item -->
		
		<!-- comments php block removed, custom team menu to be added instead of loop -->
		
	</div>
</div>
<?php get_sidebar('custom');?>
<?php get_footer();?>