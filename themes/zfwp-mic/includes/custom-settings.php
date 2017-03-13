<?php
//Custom Admin settings for ZFWP BASE theme
class CustomSettingsPage
{
	private $options;
	public function __construct()
	{
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}
	//Add options page
	public function add_plugin_page()
	{
		// This page will be under "Settings"
		add_options_page(
			'Settings Admin',
			'Site Settings',
			'manage_options',
			'custom-setting-admin',
			array( $this, 'create_admin_page' )
		);
	}
	public function create_admin_page()
	{
		// Set class property
		$this->options = get_option( 'custom_option_name' );
		print "<div class=\"wrap\">" ;
		print "<h2>Site Settings</h2>";
		print "<form method=\"post\" action=\"options.php\">";
		// This prints out all hidden setting fields
		settings_fields( 'custom_option_group' );
		do_settings_sections( 'custom-setting-admin' );
		submit_button();
		print "</form>";
		print "</div>";
	}
	//Register and add settings
	public function page_init()
	{
		register_setting(
			'custom_option_group', // Option group
			'custom_option_name', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		add_settings_section(
			'setting_section_id', // ID
			'Custom Site Settings', // Title
			array( $this, 'print_section_info' ), // Callback
			'custom-setting-admin' // Page
		);

		add_settings_field(
			'ph_info',
			'Company Phone',
			array( $this, 'ph_callback' ),
			'custom-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'ad_info',
			'Company Address',
			array( $this, 'ad_callback' ),
			'custom-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'em_info',
			'Company Email',
			array( $this, 'em_callback' ),
			'custom-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'fb_link',
			'Facebook Link',
			array( $this, 'fb_callback' ),
			'custom-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'tw_link',
			'Twitter Link',
			array( $this, 'tw_callback' ),
			'custom-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'ig_link',
			'Instagram Link',
			array( $this, 'ig_callback' ),
			'custom-setting-admin',
			'setting_section_id'
		);

		add_settings_field(
			'li_link',
			'LinkedIn Link',
			array( $this, 'li_callback' ),
			'custom-setting-admin',
			'setting_section_id'
		);
        
        add_settings_field(
			'pi_link',
			'Pinterest Link',
			array( $this, 'pi_callback' ),
			'custom-setting-admin',
			'setting_section_id'
		);
        
        add_settings_field(
			'ss_info',
			'SharpSpring Footer',
			array( $this, 'ss_callback' ),
			'custom-setting-admin',
			'setting_section_id'
		);
	}
	public function sanitize( $input )
	{
		$new_input = array();
		if( isset( $input['ph_info'] ) )
			$new_input['ph_info'] = sanitize_text_field( $input['ph_info'] );
		if( isset( $input['ad_info'] ) )
			$new_input['ad_info'] = sanitize_text_field( $input['ad_info'] );
		if( isset( $input['em_info'] ) )
			$new_input['em_info'] = sanitize_text_field( $input['em_info'] );
		if( isset( $input['fb_link'] ) )
			$new_input['fb_link'] = sanitize_text_field( $input['fb_link'] );
		if( isset( $input['tw_link'] ) )
			$new_input['tw_link'] = sanitize_text_field( $input['tw_link'] );
		if( isset( $input['ig_link'] ) )
			$new_input['ig_link'] = sanitize_text_field( $input['ig_link'] );
        if( isset( $input['li_link'] ) )
			$new_input['li_link'] = sanitize_text_field( $input['li_link'] );
		if( isset( $input['pi_link'] ) )
			$new_input['pi_link'] = sanitize_text_field( $input['pi_link'] );
        if( isset( $input['ss_info'] ) )
			$new_input['ss_info'] = sanitize_text_field( $input['ss_info'] );
		return $new_input;
	}

	public function print_section_info()
	{
		print 'Enter your settings below:';
	}
	public function ph_callback()
	{
		printf(
			'<input type="text" id="ph_info" name="custom_option_name[ph_info]" value="%s" />',
			isset( $this->options['ph_info'] ) ? esc_attr( $this->options['ph_info']) : ''
		);
	}
	public function ad_callback()
	{
		printf(
			'<input type="text" id="ad_info" name="custom_option_name[ad_info]" value="%s" />',
			isset( $this->options['ad_info'] ) ? esc_attr( $this->options['ad_info']) : ''
		);
	}
	public function em_callback()
	{
		printf(
			'<input type="text" id="em_info" name="custom_option_name[em_info]" value="%s" />',
			isset( $this->options['em_info'] ) ? esc_attr( $this->options['em_info']) : ''
		);
	}
	public function fb_callback()
	{
		printf(
			'<input type="text" id="fb_link" name="custom_option_name[fb_link]" value="%s" />',
			isset( $this->options['fb_link'] ) ? esc_attr( $this->options['fb_link']) : ''
		);
	}
	public function tw_callback()
	{
		printf(
			'<input type="text" id="tw_link" name="custom_option_name[tw_link]" value="%s" />',
			isset( $this->options['tw_link'] ) ? esc_attr( $this->options['tw_link']) : ''
		);
	}
	public function ig_callback()
	{
		printf(
			'<input type="text" id="ig_link" name="custom_option_name[ig_link]" value="%s" />',
			isset( $this->options['ig_link'] ) ? esc_attr( $this->options['ig_link']) : ''
		);
	}
	public function li_callback()
	{
		printf(
			'<input type="text" id="li_link" name="custom_option_name[li_link]" value="%s" />',
			isset( $this->options['li_link'] ) ? esc_attr( $this->options['li_link']) : ''
		);
	}
	public function pi_callback()
	{
		printf(
			'<input type="text" id="pi_link" name="custom_option_name[pi_link]" value="%s" />',
			isset( $this->options['pi_link'] ) ? esc_attr( $this->options['pi_link']) : ''
		);
	}
    public function ss_callback()
	{
		printf(
			'<input type="text" id="ss_info" name="custom_option_name[ss_info]" value="%s" />',
			isset( $this->options['ss_info'] ) ? esc_attr( $this->options['ss_info']) : ''
		);
	}
}
if( is_admin() )
	$custom_settings_page = new CustomSettingsPage();