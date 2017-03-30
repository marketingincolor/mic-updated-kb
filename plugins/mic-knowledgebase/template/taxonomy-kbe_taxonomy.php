<?php
    $kbe_terms = get_terms( array ( 'taxonomy'=> kbe_POST_TAXONOMY, 'parent' => 0, 'include' => mic_get_include_ids(), 'hide_empty' => true ) );
    $kbe_terms2 = get_terms( array ( 'taxonomy'=> kbe_POST_TAXONOMY, 'parent' => 1, 'hide_empty' => true ) );

    get_header('knowledgebase');
?>
    <?php

    function mic_get_include_ids()
    {

        $roles = array(
            'read_rca' => 38,
            'read_mic' => array(34,2,24,1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,27,28,29,30,31,32,33,34,35),                        
        );

        $include_role_id = array();
        $exclude_role_id = array();
        foreach ($roles as $role => $role_cat_id) {
            if ( is_array($role_cat_id) ) {
                $role_cat_id = implode(" ", $role_cat_id);
            }
            if ( current_user_can ($role) )
            {
                array_push($include_role_id, $role_cat_id);
            }
            else {
                array_push($exclude_role_id, $role_cat_id);
            }
        }
        $include_role_id = implode(" ", $include_role_id);
        return $include_role_id;
    }
    

    // load the style and script
    wp_enqueue_style ( 'kbe_theme_style' );
    if( kbe_SEARCH_SETTING == 1 ){
        wp_enqueue_script( 'kbe_live_search' );
    }
    
    // Classes For main content div
    if(kbe_SIDEBAR_INNER == 0) {
        $kbe_content_class = 'class="kbe_content_full"';
    } elseif(kbe_SIDEBAR_INNER == 1) {
        $kbe_content_class = 'class="kbe_content_right"';
    } elseif(kbe_SIDEBAR_INNER == 2) {
        $kbe_content_class = 'class="kbe_content_left"';
    }
    
    // Classes For sidebar div
    if(kbe_SIDEBAR_INNER == 0) {
        $kbe_sidebar_class = 'kbe_aside_none';
    } elseif(kbe_SIDEBAR_INNER == 1) {
        $kbe_sidebar_class = 'kbe_aside_left';
    } elseif(kbe_SIDEBAR_INNER == 2) {
        $kbe_sidebar_class = 'kbe_aside_right';
    }
    
    // Query for Category
    $kbe_cat_slug = get_queried_object()->slug;
    $mic_term_id = get_queried_object()->term_id;
    $children = get_term_children($mic_term_id, kbe_POST_TAXONOMY);
    $kbe_cat_name = get_queried_object()->name;
    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
