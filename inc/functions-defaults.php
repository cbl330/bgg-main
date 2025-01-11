<?php

/**
 * WordPress defaults
 *
 * @package WordPress
 */

/**
 * Remove WordPress Upgrade Nag Message
 * ------------------------------------------------------------------------------
 */

add_action( 'admin_init', 'bgg_suppress_wordpress_update_nag' );

function bgg_suppress_wordpress_update_nag() {
	remove_action( 'admin_notices', 'update_nag', 3 );
}

/**
 * Remove Default WordPress Junk in Head
 * ------------------------------------------------------------------------------
 */

remove_action( 'wp_head', 'adjacent_posts_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );

/**
 * Disable WordPress Curly Quotes
 * ------------------------------------------------------------------------------
 */

remove_filter( 'comment_text', 'wptexturize' );
remove_filter( 'single_post_title', 'wptexturize' );
remove_filter( 'the_content', 'wptexturize' );
remove_filter( 'the_title', 'wptexturize' );
remove_filter( 'wp_title', 'wptexturize' );

/**
 * Disable WordPress Emoji Support
 * ------------------------------------------------------------------------------
 */

remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );

/**
 * Replacing the default WordPress search form
 * ------------------------------------------------------------------------------
 */

// add_filter( 'get_search_form', 'html5_search_form' );

// function html5_search_form( $form ) {
// 	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
// 	<input type="search" placeholder="Search Birch Gold Group">
// 	</form>';

// 	return $form;
// }

// function html5_search_form( $form ) {
// 	$form = '<form class="mh-megamenu-search" role="search" method="get" id="searchform" action="' . home_url( '/' ) . '">
// 	<button class="icon-search"></button>
//     <input type="text" name="s" id="s" placeholder="Search..." value="' . the_search_query() . '" />
// </form>';

// 	return $form;
// }

// <form class="mh-megamenu-search">
// 	<button class="icon-search"></button>
// 	<input type="search" placeholder="Search Birch Gold Group">
// </form>

/**
 * Remove Admin Bar 
 * ------------------------------------------------------------------------------
 */ 

// add_filter('show_admin_bar', '__return_false'); 


/**
 * WP SEO
 * ------------------------------------------------------------------------------
 */
 
add_filter( 'wpseo_metabox_prio', function() { return 'low'; });
add_filter( 'wpseo_use_page_analysis', function() { return false; });

  
/**
 * Remove Editor Menus
 * ------------------------------------------------------------------------------
 */

function remove_editor_menus() { 
	remove_menu_page('edit-comments.php'); 
	remove_menu_page('link-manager.php'); 
	// sub menus 
	// remove_submenu_page( 'themes.php', 'widgets.php' ); 
	// remove_submenu_page( 'themes.php', 'theme-editor.php' ); // Editor Menu 
	remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_menu', 'remove_editor_menus', 999 );


/**
 * Set 'Search Engine Visibility' Setting Based on Environment 
 * ------------------------------------------------------------------------------
 */
 
function bgg_search_engine_visibility_robots_setting() {
	if ( ( 'WP_ENV_LOCAL' === true || 'WP_ENV_STAGING' === true || 'WP_ENV_TESTING' === true ) && get_option( 'blog_public' ) == '1' ) {
		update_option( 'blog_public', '0' );
	} elseif ( 'WP_ENV_PRODUCTION' === true && is_multisite() ) {
		// do nothing
	} elseif ( 'WP_ENV_PRODUCTION' === true && get_option( 'blog_public' ) == '0' ) {
		update_option( 'blog_public', '1' );
	}
}
add_action( 'init', 'bgg_search_engine_visibility_robots_setting' );


/**
 * Page Slug Body Class 
 * ------------------------------------------------------------------------------
 */
 
add_filter( 'body_class', 'add_slug_body_class' ); 

function add_slug_body_class( $classes ) { 
	global $post; 
	if ( isset( $post ) ) { 
		$classes[] = $post->post_type . '-' . $post->post_name; 
		
	// Also Add TAX Term for Products
/*
		if( is_singular( 'product' ) ){
			$custom_terms = get_the_terms(0, 'product_type');
		    if ($custom_terms) {
		      foreach ($custom_terms as $custom_term) {
		        $classes[] = 'term-' . $custom_term->slug;
		      }
		    }
	    }
*/	    
	} 
	return $classes; 
}



/**
 * Add Taxonomy Term to Custom Post Type Slug 
 * ------------------------------------------------------------------------------
 */
 
/*
add_filter('post_link', 'custom_product_link', 1, 3);
add_filter('post_type_link', 'custom_product_link', 1, 3);

function custom_product_link($permalink, $post_id, $leavename) {
	// con %product_type% catturo il rewrite del Custom Post Type
	// Get the rewrite of the CPT
    if (strpos($permalink, '%product_type%') === FALSE) return $permalink;
        // Get post
        $post = get_post($post_id);
        if (!$post) return $permalink;

        // Get taxonomy terms
        $terms = wp_get_object_terms($post->ID, 'product_type');
        if (!is_wp_error($terms) && !empty($terms) && is_object($terms[0]))
        	$taxonomy_slug = $terms[0]->slug;
        else $taxonomy_slug = 'misc';

    return str_replace('%product_type%', $taxonomy_slug, $permalink);
} 
*/
