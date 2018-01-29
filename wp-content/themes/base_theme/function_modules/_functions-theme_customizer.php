<?php
	// https://premium.wpmudev.org/blog/wordpress-theme-customizer-guide/


	/**
	 * Initialize Theme Customizer
	 * @param  [type] $wp_customize [description]
	 * @return [type]               [description]
	 */
	function cd_customizer_settings( $wp_customize ) {

		// Create Section
		$wp_customize->add_section( 'cd_colors' , array(
			'title'      => 'Colors',
			'priority'   => 30,
		));

		// Create Setting
		$wp_customize->add_setting( 'background_color' , array(
			'default'     => '#43C6E4',
			'transport'   => 'refresh',
		));

		// Tie Section and Setting to Control
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
			'label'        => 'Background Color',
			'section'    => 'cd_colors',
			'settings'   => 'background_color',
		)));
	}
	add_action( 'customize_register', 'cd_customizer_settings' );


	/**
	 * Inject CSS from Customizer
	 * @return [type] [description]
	 */
	function cd_customizer_css() {
		?>
			<!-- START: Theme Customizer Custom CSS -->
			<style type="text/css">
				body { background: #<?php echo get_theme_mod('background_color', '#43C6E4'); ?>; }
			</style>
			<!-- END: Theme Customizer Custom CSS -->
		<?php
	}
	add_action( 'wp_head', 'cd_customizer_css');
