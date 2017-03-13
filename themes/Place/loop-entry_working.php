<?php 
	global $pl_data, $theme_url;
	if (have_posts()) :?>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h3 class="heading_title white_box"><?php single_cat_title(); ?></h3>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3 class="heading_title white_box"><?php _e('Posts Tagged','presslayer');?>: <?php single_tag_title(); ?></h3>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3 class="heading_title white_box"><?php _e('Archive for','presslayer');?> <?php the_time('F jS, Y'); ?></h3>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3 class="heading_title white_box"><?php _e('Archive for','presslayer');?> <?php the_time('F, Y'); ?></h3>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3 class="heading_title white_box"><?php _e('Archive for','presslayer');?> <?php the_time('Y'); ?></h3>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3 class="heading_title white_box"><?php _e('Blog Archives','presslayer');?></h3>
 	  <?php } elseif (is_search()){ ?>
	  <h3 class="heading_title white_box"><?php _e('Search Results','presslayer');?></h3>
	  <?php } ?>
	  
<div id="Xpost_grids" class="masonry-container Xpost_content clearfix masonry">
	
	<?php while (have_posts()) : the_post();
	$audio = get_post_meta($post->ID, 'pl_audio', true) ;
	$audio_embed = get_post_meta($post->ID, 'pl_audio_embed', true) ;
	$video_embed = get_post_meta($post->ID, 'pl_video_embed', true) ;
	?>

	<div class="masonry-item clearfix masonry-brick post_col">
	<?php if(get_post_format()!='quote'){?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post_item white_box'); ?>>
		<?php
		if($video_embed!=''){
		?>
			<div class="fit post_video_wrapper"><?php echo $video_embed;?></div>
		<?php 
		} else {  ?>	
			
			<?php 
			$title_top_class = ' post_top_element';
			if ( has_post_thumbnail()){
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'fulls-size');
			$new_image = aq_resize( $image[0], 710, NULL, FALSE, FALSE );
			$title_top_class = '';
			?>
			<div class="large_thumb thumb_hover">
					<div class="icon_bar for_link">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="icon link"></a> 
					</div>
					<div class="icon_bar for_view">
						<a href="<?php echo $image[0];?>" class="icon view fancybox"></a> 
					</div>
					
					<div class="img_wrapper"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><img src="<?php echo $new_image[0];?>" width="<?php echo $new_image[1];?>" height="<?php echo $new_image[2];?>" alt="<?php the_title_attribute();?>" class="post_top_element thumb" /></a></div>
			</div>
			
			<?php } ?>
			
			<?php get_template_part( 'content', 'audio'); ?>
			
		<?php } // if(video_embed) ;?>	
			
			<h3 class="post_item_title<?php echo $title_top_class;?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			
			<div class="post_item_inner">
				<div class="post_meta">
					<span class="user"><?php _e('by','presslayer');?> <?php the_author_posts_link(); ?></span> 
					<span class="time"><?php the_time(get_option('date_format')) ?></span>
				</div>	
				<p><?php 
				/*$ex_length = $pl_data['ex_length'];
				if($ex_length=='') $ex_length = 35;
				echo text_trim(get_the_excerpt(), $ex_length, '...');*/ the_excerpt(); ?></p>
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="button green"><?php _e('Read More','presslayer');?></a>
				
				<span class="like"><?php printLikes(get_the_ID()); ?></span>
			
			</div>
		</div>
		<?php } else {
			get_template_part( 'content', get_post_format());
		}?>
	</div><!-- // post col -->
	<?php endwhile; ?>
	
</div>

<script>
	var $j = jQuery.noConflict();
	//$j(document).ready(function(){ 
	$j(function ($) { 
	//jQuery (function ($) {
	//jQuery(document).ready(function() {
		
		var $container = $j('.masonry-container');
		var gutter = 30;
		var min_width = 300;
		
		$container.imagesLoaded( function(){
			$container.masonry({
				itemSelector : '.masonry-item',
				gutterWidth: gutter,
				isAnimated: true,
				columnWidth: function( containerWidth ) {
					var box_width = (((containerWidth - 2*gutter)/3) | 0) ;
					if (box_width &lt; min_width) {box_width = (((containerWidth - gutter)/2) | 0);}
					if (box_width &lt; min_width) {box_width = containerWidth;}
					$j('.masonry-item').width(box_width);
					return box_width;
				}
			});
		});

		$container.infinitescroll({
				navSelector  : '#page-nav', 
				nextSelector : '#page-nav a',
				itemSelector : '.masonry-item',
				loading: {
					selector: '#infscr-load',
					msgText  : '<?php _e('Loading new posts','presslayer');?> ...',  
					finishedMsg: '<?php _e('No more pages to load.','presslayer');?>.',
					img: '<?php echo get_template_directory_uri();?>/images/loader.gif'
				}
			}, 
		
			function( newElements ) {
				var $newElems = $j( newElements ).css({ opacity: 0 });
				$newElems.imagesLoaded(function(){
					$newElems.animate({ opacity: 1 });
					$container.append( $newElems ).masonry( 'reload' );
					$j('#page-nav').show();
					
					// init
					$j('.popup-link-video').magnificPopup({type:'iframe'});
					$j('.popup-link-image').magnificPopup({
						type: 'image',
						fixedContentPos: true,
						mainClass: 'mfp-no-margins mfp-with-zoom', 
						image: {
						verticalFit: true
						},
						zoom: {
							enabled: true,
							duration: 300
						}
					});
							
					$j("body").fitVids();
					// init end
				});
		});
	
		// kill scroll binding
		$j(window).unbind('.infscr');
	
		$j("#page-nav a").on('click',function(){
			$container.infinitescroll('retrieve');
			return false;
		});
			
		// remove the paginator when we're done.
		$j(document).ajaxError(function(e,xhr,opt){
		  if (xhr.status == 404) $('#page-nav a').remove();
		});
				
	});
</script>

				
<!-- infinite scroll -->
<div class="load_more">	
	<nav id="page-nav">
		<?php next_posts_link(__('Load more posts','presslayer').' ...') ?>
	</nav>
</div>
<!-- end infinite scroll -->

<?php else : ?>
	<?php get_search_form(); ?>
<?php endif; ?>  