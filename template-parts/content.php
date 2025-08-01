<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package websussed
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php
		echo websussed_core_custom_content( 'before_content' ) ;
?>

	<div class="site-width">
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		elseif ( is_archive() ) :

		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				websussed_core_posted_on();
				// websussed_core_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php // websussed_core_post_thumbnail(); ?>

	<div class="entry-content">
		<div>
		<?php

		the_excerpt();
		// the_content(
		// 	sprintf(
		// 		wp_kses(
		// 			/* translators: %s: Name of current post. Only visible to screen readers */
		// 			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'websussed-core' ),
		// 			array(
		// 				'span' => array(
		// 					'class' => array(),
		// 				),
		// 			)
		// 		),
		// 		wp_kses_post( get_the_title() )
		// 	)
		// );

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'websussed-core' ),
				'after'  => '</div>',
			)
		);
		?>
		</div>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php // websussed_core_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	</div><!-- .site-width -->
</article><!-- #post-<?php the_ID(); ?> -->
<?php get_sidebar(); ?>
