<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
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
		websussed_core_custom_content( 'before_content' );
		?>

	<div class="site-width archive">
		<header class="entry-header <?php echo $max_content?>">
			<?php

				$title = wp_title( '', false, 'right' );

				echo '<h1 class="entry-title">' . $title . '</h1>';

				?>
		</header>
	</div>

		<div class="blog-display grid grid-cols-3 gap-4 site-width">

		<?php
		if ( have_posts() ) :




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

		</div>

		<?php get_sidebar(); ?>

		<?php 
		websussed_core_custom_content( 'after_content' );
			?>

	</main><!-- #main -->

<?php

get_footer();
