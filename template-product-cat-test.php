<?php
/**
 * Template Name: Product Category - Product Cats Test
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

get_header(); 

    // Global Category Variables
    $category = get_queried_object(); // Get category
    $category_name = $category->name; // Display the category name:
    $category_id = $category->term_id; // If you want to get the category ID:
    $category_description = $category->description; // If you want to get the category description:
    $category_slug = $category->slug; // If you want to get the category slug:
?>

<!-- Start Secondary Menu -->
<div class="page-scroll-menu">
    <div class="container">               
        <div class="psm-slider">
            <div class="psm-item <?php echo empty($_GET['category']) ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(add_query_arg('category', 'all')); ?>">All</a>
            </div>
            <div class="psm-item <?php echo isset($_GET['category']) && $_GET['category'] === 'gold' ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(add_query_arg('category', 'gold')); ?>">Gold</a>
            </div>
            <div class="psm-item <?php echo isset($_GET['category']) && $_GET['category'] === 'silver' ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(add_query_arg('category', 'silver')); ?>">Silver</a>
            </div>
            <div class="psm-item <?php echo isset($_GET['category']) && $_GET['category'] === 'platinum' ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(add_query_arg('category', 'platinum')); ?>">Platinum</a>
            </div>
            <div class="psm-item <?php echo isset($_GET['category']) && $_GET['category'] === 'palladium' ? 'active' : ''; ?>">
                <a href="<?php echo esc_url(add_query_arg('category', 'palladium')); ?>">Palladium</a>
            </div>
            <!-- Add more category options as needed -->
        </div>
    </div>
</div>
<!-- End Secondary Menu -->

<!-- Start Tertiary Menu -->
<div class="products-filter mb-sm-30 mb-15">
    <div class="pf-slider">
        <div class="psm-item <?php echo empty($_GET['tertiary_category']) ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'all')); ?>">All</a>
        </div>
        <div class="psm-item <?php echo isset($_GET['tertiary_category']) && $_GET['tertiary_category'] === 'ira_approved' ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'ira_approved')); ?>">IRA Approved</a>
        </div>
        <div class="psm-item <?php echo isset($_GET['tertiary_category']) && $_GET['tertiary_category'] === 'bullion' ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'bullion')); ?>">Bullion</a>
        </div>
        <div class="psm-item <?php echo isset($_GET['tertiary_category']) && $_GET['tertiary_category'] === 'numismatic' ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'numismatic')); ?>">Numismatic</a>
        </div>
        <div class="psm-item <?php echo isset($_GET['tertiary_category']) && $_GET['tertiary_category'] === 'proof' ? 'active' : ''; ?>">
            <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'proof')); ?>">Proof</a>
        </div>
    </div>
</div>
<!-- End Tertiary Menu -->

<div class="row products-block-row products-desktop">

<?php //Start Product Loop - Desktop ?>

<?php
// Get the selected categories from the secondary and tertiary menus
$selected_secondary_category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'all';
$selected_tertiary_category = isset($_GET['tertiary_category']) ? sanitize_text_field($_GET['tertiary_category']) : 'all';

// Custom Query for Product Artic
$products_args_desktop = array(
    'post_type' => 'products', // Specify the post type
    'orderby' => 'title',    // Order by post title
    'order' => 'ASC',         // Sort in ascending order (A to Z)
    'posts_per_page' => 20,   // You can change this to the number of posts you want to display
    'paged' => $paged,
    'tax_query' => array(),   // Initialize tax query array
);

// Add tax queries based on selected categories
if ($selected_secondary_category !== 'all') {
    $products_args_desktop['tax_query'][] = array(
        'taxonomy' => 'product_categories', // Your custom taxonomy name
        'field'    => 'slug',
        'terms'    => $selected_secondary_category,
    );
}

if ($selected_tertiary_category !== 'all') {
    $products_args_desktop['tax_query'][] = array(
        'taxonomy' => 'product_categories', // Your custom taxonomy name
        'field'    => 'slug',
        'terms'    => $selected_tertiary_category,
    );
}

// Set relation to 'AND' to ensure both conditions are met
$products_args_desktop['tax_query']['relation'] = 'AND';

$products_query_desktop = new WP_Query($products_args_desktop);

if ($products_query_desktop->have_posts()) :
    while ($products_query_desktop->have_posts()) : $products_query_desktop->the_post();
        $title = get_the_title();
        $post_image = get_the_post_thumbnail();
        $excerpt = get_the_excerpt();
        $permalink = get_permalink();
?>
        <!-- Start Article -->
        <article class="cell-lg-3 cell-md-4 cell-6 mb-15 products-block-cell products-cat">
            <div class="products-block">

                <?php if (has_term('IRA-Approved', 'product_categories')) : ?>
                    <!-- Start Ribbon Wrap -->
                    <div class="pl-ribbon">IRA Eligible</div>
                    <!-- End Robbon Wrap -->
                <?php endif; ?>

                <!-- Featured Image -->
                <div class="pl-img">
                    <a class="title-link" href="<?php echo esc_url($permalink); ?>"><?php echo $post_image; ?></a>
                </div>

                <!-- Product Content -->
                <div class="product-content-wrap pl-content">
                    <!-- Title -->
                    <a class="image-link" href="<?php echo esc_url($permalink); ?>"><h5 class="h5"><?php echo esc_html($title); ?></h5></a>
                    <!-- Excerpt -->
                    <div><?php echo esc_html($excerpt); ?></div>
                    <!-- Button -->
                    <a href="<?php echo esc_url($permalink); ?>" class="btn-link pt-30">Read More</a>
                </div>
            </div>
        </article>
        <!-- End Article -->
<?php
    endwhile;

    wp_reset_postdata();  // Reset the custom query loop
else :
    echo '<p>No products found.</p>';
endif;
?>


<?php //End Product Loop - Desktop ?>
</div>

<?php
get_footer();
