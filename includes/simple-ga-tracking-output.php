<?php
// Add Google Analytics Tracking Code to page if anything is input

add_action( 'wp_head', 'dld_add_ga_tracking', 5 );

function dld_add_ga_tracking() {

	$tracking_id = apply_filters( 'ga_tracking_id', get_option("ga_tracking_code") );
	
	if(
		!empty( $tracking_id ) // There is a tracking code
		&& !current_user_can( 'administrator' ) // The current user is NOT an admin
		&& !current_user_can( 'editor' ) // The current user is NOT an editor
	) {
	?>
	<!-- BEGIN: Simple Google Analytics Tracking Code -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo esc_attr( $tracking_id ); ?>', 'auto');
		ga('send', 'pageview');

	</script>
	<!-- END: Simple Google Analytics Tracking Code -->
	<?php

	} // If there is a tracking id and user is allowed to be tracked

}

