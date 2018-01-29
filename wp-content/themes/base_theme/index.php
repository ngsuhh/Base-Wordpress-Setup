<?php
	/**
	 * Template for fallback page
	 */
	// Initialize post data
	global $post;
	the_post();

	get_header();

	the_content();
?>


<?php get_footer(); ?>
