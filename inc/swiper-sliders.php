<?php //

add_shortcode( 'universal_slider', 'websussed_core_universal_slider' );

function websussed_core_universal_slider( $atts ) {

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ) ;

$slider_atts = shortcode_atts( array(
    'class' => ''
), $atts );

if ( is_plugin_active( 'pods/init.php' ) ) :

// get_the_ID(  )

    $slider_class = esc_attr($slider_atts['class']) ;

    // $slider_img = 'Helo';

    $slider_content = '<div class="swiper ' . $slider_class . '">' ;

    // <!-- Additional required wrapper -->
    $slider_content .= '<div class="swiper-wrapper">' ;

    // <!-- Slides -->

    $slider_img = get_the_post_thumbnail( get_the_ID(), 'full' ) ;
    $slider_img_url = get_the_post_thumbnail_url( get_the_ID(), 'full' ) ;

    $slider_content .= '<div class="swiper-slide" style="background-image: url(' . $slider_img_url . ');"><img src="' . $slider_img . '</div>' ;
    $slider_content .= '<div class="swiper-slide">Slide 2</div>' ;
    $slider_content .= '<div class="swiper-slide">Slide 3</div>' ;
    $slider_content .= '</div>' ;

    //  <!-- If we need pagination -->
    $slider_content .= '<div class="swiper-pagination"></div>' ;

    //  <!-- If we need navigation buttons -->
    $slider_content .= '<div class="swiper-button-prev"></div>' ;
    $slider_content .= '  <div class="swiper-button-next"></div>' ;

    // <!-- If we need scrollbar -->
    $slider_content .= '  <div class="swiper-scrollbar"></div></div>' ;
    $script_content = "<script>const " . $slider_class . " = new Swiper('." . $slider_class . "', {
    
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If we need pagination
    pagination: {
        // el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    scrollbar: {
        // el: '.swiper-scrollbar',
    },
    });</script>
    ";

    // apply_filters('the_content', $slider_content );


return  $slider_content . $script_content;

endif ;

}
