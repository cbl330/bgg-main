<?php
/**
 * bgg functions and definitions.
 *
 * @package bgg
 */

if ( ! function_exists( 'bgg_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function bgg_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on bgg, use a find and replace
	 * to change 'bgg' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'bgg', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Register Custom Menus
	// ---------------------
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'bgg' ),
		// 'footer' => esc_html__( 'Footer', 'bgg' ),
		// Post Page Menu
		'posts-secondary' => esc_html__( 'Post Secondary', 'bgg' ),
		// Product Page Menus
		'products-secondary' => esc_html__( 'Products Secondary', 'bgg' ),
		'products-tertiary' => esc_html__( 'Products Tertiary', 'bgg' ),
		// Footer Menus
		'footer-company' => esc_html__( 'Footer Company', 'bgg' ),
		'footer-metals' => esc_html__( 'Footer Metals', 'bgg' ),
		'footer-resources' => esc_html__( 'Footer Resources', 'bgg' ),
		'footer-customer-care' => esc_html__( 'Footer Customer Care', 'bgg' ),
	) );

	// Products - Tertiary Menu
	function custom_menu_ul_class_products_tertiary($args) {
		if ($args['theme_location'] == 'products-tertiary') {
			$args['menu_class'] = 'pf-slider'; // Add your custom class for the first menu here
		}
		return $args;
	}
	add_filter('wp_nav_menu_args', 'custom_menu_ul_class_products_tertiary');

	// Footer - Company
	function custom_menu_ul_class_company($args) {
		if ($args['theme_location'] == 'footer-company') {
			$args['menu_class'] = 'footer-company mb-md-50 mb-sm-30 mb-15'; // Add your custom class for the first menu here
		}
		return $args;
	}
	add_filter('wp_nav_menu_args', 'custom_menu_ul_class_company');

	// Footer - Metals
	function custom_menu_ul_class_metals($args) {
		if ($args['theme_location'] == 'footer-metals') {
			$args['menu_class'] = 'footer-metals mb-md-50 mb-sm-30 mb-0 pb-sm-0 pb-30'; // Add your custom class for the first menu here
		}
		return $args;
	}
	add_filter('wp_nav_menu_args', 'custom_menu_ul_class_metals');

	// Footer - Resources
	function custom_menu_ul_class_resources($args) {
		if ($args['theme_location'] == 'footer-resources') {
			$args['menu_class'] = 'footer-resources mb-md-50 mb-sm-30 mb-0 pb-sm-0 pb-30'; // Add your custom class for the first menu here
		}
		return $args;
	}
	add_filter('wp_nav_menu_args', 'custom_menu_ul_class_resources');

	// Footer - Customer Care
	function custom_menu_ul_class_customer($args) {
		if ($args['theme_location'] == 'footer-customer-care') {
			$args['menu_class'] = 'footer-customer-care mb-md-50 mb-sm-30 mb-0 pb-sm-0 pb-30'; // Add your custom class for the first menu here
		}
		return $args;
	}
	add_filter('wp_nav_menu_args', 'custom_menu_ul_class_customer');

}
endif;
add_action( 'after_setup_theme', 'bgg_setup' );

function include_custom_post_types_in_search($query) {
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        // Include default post type 'post' and your custom post types
        $post_types = array('post', 'products', 'page');
        $query->set('post_type', $post_types);
    }
}
add_action('pre_get_posts', 'include_custom_post_types_in_search');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bgg_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bgg_content_width', 640 );
}
add_action( 'after_setup_theme', 'bgg_content_width', 0 );


/**
 * Globals
 */
$home_dir = get_template_directory_uri();

// allow local testing without SSL
if ( 'WP_ENV_LOCAL' ) { 
    // error_log('LOCAL');
    add_filter('https_ssl_verify', '__return_false');
}
	
/* Disable WordPress Admin Bar for all users */
// add_filter( 'show_admin_bar', '__return_false' );

// Register Custom Block Category
function my_acf_block_categories( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'bgg-blocks',
                'title' => 'BGG Blocks',
                // 'icon'  => 'shield' // Optional. Use a dashicon class.
            ),
        )
    );
}
add_filter( 'block_categories', 'my_acf_block_categories', 10, 2 );

