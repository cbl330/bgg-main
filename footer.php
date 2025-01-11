<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bgg
 */

?>

        </div><!-- #content -->

            <footer class="main-footer pt-xl-75 pt-50">
                <div class="container">
                    <div class="row">

                        <div class="cell-xxl-6 cell-xl-5 mf-left mb-xl-0 mb-md-15">
                            
                            <a href="<?php echo home_url(); ?>" class="mf-brand mb-md-50 mb-30">
                                <img src="<?php echo get_template_directory_uri(); ?>/images/footer-brand.svg" alt="footer-brand-img">
                            </a>

                            <div class="row">
                                <div class="cell-xl-12 cell-md-6">
                                    <?php if ( is_active_sidebar( 'footer_contact' ) ) : ?>
                                        <?php dynamic_sidebar( 'footer_contact' ); ?>
                                    <?php endif; ?>
                                </div>

                                <div class="cell-xl-12 cell-md-6">
                                    <?php if ( is_active_sidebar( 'footer_purchases' ) ) : ?>
                                        <?php dynamic_sidebar( 'footer_purchases' ); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="cell-xxl-6 cell-xl-7 mf-right">
                            <div class="row">

                                <!-- <div class="cell-lg-4 cell-md-6 mf-menu"> -->
                                <div class="cell-lg-4 mf-menu">
                                    <div class="mf-device-collapse">
                                        <?php if ( is_active_sidebar( 'footer_col_2' ) ) : ?>
                                            <?php dynamic_sidebar( 'footer_col_2' ); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- <div class="cell-lg-4 cell-md-6 mf-menu"> -->
                                <div class="cell-lg-4 mf-menu">
                                    <div class="mf-device-collapse">
                                        <?php if ( is_active_sidebar( 'footer_col_3' ) ) : ?>
                                            <?php dynamic_sidebar( 'footer_col_3' ); ?>
                                        <?php endif; ?>
                                    </div>

                                    <div class="mf-device-collapse">
                                        <?php if ( is_active_sidebar( 'footer_col_4' ) ) : ?>
                                            <?php dynamic_sidebar( 'footer_col_4' ); ?>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="cell-lg-4 mf-menu">
                                    <div class="row">
                                        <!-- <div class="cell-lg-12 cell-md-6"> -->
                                        <div class="cell-lg-12">
                                            <div class="mf-device-collapse">
                                                <?php if ( is_active_sidebar( 'footer_col_5' ) ) : ?>
                                                    <?php dynamic_sidebar( 'footer_col_5' ); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- <div class="cell-lg-12 cell-md-6"> -->
                                        <div class="cell-lg-12">
                                            <?php if ( is_active_sidebar( 'footer_social' ) ) : ?>
                                                <?php dynamic_sidebar( 'footer_social' ); ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Start Footer Bottom -->
                    <?php if ( is_active_sidebar( 'footer_bottom' ) ) : ?>
                        <?php dynamic_sidebar( 'footer_bottom' ); ?>
                    <?php endif; ?>
                    <!-- End Footer Bottom -->

                </div>

                <!-- Start Footer Bottom -->
                <?php if ( is_active_sidebar( 'footer_request_bar' ) ) : ?>
                    <?php dynamic_sidebar( 'footer_request_bar' ); ?>
                <?php endif; ?>
                <!-- End Footer Bottom -->

            </footer>


        </div><!-- #page -->

        <?php wp_footer(); ?>
    </body>
</html>