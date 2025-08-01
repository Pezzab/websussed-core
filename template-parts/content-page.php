<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package websussed
 */

?>


<?php

	if ( $max_content = get_post_meta( get_the_ID(), 'override_content_width', true ) ) :

		$max_content = ' max-content';

	else :

		$max_content = '';

	endif;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<!-- // if ( has_post_thumbnail() && $custom_contents==false) :
			// 	// the_post_thumbnail();
			// 	$custom_contents = null;
			// endif ; -->

<?php 
		echo websussed_core_custom_content( 'before_content' ) ;
?>


	<?php websussed_core_yoast_breadcrumb() ?>
<div class="site-width">


<?php if ( ! is_front_page() ) : ?>

	<header class="entry-header<?php echo $max_content ; ?>">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

<?php endif; ?>


	<div class="entry-content<?php echo $max_content ; ?>">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'websussed-core' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer<?php echo $max_content ; ?>">
			<div>
	
			</div>

	<?php endif; ?>
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'websussed-core' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="edit-link bg-fuchsia-500 p-1 border-white border-2 rounded-md inline-block text-white">',
					'</span>'
				);
			?>

			</footer><!-- .entry-footer -->
</div><!-- .site-width -->

<?php 
		echo websussed_core_custom_content( 'after_content' );
			?>
</article><!-- #post-<?php the_ID(); ?> -->


<?php // websussed_core_universal_slider() ?>