?>

    <div id="mic-kb-container">
        <div class="row">
        <?php
        $class = "large-9 columns";
        $kbe_cat_slug = get_queried_object()->slug;
        $mic_term_id = get_queried_object()->term_id;
        $children = get_term_children($mic_term_id, kbe_POST_TAXONOMY);
        $kbe_cat_name = get_queried_object()->name;
        $kbe_tax_post_args = array(
            'posts_per_page' => 9,
            'include' => mic_get_include_ids(),
            'paged' => $paged,
            'post_type' => 'kbe_knowledgebase',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => array(
                array(
                    'taxonomy' => kbe_POST_TAXONOMY,
                    'field' => 'slug',
                    'terms' => $kbe_cat_slug,
                    'include_children' => 1
                ),
            ),
        );
        //var_dump($kbe_tax_post_args);
        $display_blogs = new WP_Query($kbe_tax_post_args);
        //var_dump($display_blogs);
        ?>
        <div class="large-3 columns">
        <?php kbe_search_form(); ?>

        <?php
            foreach($kbe_terms as $kbe_taxonomy){

                $queried_object = get_queried_object();
                $term_id = $queried_object->term_id;
                $kbe_term_id = $kbe_taxonomy->term_id;
                $kbe_term_slug = $kbe_taxonomy->slug;
                $kbe_term_name = $kbe_taxonomy->name;
                $kbe_taxonomy_parent_count = $kbe_taxonomy->count;
                $children = get_term_children($kbe_term_id, kbe_POST_TAXONOMY);
                //var_dump($children);
                $kbe_count_sum = $wpdb->get_var("SELECT Sum(count)
                                                             FROM wp_term_taxonomy
                                                             WHERE taxonomy = '".kbe_POST_TAXONOMY."'
                                                             And parent = $kbe_term_id"
                                                            );

                $kbe_count_sum_parent = '';
                if($children) {
                    $kbe_count_sum_parent = $kbe_count_sum + $kbe_taxonomy_parent_count;
                } else {
                    $kbe_count_sum_parent = $kbe_taxonomy_parent_count;
                }
                ?>
                <p class="category">
                    <a href="<?php echo get_term_link($kbe_term_slug, 'kbe_taxonomy') ?>" class="titles">
                        <?php echo $kbe_term_name; ?>
                    </a>
                </p>

                <?php
            }
        ?>
        </div>
            <?php
            echo '<div class="'. $class .' subcat-wrap shadow">';
            ?>
            <div class="row">
                    <h2 class="cat-name"><strong><?php echo $kbe_cat_name; ?></strong></h2>
                    <?php
                    $children2 = get_term_children(  $term_id, kbe_taxonomy );
                    //var_dump($children2);
                    foreach ($children2 as $child) {
                    ?>
                    <!-- GETS THE SUBCATEGORY ARTICLES -->
                    <div class="block large-6 columns end" data-equalizer-watch><?php
                        $term_name = get_term_by ('kbe_term_id', $child, kbe_taxonomy);
                        echo '<div class="subcat-name">'. $term_name->name . '</div>';
                        $child_args = array (
                            'hide_empty' => true,
                            'posts_per_page' => 5,
                            'paged' => $paged,
                            'post_type' => 'kbe_knowledgebase',
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => kbe_POST_TAXONOMY,
                                    'field' => 'slug',
                                    'terms' => $term_name->name,
                                    'include_children' => 1
                                ),
                            ),
                        );
                        $display_subs = new WP_Query($child_args);
                        if($display_subs->have_posts()) :
                            while($display_subs->have_posts()) :
                                $display_subs->the_post();
                                echo '<div id="article-title">';
                                echo '<div class="">';
                                echo '<span id="article-icon"><img src="' . plugins_url('/images/kbe_article_icon_img.png',__FILE__) . '"/></span>';
                                echo '<a href="'. get_the_permalink() .'"  class="">'. get_the_title() . '</a>';
                                echo '</div>';
                                echo '</div>';
                            endwhile;
                            wp_reset_query();
                    wp_reset_postdata();
                    endif;
                    echo '</div>';
                    }
                    ?>

                    </div>
                    <!-- END SUBCATEGORY QUERIES -->
    
                    <!-- GETS THE PARENT CATEGORY ARTICLES -->
                    <?php //var_dump($kbe_cat_slug); ?>
                    <?php

                    foreach ($children2 as $child) {
                        $exclude_list[] = $child;
                    }
                    //var_dump($exclude_list);

                    ?>
                    <div class="block" data-equalizer-watch><?php
                        $parent_args = array (
                            'posts_per_page' => -1,
                            'parent' => 0,
                            'paged' => $paged,
                            'post_type' => 'kbe_knowledgebase',
                            'orderby' => 'menu_order',
                            'order' => 'ASC',
                            'category__not_in' => $term_name->name,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => kbe_POST_TAXONOMY,
                                    'field' => 'slug',
                                    'terms' => $kbe_cat_slug,
                                    'include_children' => FALSE
                                ),
                            ),
                        );
                        $display_parent = new WP_Query($parent_args);
                        //var_dump($display_parent);
                        if ( !$display_parent->posts == 0 ) {
                            echo '<div class="parent-cat subcat-name">General Topics</div>';
                        }
                        //var_dump($display_parent);
                        if($display_parent->have_posts()) :
                            while($display_parent->have_posts()) :
                                $display_parent->the_post();
                                echo '<div id="article-title">';
                                echo '<div class="">';
                                echo '<span id="article-icon"><img src="' . plugins_url('/images/kbe_article_icon_img.png',__FILE__) . '"/></span>';
                                echo '<a href="'. get_the_permalink() .'"  class="">'. get_the_title() . '</a>';
                                echo '</div>';
                                echo '</div>';
                            endwhile;
                    endif;
                    wp_reset_query();
                    echo '</div>';
                    ?>
                </div>
                <!-- END PARENT CATEGORY ARTICLES -->


            </div>
            </div>

        </div>
<!--     </div> -->
<?php
    get_footer('knowledgebase');
?>