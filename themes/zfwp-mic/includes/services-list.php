<?php
/**
 * Custom display of Services for Services Page, as UL for reuse as needed.
 *
 */
?>
<h1 class="purple"><i>our services</i></h1>
<ul id="services-list">
<?php
$where_page = get_id_by_slug('services');
//wp_list_pages('title_li=&child_of='.$where_page );
$args = array( 'child_of' => $where_page, 'sort_order' => 'asc', 'meta_key' => 'type', 'meta_value' => 'service' );
$show_pages = get_pages( $args );
foreach ( $show_pages as $page ) :
	$img_args = array(
		'numberposts' => 1,
		'order'=> 'ASC',
		'post_mime_type' => 'image',
		'post_parent' => $page->ID,
		'post_type' => 'attachment'
	);
	$get_children_array = get_children($img_args,ARRAY_A);
	$rekeyed_array = array_values($get_children_array);
	$child_image = $rekeyed_array[0];
?>
	<li>
		<span id="services-list-img"><a href="<?php echo get_page_link( $page->ID ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-ico-<?php echo $page->post_name; ?>.png" /></a></span>
		<span id="services-list-title"><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a></span>
	</li>
<?php endforeach; ?>
</ul>
