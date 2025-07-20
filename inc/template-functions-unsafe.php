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


function websussed_core_beforee_content() {
	echo 'HOME';
	if ( is_home() ) :


		if ( get_option( 'global_content_default_blog_feature_image') ) :

			$default_feature_img_id = get_option( 'global_content_default_blog_feature_image') ; 

			$feature_img_url = wp_get_attachment_image_url( $default_feature_img_id[0] , 'feature-full-width' );

		endif ;

		if ( ! empty( $feature_img_url ) ) :
?>
				<div class="main-before_content">
					<div class="before_content featured-image"style="background-image: url(<?php echo $feature_img_url ?>);"></div>
				</div>
<?php 	
		endif ;
		return ;
	endif ; 

		$page_id = get_the_ID();

		if ( websussed_core_custom_content( 'before_content' ) ) :
			
			echo websussed_core_custom_content( 'before_content' ) ;
			
		elseif ( get_the_post_thumbnail_url( $page_id,'feature-full-width' ) ) :

			$feature_img_url = get_the_post_thumbnail_url( $page_id,'feature-full-width' );

		elseif ( get_option( 'global_content_default_blog_feature_image') ) :

			$default_feature_img_id = get_option( 'global_content_default_blog_feature_image') ; 

			$feature_img_url = wp_get_attachment_image_url( $default_feature_img_id[0] , 'feature-full-width' );

		endif ;

		if ( ! empty( $feature_img_url ) ) : ?>
				<div class="main-before_content">
					<div class="before_content featured-image"style="background-image: url(<?php echo $feature_img_url ?>);"></div>
				</div>
<?php
	endif ;
}


function websussed_core_custom_content( $position ) {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' ) ;

	if ( is_plugin_active( 'pods/init.php' ) ) :


	if ( is_home() ) :

	$custom_output = get_the_id() ;

		$page_id = pods( 'page', get_queried_object_id() ) ; // on blog and archive pages content is outside post loop so set page id this way
		$custom_output = get_option( 'page_for_posts' );

	elseif ( is_single() ) :

		$page_id = pods( 'page', get_the_ID() ) ; // get page pod

	endif ;




	if ( $position ) { // get position before or after editable content

		if ( ! empty( $custom_contents ) ) : // check content

		endif ; // close custom content check

	} // close position check

	return $custom_output . ' ' . $position . ' ' . $page_id ;
	return ;
	endif; // end pods check
}


function websussed_core_hero() { ?>

	<?php
		if ( is_plugin_active( 'pods/init.php' ) ) :
		?>

			<div id="hero" class="outer">

				<?php if ( ! is_front_page() && ! is_home() ) : ?>	

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


				<?php //echo websussed_core_custom_content( 'hero_content' ) ; ?>
	

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

	<div class="contact-details">
		<div class="site-width">
			<div>
		<?php websussed_core_social_links(); ?>
		<?php websussed_core_telephone_nos(); ?>
			</div>
		</div>
	</div>

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

	if ( function_exists('yoast_breadcrumb') && ! is_front_page() && ! is_home() ) {
	yoast_breadcrumb( '<div id="breadcrumbs"><div class="site-width"><div>','</div></div></div>' );
	}

}




