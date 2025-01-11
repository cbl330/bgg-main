<?php
/**
 * Template Name: Product Archive
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
            <div class="container">
                <?php wp_nav_menu( array( 'theme_location' => 'products-secondary' ) ); ?>
            </div>
        </div>
        <!-- End Page Scroll Menu -->

        <main class="main-content">
            <div class="container">

                <!-- Start Breadcrumbs -->
                <?php custom_breadcrumbs(); ?>
                <!-- End Breadcrumbs -->

                <!-- Start Header Section -->
                <div class="mb-xl-50 mb-30">
                    <!-- Page Title -->
                    <h1 class="h1"><?php the_title(); ?></h1>
                    <!-- Top Page Excerpt -->
                    <?php if( get_field( 'bgg_page_option_top_page_content' ) ): ?>
                        <div>
                            <?php the_field( 'bgg_page_option_top_page_content' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- End Header Section -->

                <!-- Start Tertiary Menu -->
                <div class="products-filter mb-sm-30 mb-15">
                    <?php wp_nav_menu( array( 'theme_location' => 'products-tertiary' ) ); ?>
                </div>
                <!-- End Tertiary Menu -->
                
                <?php the_content(); ?>

            </div>
        </main>

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

