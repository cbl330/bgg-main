<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <div class="entry-content">

            <div class="wrapper">
                <div class="main-container">
                    
                    <!-- Start Hero Section -->
                    <section class="hero-section">
                        <!-- Start Hero Logo Container - Tablet/Mobile -->
                        <div class="container">
                            <div class="hs-bottom hs-device-logo d-flex">
                                <?php while( have_rows( 'bggc_hero_logo_repeater' ) ) : the_row(); ?>
                                    <div class="hs-logo">
                                        <?php if( get_sub_field( 'bggc_hero_logo_link' ) ): ?><a href="<?php the_sub_field( 'bggc_hero_logo_link' ); ?>" target="_blank" class="logo-link"><?php endif; ?>
                                            <img src="<?php the_sub_field( 'bggc_hero_logos' ); ?>" alt="<?php the_sub_field( 'bggc_hero_logos' )['alt']; ?>">
                                        <?php if( get_sub_field( 'bggc_hero_logo_link' ) ): ?></a><?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <!-- End Hero Logo Container - Tablet/Mobile -->

                        <!-- Start Hero Container -->
                        <div class="hs-top d-flex">
                            <div class="hs-bg-wrap">
                                <!-- Start Hero Background Image - Desktop -->
                                <?php if( get_field( 'bggc_hero_background_image_desktop' ) ): ?>
                                    <picture class="hs-bg">
                                        <!-- <source media="(min-width:1200px)" srcset="<?php the_field( 'bggc_hero_background_image_desktop' ); ?>"> -->
                                        <source media="(min-width:768px)" srcset="<?php the_field( 'bggc_hero_background_image_desktop' ); ?>">
                                        <img src="<?php the_field( 'bggc_hero_background_image_mobile' ); ?>" alt="<?php the_field( 'bggc_hero_background_image_mobile' )['alt']; ?>">
                                    </picture>
                                <?php endif; ?>
                                <!-- End Hero Background - Desktop -->

                                <!-- Start Hero Content Container - Tablet/Mobile -->
                                <div class="container">
                                    <?php if( have_rows( 'bggc_hero_content' ) ): ?>
                                        <?php while( have_rows( 'bggc_hero_content' ) ) : the_row(); ?>
                                            <div class="hs-content">
                                                <!-- Hero Sub -->
                                                <?php if( get_sub_field( 'bggc_hero_cg_sub_head' ) ): ?>
                                                    <small class="eyebrow-text"><?php the_sub_field( 'bggc_hero_cg_sub_head' ); ?></small>
                                                <?php endif; ?>
                                                <!-- Hero Header -->
                                                <?php if( get_sub_field( 'bggc_hero_cg_title' ) ): ?>
                                                    <div><?php the_sub_field( 'bggc_hero_cg_title' ); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                                <!-- End Hero Content Container - Tablet/Mobile -->

                                <!-- Start Hero Background Image - Cutout -->
                                <?php if( get_field( 'hero_background_cutout_mobile' ) ): ?>
                                    <div class="hs-person-device-img">
                                        <img src="<?php the_field( 'hero_background_cutout_mobile' ); ?>" alt="<?php the_field( 'hero_background_cutout_mobile' )['alt']; ?>">
                                    </div>
                                <?php endif; ?>
                                <!-- End Hero Background Image - Cutout -->
                            </div>

                            <div class="container">
                                <div class="row">

                                    <!-- Start Hero Content - Desktop -->
                                    <div class="cell-xl-8 hs-content-wrap">
                                        <?php if( have_rows( 'bggc_hero_content' ) ): ?>
                                            <?php while( have_rows( 'bggc_hero_content' ) ) : the_row(); ?>
                                                <div class="hs-content">
                                                    <!-- Hero Sub -->
                                                    <?php if( get_sub_field( 'bggc_hero_cg_sub_head' ) ): ?>
                                                        <small class="eyebrow-text"><?php the_sub_field( 'bggc_hero_cg_sub_head' ); ?></small>
                                                    <?php endif; ?>
                                                    <!-- Hero Header -->
                                                    <?php if( get_sub_field( 'bggc_hero_cg_title' ) ): ?>
                                                        <div><?php the_sub_field( 'bggc_hero_cg_title' ); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                    <!-- End Hero Content - Desktop -->

                                    <!-- Start Hero Form -->
                                    <div class="cell-xl-4 hs-form-wrap">
                                        <div class="hs-form">
                                        <?php the_field( 'bggc_hero_form' ); ?>
                                            <div class="form-note-wrap">
                                                <div class="p">By submitting this form, you agree to receive automated text messages. This agreement is not a condition of any purchases. Msg & Data rates may apply. Reply STOP at any time to unsubscribe.</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Hero Form -->

                                </div>
                            </div>
                            <!-- End Hero Container - Tablet/Desktop -->

                        </div>
                        <!-- End Hero Container -->

                        <!-- Start Hero Logo Container - Desktop -->
                        <div class="container hs-bottom-wrap">
                            <div class="hs-bottom d-flex">
                                <?php while( have_rows( 'bggc_hero_logo_repeater' ) ) : the_row(); ?>
                                    <div class="hs-logo">
                                        <?php if( get_sub_field( 'bggc_hero_logo_link' ) ): ?><a href="<?php the_sub_field( 'bggc_hero_logo_link' ); ?>" target="_blank" class="logo-link"><?php endif; ?>
                                            <img src="<?php the_sub_field( 'bggc_hero_logos' ); ?>" alt="<?php the_sub_field( 'bggc_hero_logos' )['alt']; ?>">
                                        <?php if( get_sub_field( 'bggc_hero_logo_link' ) ): ?></a><?php endif; ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                        <!-- End Hero Logo Container - Desktop -->
                    </section>
                    <!-- End Hero Section -->

                    <!-- Start Page Builder Section -->
                    <section class="main-content">
                        <?php
                            // Start The loop
                            if (have_posts()) :
                                while (have_posts()) : the_post();
                                    the_content();
                                endwhile;
                            endif;
                            // End The Loop
                        ?>
                    </section>
                    <!-- End Page Builder Section -->
                </div>
            </div>

        </div>
    </main>
</div>

<?php
get_footer();