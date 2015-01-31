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
		<h2>Google Analytics</h2>
		<p>Enter your Google Analytics Tracking ID in the input box below</p>
		<p>Find your Tracking ID after logging into your profile by going to:<br />Admin > Property > Tracking Info > Tracking Code</p>
		
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
	register_setting( 'dld_ga_settings', 'ga_tracking_options' );
	add_settings_section( 'ga_main_section', 'Google Analytics', 'dld_ga_section_text', 'dld_ga_section' );
	add_settings_field( 'ga_tracking_code', 'Tracking Code', 'dld_ga_tracking_code_input', 'dld_ga_section', 'ga_main_section' );
}

function dld_ga_section_text() {
	echo '<p>';
	echo 'Simple Google Analytics text input field';
	echo '</p>';
}

function dld_ga_tracking_code_input() {
	$options = get_option( 'ga_tracking_options' );

	$html = '';
	$html .= '<fieldset>';
	$html .= '<p>';
	$html .= '<label for="ga_tracking_code_input">';
	$html .= '<input type="text" id="ga_tracking_code_input" name="ga_tracking_options[ga_tracking_code]" value="' . esc_attr( $options['ga_tracking_code'] ) . '" />';
	$html .= 'Tracking ID';
	$html .= '</label>';
	$html .= '</p>';

	$html .= '</fieldset>';
	echo $html;
}

function dld_ga_input_sanitize( $input ) {

	$input = sanitize_text_field( $input );
	return $input;
}