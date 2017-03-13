<?php
/*===============
    kbe Articles Widget
 ===============*/
 
//========= Custom Knowledgebase Article Widget
add_action( 'widgets_init', 'kbe_article_widgets' );
function kbe_article_widgets() {
    register_widget( 'kbe_Article_Widget' );
}

//========= Custom Knowledgebase Article Widget Body
class kbe_Article_Widget extends WP_Widget {
    
    //=======> Widget setup
    function __construct() {
        parent::__construct(
            'kbe_article_widgets', // Base ID
            __( 'Knowledgebase Article', 'kbe' ), // Name
            array( 'description' => __('WP Knowledgebase article widget to show articles on the site', 'kbe'), 
                    'classname' => 'kbe' ), // Args
            array( 'width' => 300, 'height' => 300, 'id_base' => 'kbe_article_widgets' )
        );
    }
    
    //=======> How to display the widget on the screen.
    function widget($args, $widgetData) {
        extract($args);
        
        //=======> Our variables from the widget settings.
        $kbe_widget_article_title = $widgetData['txtkbeArticleHeading'];
        $kbe_widget_article_count = $widgetData['txtkbeArticleCount'];
        $kbe_widget_article_order = $widgetData['txtkbeArticleOrder'];
        $kbe_widget_article_orderby = $widgetData['txtkbeArticleOrderBy'];
        
        //=======> widget body
        echo $before_widget;
        echo '<div class="kbe_widget kbe_widget_article">';
        
                if($kbe_widget_article_title){
                    echo '<h2>'.$kbe_widget_article_title.'</h2>';
                }
                
                if($kbe_widget_article_orderby == 'popularity'){
                    $kbe_widget_article_args = array( 
                        'posts_per_page' => $kbe_widget_article_count, 
                        'post_type'  => 'kbe_knowledgebase',
                        'orderby' => 'meta_value_num',
                        'order'	=>	$kbe_widget_article_order,
                        'meta_key' => 'kbe_post_views_count'
                    );
                }
                else{
                    $kbe_widget_article_args = array(
                        'post_type' => 'kbe_knowledgebase',
                        'posts_per_page' => $kbe_widget_article_count,
                        'order' => $kbe_widget_article_order,
                        'orderby' => $kbe_widget_article_orderby
                   );
                }
                
                $kbe_widget_articles = new WP_Query($kbe_widget_article_args);
                if($kbe_widget_articles->have_posts()) :
            ?>
                <ul>
            <?php
                    while($kbe_widget_articles->have_posts()) :
                        $kbe_widget_articles->the_post();
            ?>
                        <li>
                            <a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
                                <?php the_title() ?>
                            </a>
                        </li>
            <?php
                    endwhile;
            ?>
                </ul>
            <?php
                endif;
                
                wp_reset_query();
                
        echo "</div>";
        echo $after_widget;
    }
    
    //Update the widget 
    function update($new_widgetData, $old_widgetData) {
        $widgetData = $old_widgetData;
		
        //Strip tags from title and name to remove HTML 
        $widgetData['txtkbeArticleHeading'] = $new_widgetData['txtkbeArticleHeading'];
        $widgetData['txtkbeArticleCount'] = $new_widgetData['txtkbeArticleCount'];
        $widgetData['txtkbeArticleOrder'] = $new_widgetData['txtkbeArticleOrder'];
        $widgetData['txtkbeArticleOrderBy'] = $new_widgetData['txtkbeArticleOrderBy'];
		
        return $widgetData;
    }
    
    function form($widgetData) {
        //Set up some default widget settings.
        $widgetData = wp_parse_args((array) $widgetData);
?>
        <p>
            <label for="<?php echo $this->get_field_id('txtkbeArticleHeading'); ?>"><?php _e('Article Title:','kbe'); ?></label>
            <input id="<?php echo $this->get_field_id('txtkbeArticleHeading'); ?>" name="<?php echo $this->get_field_name('txtkbeArticleHeading'); ?>" value="<?php echo $widgetData['txtkbeArticleHeading']; ?>" style="width:275px;" />
        </p>    
        <p>
            <label for="<?php echo $this->get_field_id('txtkbeArticleCount'); ?>"><?php _e('Articles Quantity:','kbe') ?></label>
            <input id="<?php echo $this->get_field_id('txtkbeArticleCount'); ?>" name="<?php echo $this->get_field_name('txtkbeArticleCount'); ?>" value="<?php echo $widgetData['txtkbeArticleCount']; ?>" style="width:275px;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('txtkbeArticleOrder'); ?>"><?php _e('Articles Order:','kbe') ?></label>
            <select id="<?php echo $this->get_field_id('txtkbeArticleOrder'); ?>" name="<?php echo $this->get_field_name('txtkbeArticleOrder'); ?>">
                <option <?php selected($widgetData['txtkbeArticleOrder'], 'ASC') ?> value="ASC"><?php _e('ASC','kbe'); ?></option>
                <option <?php selected($widgetData['txtkbeArticleOrder'], 'DESC') ?> value="DESC"><?php _e('DESC','kbe'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('txtkbeArticleOrderBy'); ?>"><?php _e('Articles Order by:','kbe') ?></label>
            <select id="<?php echo $this->get_field_id('txtkbeArticleOrderBy'); ?>" name="<?php echo $this->get_field_name('txtkbeArticleOrderBy'); ?>">
                <option <?php selected($widgetData['txtkbeArticleOrderBy'], 'name') ?> value="name"><?php _e('By Name','kbe'); ?></option>
                <option <?php selected($widgetData['txtkbeArticleOrderBy'], 'date') ?> value="date"><?php _e('By Date','kbe'); ?></option>
                <option <?php selected($widgetData['txtkbeArticleOrderBy'], 'rand') ?> value="rand"><?php _e('By Random','kbe'); ?></option>
                <option <?php selected($widgetData['txtkbeArticleOrderBy'], 'popularity') ?> value="popularity"><?php _e('By Popularity','kbe'); ?></option>
                <option <?php selected($widgetData['txtkbeArticleOrderBy'], 'comment_count') ?> value="comment_count"><?php _e('By Comments','kbe') ?></option>
            </select>
        </p>
<?php
    }
}
?>