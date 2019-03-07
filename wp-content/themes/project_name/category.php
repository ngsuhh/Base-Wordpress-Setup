<?php
	/**
	 * Template for Catgories
	 */
	get_header();

	$cat_id = $wp_query->get_queried_object_id();
	$cat_name = $wp_query->get_queried_object()->name;

?>

<!-- Example Title
<?php single_cat_title()?> -->

<!-- Example Query -->
<!-- <?php $args = array(
				'posts_per_page' => 1,
				'meta_query' => array(

									//To get custom meta checkbox field
									array(
											'key'     => 'meta-checkbox',
											'value'   => 'yes'
									),

									//Check if primary category = $cat_id
									array(
											'key'     => '_yoast_wpseo_primary_category',
											'value'   => $cat_id
									),
							),


				'cat' => $cat_id,
		);
		$featured = new WP_Query($args);

		if ($featured->have_posts()): while($featured->have_posts()): $featured->the_post();

			$myvals = get_post_meta($featured->ID);

			$postid = $featured->ID;

			$author_name = get_the_author_meta('display_name');
			$author_desc =get_the_author_meta('description');
			$avatar_url = get_avatar_img_url();

			$thumbnail = get_the_post_thumbnail(get_the_ID());
			if(!empty($thumbnail)){
			$imageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0];
			$imageTitle = get_post(get_post_thumbnail_id(($post->ID)))->post_title; //The Title
			}
			else {
			$imageUrl= catch_that_image();
			}


			setup_postdata( $post );

	?> -->

<?php get_footer(); ?>
