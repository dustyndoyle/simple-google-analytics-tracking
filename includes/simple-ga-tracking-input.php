<?php
// Add input box under Settings menu for Google Analytics Tracking ID

add_action( 'admin_menu', 'dld_add_ga_option' );

function dld_add_ga_option() {
	add_options_page( 'Google Analtics', 'Google Analytics', 'manage_options', 'simple-ga-tracking.php', 'dld_admin_ga_input' );
}

function dld_admin_ga_input() {
	?>
	<div class="wrap">
		<h2>Simple Google Analytics</h2>
		
		<form method="post" action="options.php">
			<?php settings_fields( 'dld_ga_settings' ); ?>
			<?php do_settings_sections( 'dld_ga_section' ); ?>
			<?php submit_button( 'Save Options' ); ?>
		</form>

	</div>
	<?php
}

add_action( 'admin_init', 'dld_ga_admin_init' );

function dld_ga_admin_init() {
	register_setting( 
		'dld_ga_settings', // Settings Group Name
		'dld_ga_tracking_options', // Settings Array Name
		'dld_ga_input_sanitize' // Sanitize Function Name
	);
	add_settings_section(
		'dld_ga_main_section', // Section ID
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
		'dld_ga_main_section' // Section to display setting
	);
}

function dld_ga_section_text() {

	echo '<p>Find your Tracking ID after logging into your profile by going to:<br />Admin > Property > Tracking Info > Tracking Code</p>';
	echo '<p>Enter your Google Analytics Tracking ID in the input box below and choose which logged in users to track.<br />(Editors and Administrators are not tracked by deafult)</p>';
}

function dld_ga_tracking_code_input() {
	$options = get_option( 'dld_ga_tracking_options' );

	$html = '';
	$html .= '<fieldset>';
	$html .= '<p>';
	$html .= '<input type="text" id="ga_tracking_code_input" name="dld_ga_tracking_options[ga_tracking_code]" value="' . esc_attr( $options['ga_tracking_code'] ) . '" />';
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