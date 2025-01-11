<?php
/**
 * Template Name: Product Category - IRA Eligible
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

        <!-- Start Page Scroll Menu -->
        <div class="page-scroll-menu">
            <div class="container menu-scroll">
                <?php wp_nav_menu( array( 'theme_location' => 'products-secondary' ) ); ?>
            </div>
        </div>
        <!-- End Page Scroll Menu -->

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
                    <div class="row products-block-row products-desktop">

                        <?php //Start Product Loop - Desktop ?>
                        <?php
                            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                            // Custom Query for Product Artic
                            $products_args_desktop = array(
                                'post_type' => 'products',
                                // 'category__in' => array( $category_id ),
                                'orderby' => 'title',    // Order by post title
                                'order' => 'ASC',         // Sort in ascending order (A to Z)
                                'posts_per_page' => 20,  // You can change this to the number of posts you want to display
                                'paged' => $paged,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_categories', // Your custom taxonomy name
                                        // 'taxonomy' => 'precious-metals', // Your custom taxonomy name
                                        'field'    => 'slug',
                                        // 'terms'    => $category_id,
                                        'terms'    => 'ira_approved',
                                    ),
                                ),
                            );

                            $products_query_desktop = new WP_Query($products_args_desktop);

                            if ($products_query_desktop->have_posts()) :
                                while ($products_query_desktop->have_posts()) : $products_query_desktop->the_post();
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
                                // wp_reset_query();     // Reset the main query loop

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
                                        'terms'    => 'ira_approved',
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

            <!-- Start Pagination -->
            <!-- <div class="pagination pt-md-15 pb-md-30 pb-15 products-desktop">
                <div class="container">
                    <ul>
                        <li><span>Page</span></li>
                        <li class="page-numbers"><?php //echo paginate_links( array( 
                            //'total' => $products_query_desktop->max_num_pages,
                            //'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#e4a933}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>',
                            //'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#e4a933}</style><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>',
                            //) ); ?>
                        </li>
                    </ul>
                </div>
            </div> -->
            <!-- End Pagination -->

            <!-- Start Pagination -->
            <!-- <div class="pagination pt-md-15 pb-md-30 pb-15 products-mobile">
                <div class="container">
                    <ul>
                        <li><span>Page</span></li>
                        <li class="page-numbers"><?php //echo paginate_links( array( 
                            //'total' => $products_query_mobile->max_num_pages,
                            //'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#e4a933}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>',
                            //'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#e4a933}</style><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>',
                            //) ); ?>
                        </li>
                    </ul>
                </div>
            </div> -->
            <!-- End Pagination -->

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
