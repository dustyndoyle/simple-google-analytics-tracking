<?php
// Add input box under Settings menu for Google Analytics Tracking ID

add_action( 'admin_menu', 'dld_add_ga_option' );

function dld_add_ga_option() {
	add_options_page( 'Google Analtics', 'Google Analytics', 'manage_options', 'simple-ga-tracking.php', 'dld_admin_ga_input' );
	add_action( 'admin_init', 'dld_register_ga_settings' );
}

function dld_register_ga_settings() {
	register_setting( 'dld_ga_settings', 'ga_tracking_code', 'dld_ga_input_sanitize' );
}

function dld_admin_ga_input() {
	?>
	<div class="wrap">
		<h2>Google Analytics</h2>
		<p>Enter your Google Analytics Tracking ID in the input box below</p>
		<p>Find your Tracking ID after logging into your profile by going to:<br />Admin > Property > Tracking Info > Tracking Code</p>
		
		<form method="post" action="options.php">
			<?php settings_fields( 'dld_ga_settings' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row">Tracking ID</th>
					<td><input type="text" name="ga_tracking_code" value="<?php echo esc_attr( get_option('ga_tracking_code') ); ?>" /></td>
				</tr>
			</table>
			<?php submit_button( 'Save Tracking ID' ); ?>
		</form>

	</div>
	<?php
}

function dld_ga_input_sanitize( $input ) {

	$input = sanitize_text_field( $input );
	return $input;
}