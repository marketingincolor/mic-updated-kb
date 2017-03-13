<?php
/*===============
    kbe Tags Widget
 ===============*/
 
//========= Custom Knowledgebase Tags Widget
add_action( 'widgets_init', 'kbe_tags_widgets' );
function kbe_tags_widgets() {
    register_widget( 'kbe_Tags_Widget' );
}

//========= Custom Knowledgebase Tags Widget Body
class kbe_Tags_Widget extends WP_Widget {
    
    function __construct() {
        parent::__construct(
            'kbe_tags_widgets', // Base ID
            __( 'Knowledgebase Tags', 'kbe' ), // Name
            array( 'description' => __('WP Knowledgebase tags widget to show tags on the site', 'kbe'), 
                   'classname' => 'kbe' ),
            array( 'width' => 300, 'height' => 350, 'id_base' => 'kbe_tags_widgets' ) // Args
        );
    }
	
	//=======> How to display the widget on the screen.
    function widget($args, $widgetData) {
        extract($args);
        
        //=======> Our variables from the widget settings.
        $kbe_widget_tag_title = $widgetData['txtkbeTagsHeading'];
        $kbe_widget_tag_count = $widgetData['txtkbeTagsCount'];
        $kbe_widget_tag_style = $widgetData['txtkbeTagsStyle'];
        
        //=======> widget body
        echo $before_widget;
        echo '<div class="kbe_widget kbe_widget_article">';
        
                if($kbe_widget_tag_title){
                    echo '<h2>'.$kbe_widget_tag_title.'</h2>';
                }
        ?>
                <div class="kbe_tags_widget">
                <?php
                    $args = array(
                                'smallest'                  => 	12,
                                'largest'                   => 	30,
                                'unit'                      => 	'px',
                                'number'                    => 	$kbe_widget_tag_count,
                                'format'                    => 	$kbe_widget_tag_style,
                                'separator'                 => 	"\n",
                                'orderby'                   => 	'name',
                                'order'                     => 	'ASC',
                                'exclude'                   => 	null,
                                'include'                   => 	null,
                                'link'                      => 	'view',
                                'taxonomy'                  => 	kbe_POST_TAGS,
                                'echo'                      => 	true
                    );
						
                    wp_tag_cloud($args);
					
                    wp_reset_query();
		?>
                </div>
<?php      
        echo "</div>";
        echo $after_widget;
    }
    
    //Update the widget 
    function update($new_widgetData, $old_widgetData) {
        $widgetData = $old_widgetData;
		
        //Strip tags from title and name to remove HTML 
        $widgetData['txtkbeTagsHeading'] = $new_widgetData['txtkbeTagsHeading'];
        $widgetData['txtkbeTagsCount'] = $new_widgetData['txtkbeTagsCount'];
        $widgetData['txtkbeTagsStyle'] = $new_widgetData['txtkbeTagsStyle'];
		
        return $widgetData;
    }
    
    function form($widgetData) {
        //Set up some default widget settings.
        $widgetData = wp_parse_args((array) $widgetData);
?>
        <p>
            <label for="<?php echo $this->get_field_id('txtkbeTagsHeading'); ?>"><?php _e('Tag Title:','kbe'); ?></label>
            <input id="<?php echo $this->get_field_id('txtkbeTagsHeading'); ?>" name="<?php echo $this->get_field_name('txtkbeTagsHeading'); ?>" value="<?php echo $widgetData['txtkbeTagsHeading']; ?>" style="width:275px;" />
        </p>    
        <p>
            <label for="<?php echo $this->get_field_id('txtkbeTagsCount'); ?>"><?php _e('Tags Quantity:','kbe'); ?></label>
            <input id="<?php echo $this->get_field_id('txtkbeTagsCount'); ?>" name="<?php echo $this->get_field_name('txtkbeTagsCount'); ?>" value="<?php echo $widgetData['txtkbeTagsCount']; ?>" style="width:275px;" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('txtkbeTagsStyle'); ?>"><?php _e('Tags Style:','kbe'); ?></label>
            <select id="<?php echo $this->get_field_id('txtkbeTagsStyle'); ?>" name="<?php echo $this->get_field_name('txtkbeTagsStyle'); ?>">
                <option <?php selected($widgetData['txtkbeTagsStyle'], 'flat') ?> value="flat"><?php _e('Flat','kbe'); ?></option>
                <option <?php selected($widgetData['txtkbeTagsStyle'], 'list') ?> value="list"><?php _e('List','kbe'); ?></option>
            </select>
        </p>
<?php
    }
}
?>