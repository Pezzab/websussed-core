<?php
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
// remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );
// remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

add_action( 'wp_enqueue_scripts', function() {
  // https://github.com/WordPress/gutenberg/issues/36834
//   wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );

  // https://stackoverflow.com/a/74341697/278272
  wp_dequeue_style( 'classic-theme-styles' );

  // Or, go deep: https://fullsiteediting.com/lessons/how-to-remove-default-block-styles
} );

// add_filter( 'should_load_separate_core_block_assets', '__return_true' );

function prefix_remove_core_block_styles() {
	wp_dequeue_style( 'wp-block-columns' );
	wp_dequeue_style( 'wp-block-column' );
	wp_dequeue_style( 'wp-block-site-title' );
	wp_dequeue_style( 'wp-block-post-featured-image' );
	wp_dequeue_style( 'wp-block-post-title' );
	wp_dequeue_style( 'wp-block-post-author' );
	wp_dequeue_style( 'wp-block-post-date' );
	wp_dequeue_style( 'wp-block-post-terms' );
	wp_dequeue_style( 'wp-block-paragraph' );
	wp_dequeue_style( 'wp-block-heading' );
	wp_dequeue_style( 'wp-block-post-content' );
	wp_dequeue_style( 'wp-block-avatar' );
	wp_dequeue_style( 'wp-block-comment-author-name' );
	wp_dequeue_style( 'wp-block-site-tagline' );
	wp_dequeue_style( 'wp-block-post-author' );
	wp_dequeue_style( 'wp-block-comment-date' );
	wp_dequeue_style( 'wp-block-group' );
	wp_dequeue_style( 'p-block-comment-content' );
	wp_dequeue_style( 'wp-block-comment-reply-link' );
	wp_dequeue_style( 'wp-block-comment-template' );
	wp_dequeue_style( 'wp-block-comments-pagination' );
	wp_dequeue_style( 'wp-block-comments' );
	wp_dequeue_style( 'wp-block-post-comments-form' );
	wp_dequeue_style( 'wp-block-comment-edit-link' );
	wp_dequeue_style( 'wp-block-comment-content' );
	wp_dequeue_style( 'wp-block-buttons' );	
	wp_dequeue_style( 'wp-block-button' );
	wp_dequeue_style( 'wp-block-post-navigation-link' );
	wp_dequeue_style( 'wp-emoji-styles' );
	wp_dequeue_style( 'core-block-supports' );
	wp_dequeue_style( 'wp-block-template-skip-link' );
	
}
// add_action( 'wp_enqueue_scripts', 'prefix_remove_core_block_styles' );