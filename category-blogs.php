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
                <?php wp_nav_menu( array( 'theme_location' => 'products-secondary' ) ); ?>
            </div>
        </div>
        <!-- End Page Scroll Menu -->

        <!-- Start Breadcrumbs -->
        <?php custom_breadcrumbs(); ?>
        <!-- End Breadcrumbs -->

        <main class="main-content">
            <!-- Start Blog Listing Section - Top Row -->
            <section class="blog-listing-category">
                <div class="container">

                    <!-- Start Header Section -->
                    <div class="mb-xl-50 mb-30">
                        <!-- Page Title -->
                        <h1 class="h1"><?php the_title(); ?></h1>
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
                                // Custom Query for Top Row Articles
                                $articles_top_row_args = array(
                                    'posts_per_page' => 8,  // You can change this to the number of posts you want to display
                                    'post_status' => 'publish',
                                    'category_name' => $category_name,
                                );

                                $articles_top_row_query = new WP_Query($articles_top_row_args);

                                if ($articles_top_row_query->have_posts()) :
                                    while ($articles_top_row_query->have_posts()) : $articles_top_row_query->the_post();
                                    $title = get_the_title();
                                    $post_image = get_the_post_thumbnail();
                                    $excerpt = get_the_excerpt();
                                    $categories = get_the_category();
                                    $permalink = get_permalink();
                                ?>

                                <!-- Start Article -->

                                <article class="cell-lg-3 cell-md-4 cell-sm-6 mb-30">
                                    
                                    <!-- Start Featured Image Wrap -->
                                    <div class="bl-img">
                                        <?php echo $post_image; ?>
                                    </div>
                                    <!-- End Featured Image Wrap -->

                                    <!-- Start Content Wrap -->
                                    <div class="bl-content">
                                        <!-- Categories -->
                                        <?php foreach( $categories as $category ): ?>
                                            <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                                        <?php endforeach; ?>
                                        <!-- Title -->
                                        <h4 class="h4"><?php echo esc_html( $title ); ?></h4>
                                        <!-- Excerpt -->
                                        <div><?php echo esc_html( $excerpt ); ?></div>
                                        <!-- Button -->
                                        <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                                    </div>
                                    <!-- End Content Wrap -->

                                </article>
                                <!-- End Article -->

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

            <!-- Start Middle CTA Section -->
            <section class="newsletter-section my-md-50 my-30">
                <div class="container">
                    <div class="ns-wrap">
                        
                        <div class="ns-bg">
                            <img src="source/images/newsletter-bg.jpg" alt="newsletter-bg">
                        </div>

                        <div class="container">
                            <div class="row ns-main-row">

                                <div class="cell-xl-7 d-flex ns-left">
                                    <div class="row">
                                        <div class="cell-xl-6 cell-lg-9 cell-md-8 cell-sm-7 d-flex align-items-center pb-sm-50 pb-30 pt-lg-50 pt-30 ns-content">
                                            <div class="ns-bell-icon mb-15">
                                                <img src="source/images/bell-notification.png" alt="bell-notification-img">
                                            </div>
                                            <h2 class="h2">Get Weekly Updates from Birch Gold Group</h2>
                                            <p>Receive our free weekly market updates straight to your inbox.</p>
                                        </div>
                                        <div class="cell-xl-6 cell-lg-3 cell-md-4 cell-sm-5 d-flex align-items-end justify-content-center ns-middle">
                                            <div class="ns-img mr-15">
                                                <img src="source/images/newsletter-mobile.png" alt="newsletter-mobile-img">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="cell-xl-5 d-flex align-items-center pt-50 pb-xl-50 pb-15 ns-right">
                                    <form class="ns-form">
                                        <div class="row">
                                            <div class="cell-sm-6 form-group">
                                                <label for="ns-field-11">First Name</label>
                                                <input type="text" id="ns-field-11">
                                            </div>
                                            <div class="cell-sm-6 form-group">
                                                <label for="ns-field-14">Email Address</label>
                                                <input type="email" id="ns-field-14">
                                            </div>
                                            <div class="cell-12 form-group">
                                                <div class="checkbox">
                                                    <input type="checkbox" name="" id="ns-c11">
                                                    <label for="ns-c11">By checking this box, I have read and agree to Birch Gold Group’s <a href="#">Terms & Conditions</a>.</label>
                                                </div>
                                            </div>
                                            <div class="cell-12 form-group">
                                                <input type="submit" value="Subscribe Now">
                                            </div>
                                            <div class="cell-12 text-center">
                                                <p>By submitting this form, you agree to receive automated text messages. This agreement is not a condition of any purchases. Msg & Data rates may apply. Reply STOP at any time to unsubscribe.</p>
                                            </div>
                                        </div>
                                    </form>
                                </div>    

                            </div> 
                        </div>

                    </div>
                </div>
            </section>
            <!-- End Middle CTA Section -->

            <!-- Start Blog Listing Section - Bottom Row -->
            <section class="blog-listing-category">
                <div class="container">

                    <!-- Start Header Section -->
                    <div class="mb-xl-50 mb-30">
                        <!-- Page Title -->
                        <h1 class="h1"><?php the_title(); ?></h1>
                        <!-- Top Page Excerpt -->
                        <div>
                            <?php echo $category_description; ?>
                        </div>
                    </div>
                    <!-- End Header Section -->

                    <!-- Start Blog Listing Contianer - Bottom Row -->
                    <div class="row justify-content-center">

                        <?php //Start Article Loop ?>
                            <?php            
                                // Custom Query for Top Row Articles
                                $articles_bottom_row_args = array(
                                    'posts_per_page' => 8,  // You can change this to the number of posts you want to display
                                    'post_status' => 'publish',
                                    'category_name' => $category_name,
                                    'offset' => 8,
                                );

                                $articles_bottom_row_query = new WP_Query($articles_bottom_row_args);

                                if ($articles_bottom_row_query->have_posts()) :
                                    while ($articles_bottom_row_query->have_posts()) : $articles_bottom_row_query->the_post();
                                    $title = get_the_title();
                                    $post_image = get_the_post_thumbnail();
                                    $excerpt = get_the_excerpt();
                                    $categories = get_the_category();
                                    $permalink = get_permalink();
                                ?>

                                <!-- Start Article -->

                                <article class="cell-lg-3 cell-md-4 cell-sm-6 mb-30">
                                    
                                    <!-- Start Featured Image Wrap -->
                                    <div class="bl-img">
                                        <?php echo $post_image; ?>
                                    </div>
                                    <!-- End Featured Image Wrap -->

                                    <!-- Start Content Wrap -->
                                    <div class="bl-content">
                                        <!-- Categories -->
                                        <?php foreach( $categories as $category ): ?>
                                            <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                                        <?php endforeach; ?>
                                        <!-- Title -->
                                        <h4 class="h4"><?php echo esc_html( $title ); ?></h4>
                                        <!-- Excerpt -->
                                        <div><?php echo esc_html( $excerpt ); ?></div>
                                        <!-- Button -->
                                        <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                                    </div>
                                    <!-- End Content Wrap -->

                                </article>
                                <!-- End Article -->

                            <?php
                                endwhile;

                                wp_reset_postdata();  // Reset the main query loop

                                else :
                                echo '<p>No articles found.</p>';
                                endif;
                            ?>
                        <?php //End Product Loop ?>

                    </div>
                    <!-- End Blog Listing Container - Bottom Row -->

                </div>
            </section>
            <!-- End Blog Listing Section - Bottom Row -->

            <!-- Start Footer CTA Section -->
            <?php if ( is_active_sidebar( 'blogs_category_bottom' ) ) : ?>
                <?php dynamic_sidebar( 'blogs_category_bottom' ); ?>
            <?php endif; ?>
            <!-- End Footer CTA Section -->
        </main>
        
    </div>
</div>

<?php
get_footer();
