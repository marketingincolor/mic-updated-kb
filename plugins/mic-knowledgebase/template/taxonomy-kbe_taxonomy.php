<?php
    get_header('knowledgebase');
    

    function mic_sub_cats($children)
    {
        //mic_get_first_sub($children);

        echo '<div id="all-subcategories" class="large-3 columns">';
        for ( $i = 0; $i < count($children); $i++ )
        {
            $company_name = $children[$i];
            $list = get_term_by( 'term_id', $company_name, 'kbe_taxonomy' );
            
            //When we open the first page add to URL
            if ( $i == 0 ) {
            $list2 = get_term_by( 'term_slug', $company_name, 'kbe_taxonomy');
            echo '<script>jQuery( document ).ready(function() { window.location.hash = "'. $list2->slug .'"; });</script>';   
            }

            echo '<span class="sub-category">';
            echo '<a href="#'.$list->slug . '">';
            echo $list->name;
            echo '</a>';
            echo '</span>';

        }
        echo '</div>';
    }
    
    
    function mic_display_blogs($kbe_tax_post_qry)
    {


        
        echo '<div class="large-8 columns">';
        echo '<div id="right-content">';
            if($kbe_tax_post_qry->have_posts()) :
                while($kbe_tax_post_qry->have_posts()) :
                    $kbe_tax_post_qry->the_post();
                    echo '<div id="tax-blocks" class="card large-6 columns">';
                    echo '<div class="sub-borders">';
                    echo '<a href="'. get_the_permalink() .'"  class="article-title">'. get_the_title() . '</a>';
                    echo '<span class="post-meta">';
                    echo '<i class="fa fa-user" aria-hidden="true"></i> ';
                    the_author();
                    #cho '<i class="fa fa-clock-o" aria-hidden="true"></i>';
                    #the_time("M. d, Y");
                    echo '</span>';
                    echo the_excerpt();
                    echo '</div>';
                    echo '</div>';
                endwhile;
            endif;
        echo '</div>';
        echo '</div>';
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
    $kbe_tax_post_args = array(
        'post_type' => kbe_POST_TYPE,
        'posts_per_page' => 999,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => array(
            array(
                'taxonomy' => kbe_POST_TAXONOMY,
                'field' => 'slug',
                'terms' => $kbe_cat_slug,
            ),
        'posts_per_page' => 5,
        'paged' => $paged
        )
    );
    $kbe_tax_post_qry = new WP_Query($kbe_tax_post_args);
?>

<div id="mic-kb-container">
            <!--<articles>-->
            <div class="row">
                <div class="large-12 columns">
                    <h2><strong><?php echo $kbe_cat_name; ?></strong></h2>
                </div>
            </div>
            <div class="row">

                <?php 
                 ?>
                    <?php
                        // if($kbe_tax_post_qry->have_posts()) :
                        //     while($kbe_tax_post_qry->have_posts()) :
                        //         $kbe_tax_post_qry->the_post();
                        //         // var_dump($kbe_tax_post_qry);


                            mic_sub_cats($children);
                            #mic_get_first_sub();
                            mic_display_blogs($kbe_tax_post_qry);

                                ?>

                                <a href="<?php the_permalink(); ?>">
        
                                </a>


            </div>
    
</div>
<?php
    get_footer('knowledgebase');
?>