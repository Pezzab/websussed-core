<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package websussed
 */

get_header();
?>


<?php


	$page_id = get_queried_object_id();

	if ( $max_content = get_post_meta( $page_id, 'override_content_width', true ) ) :

		$max_content = ' max-content';

	else :

		$max_content = '';

	endif;

?>

	<main id="primary" class="site-main">

<?php 



		if ( ( is_home() ) && ( wp_get_attachment_url( get_post_thumbnail_id($page_id) ) ) ) :

			// get image url attached to page 
			$feature_img_url = wp_get_attachment_image_src( get_post_thumbnail_id($page_id), 'feature-full-width ' )[0]; 

		elseif ( ( is_home() || is_archive() ) && ( get_option( 'global_content_default_blog_feature_image') ) ) :

			// if no featured image set get default blog image url
			$default_feature_img_id = get_option( 'global_content_default_blog_feature_image') ; 

			$feature_img_url = wp_get_attachment_image_url( $default_feature_img_id[0] , 'feature-full-width' );
			
		endif ;

		echo '<div class="main-before_content"><div class="before_content" style="background-image: url('. $feature_img_url .');"></div></div>';

?>

	<?php websussed_core_yoast_breadcrumb() ?>



		<div class="blog-display grid grid-cols-3 gap-4 site-width">

<?php
		if ( have_posts() ) :	
?>
		<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->


<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_type() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php

get_footer();
