<?php
	/**
	 * Template for Single Post
	 */
	get_header();

	// Initialize post data
	global $post;


    global $query_string;

    $query_args = explode("&", $query_string);
    $search_query = array();

    // Query string
    if( strlen($query_string) > 0 ) {
    	foreach($query_args as $key => $string) {
    		$query_split = explode("=", $string);
    		$search_query[$query_split[0]] = urldecode($query_split[1]);
    	} 
    } 

    // Query
    $search = new WP_Query($search_query);

    // The Loop
    foreach ($search->posts as $result): setup_postdata( $post );
    endforeach; wp_reset_postdata();
?>


<?php
    get_footer();
?>
