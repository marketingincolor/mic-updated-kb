<?php
    function mic_get_permissions()
    {
        // Enter permissions here.
        $permissions = array(
            'read_mic',
            'read_rca'
        );

        // Find out who the user is.
        $user_id = get_current_user_id();
        $user_info = get_userdata($user_id);
        $user_roles = array();
        $user_roles = $user_info->roles;
        $permission = array_intersect($permissions, $user_roles);
        //var_dump($permission);
        $permission = implode('', $permission);
        return $permission;
    }
    $kbe_terms = get_terms( 
    array ( 
        'taxonomy'=> kbe_POST_TAXONOMY, 
        'parent' => 0,  
        'hide_empty' => true,
        'meta_query' => array(
            array(
               'key'       => 'permission-group',
               'value'     => mic_get_permissions(),
               'compare'   => 'LIKE'
            )
        )

    ) 
    );
    $kbe_terms2 = get_terms( array ( 'taxonomy'=> kbe_POST_TAXONOMY, 'parent' => 1, 'hide_empty' => true ) );
    get_header('knowledgebase');
?>
    <?php
    

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
        <div class="large-3 columns show-for-large-up">
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
                    <input type="hidden" name="post_number" value=5>
                    <?php
                    $children2 = get_term_children(  $term_id, kbe_taxonomy );

                    foreach ($children2 as $child) {
                    ?>

                    <!-- GETS THE SUBCATEGORY ARTICLES -->
                    <div class="block large-6 columns end" data-equalizer-watch><?php
                        $term_name = get_term_by ('kbe_term_id', $child, kbe_taxonomy);
                        $id = $term_name->term_id;
                        $count_query = $wpdb->get_var("SELECT count
                                         FROM wp_term_taxonomy
                                         WHERE term_id = $id"
                                        );
                        echo '<a href="'. get_term_link($id) . '"><div class="subcat-name">'. $term_name->name . '<div id="count">'.$count_query.'</div></div></a>';
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
                            ?>
                            <?php
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
                        if ( !$display_parent->posts == 0 ) {
                            //Removed <div id="count">'.$display_parent->found_posts.'</div></div>
                            echo '<div class="parent-cat subcat-name">General Topics</div>';
                        }
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