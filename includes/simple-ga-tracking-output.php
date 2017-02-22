<?php
// Add Google Analytics Tracking Code to page if anything is input

add_action( 'wp_head', 'sgat_add_tracking', 1 );

function sgat_add_tracking() {

	$tracking_id = apply_filters( 'sgat_tracking_id', get_option("sgat_tracking_code") );
	$create_options = apply_filters( 'sgat_tracker_create_fields', array(
		'cookieDomain'  => 'auto',
		'trackingId'    => $tracking_id,
	) );

	if(
		!empty( $tracking_id ) // There is a tracking code
		&& apply_filters( 'sgat_output_ga_code', sgat_allow_tracking() )
	) {
	?>
	<!-- BEGIN: Simple Google Analytics Tracking Code -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', <?php echo json_encode( $create_options ); ?> );
		ga('send', 'pageview');
		<?php do_action( 'sgat_after_tracker' ); ?>

	</script>
	<!-- END: Simple Google Analytics Tracking Code -->
	<?php

	} // If there is a tracking id and user is allowed to be tracked

}

function sgat_allow_tracking() {

	if (
		current_user_can( 'administrator' ) // The current user is an admin
		|| current_user_can( 'editor' ) // The current user is an editor
	) {

		return false;
	}

	return true;
}
