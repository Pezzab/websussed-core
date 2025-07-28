<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package websussed
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function websussed_core_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'websussed_core_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function websussed_core_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'websussed_core_pingback_header' );


function websussed_core_custom_content( $position ) {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' ) ;

	if ( is_plugin_active( 'pods/init.php' ) ) :

			// if ( ! is_home() ) :

			// $page_id = pods( 'page', get_queried_object_id() ) ; // on blog and archive pages content is outside post loop so set page id this way

			// else :

			$page_id = pods( 'page', get_the_ID() ) ; // get page pod

			// endif ;


	if ( $position ) { // get position before or after editable content

			$custom_position = 'main';

				if ( get_option( 'global_content_' . $position ) ) :
					$custom_contents = get_option( 'global_content_' . $position ) ;
					$custom_position = 'global';
				else :
					$custom_contents = $page_id->field( $position ) ;
				endif ;

			if ( ! empty( $custom_contents ) ) : // check content

				echo '<div class="' . $custom_position . '-' . $position .'">';

				foreach ( $custom_contents as $custom_content ) {

				$custom_html = '';
				$custom_wysiwyg = '';
				$custom_shortcode = '';
				$custom_classes = '';

					if ( $custom_position == 'global' ) :

						$custom_content_id 	= $custom_content ;

					else :

						$custom_content_id 	= $custom_content['ID'] ;

					endif;

					$pod = pods('custom_section', $custom_content_id );

					$expiry_date 		= $pod->field( 'expiry_date' ) ;
					$start_date 		= $pod->field( 'start_date' ) ;
					$date_today 		= date('Y-m-d');
					$custom_classes		= $pod->field( 'optional_classes' );
					$custom_classes		= $custom_classes . ' ';

					// $page_title			= get_the_title();

					global $post;
					$page_title	 = $post->post_name;

					$feature_img = 'hello' ;

					if ( get_post_meta( $custom_content_id, 'make_into_bg_img', true) && get_the_post_thumbnail_url( get_the_ID() ) ) :

					$feature_img_size = get_post_meta( $custom_content_id, 'choose_featured_image_size', true) ;
					
					$feature_img = get_the_post_thumbnail_url( get_the_ID(), 'feature-full-width' ) ;
					$feature_img = 'style="background-image: url(' . $feature_img . ');"' ;

					endif ;



					if ( $pod->exists() && $pod->field('add_shortcode') ) :

						$add_shortcode = $pod->field( 'add_shortcode' );
						$add_shortcode = '<div class="' . $custom_classes . $position . ' ' . $page_title . ' content_shortcode" data-start="' . $start_date . '" data-end="' . $expiry_date . '">' . $add_shortcode . '</div>' ;
					
						$custom_shortcode_edit_button  = '';

						if ( get_edit_post_link() ) :
						$custom_shortcode_edit_button = '<div class="edit_custom"><div class="edit-link"><a target="_blank" href="' . get_edit_post_link( $custom_content_id ) . '">Edit</a></div></div>';
						endif;

						$custom_shortcode = '%1s%2s';
						$custom_shortcode = sprintf( $custom_shortcode, $add_shortcode, $custom_shortcode_edit_button );

					elseif ( $pod->exists() && $pod->field('custom_html') ) :

						$custom_html_output = $pod->field( 'custom_html' );
						$custom_html_output = '<div class="' . $custom_classes . $position . ' ' . $page_title .' content_html" data-start="' . $start_date . '" data-end="' . $expiry_date . '" ' . $feature_img . '>' . $custom_html_output . '</div>' ;
					
						$custom_html_edit_button  = '';

						if ( get_edit_post_link() ) :
						$custom_html_edit_button = '<div class="edit_custom"><div class="edit-link"><a target="_blank" href="' . get_edit_post_link( $custom_content_id ) . '">Edit</a></div></div>';
						endif;

						$custom_html = '%1s%2s';
						$custom_html = sprintf( $custom_html, $custom_html_output, $custom_html_edit_button );
					
					elseif ( $pod->exists() && $pod->field('wysiwyg_content') ) :

						$custom_wysiwyg_output = $pod->field( 'wysiwyg_content' );
						$custom_wysiwyg_output = '<div class="' . $custom_classes . $position . ' ' . $page_title . ' content_wysiwyg" data-start="' . $start_date . '" data-end="' . $expiry_date . '" ' . $feature_img . '><div class="site-width"><div>' . wpautop( $custom_wysiwyg_output ) . '</div></div>' ;

						$custom_wysiwyg_edit_button = '';

						if ( get_edit_post_link() ) :
						$custom_wysiwyg_edit_button = '<div class="edit_custom"><div class="edit-link"><a target="_blank" href="' . get_edit_post_link( $custom_content_id ) . '">Edit</a></div></div>';
						endif;

						
						$custom_wysiwyg = '%1s%2s';
						$custom_wysiwyg = sprintf( $custom_wysiwyg, $custom_wysiwyg_output, $custom_wysiwyg_edit_button );

					endif;

					if ( ( $expiry_date == '0000-00-00' ) && ( $start_date == '0000-00-00' ) ) :
					
						echo do_shortcode( $custom_shortcode );	
						echo $custom_html;
						echo $custom_wysiwyg;

					elseif ( ( $expiry_date < $date_today ) && ( $expiry_date != '0000-00-00'  )) :

					elseif ( $start_date <= $date_today ) :

						echo do_shortcode( $custom_shortcode );	
						echo $custom_html;
						echo $custom_wysiwyg;	

					endif ;

		

				}
				echo '</div>';
			
						
			endif ; // close custom content check

			if ( empty( $custom_contents ) && $position=='before_content') :

				$page_id = get_the_ID();
			 	// $page_id = get_queried_object_id();

				if ( wp_get_attachment_url( get_post_thumbnail_id($page_id) ) ) :
					
					// get image url attached to page 
					$feature_img_url = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'feature-full-width ' )[0]; 

				else :

					// if no featured image set get default blog image url
					$default_feature_img_id = get_option( 'global_content_default_blog_feature_image') ; 

					$feature_img_url = wp_get_attachment_image_url( $default_feature_img_id[0] , 'feature-full-width' );
				 
				endif ;

				echo '<div class="main-before_content"><div class="before_content" style="background-image: url('. $feature_img_url .');">' . $page_id . '</div></div>';

			endif ;

		} // close position check

	

	endif; // end pods check
}


