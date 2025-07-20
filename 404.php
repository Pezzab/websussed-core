<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package websussed
 */

get_header();
?>

	<main id="primary" class="site-main">
<?php 

		if ( ( get_option( 'global_content_default_blog_feature_image') ) ) :

			// if no featured image set get default blog image url
			$default_feature_img_id = get_option( 'global_content_default_blog_feature_image') ; 

			$feature_img_url = wp_get_attachment_image_url( $default_feature_img_id[0] , 'feature-full-width' );
			
			echo '<div class="main-before_content"><div class="before_content" style="background-image: url('. $feature_img_url .');">' . $page_id . '</div></div>';


		endif ;


?>


		<article>
		<section class="error-404 not-found site-width">
			<header class="entry-header max-content">
				<h1 class="page-title text-center"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'websussed-core' ); ?></h1>
			</header><!-- .page-header -->

			<div class="entry-content max-content text-center">
				<p><?php esc_html_e( 'It looks like nothing was found at this location?', 'websussed-core' ); ?></p>



			</div><!-- .page-content -->
		</section><!-- .error-404 -->
	</article>
	</main><!-- #main -->

<?php
get_footer();
