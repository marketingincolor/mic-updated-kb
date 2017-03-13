<?php
    get_header('knowledgebase');
    
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
?>
<div id="mic-kb-container">

    <!--content-->
    <!-- CONTENT -->
    <div class="row">
        <div class="small-12 columns">
            <div id="kbe_content" <?php echo $kbe_content_class; ?>>
                <!--Content Body-->
                <div class="kbe_leftcol" >
                <?php
                    while(have_posts()) :
                        the_post();

                        //  Never ever delete it !!!
                        kbe_set_post_views(get_the_ID());
                ?>
                        <h1><?php the_title(); ?></h1>
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