// Register Product Category
// -----------------------------
function custom_product_categories() {
    $labels = array(
        'name' => 'Product Categories',
        'singular_name' => 'Product Category',
        'search_items' => 'Search Product Categories',
        'all_items' => 'All Product Categories',
        'parent_item' => 'Parent Product Category',
        'parent_item_colon' => 'Parent Product Category:',
        'edit_item' => 'Edit Product Category',
        'update_item' => 'Update Product Category',
        'add_new_item' => 'Add New Product Category',
        'new_item_name' => 'New Product Category Name',
        'menu_name' => 'Product Categories'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
		// 'rewrite' => array('slug' => 'product-category'),
        'rewrite' => array('slug' => 'precious-metals'), // rewrite to precious-metals
    );

    register_taxonomy('product_categories', array('products'), $args);
}
add_action('init', 'custom_product_categories');

// Register Custom Post Types
// -----------------------------
add_action( 'init', 'bgg_post_type' );
function bgg_post_type() {

	// Product Post Type
	register_post_type( 'products',
		array(
			'labels' => array(
			'name' => __( 'Products' ),
			'singular_name' => __( 'Product' )
			),
			'public' => true,
			'has_archive' => true,
			'show_in_rest' => true, // To use Gutenberg editor.
			'supports' => array( 'title', 'editor', 'custom-fields','thumbnail', 'categories', 'excerpt', 'author' ), //Enable Post Thumbnails
			// 'taxonomies' => array( 'category', 'post_tag' ),
		)
	);

  	// Endorsee Post Type
	register_post_type( 'endorser',
		array(
			'labels' => array(
			'name' => __( 'Endorsers' ),
			'singular_name' => __( 'Endorser' )
			),
			'public' => true,
			'has_archive' => true,
			'show_in_rest' => true, // To use Gutenberg editor.
			'supports' => array( 'title', 'editor', 'custom-fields','thumbnail', 'categories', 'excerpt', 'author' ), //Enable Post Thumbnails
			'taxonomies' => array( 'category', 'post_tag' ),
		)
	);
}

// Noindex Endorser Custom Post Type
function custom_post_type_noindex() {
    // Check if it's a single post of your custom post type
    if (is_singular('endorser')) {
        echo '<meta name="robots" content="noindex">';
    }
}

add_action('wp_head', 'custom_post_type_noindex');


function enable_custom_post_type_excerpt() {
    add_post_type_support('endorser', 'excerpt');
}
add_action('init', 'enable_custom_post_type_excerpt');

/**
 * Enqueue scripts and styles.
 */

function enqueue_slick_slider() {
    // Slick styles
    wp_enqueue_style('slick-style', get_template_directory_uri() . '/slick/slick.css');
    wp_enqueue_style('slick-theme-style', get_template_directory_uri() . '/slick/slick-theme.css');

    // Slick scripts
    wp_enqueue_script('slick-js', get_template_directory_uri() . '/slick/slick.min.js', array('jquery'), '', true);

    // Your custom script, if you want to add custom slick slider initialization
    wp_enqueue_script('custom-slick-init', get_template_directory_uri() . '/js/custom-slick-init.js', array('jquery', 'slick-js'), '', true);
}
add_action('wp_enqueue_scripts', 'enqueue_slick_slider');

// Add Child Theme Stylesheet Support
function add_all_stylesheets()
{
	// wp_enqueue_style('slick-style', get_template_directory_uri() . '/lib/slick-slider/slick/slick.css');
	// wp_enqueue_style('slick-theme-style', get_template_directory_uri() . '/lib/slick-slider/slick/slick-theme.css');
	wp_enqueue_style('bgg-custom-styles', get_template_directory_uri() . '/css/scss/style.css');
}
add_action('wp_enqueue_scripts', 'add_all_stylesheets', 200); // 200 is the order - load after parent main.css

