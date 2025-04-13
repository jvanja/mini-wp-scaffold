<?php

/**
 * Add custom scripts to head
 *
 * @return string
 */

function add_gtag_to_head() {

	// Google Analytics
	$tracking_code = 'UA-*********-1';
?>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $tracking_code; ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', '<?php echo $tracking_code; ?>');
	</script>
<?php
}

add_action('wp_head', 'add_gtag_to_head');
