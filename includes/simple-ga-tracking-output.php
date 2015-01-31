<?php
// Add Google Analytics Tracking Code to page if anything is input

add_action( 'wp_footer', 'dld_add_ga_tracking' );

function dld_add_ga_tracking() {

	$ga_tracking_id = esc_attr( get_option("ga_tracking_code") );

	if( !empty($ga_tracking_id) && !current_user_can( 'edit_pages' ) ) {
	?>
	<!-- BEGIN: Simple Google Analytics Tracking Code -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', '<?php echo $ga_tracking_id; ?>', 'auto');
		ga('send', 'pageview');

	</script>
	<!-- END: Simple Google Analytics Tracking Code -->
	<?php

	} // If there is a tracking id

}
