<?php
// Add input box under Settings menu for Google Analytics Tracking ID

add_action( 'admin_menu', 'dld_add_ga_option' );

function dld_add_ga_option() {
	add_options_page( 'Google Analtics', 'Google Analytics', 'manage_options', 'simple-ga-tracking.php', 'dld_admin_ga_input' );
	// add_action( 'admin_init', 'dld_register_ga_settings' );
}

// function dld_register_ga_settings() {
// 	register_setting( 'dld_ga_settings', 'ga_tracking_code', 'dld_ga_input_sanitize' );
// }

function dld_admin_ga_input() {
	?>
	<div class="wrap">
		<h2>Simple Google Analytics</h2>
		
		<form method="post" action="options.php">
			<?php settings_fields( 'dld_ga_settings' ); ?>
			<?php do_settings_sections( 'dld_ga_section' ); ?>
			<?php submit_button( 'Save Tracking ID' ); ?>
		</form>

	</div>
	<?php
}

add_action( 'admin_init', 'dld_ga_admin_init' );

function dld_ga_admin_init() {
	register_setting( 
		'dld_ga_settings', // Settings Group Name
		'ga_tracking_options', // Settings Array Name
		'dld_ga_input_sanitize' // Sanitize Function Name
	);
	add_settings_section(
		'ga_main_section', // Section ID
		'Simple Google Analytics Settings', // Section Title
		'dld_ga_section_text', // Section function name
		'dld_ga_section' // Page to display section
	);
	// Tracking ID Settings
	add_settings_field(
		'ga_tracking_code', // Setting ID
		'Tracking ID', // Setting Title
		'dld_ga_tracking_code_input', // Setting function name
		'dld_ga_section', // Page to display setting
		'ga_main_section' // Section to display setting
	);
	// User Group Settings
	add_settings_field(
		'ga_user_group_tracking', // Setting ID
		'Users to Track', // Setting Title
		'dld_ga_user_group_input', // Setting function name
		'dld_ga_section', // Page to display setting
		'ga_main_section' // Section to display setting
	);
}

function dld_ga_section_text() {
	echo '<p>Enter your Google Analytics Tracking ID in the input box below</p>';
	echo '<p>Find your Tracking ID after logging into your profile by going to:<br />Admin > Property > Tracking Info > Tracking Code</p>';
}

function dld_ga_tracking_code_input() {
	$options = get_option( 'ga_tracking_options' );

	$html = '';
	$html .= '<fieldset>';
	$html .= '<p>';
	$html .= '<input type="text" id="ga_tracking_code_input" name="ga_tracking_options[ga_tracking_code]" value="' . esc_attr( $options['ga_tracking_code'] ) . '" />';
	$html .= '</p>';

	$html .= '</fieldset>';
	echo $html;
}

function dld_ga_user_group_input() {
	$options = get_option( 'ga_tracking_options' );

	if ( isset($options['ga_user_group_tracking']) ) {
		
		$user_selected = $options['ga_user_group_tracking'];
	} else {
		
		$user_selected = 4;
	}

	$html = '';
	$html .= '<fieldset>';
	
	// Exclude Subscribers
	$html .= '<p>';
	$html .= '<label for="ga_user_group_subscriber">';
	$html .= '<input type="radio" id="ga_user_group_subscriber" name="ga_tracking_options[ga_user_group_tracking]" value="1"' . checked( 1, $user_selected, false ) . ' />';
	$html .= 'Exclude Subscribers';
	$html .= '</label>';
	$html .= '</p>';

	// Exclude Contributors
	$html .= '<p>';
	$html .= '<label for="ga_user_group_contributor">';
	$html .= '<input type="radio" id="ga_user_group_contributor" name="ga_tracking_options[ga_user_group_tracking]" value="2"' . checked( 2, $user_selected, false ) . ' />';
	$html .= 'Exclude Contributors';
	$html .= '</label>';
	$html .= '</p>';

	// Exclude Authors
	$html .= '<p>';
	$html .= '<label for="ga_user_group_authors">';
	$html .= '<input type="radio" id="ga_user_group_authors" name="ga_tracking_options[ga_user_group_tracking]" value="3"' . checked( 3, $user_selected, false ) . ' />';
	$html .= 'Exclude Authors';
	$html .= '</label>';
	$html .= '</p>';

	// Exclude Editors
	$html .= '<p>';
	$html .= '<label for="ga_user_group_editors">';
	$html .= '<input type="radio" id="ga_user_group_editors" name="ga_tracking_options[ga_user_group_tracking]" value="4"' . checked( 4, $user_selected, false ) . ' />';
	$html .= 'Exclude Editors';
	$html .= '</label>';
	$html .= '</p>';

	// Exclude Admins
	$html .= '<p>';
	$html .= '<label for="ga_user_group_admins">';
	$html .= '<input type="radio" id="ga_user_group_admins" name="ga_tracking_options[ga_user_group_tracking]" value="5"' . checked( 5, $user_selected, false ) . ' />';
	$html .= 'Exclude Administrators';
	$html .= '</label>';
	$html .= '</p>';

	$html .= '</fieldset>';
	echo $html;
}

function dld_ga_input_sanitize( $input ) {

	// error_log( print_r($input, true) );

	$input['ga_tracking_code'] = sanitize_text_field( $input['ga_tracking_code'] );

	// error_log( print_r($input, true) );
	return $input;
}