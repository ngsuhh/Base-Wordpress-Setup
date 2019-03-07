<?php
	////////////////////////////////////////////////
	// Add Custom Post Type
	////////////////////////////////////////////////
	function custom_post_type() {
		// Custom post
		register_post_type('sample_post_type',
			array(
				'capability_type' => 'post',
				'has_archive' => true,
				'label' => 'sample_post_type',
				// label text
				'labels' => array(
					'name' => 'Sample Post Type',
					'singular_name' => 'Sample Post Type',
					'add_new' => 'Add New'
				),
				'menu_icon' => 'dashicons-plus',
				'menu_position' => 5,
				'query_var' => true,
				'supports' => array(
					'title',
					'editor',
					'thumbnail',
					'revisions',
					// 'excerpt',
					// 'comments',
					// 'author',
					'trackbacks',
					// 'custom-fields',
					// 'page-attributes',
				),
				'public' => true,
				'publicly_queryable' => true,
				'hierarchical' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'show_in_admin_bar' => true,
				'rewrite' => array('slug' => 'sample_post_type', 'with_front' => false),
				'taxonomies' => array('category', 'post_tag'),
			)
		);
	}
	add_action('init', 'custom_post_type', 0 );

