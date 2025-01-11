<?php
/**
 * ACF Pro Defaults
 *
 * @package WordPress
 */

/**
 * Add ACF Options Pages
 * ------------------------------------------------------------------------------
 */

if ( function_exists('acf_add_options_page') ) {
	
	// add parent
	$parent = acf_add_options_page( array(
		'page_title' 	=> 'Global Settings',
		'menu_title'	=> 'Global Settings',
		'menu_slug' 	=> 'global-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	)); 
/*	// add sub page
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Social Settings',
		'menu_title' 	=> 'Social',
		'parent_slug' 	=> $parent['menu_slug'],
	));
*/
}


/**
 * Register ACF Gutenberg Blocks
 * ------------------------------------------------------------------------------
 */

add_action('init', 'register_acf_blocks');

function register_acf_blocks() {
	// Blocks - Content
	// register_block_type( __DIR__ . '/../blocks/bgg-thank-you' );
	// register_block_type( __DIR__ . '/../blocks/bgg-related-products' );
	// register_block_type( __DIR__ . '/../blocks/bgg-product' );
	// register_block_type( __DIR__ . '/../blocks/bgg-product-description' );
	// register_block_type( __DIR__ . '/../blocks/bgg-product-hero' );
	// register_block_type( __DIR__ . '/../blocks/bgg-similar-posts' );
	// register_block_type( __DIR__ . '/../blocks/bgg-featured-product' );
	// register_block_type( __DIR__ . '/../blocks/bgg-interviews' );
	// register_block_type( __DIR__ . '/../blocks/bgg-endorsee' );
	// register_block_type( __DIR__ . '/../blocks/bgg-contact-purchase' );

	register_block_type( __DIR__ . '/../blocks/bgg-about-the-author' );
	register_block_type( __DIR__ . '/../blocks/bgg-block-quote' );
	register_block_type( __DIR__ . '/../blocks/bgg-contact' );
	register_block_type( __DIR__ . '/../blocks/bgg-content-card' );
	register_block_type( __DIR__ . '/../blocks/bgg-content-highlight' );
	register_block_type( __DIR__ . '/../blocks/bgg-cta' );
	register_block_type( __DIR__ . '/../blocks/bgg-endorsement-slider' );
	register_block_type( __DIR__ . '/../blocks/bgg-faq' );
	register_block_type( __DIR__ . '/../blocks/bgg-key-takeaway' );
	register_block_type( __DIR__ . '/../blocks/bgg-logos' );
	register_block_type( __DIR__ . '/../blocks/bgg-media-content' );
	register_block_type( __DIR__ . '/../blocks/bgg-posts-slider' );
	register_block_type( __DIR__ . '/../blocks/bgg-products-slider' );
	register_block_type( __DIR__ . '/../blocks/bgg-product-specifications' );
	register_block_type( __DIR__ . '/../blocks/bgg-resource-spotlight' );
	register_block_type( __DIR__ . '/../blocks/bgg-reviews-slider' );
	register_block_type( __DIR__ . '/../blocks/bgg-single-video' );
	register_block_type( __DIR__ . '/../blocks/bgg-single-image' );
	register_block_type( __DIR__ . '/../blocks/bgg-social' );
	register_block_type( __DIR__ . '/../blocks/bgg-table-of-contents' );
	register_block_type( __DIR__ . '/../blocks/bgg-wysiwyg' );
	register_block_type( __DIR__ . '/../blocks/bgg-posts' );
	register_block_type( __DIR__ . '/../blocks/bgg-products' );
	register_block_type( __DIR__ . '/../blocks/bgg-button' );
	register_block_type( __DIR__ . '/../blocks/bgg-sidebar-posts' );
	register_block_type( __DIR__ . '/../blocks/bgg-sidebar-recent-posts' );
}; 



/**
 * Custom Admin Styles
 * ------------------------------------------------------------------------------
 */

add_action( 'acf/input/admin_enqueue_scripts', 'acf_admin_styles' );  

function acf_admin_styles() {	
		// register style
    wp_register_style( 'acf-css', get_stylesheet_directory_uri() . '/css/acf-styles.css', false, '1.0.0' );
    wp_enqueue_style( 'acf-css' );

    // register script
    // wp_register_script( 'my-acf-input-js', get_stylesheet_directory_uri() . '/js/my-acf-input.js', false, '1.0.0');
    // wp_enqueue_script( 'my-acf-input-js' );
} 