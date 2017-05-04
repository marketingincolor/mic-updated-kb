<?php
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

if(!empty($_GET['ajax']) ? $_GET['ajax'] : null) {
    if ( have_posts() ) {
?>
        <ul id="search-result">
    <?php
        while (have_posts()) : the_post();
    ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            
    <?php
        endwhile;
    ?>
        </ul>

<?php
    } else {
?>
        <span class="kbe_no_result">Search result not found......</span>
<?php
    }
} else {
    get_header('knowledgebase');
    // load the style and script
    wp_enqueue_style ( 'kbe_theme_style' );
    if( kbe_SEARCH_SETTING == 1 ){
        wp_enqueue_script( 'kbe_live_search' );
    }
?>
    <div id="mic-kb-container">
        <div class="row">
        <?php
        $kbe_terms = get_terms( array ( 'taxonomy'=> kbe_POST_TAXONOMY, 'parent' => 0 ) );
        $class = "large-9 columns";
        $kbe_cat_slug = get_queried_object()->slug;
        $mic_term_id = get_queried_object()->term_id;
        $children = get_term_children($mic_term_id, kbe_POST_TAXONOMY);
        $kbe_cat_name = get_queried_object()->name;
        $kbe_tax_post_args = array(
            'posts_per_page' => -1,
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

        <div class="large-9 columns shadow">
            <?php
                $kbe_search_term = $_GET['s'];
            ?>
            <h1><?php _e('Search Results for: '.$kbe_search_term, 'kbe'); ?></h1>
            <hr/>
        <?php
            while(have_posts()) :
                the_post();
        ?>
                <a href="<?php the_permalink(); ?>">
                    <div class="mic-kb-title"><?php the_title(); ?></div>
                </a>
                <span class="post-meta">
                <i class="fa fa-user" aria-hidden="true"></i>
                    <?php the_author(); ?>
                    <i class="fa fa-clock-o" aria-hidden="true"></i> <?php the_time('M. d, Y'); ?>
                </span>
                <p><?php echo kbe_short_content(300); ?></p>
                <hr />
<!--                             <div class="kbe_read_more">
                    <a class="mic-read-more" href="<?php the_permalink(); ?>">
                        Read More
                    </a>
                </div> -->
        <?php
            endwhile;
        ?>
        </div>
</div>
    
    <!--aside-->
    <div class="kbe_aside <?php echo $kbe_sidebar_class; ?>">
    <?php
        if((kbe_SIDEBAR_INNER == 2) || (kbe_SIDEBAR_INNER == 1)){
            dynamic_sidebar('kbe_cat_widget');
        }
    ?>
    </div>
    <!--/aside-->
    
</div>
<?php
    get_footer('knowledgebase');
}
?>