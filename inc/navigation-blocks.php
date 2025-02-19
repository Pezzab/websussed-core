<?php

// supplementary 3 or less item nav for login or contact links - inline
function websussed_core_contact_nav() {

    if ( has_nav_menu( 'site_header' ) ) {

        echo '<nav id="contact-nav" class="contact-nav">';
            
            wp_nav_menu(
                array(
                    'container' 	 => 'ul',
                    'theme_location' => 'site_header',
                    'menu_id'        => 'site_header',
                    'menu_class'	 => 'nav-contact',
                )
            );

        echo '</nav><!-- #site-navigation -->';

    };

}

// 2 level main site nav - inline
function websussed_core_main_nav() {

if ( has_nav_menu( 'main' ) ) {

    echo '<nav id="site-navigation" class="site-navigation">';

    // $main_toggle = esc_html_e( 'Primary Menu', 'websussed-core' );

    // var_dump( $main_toggle );

        echo '<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">Primary Menu</button>'.

        wp_nav_menu(
            array(
                'theme_location' => 'main',
                'menu_id'        => 'primary-menu',
                'container' => 'ul',
                'menu_class'	 => 'nav-menu no-js'
            )
        );

    echo '</nav><!-- #site-navigation -->';
    };

}

// supplementary "utility" menu - list
function websussed_core_footer_nav() {

if ( has_nav_menu( 'site_footer' ) ) {
	
    echo '<nav id="footer-nav" class="footer-nav"> ';
        
        wp_nav_menu(
            array(
                'container' 	 => 'ul',
                'theme_location' => 'site_footer',
                'menu_id'        => 'site_footer',
                'menu_class'	 => '',
            )
        );

    echo '</nav><!-- #site-navigation -->';

} ;
    
}