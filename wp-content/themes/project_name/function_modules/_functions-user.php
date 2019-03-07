<?php

	///////////////////////////////////////////////
	// Add user custom roles
	///////////////////////////////////////////////
	function addRoles() {
		add_role('pending', 'Pending', array(
			'read' => true, // True allows that capability
		));

		add_role('applicant', 'Applicant', array(
			'read' => true, // True allows that capability
		));

		add_role('fellow', 'Fellow', array(
			'read' => true, // True allows that capability
		));

		add_role('alumni', 'Alumni', array(
			'read' => true, // True allows that capability
		));
	}
	// add_action('init', 'addRoles');















	// https://wordpress.stackexchange.com/questions/23026/is-there-way-to-rename-user-role-name-without-plugin
	function modifyRoleNames() {
		global $wp_roles;

		if ( ! isset( $wp_roles ) )
			$wp_roles = new WP_Roles();

		// // You can list all currently available roles like this...
		// $roles = $wp_roles->get_names();
		// print_r($roles);

		$wp_roles->roles['subscriber']['name'] = 'Subscriber';
		$wp_roles->role_names['subscriber'] = 'Subscriber';

		$wp_roles->roles['contributor']['name'] = 'Contributor';
		$wp_roles->role_names['contributor'] = 'Contributor';

		// Change role "pending" to "visitor"
		$wp_roles->roles['pending']['name'] = 'Visitor';
		$wp_roles->role_names['pending'] = 'Visitor';

		// Remove Role
		// remove_role( 'editor' );
		// remove_role( 'author' );
	}
	// add_action('init', 'modifyRoleNames');














	////////////////////////////////////////////////
	// Login error redirect
	// https://wordpress.stackexchange.com/questions/61267/prevent-wp-login-form-from-redirecting-to-wp-admin-when-there-are-errors
	////////////////////////////////////////////////
	function customLoginFailedRedirect( $username ) {
		$referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?

		// if there's a valid referrer, and it's not the default log-in screen
		if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
			wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
			exit;
		}
	}
	// add_action( 'wp_login_failed', 'customLoginFailedRedirect' );  // hook failed login









	////////////////////////////////////////////////
	// TODO: Find better way
	// Create user account
	// https://wordpress.stackexchange.com/questions/154782/creating-wordpress-user-registration-form
	////////////////////////////////////////////////
	// function create_account(){
	//
	// 	// Get form fields
	// 	$fName = ( isset($_POST['fname']) ? $_POST['fname'] : '' );
	// 	$lName = ( isset($_POST['lname']) ? $_POST['lname'] : '' );
	// 	$pass = ( isset($_POST['password']) ? $_POST['password'] : '' );
	// 	$email = ( isset($_POST['email']) ? $_POST['email'] : '' );
	//
    //     // Validate
	// 	if ($fName == '' || $lName == '' || $pass == '' || $email == '') {
	// 		return;
	// 	}
	// 	else {
	//
	// 		$_POST['is_registration'] = true;
	// 		$_POST['fname'] = $fName;
	// 		$_POST['lname'] = $lName;
	// 		$_POST['password'] = $pass;
	// 		$_POST['email'] = $email;
	//
	//
	// 		// Check if email is in use
	// 		if ( !email_exists( $email ) ) {
	//
	// 			// Create user object
	// 			$userdata = array(
	// 				'user_login'  =>  $email,
	// 				'first_name'  =>  $fName,
	// 				'last_name'  =>  $lName,
	// 				'user_email' => $email,
	// 				'user_pass'   =>  $pass,
	// 			);
	//
	// 			// Insert new user data
	// 			$user_id = wp_insert_user( $userdata ) ;
	//
	// 			// On Insert new user success
	// 			if ( ! is_wp_error( $user_id ) ) {
	//
	// 				// Send email
	// 				// sendRegisteredEmail($user_id);
	//
    //                 // Redirect
	// 				wp_redirect( site_url( '/login?registered=true ' ) );
	//
	// 				exit();
	// 			}
	//
	// 			// On Insert new user fail
	// 			else {
	// 				$_POST['error_message'] = $user_id->get_error_message();
	// 			}
	// 		}
	// 		else {
	// 			$_POST['error_message'] = 'That Email has already been taken.';
	// 		}
	// 	}
	//
	// }
	// add_action('init','create_account');









	////////////////////////////////////////////////
	// TODO: Find better way
	// Set user role
	////////////////////////////////////////////////
	// function setUserRole($userID, $role) {
	// 	global $wpdb;
	//
	// 	$query = 'SELECT count(meta_value) AS size FROM wp_usermeta WHERE user_id = ' . $userID .
	// 			' AND meta_key LIKE "completed%"';
	// 	$result = $wpdb->get_results( $query , OBJECT );
	//
	// 	if ($result[0]->size == "3") {
	// 		$u = new WP_User( $userID );
	//
	// 		// Remove role
	// 		$u->remove_role( 'pending' );
	//
	// 		// Add role
	// 		$u->add_role( 'applicant' );
	// 	}
	//
	// 	return get_userdata( $userID );
	// }










	/**
	 * Get current user role
	 * @param  Object	$current_user		Object from wp_get_current_user()
	 * @param  Object	$current_user		Object from wp_get_current_user()
	 * @return none
	 */
	function getCurrentUserRole( $current_user ) {

		// Current user
		// $current_user = wp_get_current_user();

		// Get user data
		$userData = get_userdata( $userID );

		return $userData->roles;

	}




	/**
	 * On user role change event
	 * http://wordpress.stackexchange.com/questions/50825/send-confirmation-email-when-a-users-role-is-upgraded
	 *
	 * @param  int		$user_id	ID of user
	 * @param  String	$new_role	Role name
	 * @return none
	 */
	function onUserRoleUpdate( $user_id, $new_role ) {

		if ($new_role == "ROLE_NAME") {
		}

	}
	add_action( 'set_user_role', 'onUserRoleUpdate', 10, 2);
