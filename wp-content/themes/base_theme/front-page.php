<?php
	/**
	 * Template for home page
	 */



	get_header();

	// require('model/Post.php');
	// $postList = new Post();

	// $posts_array = $postList->getPosts();
	// foreach ( $posts_array as $post ) : setup_postdata( $post );
	// 	the_title();
	// endforeach;
	// wp_reset_postdata();

?>


<!--EXAMPLE QUERY ----------------------------->

<!-- <?php
wp_reset_query();
$args = array(
	'order'    => 'DESC',
	'offset' => 0,
	'showposts' => 3,
	'public'   => true,
);
$the_query = new WP_Query( $args );
?>
<?php while ($the_query -> have_posts()) : $the_query -> the_post(); ?>

		<!--insert content-->
		<?php setup_postdata( $post ); ?>

<?php
	endwhile;
	wp_reset_postdata();
?> -->


<!--EXAMPLE CONTENT ----------------------------->
<!-- <?php
$postid = $post->ID;

///////// AUTHOR /////////////
$author_name = get_the_author_meta('display_name');
$author_desc =get_the_author_meta('description');
$avatar_url = get_avatar_img_url();


///////// CATEGORY /////////////
$category = get_the_category($postid);

if (class_exists('WPSEO_Primary_Term')) {
	// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
	$wpseo_primary_term = new WPSEO_Primary_Term('category', $postid);
	$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
	$term = get_term($wpseo_primary_term);
	if (is_wp_error($term)) {
		// Default to first category (not Yoast) if an error is returned
		$category_display = $category[0]->name;
		$category_link = get_category_link($category[0]->term_id);
	}
	else {
		// Yoast Primary category
		$category_display = $term->name;
		$category_link = get_category_link($term->term_id);
	}
}
else {
	// Default, display the first category in WP's list of assigned categories
	$category_display = $category[0]->name;
	$category_link = get_category_link($category[0]->term_id);
}



///////// FEATURED IMAGE  /////////////
$thumbnail = get_the_post_thumbnail(get_the_ID());
if(!empty($thumbnail)){
	$imageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0];
	$imageTitle = get_post(get_post_thumbnail_id(($post->ID)))->post_title; //The Title
}
else {
	$imageUrl = '<img src="';
	$imageUrl .= catch_that_image();
	$imageUrl .= '" alt="" />';
}
?> -->

<?php get_footer(); ?>
