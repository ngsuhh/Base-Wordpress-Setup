<?php
    /**
     * Header Template
     *
     * Displays all of the head element and everything up until the "site-content" div.
     */
?>

<!-- DOM Elements -->


<title><?php if(is_home()) { echo bloginfo("name"); echo " | "; echo bloginfo("description"); } else { echo wp_title(" | ", false, right); echo bloginfo("name"); } ?></title>

<?php
wp_nav_menu( array(
	'theme_location' => 'home-menu-1',
	'menu_id' => 'navbar-1' ,
	'container'       => 'ul',
	'menu_class' => 'nav navbar-nav'
) );
?>
