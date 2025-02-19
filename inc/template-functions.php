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


function websussed_custom_content( $position ) {

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' ) ;

	if ( is_plugin_active( 'pods/init.php' ) ) :

		if ( $position ) { // get position before or after editable content

			$page_id = get_the_ID() ;

			$page_id = pods( 'page', get_the_ID() ) ; // get page pod

			$custom_position = 'main';

			if ( get_option( 'global_content_' . $position ) ) :
				$custom_contents = get_option( 'global_content_' . $position ) ;
				$custom_position = 'global';
			else :
				$custom_contents = $page_id->field( $position ) ;
			endif ;


			if ( ! empty( $custom_contents ) ) { // check content

				foreach ( $custom_contents as $custom_content ) {

				$custom_html = '';
				$custom_wysiwyg = '';

					if ( $custom_position == 'global' ) :

						$custom_content_id 	= $custom_content ;

					else :

						$custom_content_id 	= $custom_content['ID'] ;

					endif;

					$pod = pods('custom_section', $custom_content_id );

					$expiry_date 		= $pod->field( 'expiry_date' ) ;
					$start_date 		= $pod->field( 'start_date' ) ;
					$date_today 		= date('Y-m-d');

					if ( $pod->exists() && $pod->field('custom_html') ) :

						$custom_html_output = $pod->field( 'custom_html' );
						$custom_html_output = '<div class="clear-both ' . $position . '" data-start="' . $start_date . '" data-end="' . $expiry_date . '">' . $custom_html_output . '</div>' ;
						
						$custom_html_edit_button  = '';

						if ( get_edit_post_link() ) :
						$custom_html_edit_button = '<div class="edit_custom"><div class="edit-link"><a target="_blank" href="' . get_edit_post_link( $custom_content_id ) . '">Edit</a></div></div>';
						endif;

						$custom_html = '%1s%2s';
						$custom_html = sprintf( $custom_html, $custom_html_output, $custom_html_edit_button );
					
					elseif ( $pod->exists() && $pod->field('wysiwyg_content') ) :

						$custom_wysiwyg_output = $pod->field( 'wysiwyg_content' );
						$custom_wysiwyg_output = '<div class="content_wysiwyg ' . $position . '" data-start="' . $start_date . '" data-end="' . $expiry_date . '"><div>' . $custom_wysiwyg_output . '</div></div>' ;

						$custom_wysiwyg_edit_button = '';

						if ( get_edit_post_link() ) :
						$custom_wysiwyg_edit_button = '<div class="edit_custom"><div class="edit-link"><a target="_blank" href="' . get_edit_post_link( $custom_content_id ) . '">Edit</a></div></div>';
						endif;

						
						$custom_wysiwyg = '%1s%2s';
						$custom_wysiwyg = sprintf( $custom_wysiwyg, $custom_wysiwyg_output, $custom_wysiwyg_edit_button );

					endif;

					if ( ( $expiry_date == '0000-00-00' ) && ( $start_date == '0000-00-00' ) ) :
					
					echo $custom_html;
					echo $custom_wysiwyg;

					elseif ( ( $expiry_date < $date_today ) && ( $expiry_date != '0000-00-00'  )) :

					elseif ( $start_date <= $date_today ) :
					
					echo $custom_html;
					echo $custom_wysiwyg;	
					endif ;

					// echo $custom_html;
					// echo $custom_wysiwyg;

				}

			} // close custom content check
		} // close position check
	endif; // end pods check
}


function websussed_hero() { ?>

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


				<?php //websussed_custom_content( 'hero_content' ) ; ?>
	

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
	<?php websussed_social_links(); ?>
	<?php websussed_tel_nos(); ?>
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
	yoast_breadcrumb( '<span id="breadcrumbs">','</span>' );
	}

}




