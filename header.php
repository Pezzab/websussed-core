<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package websussed
 */

?>
<!doctype html>

<html <?php language_attributes(); ?>>

	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
		<meta name='viewport' content='initial-scale=1, viewport-fit=cover'>
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>

	</head>

	<body <?php body_class(); ?>>
		
	<?php wp_body_open(); ?>

		<div id="page" class="site">

		<?php $header_layout = get_option('layout_options_select_site_header');

			if ( empty($header_layout) ) :
				
				get_template_part( 'template-parts/header-layout_one' );

			else :

			get_template_part( 'template-parts/' . $header_layout );

			endif;

		?>



