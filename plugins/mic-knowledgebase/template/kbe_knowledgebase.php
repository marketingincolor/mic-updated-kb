<?php
    /*=========
    Template Name: kbe
    =========*/

    $team = array(
        42,
        39,
        40,
        17
    );


    get_header('knowledgebase');
    
    // load the style and script
    wp_enqueue_style ( 'kbe_theme_style' );
    if( kbe_SEARCH_SETTING == 1 ){
        wp_enqueue_script( 'kbe_live_search' );
    }

    
    // Classes For main content div
    if(kbe_SIDEBAR_HOME == 0) {
        $kbe_content_class = 'class="kbe_content_full"';
    } elseif(kbe_SIDEBAR_HOME == 1) {
        $kbe_content_class = 'class="kbe_content_right"';
    } elseif(kbe_SIDEBAR_HOME == 2) {
        $kbe_content_class = 'class="kbe_content_left"';
    }
    
    // Classes For sidebar div
    if(kbe_SIDEBAR_HOME == 0) {
        $kbe_sidebar_class = 'kbe_aside_none';
    } elseif(kbe_SIDEBAR_HOME == 1) {
        $kbe_sidebar_class = 'kbe_aside_left';
    } elseif(kbe_SIDEBAR_HOME == 2) {
        $kbe_sidebar_class = 'kbe_aside_right';
    }
?>
<div id="mic-kb-container">
    <h1 class="text-center">How can we help you?</h1><br/>
    <p class="text-center" style="margin-bottom:48px;">Choose a category to find the help you need</p>
    <div class="row">
        <div class="small-12 columns">
            <?php kbe_search_form(); ?>
        </div>
    </div> 
                <?php
                    $kbe_cat_args = array(
                        'orderby'       => 'terms_order', 
                        'order'         => 'ASC',
                        'hide_empty'    => true,
                        'parent'        => 0,

                    );

                    /*
                    * Author: Doe
                    * Date: 03/01/2017
                    * Purpose: Helper function to user later on for getting key value pairs.
                     */
                    function mic_setup_roles()
                    {
                        $roles = array(
                            'read_rca' => 37,
                            'read_mic' => array(1,2,3),
                        );
                        return $roles;
                    }

                    /*
                    * Author: Doe
                    * Date: 03/01/2017
                    * Purpose: Get the IDs for helper altering category loop
                     */
                    function mic_get_include_ids()
                    {

                        $roles = array(
                            'read_rca' => 38,
                            'read_mic' => array(34,2,24,1,3,4,5,6,7,8,9,10,11,12,13,14,15, 16, 43),                        
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

                    /*
                    * Author: Doe
                    * Date: 03/01/2017
                    * Purpose: Finds roles that match user
                     */
                    function mic_get_read_roles()
                    {

                        $roles = array(
                            'read_rca' => 38,
                            'read_mic' => array(34,2,24,1,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,27,28,29,30,31,32,33,34,35),                        
                        );
                        $accepted_roles = array();
                        $rejected_roles = array();
                        foreach ($roles as $role => $id) {
                            if ( current_user_can( $role ) ) {
                                array_push($accepted_roles, $role);
                            }
                            else {
                                array_push($rejected_roles, $role);
                            }
                        }
                        $accepted_roles = implode(" && ", $accepted_roles);
                        return $accepted_roles;
                    }

                    /*
                    * Author: Doe
                    * Date: 03/01/2017
                    * Purpose: Alter the category loop to show only user specific categories
                     */

                    if ( true && mic_get_read_roles() )
                    {
                        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                        $kbe_cat_args = array(
                        'orderby'    => 'terms_order', 
                        'order'      => 'ASC',
                        'hide_empty' => true,
                        'parent'     => 0,
                        'include'    => mic_get_include_ids(),
                        'fields' => 'all',

                        );
                    }


                $kbe_terms = get_terms(kbe_POST_TAXONOMY, $kbe_cat_args, 'posts_per_page=3&paged=' . $paged);
                ?>
                    <div id="blocks" class="row">
                    <?php
                    foreach($kbe_terms as $kbe_taxonomy){
                        $queried_object = get_queried_object();
                        $term_id = $queried_object->term_id;

                        $kbe_term_id = $kbe_taxonomy->term_id;
                        $kbe_term_slug = $kbe_taxonomy->slug;
                        $kbe_term_name = $kbe_taxonomy->name;

                        $kbe_taxonomy_parent_count = $kbe_taxonomy->count;

                            $children = get_term_children($kbe_term_id, kbe_POST_TAXONOMY);

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
                    <div class="small-12 medium-6 large-3 columns box end">
                        <div class="borders">
                            <span id="category-icon">
                            <?php  

                                echo tax_icons_output_term_icon( $kbe_term_id, "fa-lg");

                             ?>
                            </span>
                            <h2 class="title">
                                <a href="<?php echo get_term_link($kbe_term_slug, 'kbe_taxonomy') ?>" class="titles">
                                    <?php echo $kbe_term_name; ?>
                                </a>
                            </h2>
<!--                             <span class="mic-count">
                                <?php
                                    // echo $kbe_count_sum_parent;
                                    // if ($kbe_count_sum_parent == 1) {
                                    //     _e(' Article','kbe');
                                    // } else {
                                    //     _e(' Articles','kbe');
                                    // }
                                ?>
                            </span> -->
                        </div>
                    </div>
                    <?php } ?>
            </div>
            <div id="mic-faq" class="row">
                <div class="small-12 columns">
                    <h2>Frequently Asked Questions</h2><br/>
                </div>
                <div class="small-12 large-6 columns">
                    <p>Lorem Ipsum Dolar</p>
                    <p>Lorem Ipsum Dolar</p>
                    <p>Lorem Ipsum Dolar</p>
                    <p>Lorem Ipsum Dolar</p>
                    <p>Lorem Ipsum Dolar</p>
 
                </div>
                <div class="small-12 large-6 columns">
                    <p>Lorem Ipsum Dolar</p>
                    <p>Lorem Ipsum Dolar</p>
                    <p>Lorem Ipsum Dolar</p>
                    <p>Lorem Ipsum Dolar</p>
                    <p>Lorem Ipsum Dolar</p>
 
                </div>
            </div>
</div>
            <!--content-->
<?php get_footer('knowledgebase'); ?>