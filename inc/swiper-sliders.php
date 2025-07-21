<?php //

add_shortcode( 'universal_slider', 'websussed_core_universal_slider' );

function websussed_core_universal_slider( $atts ) {

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ) ;

$slider_atts = shortcode_atts( array(
    'class'         => '', // make class same as slider content tag! use pattern 'pageslugslider' no spaces
    'showbgimg'     => 'no',
    'showtitle'     => 'no',
    'showheader'    => 'no',
    'showpgph'      => 'no',
    'showlink'      => 'no',
    'showscrollbar' => 'no',
    'showpagination'=> 'no',
    'shownav'       => 'no'
), $atts );

$slider_showbgimg       = esc_attr($slider_atts['showbgimg']) ;
$slider_showtitle       = esc_attr($slider_atts['showtitle']) ;
$slider_showpgph        = esc_attr($slider_atts['showpgph']) ;
$slider_showlink        = esc_attr($slider_atts['showlink']) ;
$slider_showheader      = esc_attr($slider_atts['showheader']) ;
$slider_showscrollbar   = esc_attr($slider_atts['showscrollbar']) ;
$slider_showpagination  = esc_attr($slider_atts['showpagination']) ;
$slider_shownav         = esc_attr($slider_atts['shownav']) ;
$slider_count           = 0;

$slider_class       = esc_attr($slider_atts['class']) ;

if ( is_plugin_active( 'pods/init.php' ) ) :

    $slider_content = '<div class="swiper ' . $slider_class . '">' ;

    // <!-- Additional required wrapper -->
    $slider_content .= '<div class="swiper-wrapper">' ;

     // <!-- Slides -->

    //______________________________________________________________________

    $slider_args = array(
    'post_type' => 'slider_content',
        'tax_query' => array(
            array(
            'taxonomy' => 'slider_tag',
            'field' => 'slug',
            'terms' => $slider_class,
            ),
        ),
    );

    // the query.
    $the_query = new WP_Query( $slider_args );

    if ( $the_query->have_posts() ) :

        while ( $the_query->have_posts() ) :
            $the_query->the_post();

                $slider_count++;
                $slider_img = get_the_post_thumbnail( get_the_ID(), 'feature-full-width' ) ;
                $slider_img_url = get_the_post_thumbnail_url( get_the_ID(), 'feature-full-width' ) ;
                $slider_title = get_the_title();


    $slider_header_text     = get_post_meta( get_the_ID(), 'websussed_header_text' );
    $slider_paragraph_text  = get_post_meta( get_the_ID(), 'websussed_paragraph_text' );
    $slider_custom_html     = get_post_meta( get_the_ID(), 'websussed_slider_custom_html' );
    $slider_button_link     = get_post_meta( get_the_ID(), 'websussed_slide_link_button' );
    $slider_button_text     = get_post_meta( get_the_ID(), 'websussed_slide_link_button_text' );
    


    if ( $slider_showbgimg == 'yes' ) :

        $slider_content .= '<div class="swiper-slide slide-' . $slider_count . '" style="background-image: url(' . $slider_img_url . ');"><div class="site-width">';

    else :
        
        $slider_content .= '<div class="swiper-slide showbgimg-no slide-' . $slider_count . '"><div class="site-width">' . $slider_img . '<div>';
        
    endif ;

        if ( $slider_showtitle == 'yes' ) :

            $slider_content .= '<h2>' . $slider_title . '</h2>';

        endif ;

        if ( ( $slider_showheader == 'yes' ) && (! empty ( $slider_header_text[0] ) ) ) :

            $slider_content .= '<h2>' . $slider_header_text[0] . '</h2>';

        endif ;

        if ( ( $slider_showpgph == 'yes' ) && (! empty ( $slider_paragraph_text[0] ) ) ) :

            $slider_content .= '<p>' . $slider_paragraph_text[0] . '</p>';

        endif ;

        if ( ( $slider_showlink == 'yes' ) && (! empty ( $slider_button_link[0] ) ) && (! empty ( $slider_button_text[0] ) )) :

            $slider_content .= '<div><button><a href="' . $slider_button_link[0] . '">' . $slider_button_text[0] . '</a></button></div>';

        endif ;

        if ( $slider_showbgimg == 'no' ) :

        $slider_content .= '</div></div></div><!-- close slide -->';

        else :
        $slider_content .= '</div></div><!-- close slide -->';
        endif ;

    endwhile; 

        $slider_content .= '</div><!-- .swiper-wrapper -->' ;

    if ( ( $slider_showpagination == 'yes' ) ) :
        //  <!-- If we need pagination -->
        $slider_content .= '<div class="swiper-pagination"></div>' ;
    endif ;

    if ( ( $slider_shownav == 'yes' ) ) :
        //  <!-- If we need navigation buttons -->
        $slider_content .= '<div class="swiper-button-prev"></div>' ;
        $slider_content .= '  <div class="swiper-button-next"></div>' ;
        // <!-- If we need scrollbar -->
    endif ;

    if ( ( $slider_showscrollbar == 'yes' ) ) :
        $slider_content .= '  <div class="swiper-scrollbar"></div>' ;
    endif ;

        wp_reset_postdata();

    else : 
        esc_html_e( 'Sorry, no posts matched your criteria.' );
    endif;              

    //______________________________________________________________________


 
    $script_content = "<script>";
    $script_content .= "const " . $slider_class . " = new Swiper('." . $slider_class . "', {";
    $script_content .= "direction: 'horizontal', loop: true, speed: 1000, effect: 'fade',
    fadeEffect: {
        crossFade: true
    },

    // If we need pagination
    // pagination: {
    //     // el: '.swiper-pagination',
    // },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    });</script>
    ";

    // apply_filters('the_content', $slider_content );


    $slider_content .= $script_content;

return  $slider_content . '</div>'; // closing div comes after script

endif ;

}
