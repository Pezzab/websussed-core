<?php

function websussed_core_telephone_nos() {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' ) ;

	if ( is_plugin_active( 'pods/init.php' ) ) :

		$mobile 			= get_option( 'contact_details_mobile' ) ;	
		$landline 			= get_option( 'contact_details_landline' ) ;	

		// format tel nos for hrefs
		$mobile_nosp 		= preg_replace( '/\s+/', '', $mobile );
		$landline_nosp 		= preg_replace( '/\s+/', '', $landline );

		$mobile_htm =
		$landline_htm = '';

				// format list items	
		if ( ! empty( $mobile ) ) : $mobile_htm = '<span><a class="tel_link" href="tel:' . $mobile_nosp . '"><i class="fa-solid fa-mobile-retro"></i>' . $mobile . '</a></span>'; endif;

		if ( ! empty( $landline ) ) : $landline_htm = '<span><a class="tel_link" href="tel:' . $landline_nosp . '"><i class="fa-solid fa-phone"></i>' . $landline . '</a></span>'; endif;

		echo '<div class="tel_nos">' . $mobile_htm . $landline_htm . '</div>';

	endif;

	}

function websussed_core_social_links() {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' ) ;

	if ( is_plugin_active( 'pods/init.php' ) ) :
	
		$twitter_acc 		= get_option( 'contact_details_twitter_account_url' ) ;
		$twitter_icon 		= get_option( 'contact_details_twitter_icon' ) ;	
		$instagram_acc 		= get_option( 'contact_details_instagram_account_url' ) ;	
		$instagram_icon 	= get_option( 'contact_details_instagram_icon' ) ;	
		$facebook_acc 		= get_option( 'contact_details_facebook_account_url' ) ;
		$facebook_icon 		= get_option( 'contact_details_facebook_icon' ) ;
        $linkedin_acc 		= get_option( 'contact_details_linkedin_account_url' ) ;
		$linkedin_icon 		= get_option( 'contact_details_linkedin_icon' ) ;
        $youtube_acc 		= get_option( 'contact_details_youtube_account_url' ) ;
		$youtube_icon 		= get_option( 'contact_details_youtube_icon' ) ;



        if ( $twitter_icon ) :
            $twitter_icon = wp_get_attachment_url( $twitter_icon[0] );
        endif;

        if ( $facebook_icon ) :
		    $facebook_icon = wp_get_attachment_url( $facebook_icon[0] );
        endif;

        if ( $instagram_icon ) :
		    $instagram_icon = wp_get_attachment_url( $instagram_icon[0] );
        endif;

        if ( $linkedin_icon ) :
            $linkedin_icon = wp_get_attachment_url( $linkedin_icon[0] );
        endif;

        if ( $youtube_icon ) :
            $youtube_icon = wp_get_attachment_url( $youtube_icon[0] );
        endif;

		$twitter_htm = '';
		$youtube_htm = '';
		$facebook_htm = '';
        $linkedin_htm = '';
		$youtube_htm = '';
		$instagram_htm = '';

		if ( ! empty( $twitter_acc ) ) : $twitter_htm = '<li><a title="Follow ' . get_bloginfo() . ' on Twitter" target="_blank" href="' . $twitter_acc . '"><i class="fa-brands fa-square-x-twitter"></i></a></li>'; endif;

		if ( ! empty( $instagram_acc ) ) : $instagram_htm = '<li><a title="Follow ' . get_bloginfo() . ' on Instagram" target="_blank" href="' . $instagram_acc . '"><i class="fa-brands fa-square-instagram"></i></a></li>'; endif;

		if ( ! empty( $facebook_acc ) ) : $facebook_htm = '<li><a title="Follow ' . get_bloginfo() . ' on Facebook"  target="_blank" href="' . $facebook_acc . '"> <i class="fa-brands fa-square-facebook"></i></a></li>'; endif;

        if ( ! empty( $linkedin_acc ) ) : $linkedin_htm = '<li><a title="Follow ' . get_bloginfo() . ' on LinkedIn" target="_blank" href="' . $linkedin_acc . '"><i class="fa-brands fa-linkedin"></i></a></li>'; endif;

		if ( ! empty( $youtube_acc ) ) : $youtube_htm = '<li><a title="Follow ' . get_bloginfo() . ' on YouTube" target="_blank" href="' . $youtube_acc . '"><i class="fa-brands fa-square-youtube"></i></a></li>'; endif;

		echo '<ul class="social_links">' . $twitter_htm . $instagram_htm . $facebook_htm . $linkedin_htm . $youtube_htm . '</ul>';

	endif;

	}