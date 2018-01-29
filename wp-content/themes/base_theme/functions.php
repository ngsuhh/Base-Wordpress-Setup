<?php
	/**
	 *
	 * @package WordPress
	 * @subpackage WP_BASE
	 * @since WP_BASE
	 */

	/**
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To add Visual Editor stylesheets.
	 * @uses add_theme_support() To add support for automatic feed links, post
	 * formats, and post thumbnails.
	 * @uses register_nav_menu() To add support for a navigation menu.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since WP_BASE
	 *
	 *
	 * List of Plugins
	 * * Wordfence
	 * * WP Remove Category Base
	 * * Adance Custom Fields Pro
	 * * Contact Form 7
	 * * Disable Comments
	 * * Developer Mode
	 */
	show_admin_bar(false);

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );


	////////////////////////////////////////////////
	// Theme Setup
	////////////////////////////////////////////////
	function theme_setup() {

		add_theme_support( 'post-thumbnails' );		// Enable Post Thumbnails (Featured Image)
		// add_theme_support('root-relative-urls');    // Enable relative URLs
		// add_theme_support('nice-search');           // Enable /?s= to /search/ redirect


		////////////////////////////////////////////////
		// Enable Post Format
		////////////////////////////////////////////////
		// add_theme_support( 'post-formats', array( 'gallery', 'quote', 'video', 'aside', 'image', 'link' ) );



		////////////////////////////////////////////////
		// Enable Post Format for Custom Post Type
		////////////////////////////////////////////////
		// remove_post_type_support( 'post', 'post-formats' );		// Work around
		// add_post_type_support( 'sample_post_type', 'post-formats', array( 'aside', 'image', 'quote' ) );

	}
	add_action( 'after_setup_theme', 'theme_setup' );



	////////////////////////////////////////////////
	// Add CSS and JS Scripts
	////////////////////////////////////////////////
	function init_theme_scripts() {
		wp_register_style( 'Font_Awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );
		wp_enqueue_style('Font_Awesome');
		// Main style sheet
		wp_enqueue_style('app', get_template_directory_uri() . '/assets/css/app.css', false, null);

		// Default style sheer for overrides
		wp_enqueue_style( 'style', get_stylesheet_uri() );


		// Main JS File
		wp_register_script( 'jQuery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js', null, null, true );
		wp_enqueue_script('jQuery');

		wp_register_script( 'app-js', get_template_directory_uri() . '/assets/js/app.js' , false, '1.0', true );
		wp_enqueue_script( 'app-js' );

	}
	add_action( 'wp_enqueue_scripts', 'init_theme_scripts' );



	////////////////////////////////////////////////
	// Menus
	////////////////////////////////////////////////
	function register_my_menus() {
		register_nav_menus(
			array(
				'header-menu' => __( 'Header Menu' ),
				)
			);
	}
	add_action( 'init', 'register_my_menus' );

	

	////////////////////////////////////////////////
	// Get user gravatar image
	////////////////////////////////////////////////
	function get_avatar_img_url() {

		$user_email = get_the_author_meta( 'user_email' );

		$url = 'http://gravatar.com/avatar/' . md5( $user_email );
		$url = add_query_arg( array(
			's' => 80,
			'd' => 'mm',
		), $url );
		return esc_url_raw( $url );

	}


	////////////////////////////////////////////////
	// Limit Except Character and Format
	////////////////////////////////////////////////

	function get_excerpt() {

      $content = apply_filters( 'the_content', get_the_content() );
			$content = preg_replace("#<p>\s*+<img[^>]+\>\s*</p>#i", "", $content);

      $text = substr( $content, 0, strpos( $content, '</p>' ) + 4 );
			$text = strip_tags($text);
			$count=100;
			if(strlen($text) > $count){

			 $text = substr($text, 0, $count) . '&#8230;';

			}
			else{
				$text = substr($text, 0, $count);
			}
	    return $text;
	}

	////////////////////////////////////////////////
	// Grab First Image - For no feaured images
	////////////////////////////////////////////////

	function catch_that_image() {
		global $post, $posts;
		$first_img = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		$first_img = $matches [1] [0];

		if(empty($first_img)){ //Defines a default image
			$first_img = "/images/default.jpg";
		}
		return $first_img;
	}

	////////////////////////////////////////////////
	// New Meta Checkbox - Feature this post
	////////////////////////////////////////////////
		/**
		 * Saves the custom meta input
		 */
		function sm_meta_save( $post_id ) {

		    // Checks save status
		    $is_autosave = wp_is_post_autosave( $post_id );
		    $is_revision = wp_is_post_revision( $post_id );
		    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

		    // Exits script depending on save status
		    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
		        return;
		    }

		 // Checks for input and saves
		if( isset( $_POST[ 'meta-checkbox' ] ) ) {
		    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
		} else {
		    update_post_meta( $post_id, 'meta-checkbox', '' );
		}

		}
		add_action( 'save_post', 'sm_meta_save' );

		function sm_custom_meta() {
		    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
		}
		function sm_meta_callback( $post ) {
		    $featured = get_post_meta( $post->ID );
		    ?>

			<p>
		    <div class="sm-row-content">
		        <label for="meta-checkbox">
		            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
		            <?php _e( 'Feature this post', 'sm-textdomain' )?>
		        </label>

		    </div>
		</p>

		    <?php
		}
		add_action( 'add_meta_boxes', 'sm_custom_meta' );


	////////////////////////////////////////////////
	// Facebook Open Graphs
	////////////////////////////////////////////////
	function doctype_opengraph($output) {
	    return $output . '
	    xmlns:og="http://opengraphprotocol.org/schema/"
	    xmlns:fb="http://www.facebook.com/2008/fbml"';
	}
	add_filter('language_attributes', 'doctype_opengraph');

	function fb_opengraph() {
	    global $post;

	    if(is_single()) {
	        $img_src = get_the_post_thumbnail_url(get_the_ID(),'full');

	        if(get_excerpt()) {
	            $excerpt = get_excerpt();
	        } else {
	            $excerpt = get_bloginfo('description');
	        }
	        ?>

	    <meta property="og:title" content="<?php echo the_title(); ?>"/>
	    <meta property="og:description" content="<?php echo get_excerpt(); ?>"/>
			<meta property="og:image" content="<?php echo $img_src ?>"/>
	    <meta property="og:type" content="article"/>
	    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
	    <meta property="og:site_name" content="Bountie Blog"/>
	    <!-- <meta property="og:image" content="<?php echo $img_src; ?>"/> -->

	<?php
	    } else {
	        return;
	    }
	}
	add_action('wp_head', 'fb_opengraph', 5);

	////////////////////////////////////////////////
	// Modify ACF WYSIWYG toolbar buttons
	//
	// Options:
	// 'bold', 'italic', 'strikethrough', 'bullist', 'numlist', 'blockquote', 'hr', 'alignleft', 'aligncenter',
	// 'alignright', 'link', 'unlink', 'wp_more', 'spellchecker', 'fullscreen', 'wp_adv', 'formatselect',
	// 'underline', 'alignjustify', 'forecolor', 'pastetext', 'removeformat', 'charmap', 'outdent', 'indent',
	// 'undo', 'redo', 'wp_help'
	////////////////////////////////////////////////
	function my_toolbars( $toolbars ){

		$toolbars['Simplified' ] = array();
		$toolbars['Simplified' ][1] = array('formatselect', 'bold' , 'italic' , 'underline', 'bullist', 'link', 'strikethrough', 'alignleft', 'aligncenter', 'alignright', 'unlink');

		return $toolbars;
	}
	add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );




	////////////////////////////////////////////////
	// Echo template directory
	////////////////////////////////////////////////
	function template_dir() {
		echo get_template_directory_uri();
	}


	////////////////////////////////////////////////
	// Remove Default Post Type
	////////////////////////////////////////////////
	function remove_default_post_type() {
		remove_menu_page('edit.php');
	}
	// add_action('admin_menu','remove_default_post_type');


	////////////////////////////////////////////////
	// Truncate String
	////////////////////////////////////////////////
	function truncateString($string, $length) {
		if (strlen($string) > $length) {
			$string = wordwrap($string, $length);
			$string = substr($string, 0, strpos($string, "\n")) . " ...";
		}
		return $string;
	}


	/*
	 * Disable Automatic Updates
	 * 3.7+
	 *
	 * @author	sLa NGjI's @ slangji.wordpress.com
	 */
	// add_filter( 'auto_update_translation', '__return_false' );
	// add_filter( 'automatic_updater_disabled', '__return_true' );

	// add_filter( 'allow_minor_auto_core_updates', '__return_return' );
	// add_filter( 'allow_major_auto_core_updates', '__return_false' );

	// add_filter( 'allow_dev_auto_core_updates', '__return_false' );
	// add_filter( 'auto_update_core', '__return_false' );
	// add_filter( 'wp_auto_update_core', '__return_false' );

	// add_filter( 'auto_core_update_send_email', '__return_false' );
	// add_filter( 'send_core_update_notification_email', '__return_false' );

	// add_filter( 'auto_update_plugin', '__return_false' );
	// add_filter( 'auto_update_theme', '__return_false' );

	// add_filter( 'automatic_updates_send_debug_email', '__return_false' );
	// add_filter( 'automatic_updates_is_vcs_checkout', '__return_true' );

	// add_filter( 'automatic_updates_send_debug_email ', '__return_false', 1 );
	// if( !defined( 'AUTOMATIC_UPDATER_DISABLED' ) ) define( 'AUTOMATIC_UPDATER_DISABLED', true );
	// if( !defined( 'WP_AUTO_UPDATE_CORE') ) define( 'WP_AUTO_UPDATE_CORE', false );

	// add_filter( 'pre_http_request', array($this, 'block_request'), 10, 3 );





	// Inlcude Theme Customizer
	// include(locate_template('function_modules/_functions-theme_customizer.php'));

	// Inlcude Custom Post type
	// include(locate_template('function_modules/_functions-custom_post_types.php'));

	// Inlcude Custom Taxonomy
	// include(locate_template('function_modules/_functions-custom_taxonomy.php'));

	// Inlcude pagination functions
	// include(locate_template('function_modules/_functions-pagination.php'));

	// Inlcude user functions
	// include(locate_template('function_modules/_functions-user.php'));

	// Inlcude email functions
	// include(locate_template('function_modules/_functions-email.php'));

	// Inlcude Custom Login page styling
	// include(locate_template('function_modules/_functions-login_style.php'));

	// Inlcude Dev functions
	include(locate_template('function_modules/_functions-development.php'));
