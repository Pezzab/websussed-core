<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package websussed
 */

?>

<?php // get_sidebar();?>

<?php 
		websussed_core_custom_content( 'footer_custom_content' );
			?>

	<footer id="colophon" class="site-footer">

		<div class="site-width">

		<?php websussed_core_footer_nav() ; ?>

			<div class="site-info">
				<div class="copyright">&#169; <?php echo date('Y');?>  <?php bloginfo();?> | 
				<a href="<?php echo esc_url( __( 'https://websussed.co.uk/', 'websussed-core' ) ); ?>">
					<?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Hand built by %s', 'websussed-core' ), 'WebSussed' );
					?></div>
				</a>
			</div><!-- .site-info -->

		</div><!-- .site-width -->

	</footer><!-- #colophon -->


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
