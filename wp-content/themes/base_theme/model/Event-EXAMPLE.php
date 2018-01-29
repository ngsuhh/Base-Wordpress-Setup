<?php
	require_once('Post.php');
	
	/**
	* Event Class
	*/
	class Event extends Post {

		function __construct( $args = null ) {
			parent::__construct( $args );

			$this->setArgs($args);
		}

		public function setArgs( $args ) {

			// Set Arguments
			if ($args != null) {
				$this->args = $args;
			}
			else {
				$this->args = array(
					'posts_per_page'   => 4,
					'offset'           => 0,
					'category'         => '',
					'category_name'    => '',
					'include'          => '',
					'exclude'          => '',
					'post_type'        => 'events',
					'post_status'      => 'publish',
					'suppress_filters' => true,

					// // Sort by Event start datetime
					// 'meta_key'       => 'event_start_time',
					// 'orderby'		 => 'meta_value',
					// 'order'			 => 'ASC',

					// // Get events that have not passed
					// 'meta_query'	 => array(
					// 	array(
					// 		'key'	 	=> 'event_start_time',
					// 		'value'	  	=> date('Ymd'),
					// 		'type'      => 'DATE',
					// 		'compare' 	=> '>=',
					// 	),
					// ),
				);
			}

		}


		public function setToUpcoming() {
			$this->args['meta_query'][0]['compare'] = '>=';
		}

		public function setToPast() {
			$this->args['meta_query'][0]['compare'] = '<';
		}

	}
