<?php
/**
 * Template for child categories of "Product"
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

get_header(); 

    // Global Category Variables
    $category = get_queried_object(); // Get category
    $category_name = $category->name; // If you want to get the category ID:
    $category_id = $category->term_id; // If you want to get the category description:
    $category_description = $category->description; // If you want to get the category slug:
    $category_slug = $category->slug; // Display the category name:
?>

<div class="wrapper">
    <div class="main-container">

        <!-- Start Page Scroll Menu -->
        <div class="page-scroll-menu">
            <div class="container menu-scroll">
                <?php wp_nav_menu( array( 'theme_location' => 'products-secondary' ) ); ?>
            </div>
        </div>
        <!-- End Page Scroll Menu -->

        <main class="main-content">
            
            <!-- Start Page Header Section -->
            <div class="container">

                <!-- Start Breadcrumbs -->
                <?php custom_breadcrumbs(); ?>
                <!-- End Breadcrumbs -->

                <!-- Start Header Section -->
                <div class="mb-xl-50 mb-30">
                    <!-- Page Title -->
                    <h1 class="h1"><?php the_title(); ?></h1>
                    <!-- Top Page Excerpt -->
                    <?php //if( get_field( 'bgg_page_option_top_page_content' ) ): ?>
                        <div>
                            <?php echo $category_description; ?>
                        </div>
                    <?php //endif; ?>
                </div>
                <!-- End Header Section -->

                <!-- Start Tertiary Menu -->
                <div class="products-filter mb-30">
                    <div class="products-filter-inner">
                        <?php wp_nav_menu( array( 'theme_location' => 'products-tertiary' ) ); ?>
                    </div>
                </div>
                <!-- End Tertiary Menu -->

            </div>
            <!-- End Page Header Section -->

            <!-- Start Product Listing Section -->
            <section class="products-listing py-15">
                <div class="container">
                    <div class="row products-block-row">

                        <?php //Start Product Loop ?>
                        <?php            
                            // Custom Query for Product Articles
                            $products_args = array(
                                'posts_per_page' => 20,  // You can change this to the number of posts you want to display
                                'post_status' => 'publish',
                                'category_name' => $category_name,

                            );

                            $products_query = new WP_Query($products_args);

                            if ($products_query->have_posts()) :
                                while ($products_query->have_posts()) : $products_query->the_post();
                                $title = get_the_title();
                                $post_image = get_the_post_thumbnail();
                                $excerpt = get_the_excerpt();
                                $categories = get_the_category();
                                $permalink = get_permalink();
                            ?>

                                <!-- Start Article -->
                                <article class="cell-lg-3 cell-md-4 cell-sm-6 mb-15 products-block-cell">
                                    <div class="product-block">

                                        <?php if( get_field( 'bggb_product_options_product_eligibility' ) ): ?>
                                            <!-- Start Ribbon Wrap -->
                                            <div class="pl-ribbon">IRA Eligible</div>
                                            <!-- End Robbon Wrap -->
                                        <?php endif; ?>

                                        <!-- Featured Image -->
                                        <div class="pl-img">
                                            <?php echo $post_image; ?>
                                        </div>

                                        <!-- Product Content -->
                                        <div class="pl-content">
                                            <!-- Title -->
                                            <h5 class="h5"><?php echo esc_html( $title ); ?></h5>
                                            <!-- Excerpt -->
                                            <div><?php echo esc_html( $excerpt ); ?></div>
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
                        <?php //End Product Loop ?>

                    </div>
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
