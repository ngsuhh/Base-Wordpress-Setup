<?php
	////////////////////////////////////////////////
	// Login Page Styling
	////////////////////////////////////////////////
	function my_login_stylesheet() {
		wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/assets/css/style-login.css' );
		// wp_enqueue_script( 'custom-login', get_template_directory_uri() . '/style-login.js' );
	}
	add_action( 'login_enqueue_scripts', 'my_login_stylesheet' );

	////////////////////////////////////////////////
	// Login Page Logo
	////////////////////////////////////////////////
	function my_login_logo_url() {
		return home_url();
	}
	add_filter( 'login_headerurl', 'my_login_logo_url' );
