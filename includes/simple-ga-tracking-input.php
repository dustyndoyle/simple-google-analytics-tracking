<?php
// Add input box under Settings menu for Google Analytics Tracking ID

add_action( 'admin_menu', 'sgat_add_option' );

function sgat_add_option() {
	add_options_page( 'Google Analytics', 'Google Analytics', 'manage_options', 'simple-google-analytics-tracking.php', 'sgat_admin_input' );
}

function sgat_admin_input() {
	?>
	<div class="wrap">
		<h2>Simple Google Analytics Tracking</h2>
		
		<form method="post" action="options.php">
			<?php settings_fields( 'sgat_settings' ); ?>
			<?php do_settings_sections( 'sgat_section' ); ?>
			<?php submit_button( 'Save Tracking ID' ); ?>
		</form>

	</div>
	<?php
}

add_action( 'admin_init', 'sgat_admin_init' );

function sgat_admin_init() {
	register_setting( 
		'sgat_settings', // Settings Group Name
		'sgat_tracking_code', // Settings Array Name
		'sgat_input_sanitize' // Sanitize Function Name
	);
	add_settings_section(
		'sgat_main_section', // Section ID
		'Simple Google Analytics Tracking Settings', // Section Title
		'sgat_section_text', // Section function name
		'sgat_section' // Page to display section
	);
}

function sgat_section_text() {

	$html = '';

	$html .= '<p>Find your Tracking ID after logging into your profile by going to:<br />Admin > Property > Tracking Info > Tracking Code</p>';
	$html .= '<p>Enter your Google Analytics Tracking ID in the input box below.<br />(Editors and Administrators are not tracked)</p>';
	
	$html .= '<fieldset>';
		$html .= '<p>';
			$html .= '<b>Tracking ID:</b> ';
			$html .= '<input type="text" id="sgat_tracking_code_input" name="sgat_tracking_code" value="' . esc_attr( get_option('sgat_tracking_code') ) . '" />';
		$html .= '</p>';
	$html .= '</fieldset>';
	
	echo $html;
}

function sgat_input_sanitize( $input ) {

	$input = sanitize_text_field( $input );

	return $input;
}