// Add Child Theme JS Support
function extras_script()
{
	// wp_register_script('slick-jquery-1', '//code.jquery.com/jquery-1.11.0.min.js', '', '', true);
	// wp_register_script('slick-jquery-2', '//code.jquery.com/jquery-migrate-1.2.1.min.js', '', '', true);
	// wp_register_script('slick_script', get_template_directory_uri() . '/lib/slick-slider/slick/slick.min.js', '', '', true);
    // wp_register_script('slider_settings', get_template_directory_uri() . '/js/slider-settings.js', '', '', true);
    wp_register_script('main_script', get_template_directory_uri() . '/js/scripts.js', '', '', true);
    // wp_register_script('font_awesome_script', '//kit.fontawesome.com/a5221f2a14.js', '', '', true);
    
	// Enque Scripts
	// wp_enqueue_script('slick_script');
    wp_enqueue_script('slider_settings');
	// wp_enqueue_script('scroll_script');
	wp_enqueue_script('main_script');
	wp_enqueue_script('font_awesome_script');
}

add_action('wp_enqueue_scripts', 'extras_script');

require_once get_template_directory() . '/inc/template-tags.php';
require_once( get_template_directory() . '/inc/functions-defaults.php' );
require_once( get_template_directory() . '/inc/functions-acf.php' );


// Add Font Awesome
// -----------------------------

add_action('wp_head', 'add_font_awesome');
function add_font_awesome(){
?>
	<script src="https://kit.fontawesome.com/a5221f2a14.js" crossorigin="anonymous"></script>
<?php
};

