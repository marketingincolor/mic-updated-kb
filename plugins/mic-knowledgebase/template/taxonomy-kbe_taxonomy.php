<?php
    get_header('knowledgebase');
?>
    <div id="mic-kb-container">
        <div class="row">
            <div class="small-12 columns">
                <?php kbe_search_form(); ?>
            </div>
        </div> 

    <?php
    /**
     * For Displaying subcategories down the side
     * @param  [type] $children [description]
     * @return [type]           [description]
     */
    function mic_sub_cats($children)
    {
        if ( count($children) == 0 ) {
            $class = "display-none";
        }
        else {
            $class = "large-3 columns";
        }

        echo '<div id="all-subcategories" class="'. $class .'">';
        for ( $i = 0; $i < count($children); $i++ )
        {
            $company_name = $children[$i];
            $list = get_term_by( 'term_id', $company_name, 'kbe_taxonomy' );

            echo '<span class="sub-category">';
            echo '<a href="'. site_url() . "/knowledgebase_category/" . $list->slug . '">';
            echo $list->name;
            echo '</a>';
            echo '</span>';

        }
        echo '</div>';
    }
    
    /**
     * Displays card style blog posts within category
     * @param  [type] $kbe_tax_post_qry [description]
     * @param  [type] $children         [description]
     * @return [type]                   [description]
     */
    function mic_display_blogs()
    {
        global $wp_query;
        //var_dump($wp_query);
        $kbe_cat_slug = get_queried_object()->slug;
        $mic_term_id = get_queried_object()->term_id;
        $children = get_term_children($mic_term_id, kbe_POST_TAXONOMY);
        $kbe_cat_name = get_queried_object()->name;
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        //$display_blogs = new WP_Query();
        //$inner_query->query('posts_per_page=9' . '&paged='.$paged.'' . '&post_type=kbe_knowledgebase' . '&order=ASC' );
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
                ),
            ),
        );
        $display_blogs = new WP_Query($kbe_tax_post_args);
        //var_dump($display_blogs);
        echo '<div class="large-9 columns">';
        echo '<div id="right-content">';
            if($display_blogs->have_posts()) :
                while($display_blogs->have_posts()) :
                    $display_blogs->the_post();
                    echo '<div id="tax-blocks" class="card large-4 columns">';
                    echo '<div class="sub-borders">';
                    echo '<a href="'. get_the_permalink() .'"  class="article-title">'. get_the_title() . '</a>';
                    echo '<span class="post-meta">';
                    echo '<i class="fa fa-user" aria-hidden="true"></i> ';
                    the_author();
                    echo '</span>';
                    echo the_excerpt();
                    echo '</div>';
                    echo '</div>';
                endwhile;
            echo '<div id="pagination" class="row">';
            echo '<div class="large-12 columns">';


              $big = 999999999; // need an unlikely integer
              echo paginate_links( array(
               'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
               'format' => '?paged=%#%',
               'current' => max( 1, get_query_var('paged') ),
               'total' => $display_blogs->max_num_pages
              ) );

                # echo paginate_links( $args );
                #wp_pagenavi( array( 'query' => $display_blogs ) );

            echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '</div>';
        endif;
        wp_reset_query();
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
            <div class="large-12 columns">
                <h2><strong><?php echo $kbe_cat_name; ?></strong></h2>
            </div>
        </div>
        <div class="row">
            <?php
                mic_sub_cats($children);
                mic_display_blogs();
                // wp_pagenavi( array( 'query' => $display_blogs ) );
            ?>
        </div>
    </div>
    
</div>
<?php
    get_footer('knowledgebase');
?>