<?php
/**
 * Template for child categories of "Blog"
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
                <?php wp_nav_menu( array( 'theme_location' => 'posts-secondary' ) ); ?>
            </div>
        </div>
        <!-- End Page Scroll Menu -->

        <!-- Start Breadcrumbs -->
        <div class="container">
            <?php custom_breadcrumbs(); ?>
        </div>
        <!-- End Breadcrumbs -->

        <main class="main-content">
            <!-- Start Blog Listing Section - Top Row -->
            <section class="blog-listing-category blog-listing">
                <div class="container">

                    <!-- Start Header Section -->
                    <div class="mb-xl-50 mb-30">
                        <!-- Page Title -->
                        <h1 class="h1"><?php echo $category_name; ?></h1>
                        <!-- Top Page Excerpt -->
                        <div>
                            <?php echo $category_description; ?>
                        </div>
                    </div>
                    <!-- End Header Section -->

                    <!-- Start Blog Listing Contianer - Top Row -->
                    <div class="row justify-content-center">

                        <?php //Start Article Loop ?>
                            <?php
                                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                // Custom Query for Top Row Articles
                                $articles_args = array(
                                    'posts_per_page' => 16,  // You can change this to the number of posts you want to display
                                    'post_status' => 'publish',
                                    'category_name' => $category_name,
                                    'paged' => $paged,
                                );

                                $articles_query = new WP_Query($articles_args);

                                if ($articles_query->have_posts()) :
                                    while ($articles_query->have_posts()) : $articles_query->the_post();
                                    $title = get_the_title();
                                    $post_image = get_the_post_thumbnail();
                                    $excerpt = get_the_excerpt();
                                    $categories = get_the_category();
                                    $permalink = get_permalink();
                                ?>

                                <!-- Start Article -->

                                <a class="article-link" href="<?php echo esc_html( $permalink ); ?>">
                                    <article class="article-wrap cat-article-wrap cell-lg-3 cell-md-4 cell-sm-6 mb-30">
                                        <!-- Featured Image -->
                                        <div class="bl-img">
                                            <?php echo $post_image; ?>
                                        </div>

                                        <div class="article-content-wrap bl-content">
                                            <!-- Categories -->
                                            <?php foreach( $categories as $category ): ?>
                                                <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                                            <?php endforeach; ?>
                                            <!-- Title -->
                                            <h4 class="h4"><?php echo esc_html( $title ); ?></h4>
                                            <!-- Excerpt -->
                                            <div class="excerpt"><?php echo esc_html( $excerpt ); ?></div>
                                            <!-- Button -->
                                            <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link pt-15">Read More</a>
                                        </div>
                                    </article>
                                </a>

                                <!-- <article class="cell-lg-3 cell-md-4 cell-sm-6 mb-30"> -->
                                    
                                    <!-- Start Featured Image Wrap -->
                                    <!-- <div class="bl-img">
                                        <?php //echo $post_image; ?>
                                    </div> -->
                                    <!-- End Featured Image Wrap -->

                                    <!-- Start Content Wrap -->
                                    <!-- <div class="bl-content"> -->
                                        <!-- Categories -->
                                        <!-- <?php //foreach( $categories as $category ): ?>
                                            <small class="eyebrow-text -small"><?php //echo esc_html( $category->cat_name ); ?></small>
                                        <?php //endforeach; ?> -->
                                        <!-- Title -->
                                        <!-- <h4 class="h4"><?php //echo esc_html( $title ); ?></h4> -->
                                        <!-- Excerpt -->
                                        <!-- <div><?php //echo esc_html( $excerpt ); ?></div> -->
                                        <!-- Button -->
                                        <!-- <a href="<?php //echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                                    </div> -->
                                    <!-- End Content Wrap -->

                                <!-- </article> -->
                                <!-- End Article -->

                                <?php if( $articles_query->current_post == 7 ): ?>
                                    <!-- Start Middle CTA Section -->
                                    <?php if ( is_active_sidebar( 'blog_category_mid_cta' ) ) : ?>
                                        <?php dynamic_sidebar( 'blog_category_mid_cta' ); ?>
                                    <?php endif; ?>
                                    <!-- End Middle CTA Section -->
                                <?php endif; ?>

                            <?php
                                endwhile;

                                wp_reset_postdata();  // Reset the main query loop

                                else :
                                echo '<p>No articles found.</p>';
                                endif;
                            ?>
                        <?php //End Product Loop ?>

                    </div>
                    <!-- End Blog Listing Container - Top Row -->

                </div>
            </section>
            <!-- End Blog Listing Section - Top Row -->

            <!-- Start Pagination -->
            <?php
            // Check if there's more than one page
            global $wp_query;

            $total_pages = $wp_query->max_num_pages;

            if ($total_pages > 1) :
            ?>
                <div class="pagination py-md-30 py-15">
                    <div class="container">
                        <ul>
                            <li><span>Page</span></li>
                            <li class="page-numbers"><?php echo paginate_links(array(
                                'total' => $total_pages,
                                'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#e4a933}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>',
                                'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#e4a933}</style><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>',
                            )); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
            <!-- End Pagination -->

            <!-- Start Footer CTA Section -->
            <?php if ( is_active_sidebar( 'category_page_bottom' ) ) : ?>
                <?php dynamic_sidebar( 'category_page_bottom' ); ?>
            <?php endif; ?>
            <!-- End Footer CTA Section -->
        </main>
        
    </div>
</div>

<?php
get_footer();
