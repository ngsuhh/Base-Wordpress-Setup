<?php
	/**
	 * Template for Pages
	 */
	
	// Initialize post data
	global $post;
	the_post();

	get_header();


	// Get parent template
	// http://wordpress.stackexchange.com/questions/216583/check-if-page-parent-has-certain-template
	$parent_template = get_post_meta( $post->post_parent, '_wp_page_template', true );
	// If page's parent is a particular template
	if ($parent_template == 'page_consumer_goods.php') {
		// Include template
		// include(locate_template('partial_page_templates/subpage_consumer_goods.php'));
	}


	the_content();
?>


<?php get_footer(); ?>
