<?php
/**
 * Social Links Options Page
 * @package kmaevent
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) { exit; }

class SocialSettingsPage {
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct(){
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page(){
		// This page will be under "Settings"
		add_options_page(
			'Settings Admin',
			'Social Media Links',
			'manage_options',
			'social-setting-admin',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page(){
		// Set class property
		$this->options = get_option( 'social_option_name' );
		?>
		<div class="wrap">
			<h1>Social Media Settings Settings</h1>
			<form class="form form-horizontal" method="post" action="options.php">
				<?php
				// This prints out all hidden setting fields
				settings_fields( 'social_option_group' );
				do_settings_sections( 'social-setting-admin' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init(){
		register_setting(
			'social_option_group', // Option group
			'social_option_name', // Option name
			array( $this, 'sanitize' ) // Sanitize
		);

		/*add_settings_section(
            'setting_display_section_id', // ID
            'Display Options', // Title
            array( $this, 'print_display_section_info' ), // Callback
            'social-setting-admin' // Page
        ); */

		add_settings_section(
			'setting_section_id', // ID
			'Manage Social Media Links', // Title
			array( $this, 'print_link_section_info' ), // Callback
			'social-setting-admin' // Page
		);

		//Configure fields
		add_settings_field(
			'facebook', // ID
			'Facebook', // Title
			array( $this, 'facebook_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'youtube', // ID
			'YouTube', // Title
			array( $this, 'youtube_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'linkedin', // ID
			'LinkedIn', // Title
			array( $this, 'linkedin_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'twitter', // ID
			'Twitter', // Title
			array( $this, 'twitter_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'googleplus', // ID
			'Google+', // Title
			array( $this, 'googleplus_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'vimeo', // ID
			'Vimeo', // Title
			array( $this, 'vimeo_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'atom', // ID
			'Atom/Rss', // Title
			array( $this, 'atom_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'blogger', // ID
			'Blogger', // Title
			array( $this, 'blogger_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'instagram', // ID
			'Instagram', // Title
			array( $this, 'instagram_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'pinterest', // ID
			'Pinterest', // Title
			array( $this, 'pinterest_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'ios', // ID
			'Apple/iOS', // Title
			array( $this, 'ios_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		add_settings_field(
			'android', // ID
			'Android', // Title
			array( $this, 'android_callback' ), // Callback
			'social-setting-admin', // Page
			'setting_section_id' // Section
		);

		//display options
		/*add_settings_field(
            'size', // ID
            'Icon Size', // Title
            array( $this, 'size_callback' ), // Callback
            'social-setting-admin', // Page
            'setting_display_section_id' // Section
        );

		add_settings_field(
            'color', // ID
            'Icon Color', // Title
            array( $this, 'color_callback' ), // Callback
            'social-setting-admin', // Page
            'setting_display_section_id' // Section
        );
		*/
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ){
		$new_input = array();
		if( isset( $input['facebook'] ) )
			$new_input['facebook'] = sanitize_text_field( $input['facebook'] );

		if( isset( $input['youtube'] ) )
			$new_input['youtube'] = sanitize_text_field( $input['youtube'] );

		if( isset( $input['linkedin'] ) )
			$new_input['linkedin'] = sanitize_text_field( $input['linkedin'] );

		if( isset( $input['twitter'] ) )
			$new_input['twitter'] = sanitize_text_field( $input['twitter'] );

		if( isset( $input['googleplus'] ) )
			$new_input['googleplus'] = sanitize_text_field( $input['googleplus'] );

		if( isset( $input['vimeo'] ) )
			$new_input['vimeo'] = sanitize_text_field( $input['vimeo'] );

		if( isset( $input['atom'] ) )
			$new_input['atom'] = sanitize_text_field( $input['atom'] );

		if( isset( $input['blogger'] ) )
			$new_input['blogger'] = sanitize_text_field( $input['blogger'] );

		if( isset( $input['instagram'] ) )
			$new_input['instagram'] = sanitize_text_field( $input['instagram'] );

		if( isset( $input['pinterest'] ) )
			$new_input['pinterest'] = sanitize_text_field( $input['pinterest'] );

		if( isset( $input['ios'] ) )
			$new_input['ios'] = sanitize_text_field( $input['ios'] );

		if( isset( $input['android'] ) )
			$new_input['android'] = sanitize_text_field( $input['android'] );

		/*if( isset( $input['size'] ) )
            $new_input['size'] = sanitize_text_field( $input['size'] );

		if( isset( $input['color'] ) )
            $new_input['color'] = sanitize_text_field( $input['color'] );*/

		return $new_input;
	}

	// Print the Section text
	/*public function print_display_section_info(){
		print 'Copy the entire URL to your profile page in the blanks below. Simply leave unused social media platforms blank.';
	}*/

	// Print the Section text
	public function print_link_section_info(){
		print '<p>Copy the entire URL to your profile page in the blanks below. Simply leave unused social media platforms blank.</p>
		<p>PHP function usage: getSocialLinks(); returns an array of platform ids and links.</p>';
	}

	// Get the settings option array and print the values
	public function facebook_callback(){
		printf(
			'<input class="form-control" type="text" id="facebook" name="social_option_name[facebook]" value="%s" />',
			isset( $this->options['facebook'] ) ? esc_attr( $this->options['facebook']) : ''
		);
	}

	public function twitter_callback(){
		printf(
			'<input class="form-control" type="text" id="twitter" name="social_option_name[twitter]" value="%s" />',
			isset( $this->options['twitter'] ) ? esc_attr( $this->options['twitter']) : ''
		);
	}

	public function googleplus_callback(){
		printf(
			'<input class="form-control" type="text" id="googleplus" name="social_option_name[googleplus]" value="%s" />',
			isset( $this->options['googleplus'] ) ? esc_attr( $this->options['googleplus']) : ''
		);
	}

	public function youtube_callback(){
		printf(
			'<input class="form-control" type="text" id="youtube" name="social_option_name[youtube]" value="%s" />',
			isset( $this->options['youtube'] ) ? esc_attr( $this->options['youtube']) : ''
		);
	}

	public function vimeo_callback(){
		printf(
			'<input class="form-control" type="text" id="vimeo" name="social_option_name[vimeo]" value="%s" />',
			isset( $this->options['vimeo'] ) ? esc_attr( $this->options['vimeo']) : ''
		);
	}

	public function atom_callback(){
		printf(
			'<input class="form-control" type="text" id="atom" name="social_option_name[atom]" value="%s" />',
			isset( $this->options['atom'] ) ? esc_attr( $this->options['atom']) : ''
		);
	}

	public function blogger_callback(){
		printf(
			'<input class="form-control" type="text" id="blogger" name="social_option_name[blogger]" value="%s" />',
			isset( $this->options['blogger'] ) ? esc_attr( $this->options['blogger']) : ''
		);
	}

	public function linkedin_callback(){
		printf(
			'<input class="form-control" type="text" id="linkedin" name="social_option_name[linkedin]" value="%s" />',
			isset( $this->options['linkedin'] ) ? esc_attr( $this->options['linkedin']) : ''
		);
	}

	public function instagram_callback(){
		printf(
			'<input class="form-control" type="text" id="instagram" name="social_option_name[instagram]" value="%s" />',
			isset( $this->options['instagram'] ) ? esc_attr( $this->options['instagram']) : ''
		);
	}

	public function pinterest_callback(){
		printf(
			'<input class="form-control" type="text" id="pinterest" name="social_option_name[pinterest]" value="%s" />',
			isset( $this->options['pinterest'] ) ? esc_attr( $this->options['pinterest']) : ''
		);
	}

	public function ios_callback(){
		printf(
			'<input class="form-control" type="text" id="ios" name="social_option_name[ios]" value="%s" />',
			isset( $this->options['ios'] ) ? esc_attr( $this->options['ios']) : ''
		);
	}

	public function android_callback(){
		printf(
			'<input class="form-control" type="text" id="android" name="social_option_name[android]" value="%s" />',
			isset( $this->options['android'] ) ? esc_attr( $this->options['android']) : ''
		);
	}

	/*public function size_callback(){
        printf(
            '<select class="form-control" id="size" name="social_option_name[size]" >
				<option value="small">Small</option>
				<option value="medium">Medium</option>
				<option value="large">Large</option>
			</select>',
            isset( $this->options['size'] ) ? esc_attr( $this->options['size']) : ''
        );
    }

	public function color_callback(){
        printf(
            '<select class="form-control" id="color" name="social_option_name[color]" >
				<option value="small">All White</option>
				<option value="medium">All Black</option>
				<option value="large">Full Color</option>
			</select>',
            isset( $this->options['color'] ) ? esc_attr( $this->options['color']) : ''
        );
    }*/

}

if( is_admin() ){
	$social_settings_page = new SocialSettingsPage();
}
/*
 * TODO:
 * */
function getSocialLinks( $format = 'svg', $shape = 'square' ){

	$supportedPlatforms = get_option('social_option_name');



	$socialArray = array();
    if(is_array($supportedPlatforms)) {
	    foreach ( $supportedPlatforms as $plat => $platLink ) {
		    if ( $platLink != '' ) {
			    $iconUrl = get_template_directory() . '/modules/social/icons/'.$format.'/'.$shape.'/'.$plat.'.svg';
			    $iconData = file_get_contents(wp_normalize_path( $iconUrl));
			    $socialArray[ $plat ][0] = $platLink;
			    $socialArray[ $plat ][1] = $iconData;
		    }
	    }
    }

	return $socialArray;
}