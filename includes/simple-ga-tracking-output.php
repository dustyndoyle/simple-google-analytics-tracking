<?php
// Add Google Analytics Tracking Code to page if anything is input

add_action( 'wp_footer', 'dld_add_ga_tracking' );

function dld_add_ga_tracking() {

	$options = get_option("dld_ga_tracking_options");

	// Default to Editors
	$user_option = 'edit_pages';

	switch ( $options['ga_user_group_tracking'] ) {
		case 0:
			// All Users
			$user_option = '';
			break;
		case 1:
			// Subsrcibers
			$user_option = 'read';
			break;
		case 2:
			// Editors
			$user_option = 'edit_posts';
			break;
		case 3:
			// Authors
			$user_option = 'publish_posts';
			break;
		case 4:
			// Editors
			$user_option = 'edit_pages';
			break;
		case 5:
			// Administrators
			$user_option = 'edit_files';
			break;
	}

	if(
		!empty( $options['ga_tracking_code'] ) // There is a tracking code
		&& !current_user_can( $user_option ) // The current user is less than the role defined
	) {
	?>
	<!-- BEGIN: Simple Google Analytics Tracking Code -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo esc_attr( $options["ga_tracking_code"] ); ?>', 'auto');
		ga('send', 'pageview');

	</script>
	<!-- END: Simple Google Analytics Tracking Code -->
	<?php

	} // If there is a tracking id and user is allowed to be tracked

}
