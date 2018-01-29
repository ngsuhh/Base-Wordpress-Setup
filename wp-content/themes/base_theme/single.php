<?php
	/**
	 * Template for Single Post
	 */
	get_header();

	// Initialize post data
	global $post;
	the_post();

	// The Loop
	// while ( have_posts() ) : the_post();
	// endwhile;
?>


<?php get_footer(); ?>
