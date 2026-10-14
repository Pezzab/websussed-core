<?php //

// add_shortcode( 'universal_slider', 'websussed_core_universal_slider' );

function websussed_core_universal_slider( $add_slides, $custom_content_id ) {

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ) ;


if ( ! empty( $add_slides ) ) : // check content
 
    $slider_count = 0 ;

    $slider_class           = get_post_meta( $custom_content_id, 'add_slider_class' ) ;
    $slider_showscrollbar   = get_post_meta( $custom_content_id, 'show_slide_scrollbar' ) ;
    $slider_showpagination  = get_post_meta( $custom_content_id, 'show_pagination' ) ;
    $slider_shownav         = get_post_meta( $custom_content_id, 'show_slide_navigation' ) ;

    if ( is_plugin_active( 'pods/init.php' ) ) :

        $slider_content = '<div class="swiper ' . $slider_class[0] . '">' ;

        // <!-- Additional required wrapper -->
        $slider_content .= '<div class="swiper-wrapper">' ;

        // <!-- Slides -->

        foreach ( $add_slides as $add_slide ) {

            $slide_id = $add_slide['ID'] ;

            $slider_count++;

            $slider_showbgimg       = get_post_meta( $slide_id, 'slider_showbgimg' ) ;
            $slider_showtitle       = get_post_meta( $slide_id, 'showtitle') ;
            $slider_showpgph        = get_post_meta( $slide_id, 'showpgph') ;
            $slider_showlink        = get_post_meta( $slide_id, 'showlink') ;
            $slider_showheader      = get_post_meta( $slide_id, 'showheader') ;


            $slider_img     = get_the_post_thumbnail( $slide_id, 'feature-full-width' ) ;
            $slider_img_url = get_the_post_thumbnail_url( $slide_id, 'feature-full-width' ) ;
            $slider_title   = get_the_title();


            $slider_header_text     = get_post_meta( $slide_id, 'websussed_header_text' );
            $slider_paragraph_text  = get_post_meta( $slide_id, 'websussed_paragraph_text' );
            $slider_custom_html     = get_post_meta( $slide_id, 'websussed_slider_custom_html' );
            $slider_button_link     = get_post_meta( $slide_id, 'websussed_slide_link_button' );
            $slider_button_text     = get_post_meta( $slide_id, 'websussed_slide_link_button_text' );

            if ( $slider_showbgimg = true ) :

                $slider_content .= '<div class="swiper-slide slide-' . $slider_count . '" style="background-image: url(' . $slider_img_url . ');"><div class="site-width">';

            else :
                
                $slider_content .= '<div class="swiper-slide showbgimg-no slide-' . $slider_count . '"><div class="site-width">' . $slider_img . '<div>';
                
            endif ;

            if ( $slider_showtitle == true ) :

                $slider_content .= '<h2>' . $slider_title . '</h2>';

            endif ;

            if ( (! empty ( $slider_header_text[0] ) ) ) :

                $slider_content .= '<h2>' . $slider_header_text[0] . '</h2>';

            endif ;

            if ( (! empty ( $slider_paragraph_text[0] ) ) ) :

                $slider_content .= '<p>' . $slider_paragraph_text[0] . '</p>';

            endif ;

            if ( (! empty ( $slider_button_link[0] ) ) && (! empty ( $slider_button_text[0] ) )) :

                $slider_content .= '<div><button><a href="' . $slider_button_link[0] . '">' . $slider_button_text[0] . '</a></button></div>';

            endif ;

            if ( $slider_showbgimg == false ) :

            $slider_content .= '</div></div></div><!-- close slide -->';

            else :
            $slider_content .= '</div></div><!-- close slide -->';
            endif ;

        }


        $slider_content .= '</div><!-- .swiper-wrapper -->' ;

        if ( ( $slider_showpagination[0] == true ) ) :
            //  <!-- If we need pagination -->
            $slider_content .= '<div class="swiper-pagination"></div>' ;
        endif ;

        if ( ( $slider_shownav[0] == true ) ) :
            //  <!-- If we need navigation buttons -->
            $slider_content .= '<div class="swiper-button-prev"></div>' ;
            $slider_content .= '  <div class="swiper-button-next"></div>' ;

        endif ;

        if ( ( $slider_showscrollbar[0] == true ) ) :
            // <!-- If we need scrollbar -->
            $slider_content .= '  <div class="swiper-scrollbar"></div>' ;
            endif ;

                wp_reset_postdata();

            else : 
            // esc_html_e( 'Sorry, no posts matched your criteria.' );
        endif;     

                
    $script_content = "<script>";
    $script_content .= "const " . $slider_class[0] . " = new Swiper('." . $slider_class[0] . "', {";
    $script_content .= "direction: 'horizontal', loop: true, speed: 1000, effect: 'fade',";

    //   $script_content .= "breakpoints: {
    // 1000: {
    //   slidesPerView: 3,
    //   spaceBetween: 20
    // },},";
    
    $script_content .=  " autoplay: {
        delay: 5000,
    },";

    if ( ( $slider_showpagination[0] == true ) ) :
        // If we need pagination
        $script_content .=  "pagination: {
            el: '.swiper-pagination',
        },";
    endif ;

    if ( ( $slider_shownav[0] == true ) ) :
        // Navigation arrows
        $script_content .=  "navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },";
    endif ;

    if ( ( $slider_showscrollbar[0] == true ) ) :
        // And if we need scrollbar
        $script_content .=  "scrollbar: {
            el: '.swiper-scrollbar',
        },";
    endif ;


     $script_content .=  " });</script>";


    $slider_content .= $script_content;

    return  $slider_content . '</div>'; // closing div comes after script

endif ;

}
