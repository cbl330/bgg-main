<?php
/**
 * Template Name: Product Category Filtering - TEST
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
    $current_category = get_queried_object();
?>

<div class="wrapper">
    <div class="main-container">

        <!-- Start Secondary Menu -->
        <div class="page-scroll-menu">
            <div class="container">
                <div class="menu-products-secondary-menu-container"></div>
                    <ul id="menu-products-secondary-menu" class="menu">
                        <!-- Filter: All -->
                        <li class="psm-item <?php echo empty($_GET['category']) ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(add_query_arg('category', 'all')); ?>">All</a>
                        </li>
                        <!-- Filter: Gold -->
                        <li class="psm-item <?php echo isset($_GET['category']) && $_GET['category'] === 'gold' ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(add_query_arg('category', 'gold')); ?>">Gold</a>
                        </li>
                        <!-- Filter: Silver -->
                        <li class="psm-item <?php echo isset($_GET['category']) && $_GET['category'] === 'silver' ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(add_query_arg('category', 'silver')); ?>">Silver</a>
                        </li>
                        <!-- Filter: Platinum -->
                        <li class="psm-item <?php echo isset($_GET['category']) && $_GET['category'] === 'platinum' ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(add_query_arg('category', 'platinum')); ?>">Platinum</a>
                        </li>
                        <!-- Filter: Palladium -->
                        <li class="psm-item <?php echo isset($_GET['category']) && $_GET['category'] === 'palladium' ? 'active' : ''; ?>">
                            <a href="<?php echo esc_url(add_query_arg('category', 'palladium')); ?>">Palladium</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Secondary Menu -->

        <main class="main-content pb-50">
            
            <!-- Start Page Header Section -->
            <div class="container">

                <!-- Start Breadcrumbs -->
                <?php custom_breadcrumbs(); ?>
                <!-- End Breadcrumbs -->

                <!-- Start Header Section -->
                <div class="mb-xl-50 mb-30">
                    <!-- Page Title -->
                    <!-- <h1 class="h1"><?php //echo $category_name; ?></h1> -->
                    <h1 class="h1"><?php the_title(); ?></h1>
                    <!-- Top Page Excerpt -->
                    <div>
                        <?php //echo $category_description; ?>
                        <?php the_field( 'bgg_page_option_top_page_content' ); ?>
                    </div>
                </div>
                <!-- End Header Section -->

                <!-- Start Tertiary Menu -->
                <div class="products-filter mb-sm-30 mb-15">
                    <div class="menu-products-tertiary-menu-container">
                        <ul id="menu-products-tertiary-menu" class="pf-slider">
                            <!-- Filter: All -->
                            <li class="pf-item <?php echo empty($_GET['tertiary_category']) ? 'active' : ''; ?>">
                                <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'all')); ?>">All</a>
                            </li>
                            <!-- Filter: IRA Approved -->
                            <li class="pf-item <?php echo isset($_GET['tertiary_category']) && $_GET['tertiary_category'] === 'ira_approved' ? 'active' : ''; ?>">
                                <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'ira_approved')); ?>">IRA Approved</a>
                            </li>
                            <!-- Filter: Bullion -->
                            <li class="pf-item <?php echo isset($_GET['tertiary_category']) && $_GET['tertiary_category'] === 'bullion' ? 'active' : ''; ?>">
                                <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'bullion')); ?>">Bullion</a>
                            </li>
                            <!-- Filter: Numismatic -->
                            <li class="pf-item <?php echo isset($_GET['tertiary_category']) && $_GET['tertiary_category'] === 'numismatic' ? 'active' : ''; ?>">
                                <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'numismatic')); ?>">Numismatic</a>
                            </li>
                            <!-- Filter: Proof -->
                            <li class="pf-item <?php echo isset($_GET['tertiary_category']) && $_GET['tertiary_category'] === 'proof' ? 'active' : ''; ?>">
                                <a href="<?php echo esc_url(add_query_arg('tertiary_category', 'proof')); ?>">Proof</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- End Tertiary Menu -->

            </div>
            <!-- End Page Header Section -->

            <!-- Start Product Listing Section -->
            <section class="products-listing py-15">
                <div class="container">
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
                                    $limited_excerpt = limit_content_to_character_count($excerpt, 125);
                            ?>
                                <!-- Start Article -->
                                <article class="cell-lg-3 cell-md-4 cell-6 mb-15 products-block-cell products-cat">
                                    <div class="products-block">

                                        <?php if( has_term( 'IRA-Approved', 'product_categories' ) ) : ?>
                                            <!-- Start Ribbon Wrap -->
                                            <div class="pl-ribbon">IRA Eligible</div>
                                            <!-- End Robbon Wrap -->
                                        <?php endif; ?>

                                        <!-- Featured Image -->
                                        <div class="pl-img">
                                            <a class="title-link" href="<?php echo esc_html( $permalink ); ?>"><?php echo $post_image; ?></a>
                                        </div>

                                        <!-- Product Content -->
                                        <div class="product-content-wrap pl-content">
                                            <!-- Title -->
                                            <a class="image-link" href="<?php echo esc_html( $permalink ); ?>"><h5 class="h5"><?php echo esc_html( $title ); ?></h5></a>
                                            <!-- Excerpt -->
                                            <!-- <div><?php //echo esc_html( $excerpt ); ?></div> -->
                                            <div class="excerpt"><?php echo esc_html( $limited_excerpt ); ?></div>
                                            <!-- Button -->
                                            <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link pt-30">Read More</a>
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

                    <div class="row products-block-row products-mobile">
                        <?php //Start Product Loop - Desktop ?>
                        <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            // Custom Query for Product Artic
                            $products_args_mobile = array(
                                'post_type' => 'products',
                                // 'category__in' => array( $category_id ),
                                'posts_per_page' => 10,  // You can change this to the number of posts you want to display
                                'paged' => $paged,
                                'orderby' => 'title',    // Order by post title
                                'order' => 'ASC',         // Sort in ascending order (A to Z)
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_categories', // Your custom taxonomy name
                                        'field'    => 'slug',
                                        'terms'    => 'bullion',
                                    ),
                                ),
                            );

                            $products_query_mobile = new WP_Query($products_args_mobile);

                            if ($products_query_mobile->have_posts()) :
                                while ($products_query_mobile->have_posts()) : $products_query_mobile->the_post();
                                $title = get_the_title();
                                $post_image = get_the_post_thumbnail();
                                $excerpt = get_the_excerpt();
                                $categories = get_the_category();
                                $permalink = get_permalink();
                                $limited_excerpt = limit_content_to_character_count($excerpt, 125);
                            ?>

                                <!-- Start Article -->
                                <article class="cell-lg-3 cell-md-4 cell-6 mb-15 products-block-cell products-cat">
                                    <div class="products-block">

                                        <?php if( has_term( 'IRA-Approved', 'product_categories' ) ) : ?>
                                            <!-- Start Ribbon Wrap -->
                                            <div class="pl-ribbon">IRA Eligible</div>
                                            <!-- End Robbon Wrap -->
                                        <?php endif; ?>

                                        <!-- Featured Image -->
                                        <div class="pl-img">
                                            <?php echo $post_image; ?>
                                        </div>

                                        <!-- Product Content -->
                                        <div class="pl-content product-content-wrap">
                                            <!-- Title -->
                                            <h5 class="h5"><?php echo esc_html( $title ); ?></h5>
                                            <!-- Excerpt -->
                                            <!-- <div><?php //echo esc_html( $excerpt ); ?></div> -->
                                            <!-- <div class="excerpt"><?php //echo esc_html( $limited_excerpt ); ?></div> -->
                                            <!-- Button -->
                                            <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                                        </div>
                                    </div>
                                </article>
                                <!-- End Article -->

                            <?php
                                endwhile;

                                wp_reset_postdata();  // Reset the main query loop

                                else :
                                echo '<p>No products found.</p>';
                                endif;
                            ?>
                        <?php //End Product Loop - Desktop ?>

                    </div>

                    <?php 
                        $content = get_the_content();
                        if (!empty($content)) :
                    ?>
                        <div class="page-builder">
                            <?php echo $content; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </section>
            <!-- End Product Listing Section -->

        </main>

        <!-- Start Footer CTA Section -->
        <?php if ( is_active_sidebar( 'products_category' ) ) : ?>
            <?php dynamic_sidebar( 'products_category' ); ?>
        <?php endif; ?>
        <!-- End Footer CTA Section -->
        
    </div>
</div>

<?php
get_footer();
