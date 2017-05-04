<?php
/**
 * Template: kbe_settings.php
 * 
 */
?>

<?php
    $kbe_defaults = array( 
        'kbe_plugin_slug' => 'Knowledgebase',
        'kbe_article_qty' => 5,
        'kbe_search_setting' =>  0,
        'kbe_breadcrumbs_setting' =>  0,
        'kbe_sidebar_home' => 0,
        'kbe_sidebar_inner' => 0,
        'kbe_comments_setting' => 0,
        'kbe_bgcolor' => ''
    );

    $kbe_settings = wp_parse_args( get_option( 'kbe_settings' ), $kbe_defaults );
?>
<div id="wpbody">
    <div id="wpbody-content">
        <div class="wrap">
            
            <h2><?php _e('Knowledgebase Display Settings','kbe')?></h2>
            <?php                
                global $wpdb;
                
                $tbl_posts = $wpdb->prefix."posts";
                
                if(isset($kbe_settings['update'])){
                    $kbe_posts = $wpdb->get_results("Select * From $tbl_posts Where post_content like '%[kbe_knowledgebase]%' and post_type = 'page'");
                    
                    foreach($kbe_posts as $kbe_post){
                        $kbe_id = $kbe_post->ID;
                        $kbe_slug = get_option('kbe_plugin_slug');
                        
                        $kbe_post_data = array(
                            'post_name' => $kbe_slug
                        );
                        
                        $kbe_post_where = array(
                            'ID' => $kbe_id
                        );
                        
                        $wpdb->update($tbl_posts, $kbe_post_data, $kbe_post_where);
                    }
                    flush_rewrite_rules();
            ?>
                    <div class='updated' style='margin-top:10px;'>
                        <p><?php _e('Settings updated successfully','kbe') ?></p>
                    </div>
            <?php
                    unset($kbe_settings['update']);
                    update_option('kbe_settings', $kbe_settings);
                }
            ?>
            <div class="kbe_admin_left_bar">
                <div class="kbe_admin_left_content">
                    <div class="kbe_admin_left_heading">
                        <h3><?php _e('Settings','kbe'); ?></h3>
                    </div>
                    <div class="kbe_admin_settings">
                        <form method="post" action="options.php">
                        <?php  
                            settings_fields('kbe_settings');
                        ?>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top: 18px;">
                            <tr>
                                <td width="35%" valign="top">
                                    <label><?php _e('Knowledgebase Slug','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_plugin_slug]" id="kbe_plugin_slug" value="<?php echo esc_attr( $kbe_settings['kbe_plugin_slug'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Number of articles to show','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_article_qty]" id="kbe_article_qty" value="<?php echo esc_attr( $kbe_settings['kbe_article_qty'] ); ?>">
                                <p>
                                    <strong><?php _e('Note:','kbe'); ?></strong>
                                    <?php _e('Set the number of articles to show in each category on KB homepage','kbe'); ?>
                              	</p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Knowledgebase search','kbe'); ?></label>
                                </td>
                                <td width="15%">
                                    <input type="radio" name="kbe_settings[kbe_search_setting]" id="kbe_search_setting" value="1" <?php checked( $kbe_settings['kbe_search_setting'], '1' ); ?>>
                                    <span><?php _e('On','kbe'); ?></span>
                                </td>
                                <td width="15%">
                                    <input type="radio" name="kbe_settings[kbe_search_setting]" id="kbe_search_setting" value="0" <?php checked( $kbe_settings['kbe_search_setting'], '0' ); ?>>
                                    <span><?php _e('Off','kbe'); ?></span>
                                </td>
                                <td width="45%">&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Knowledgebase breadcrumbs','kbe'); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_breadcrumbs_setting]" id="kbe_breadcrumb_setting" value="1" <?php checked( $kbe_settings['kbe_breadcrumbs_setting'], '1' ); ?>>
                                    <span><?php _e('On','kbe'); ?></span>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_breadcrumbs_setting]" id="kbe_breadcrumb_setting" value="0" <?php checked( $kbe_settings['kbe_breadcrumbs_setting'], '0' ); ?>>
                                    <span><?php _e('Off','kbe'); ?></span>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Knowledgebase home page sidebar','kbe'); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_sidebar_home]" id="kbe_sidebar_home" value="1" <?php checked( $kbe_settings['kbe_sidebar_home'], 1 ); ?>>
                                    <span><?php _e('Left','kbe'); ?></span>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_sidebar_home]" id="kbe_sidebar_home" value="2" <?php checked( $kbe_settings['kbe_sidebar_home'], 2 ); ?>>
                                    <span><?php _e('Right','kbe'); ?></span>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_sidebar_home]" id="kbe_sidebar_home" value="0" <?php checked( $kbe_settings['kbe_sidebar_home'], 0 ); ?>>
                                    <span><?php _e('None','kbe'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Knowledgebase inner pages sidebar','kbe'); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_sidebar_inner]" id="kbe_sidebar_inner" value="1" <?php checked( $kbe_settings['kbe_sidebar_inner'], 1 ); ?>>
                                    <span><?php _e('Left','kbe'); ?></span>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_sidebar_inner]" id="kbe_sidebar_inner" value="2" <?php checked( $kbe_settings['kbe_sidebar_inner'], 2 ); ?>>
                                    <span><?php _e('Right','kbe'); ?></span>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_sidebar_inner]" id="kbe_sidebar_inner" value="0" <?php checked( $kbe_settings['kbe_sidebar_inner'], 0 ); ?>>
                                    <span><?php _e('None','kbe'); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Knowledgebase comments','kbe'); ?></label>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_comments_setting]" id="kbe_comment_setting" value="1" <?php checked( $kbe_settings['kbe_comments_setting'], '1' ); ?>>
                                    <span><?php _e('On','kbe'); ?></span>
                                </td>
                                <td>
                                    <input type="radio" name="kbe_settings[kbe_comments_setting]" id="kbe_comment_setting" value="0" <?php checked( $kbe_settings['kbe_comments_setting'], '0' ); ?>>
                                    <span><?php _e('Off','kbe'); ?></span>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Knowledgebase theme color','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_bgcolor]" id="kbe_bgcolor" value="<?php echo esc_attr( $kbe_settings['kbe_bgcolor'] ); ?>" class="cp-field">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #1','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq1]" id="kbe_faq1" value="<?php echo esc_attr( $kbe_settings['kbe_faq1'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #2','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq2]" id="kbe_faq2" value="<?php echo esc_attr( $kbe_settings['kbe_faq2'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #3','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq3]" id="kbe_faq3" value="<?php echo esc_attr( $kbe_settings['kbe_faq3'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #4','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq4]" id="kbe_faq4" value="<?php echo esc_attr( $kbe_settings['kbe_faq4'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #5','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq5]" id="kbe_faq5" value="<?php echo esc_attr( $kbe_settings['kbe_faq5'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #6','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq6]" id="kbe_faq6" value="<?php echo esc_attr( $kbe_settings['kbe_faq6'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #7','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq7]" id="kbe_faq7" value="<?php echo esc_attr( $kbe_settings['kbe_faq7'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #8','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq8]" id="kbe_faq8" value="<?php echo esc_attr( $kbe_settings['kbe_faq8'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #9','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq9]" id="kbe_faq9" value="<?php echo esc_attr( $kbe_settings['kbe_faq9'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td valign="top">
                                    <label><?php _e('Question #10','kbe'); ?></label>
                                </td>
                                <td colspan="3">
                                    <input type="text" name="kbe_settings[kbe_faq10]" id="kbe_faq10" value="<?php echo esc_attr( $kbe_settings['kbe_faq10'] ); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" align="right" style="border:0px;">
                                    <input type="hidden" name="kbe_settings[update]" value="update" />
                                    <input type="submit" value="<?php _e('Save Changes','kbe'); ?>" name="submit" id="submit">
                                </td>
                            </tr>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>