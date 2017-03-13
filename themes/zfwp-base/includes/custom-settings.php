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
			'gp_link',
			'Google+ Link',
			array( $this, 'gp_callback' ),
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
	}
	public function sanitize( $input )
	{
		$new_input = array();
		if( isset( $input['fb_link'] ) )
			$new_input['fb_link'] = sanitize_text_field( $input['fb_link'] );
		if( isset( $input['tw_link'] ) )
			$new_input['tw_link'] = sanitize_text_field( $input['tw_link'] );
		if( isset( $input['gp_link'] ) )
			$new_input['gp_link'] = sanitize_text_field( $input['gp_link'] );
		if( isset( $input['li_link'] ) )
			$new_input['li_link'] = sanitize_text_field( $input['li_link'] );
		return $new_input;
	}

	public function print_section_info()
	{
		print 'Enter your settings below:';
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
	public function gp_callback()
	{
		printf(
			'<input type="text" id="gp_link" name="custom_option_name[gp_link]" value="%s" />',
			isset( $this->options['gp_link'] ) ? esc_attr( $this->options['gp_link']) : ''
		);
	}
	public function li_callback()
	{
		printf(
			'<input type="text" id="li_link" name="custom_option_name[li_link]" value="%s" />',
			isset( $this->options['li_link'] ) ? esc_attr( $this->options['li_link']) : ''
		);
	}
}
if( is_admin() )
	$custom_settings_page = new CustomSettingsPage();