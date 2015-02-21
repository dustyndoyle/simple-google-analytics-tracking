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
			<?php submit_button( 'Save Tracking ID' ); ?>
		</form>

	</div>
	<?php
}

add_action( 'admin_init', 'dld_ga_admin_init' );

function dld_ga_admin_init() {
	register_setting( 
		'dld_ga_settings', // Settings Group Name
		'ga_tracking_code', // Settings Array Name
		'dld_ga_input_sanitize' // Sanitize Function Name
	);
	add_settings_section(
		'dld_ga_main_section', // Section ID
		'Simple Google Analytics Settings', // Section Title
		'dld_ga_section_text', // Section function name
		'dld_ga_section' // Page to display section
	);
}

function dld_ga_section_text() {

	$html = '';

	$html .= '<p>Find your Tracking ID after logging into your profile by going to:<br />Admin > Property > Tracking Info > Tracking Code</p>';
	$html .= '<p>Enter your Google Analytics Tracking ID in the input box below.<br />(Editors and Administrators are not tracked)</p>';
	
	$html .= '<fieldset>';
	$html .= '<p>';
	$html .= '<b>Tracking ID:</b> ';
	$html .= '<input type="text" id="ga_tracking_code_input" name="ga_tracking_code" value="' . esc_attr( get_option('ga_tracking_code') ) . '" />';
	$html .= '</p>';

	$html .= '</fieldset>';
	echo $html;
}

function dld_ga_input_sanitize( $input ) {

	$input = sanitize_text_field( $input );

	return $input;
}