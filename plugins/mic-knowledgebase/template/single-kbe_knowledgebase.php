<?php
    get_header('knowledgebase');
        function getPostViews($postID){
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0 View";
        }
        return $count.' Views';
    }

    function setPostViews($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            $count = 0;
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
        }else{
            $count++;
            update_post_meta($postID, $count_key, $count);
        }
    }
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

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



?>
<div id="mic-kb-container">

    <!--content-->
    <!-- CONTENT -->
        <div class="row">
        <?php
        $kbe_terms = get_terms( array ( 
            'taxonomy'=> kbe_POST_TAXONOMY, 
            'parent' => 0,
            'meta_query' => array(
                array(
                   'key'       => 'permission-group',
                   'value'     => mic_get_permissions(),
                   'compare'   => 'LIKE'
                )
            )
        ) 
        );
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

        <div class="small-12 large-9 columns shadow">
            <div id="kbe_content" <?php echo $kbe_content_class; ?>>
                <!--Content Body-->
                <div class="kbe_leftcol" >
                <?php
                    while(have_posts()) :
                        the_post();
                    ?>
                        <div class="entry-header">
                            <?php
                                the_title( '<h1 class="entry-title gray">', '</h1>' );
                            ?>
                        </div><!-- .entry-header -->
                        <div class="entry-meta">
                            <div class="row">
                                <div class="hide-for-small-down medium-2 columns">
                                    <hr class="midline">
                                </div>
                                <div class="small-12 medium-8 columns">
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <time datetime="<?php echo the_time('Y-m-j'); ?>"><?php echo the_time(get_option('date_format')); ?></time>
                                    <!-- by <span class="author_name"><?php the_author_link(); ?></span> -->
                                    <span class="binoculars"> 
                                    <?php 
                                        setPostViews(get_the_ID());
                                        echo '<i class="fa fa-binoculars" aria-hidden="true"></i>';
                                        echo getPostViews(get_the_ID()); 
                                    ?>
                                    </span>
                                    <span class="print" onclick="window.print()" style="cursor: pointer;">
                                    <i class="fa fa-print" aria-hidden="true"></i>Print Article
                                    </span>
                                    <br />
                                    <?php
                                    $categories = get_the_category();
                                    $separator = ', ';
                                    $output = '';
                                    if ( ! empty( $categories ) ) {
                                        foreach( $categories as $category ) {
                                            $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
                                        }
                                        if ($post->post_type != 'portfolio') :
                                            echo trim( $output, $separator );
                                        endif;
                                    }
                                    ?>
                                    <br>
                                    <?php //echo get_the_term_list( $post->ID, 'post_tag', '', '&#44; ' , '' ); ?>
                                </div>
                                <div class="hide-for-small-down medium-2 columns">
                                    <hr class="midline">
                                </div>
                            </div>
                        </div>
                    <?php
                        //  Never ever delete it !!!
                        kbe_set_post_views(get_the_ID());
                    ?>
                    <?php 
                        the_content();
                        if(kbe_COMMENT_SETTING == 1){
                    ?>
                            <div class="kbe_reply">
                    <?php
                                comments_template("wp_knowledgebase/kbe_comments.php");
                    ?>
                            </div> 
                <?php
                        }
                    endwhile;

                    //  Never ever delete it !!!
                    kbe_get_post_views(get_the_ID());
                ?>
                </div>
                <!--/Content Body-->

            </div>
        </div>
    </div>
    <!-- END CONTENT -->
	
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
<?php get_footer('knowledgebase'); ?>
