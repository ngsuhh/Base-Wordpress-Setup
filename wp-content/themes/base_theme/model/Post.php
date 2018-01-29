<?php
	class Post {

		protected $args;

		function __construct( $args = null ) {
			$this->setArgs( $args );
		}

		public function getPosts() {
			return get_posts( $this->args );

			// Get current page number
			// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			// Loop Example
			// foreach ( $posts_array as $post ) : setup_postdata( $post );
			// endforeach; 
			// wp_reset_postdata();
		}

		public function getPostUsingWPQuery() {
			return new WP_Query( $this->args );

			// Get current page number
			// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

			// Loop Example
			// while ( $the_query->have_posts() ) : $the_query->the_post();
			// endwhile;
			// wp_reset_postdata();
		}

		public function getArgs() {
			return $this->args;
		}

		public function setArgs( $args ) {

			// Set Arguments
			if ($args != null) {
				$this->args = $args;
			}
			else {
				$this->args = array(
					'posts_per_page'   => 7,
					'offset'           => 0,
					'category'         => '',
					'category_name'    => '',
					'orderby'          => 'date',
					'order'            => 'DESC',
					'include'          => '',
					'exclude'          => '',
					'meta_key'         => '',
					'meta_value'       => '',
					'post_type'        => 'post',
					'post_mime_type'   => '',
					'post_parent'      => '',
					'author'	   => '',
					'author_name'	   => '',
					'post_status'      => 'publish',
					'paged'			   => 1,
					'suppress_filters' => true
				);
			}

		}


		public function updateSingleArgs( $key, $value ) {
			$this->args[$key] = $value;
		}
	}


