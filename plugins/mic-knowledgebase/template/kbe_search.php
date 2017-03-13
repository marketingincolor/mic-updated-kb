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
            <div class="large-12 columns">
                <?php
                    $kbe_search_term = $_GET['s'];
                ?>
                <h1><?php _e('Search Results for: '.$kbe_search_term, 'kbe'); ?></h1>
                <hr/>
            </div>
        </div>

        <div class="row">
            <div class="large-12 columns">

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