// Add Custom Widgets
// -----------------------------
function custom_widgets_init() {
	
	// Sidebar Widget
    register_sidebar( array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

	// Thank You Page Widget
	register_sidebar( array(
		'name'          => 'Thank You Page',
		'id'            => 'thank_you_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Top Footer Widget
	register_sidebar( array(
        'name'          => 'Top Footer',
        'id'            => 'top_footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

	// Products - Child
	register_sidebar( array(
		'name'          => 'Products Child - Sidebar',
		'id'            => 'products_child',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Blog - Category - Mid CTA
	register_sidebar( array(
		'name'          => 'Blog Category Middle CTA',
		'id'            => 'blog_category_mid_cta',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Category Page - Bottom
	register_sidebar( array(
		'name'          => 'Category Page Bottom',
		'id'            => 'category_page_bottom',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Decom Template - Sidebar
	register_sidebar( array(
		'name'          => 'No Header Template Sidebar',
		'id'            => 'no_header_template',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer - Contact
	register_sidebar( array(
		'name'          => 'Footer - Contact',
		'id'            => 'footer_contact',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer - Purchases
	register_sidebar( array(
		'name'          => 'Footer - Purchases',
		'id'            => 'footer_purchases',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer - Col 2
	register_sidebar( array(
		'name'          => 'Footer - Col 2',
		'id'            => 'footer_col_2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer - Col 3
	register_sidebar( array(
		'name'          => 'Footer - Col 3',
		'id'            => 'footer_col_3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer - Col 4
	register_sidebar( array(
		'name'          => 'Footer - Col 4',
		'id'            => 'footer_col_4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer - Col 5
	register_sidebar( array(
		'name'          => 'Footer - Col 5',
		'id'            => 'footer_col_5',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer - Social
	register_sidebar( array(
		'name'          => 'Footer - Social',
		'id'            => 'footer_social',
		'before_widget' => '<div id="%1$s" class="widget %2$s mf-social">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer - Bottom
	register_sidebar( array(
		'name'          => 'Footer - Bottom',
		'id'            => 'footer_bottom',
		'before_widget' => '<div id="%1$s" class="widget %2$s mf-bottom">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	// Footer - Request Info Kit
	register_sidebar( array(
		'name'          => 'Footer - Request Bar',
		'id'            => 'footer_request_bar',
		'before_widget' => '<div id="%1$s" class="widget %2$s mf-request-bar">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'custom_widgets_init' );

// Add Breadcrumbs
// -----------------------------
function custom_breadcrumbs() {
    global $post;

    echo '<div class="breadcrumbs">';
    echo '<ul>';

    // Home link
    echo '<li><a href="' . home_url() . '">Home</a></li>';

    // Custom Post Type: Product products
    if (is_singular('products')) {
        // Product Page
        echo '<li><a href="/gold-silver">Gold and Silver</a></li>';

        // Product Category Page
        $product_categories = get_the_terms($post->ID, 'product_categories');
        if ($product_categories && !is_wp_error($product_categories)) {
            $product_category = array_shift($product_categories);
            echo '<li><a href="' . get_term_link($product_category) . '">' . $product_category->name . '</a></li>';
        }

        // Product Single Page
        echo '<li>';
        the_title();
        echo '</li>';
    } elseif (is_single()) {
        // Category
        $categories = get_the_category($post->ID);
        if ($categories) {
            $category = array_shift($categories);
            echo '<li><a href="' . get_category_link($category) . '">' . $category->name . '</a></li>';
        }
        // Single Post
        echo '<li>';
        the_title();
        echo '</li>';
    } elseif (is_page() && $post->post_parent) {
        // Parent Page
        echo '<li><a href="' . get_permalink($post->post_parent) . '">' . get_the_title($post->post_parent) . '</a></li>';
        // Current Page
        echo '<li>';
        the_title();
        echo '</li>';
    } elseif (is_page()) {
        // Single Page
        echo '<li>';
        the_title();
        echo '</li>';
    } elseif (is_category() || is_tag()) {
        // Category or Tag
        echo '<li>';
        single_term_title();
        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
}

// Adjust Excerpt
// -----------------------------
function custom_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'custom_excerpt_more');

// Limit "The Content" word count
function custom_excerpt($limit) {
    $content = get_the_content();
    $content = strip_shortcodes($content); // Remove shortcodes
    $content = strip_tags($content); // Remove HTML tags
    $words = explode(' ', $content, $limit + 1);

    if (count($words) > $limit) {
        array_pop($words);
        $content = implode(' ', $words);
        $content = $content . '...';
    }

    echo $content;
}

// Limit "The Content" character count
function limit_content_to_character_count($content, $limit) {
    // Trim content to a certain number of words
    $trimmed_content = wp_trim_words($content, $limit);

    // Further limit to the desired character count
    $limited_content = substr($trimmed_content, 0, $limit);

	// Add ellipses (...) if the content was trimmed
	if (mb_strlen($content) > mb_strlen($limited_content)) {
		$limited_content .= '...';
	}

    return $limited_content;
}

// Add a custom filter to modify the main query
function custom_recipe_filter($query) {
    // Check if it's the main query and if it's on the front end
    if ($query->is_main_query() && !is_admin()) {
        // Check if the query is for the 'recipe' post type (replace with your actual post type)
        if (is_post_type_archive('products')) {
            // Get the selected categories (replace 'category1' and 'category2' with your actual category slugs)
            $category1 = isset($_GET['gold']) ? sanitize_text_field($_GET['gold']) : '';
            $category2 = isset($_GET['bullion']) ? sanitize_text_field($_GET['bullion']) : '';

            // Define the tax query
            $tax_query = array('relation' => 'AND');

            if ($category1) {
                $tax_query[] = array(
                    'taxonomy' => 'gold', // Replace with your taxonomy slug
                    'field'    => 'slug',
                    'terms'    => $category1,
                );
            }

            if ($category2) {
                $tax_query[] = array(
                    'taxonomy' => 'bullion', // Replace with your taxonomy slug
                    'field'    => 'slug',
                    'terms'    => $category2,
                );
            }

            // Add the tax query to the main query
            $query->set('tax_query', $tax_query);
        }
    }
}

// Hook the filter function into the pre_get_posts action
add_action('pre_get_posts', 'custom_recipe_filter');


// Velocify integration - CTA 2 -Home Page Hero Section Form
add_action( 'gform_after_submission_10', 'post_to_velocify', 10, 2 );
function post_to_velocify( $entry, $form ) {
    $post_url = 'https://secure.velocify.com/Import.aspx?Provider=Unbounce&Client=BirchGoldGroup&CampaignId=1027&xmlresponse=true';
    $body = array(
		// 'Provider' => 'GravityForms',
		// 'Client' => 'BirchGoldGroup',
		// 'CampaignId' => '1027',
		'first_name' => rgar( $entry, '10' ),
		'last_name' => rgar( $entry, '9' ),
		'email' => rgar( $entry, '7' ),
		'phone' => rgar( $entry, '6' ),
		);

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, $post_url );
    curl_setopt( $ch, CURLOPT_POST, true );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query( $body ) );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    $response = curl_exec( $ch );
    curl_close( $ch );
}