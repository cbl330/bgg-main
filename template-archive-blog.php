<?php
/**
 * Template Name: Blog Archive
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

get_header(); ?>

    <div class="wrapper">
        <div class="main-container">

            <!-- Start Page Scroll Menu -->
            <div class="page-scroll-menu">
                <div class="container menu-scroll">
                    <?php wp_nav_menu( array( 'theme_location' => 'posts-secondary' ) ); ?>
                </div>
            </div>
            <!-- End Page Scroll Menu -->

            <!-- Start Featured Section -->
            <section class="blog-parent-hero mb-30 id-section" id="all">
                <div class="container">

                    <!-- Start Breadcrumbs -->
                    <?php custom_breadcrumbs(); ?>
                    <!-- End Breadcrumbs -->

                    <h1 class="h1">Featured Posts</h1>

                    <div class="row">

                        <?php //Start Featured Post Loop ?>
                        <?php
                            // Custom Query for First Featured Post
                            $featured_args = array(
                                'posts_per_page' => 1,  // You can change this to the number of posts you want to display
                                'post_status' => 'publish'
                            );

                            $featured_query = new WP_Query($featured_args);

                            if ($featured_query->have_posts()) :
                                while ($featured_query->have_posts()) : $featured_query->the_post();
                                $title = get_the_title();
                                $post_image = get_the_post_thumbnail();
                                $excerpt = get_the_excerpt();
                                $categories = get_the_category();
                                $permalink = get_permalink();
                        ?>

                            <article class="cell-xl-8 mb-xl-0 mb-30">
                                <div class="bph-block">

                                    <!-- Start Featured Image -->
                                    <div class="bph-bg">
                                        <?php echo $post_image; ?>
                                    </div>
                                    <!-- End Featured Image -->

                                    <!-- Start Post Content -->
                                    <div class="bph-content">
                                        <div class="text-white-all">
                                            <!-- Category -->
                                            <?php foreach( $categories as $category ): ?>
                                                <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                                            <?php endforeach; ?>
                                            <!-- Title -->
                                            <a class="article-link" href="<?php echo esc_html( $permalink ); ?>">
                                                <h2><?php echo esc_html( $title ); ?></h2>
                                            </a>
                                            <!-- Excerpt -->
                                            <div><?php echo esc_html( $excerpt ); ?></div>
                                        </div>
                                        <!-- Button -->
                                        <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                                    </div>
                                    <!-- End Post Content -->

                                </div>
                            </article>
                            <!-- End Main Featured Article -->

                        <?php
                            endwhile;

                            wp_reset_postdata();  // Reset the main query loop

                            else :
                            echo '<p>No news articles found.</p>';
                            endif;
                        ?>
                        <?php //End Featured Post Loop ?>

                        <div class="cell-xl-4">
                            <?php //Start Featured Sub Post Loop ?>
                            <?php
                                // Custom Query for Sub Featured Post
                                $featured_sub_args = array(
                                    'posts_per_page' => 3,  // You can change this to the number of posts you want to display
                                    'post_status' => 'publish',
                                    'offset' => 1
                                );

                                $featured_sub_query = new WP_Query($featured_sub_args);

                                if ($featured_sub_query->have_posts()) :
                                    while ($featured_sub_query->have_posts()) : $featured_sub_query->the_post();
                                    $title = get_the_title();
                                    $post_image = get_the_post_thumbnail();
                                    $excerpt = get_the_excerpt();
                                    $categories = get_the_category();
                                    $permalink = get_permalink();
                            ?>

                                <article class="bph-line d-flex flex-nowrap">
                                    <!-- <div class="bph-line d-flex flex-nowrap"> -->
                                        
                                        <!-- Start Featured Image -->
                                        <div class="bph-line-img">
                                            <?php echo $post_image; ?>
                                        </div>
                                        <!-- End Featured image -->

                                        <!-- Start Article Content -->
                                        <div class="bph-line-wrap">
                                            <!-- Categories -->
                                            <?php foreach( $categories as $category ): ?>
                                                    <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                                                <?php endforeach; ?>
                                            <!-- Title -->
                                            <a class="article-link" href="<?php echo esc_html( $permalink ); ?>">
                                                <h6 class="h6"><?php echo esc_html( $title ); ?></h6>
                                            </a>
                                            <!-- Button -->
                                            <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                                        </div>
                                        <!-- End Article Content -->

                                    <!-- </div> -->
                                </article>
                                <!-- End Main Featured Article -->

                            <?php
                                endwhile;

                                wp_reset_postdata();  // Reset the main query loop

                                else :
                                echo '<p>No news articles found.</p>';
                                endif;
                            ?>
                            <?php //End Featured Sub Post Loop ?>
                        </div>


                    </div>
                </div>
            </section>
            <!-- End Featured Section -->

            <!-- Start Main Section -->
            <main class="main-content">
                <?php the_content(); ?>
            </main>
            <!-- End Main Section -->

            <?php if( get_field( 'bgg_template_sidebar_footer_cta_display' ) === 'Show' ) : ?>
				<!-- Start Footer CTA Section -->
				<?php if ( is_active_sidebar( 'top_footer' ) ) : ?>
					<?php dynamic_sidebar( 'top_footer' ); ?>
				<?php endif; ?>
				<!-- End Footer CTA Section -->
			<?php endif; ?>
        </div>
    </div>

<?php
get_footer();
