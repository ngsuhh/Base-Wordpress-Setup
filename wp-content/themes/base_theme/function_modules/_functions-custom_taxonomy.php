<?php
	////////////////////////////////////////////////
	// Add Custom Taxonomy
	////////////////////////////////////////////////
	function custom_taxonomy() {
		register_taxonomy(
			'taxonomy_name',  //The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
			'post_type_name',        //post type name
			array(
				'hierarchical' => true,
				'label' => 'Areas',  //Display name
				'query_var' => true,
				'rewrite' => array(
					'slug' => 'taxonomy_name_slug', // This controls the base slug that will display before each term
					'with_front' => false // Don't display the category base before
				)
			)
		);
	}
	add_action( 'init', 'custom_taxonomy');