function websussed_core_hero() { ?>

	<?php
		if ( is_plugin_active( 'pods/init.php' ) ) :
		?>

			<div id="hero" class="outer">

				<?php if ( ! is_front_page() ) : ?>	

						<header class="entry-header inner">

							<div class="page-title">
							<?php
								if ( function_exists('yoast_breadcrumb') && ! is_front_page() && ! is_home() ) {
								yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
								}

								?>

							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							</div>

						</header><!-- .entry-header -->

				<?php endif; ?>	


				<?php //websussed_core_custom_content( 'hero_content' ) ; ?>
	

				<?php //	endif; // check if hero active
					?>
			</div> <!-- #hero -->

		<?php
			// endif; // end if hero active
			?>
	
	<?php
		endif; // end pods plugin check
		?>

<?php }

// misc layout components to simplify customisation

function websussed_core_skip_link() { ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'websussed-core' ); ?></a>

<?php }


function websussed_core_contact_links(){ ?>

<?php if ( websussed_core_social_links() ||  websussed_core_telephone_nos() ) : ?>

	<div class="contact-details"> 
		<div class="site-width">
			<div>
		<?php echo websussed_core_social_links(); ?>
		<?php echo websussed_core_telephone_nos(); ?>
			</div>
		</div>
	</div>

<?php endif ; ?>

<?php }

function websussed_core_site_branding() {?>

<div class="site-branding">
			<?php	
		
			if( function_exists( 'the_custom_logo' ) ) {
				if( has_custom_logo() ) {
					the_custom_logo();

					$screen_reader_tag = 'sr-only';

				} else {
					$screen_reader_tag = '';
				}
			}

			if ( is_front_page() ) :
				?>
				<h1 class="site-title <?php echo $screen_reader_tag; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title <?php echo $screen_reader_tag; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$websussed_core_description = get_bloginfo( 'description', 'display' );
			if ( $websussed_core_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $websussed_core_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>

		</div><!-- .site-branding -->

<?php }


function websussed_core_yoast_breadcrumb(){

	if ( function_exists('yoast_breadcrumb') && ! is_front_page() ) {
	yoast_breadcrumb( '<div id="breadcrumbs"><div class="site-width"><div>','</div></div></div>' );
	}

}




