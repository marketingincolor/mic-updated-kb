<?php
/**
 * Custom display of Who We Are for Frontpage.
 *
 */
?>

<h1 class="entry-title small-8 small-offset-1">who we are</h1>

<div class="vertical-accordion horizontal hide-for-medium-down">
    <ul>
        <li>
            <input type="radio" id="vert-1" name="vert-accordion" checked="checked" />
            <label for="vert-1"><img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-expd-purp.png" alt="Vertical purple crayon that's labled blog"></label>
            <div class="acc-content bgnd-purple">
	            <div class="acc-content-shadow"></div>


                <?php echo do_shortcode('[display-posts category="blog" include_excerpt="true" posts_per_page="3" image_size="thumbnail"]') ?>



                <ul class="display-posts-listing" style="display:none;">
                    <li class="listing-item one-half first">
                        <?php //echo do_shortcode('[display-posts category="blog" include_excerpt="true" posts_per_page="1" image_size="story-thumb"]') ?>
                    </li>
                    <li class="listing-item one-half">
                        <?php //echo do_shortcode('[display-posts category="blog" offset="1" include_excerpt="true" posts_per_page="2" image_size="thumbnail"]') ?>
                    </li>
                </ul>
            </div>
        </li>
        <li>
            <input type="radio" id="vert-2" name="vert-accordion" />
            <label for="vert-2"><img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-expd-orng.png" alt="Vertical orange crayon that's labled team"></label>
            <div class="acc-content bgnd-orange">
                <div class="acc-content-shadow"></div>

                <div class="row frontpage-team-slider" data-equalizer data-options="equalize_on_stack:true">
	                <?php include get_template_directory() . '/includes/team-list.php'; ?>
                </div>

                <script>
                    jQuery(document).ready(function(){
	                    $('#vert-2').click(function () {
		                    if ($(this).is(':checked')) {
			                    $('.frontpage-team-slider').resize();
		                    }
	                    });

                        $('.frontpage-team-slider').slick({
                            infinite: true,
                            slidesToShow: 4,
                            slidesToScroll: 4
                        });
                    });
                </script>
            </div>
        </li>
        <li>
            <input type="radio" id="vert-3" name="vert-accordion" />
            <label for="vert-3"><img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-expd-gren.png" alt="Vertical green crayon that's labled our true colors"></label>
            <div class="acc-content bgnd-green">
                <div class="acc-content-shadow"></div>
                <?php
                $display_id = get_id_by_slug('about');
                $partner = get_post_meta( $display_id, 'otc_partner_excerpt', true );
                $growth = get_post_meta( $display_id, 'otc_growth_excerpt', true );
                $creative = get_post_meta( $display_id, 'otc_creative_excerpt', true );
                $give = get_post_meta( $display_id, 'otc_give_excerpt', true );
                $prosper = get_post_meta( $display_id, 'otc_prosper_excerpt', true );
                echo '<ul class="true-colors NOTsmall-block-grid-5">'.
                    '<li><img src="' . get_template_directory_uri() . '/img/Be A Partner.png" alt="Be a partner">' . $partner . '</li>' .
                    '<li><img src="' . get_template_directory_uri() . '/img/Cultivate Growth.png" alt="Cultivate Growth">' . $growth . '</li>' .
                    '<li><img src="' . get_template_directory_uri() . '/img/Stay Creative.png" alt="Stay Creative">' . $creative . '</li>' .
                    '<li><img src="' . get_template_directory_uri() . '/img/Give Back.png" alt="Give Back">' . $give . '</li>' .
                    '<li><img src="' . get_template_directory_uri() . '/img/Prosper.png" alt="Prosper">' . $prosper . '</li>' .
                    '</ul>';
                ?>
            </div>
        </li>
        <li>
            <input type="radio" id="vert-4" name="vert-accordion" />
            <label for="vert-4"><img src="<?php echo get_template_directory_uri(); ?>/img/mic-grfx-expd-slvr.png" alt="Vertical gray crayon that's labled downtown"></label>
            <div class="acc-content bgnd-silver">
                <div class="acc-content-shadow"></div>

                <?php echo do_shortcode('[display-posts category="downtown-stories" include_excerpt="true" posts_per_page="3" image_size="thumbnail"]') ?>

                <ul class="display-posts-listing" style="display:none; ">
                    <li class="listing-item one-half first">
                        <?php echo do_shortcode('[display-posts category="downtown-stories" include_excerpt="true" posts_per_page="1" image_size="story-thumb"]') ?>
                    </li>
                    <li class="listing-item one-half">
                        <?php echo do_shortcode('[display-posts category="downtown-stories" offset="1" include_excerpt="true" posts_per_page="2" image_size="thumbnail"]') ?>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<!--
	<?php
	$where_page = get_id_by_slug('who');
	$args = array( 'child_of' => $where_page, 'sort_order' => 'desc' );
	$show_pages = get_pages( $args );
	foreach ( $show_pages as $page ) :
	?>
	<div>
		<span style="min-height:40px; display:block; color: #47c2bf;"><?php  echo $page->post_title; ?></span>
		<span style="display:block;"><a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo get_the_post_thumbnail($page->ID, 'profile-thumb'); ?></a></span>
		<span style="margin-top:10px; display:block;"><a href="<?php echo get_page_link( $page->ID ); ?>" class="button radius blue-gradient">Read Bio</a></span>
	</div>
	<?php endforeach; ?>
-->

<br clear="both" />

