<?php
/**
 * Block Quote Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'cta-options-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-cta-options';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}
?>

<?php if( get_field( 'bggb_cta_layout_option_picker' ) == 'Layout Option 1' ): ?>
    <!-- Start CTA Option 1 - Call Us Section -->
    <section  id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> cta-option-1-container call-us-section my-xl-50 my-30 py-xl-50 py-30">

        <code>BGG - CTA Option 1</code>

        <?php if( get_field( 'bggb_opt_one_cta_background_image' ) ): ?>
            <!-- Start Background Image Wrap -->
            <div class="image-background-wrap cu-bg">
                <img src="<?php the_field( 'bggb_opt_one_cta_background_image' ); ?>" alt="<?php the_field( 'bggb_opt_one_cta_background_image' )['alt']; ?>" class="image-background">
            </div>
            <!-- End Background Image Wrap -->
        <?php endif; ?>

        <?php if( get_field( 'bggb_opt_one_cta_content' ) ): ?>
            <!-- Start CTA Content Wrap -->
            <div class="cta-content-wrap container">
                <?php the_field( 'bggb_opt_one_cta_content' ); ?>
            </div>
            <!-- End CTA Content Wrap -->
        <?php endif; ?>

    </section>
    <!-- End CTA Option 1 - Call Us Section -->
<?php endif; ?>

<?php if( get_field( 'bggb_cta_layout_option_picker' ) == 'Layout Option 2' ): ?>
    <!-- Start CTA Option 2 - Request Info Section Gold -->
    <section  id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> request-info mt-md-50 mt-30">
        <div class="cta-option-2-container ri-wrap py-xl-75 py-30">
            <div class="container ri2-container">
                <div class="row flex-row-reverse align-items-center">
                
                    <code>BGG - CTA Option 2</code>
                    
                    <?php if( get_field( 'bggb_opt_two_cta_image' ) ): ?>
                        <!-- Start Image Wrap -->
                        <div class="column-2-wrap cell-lg-4 mb-lg-0 mb-30">
                            <div class="ri-img">
                                <img src="<?php the_field( 'bggb_opt_two_cta_image' ); ?>" alt="<?php the_field( 'bggb_opt_two_cta_image' )['alt']; ?>" class="cta-image">
                            </div>
                        </div>
                        <!-- End Image Wrap -->
                    <?php endif; ?>

                    <!-- Start Form Wrap -->
                    <div class="cell-lg-8">
                        <div class="ri-form">
                            <?php the_field( 'bggb_opt_two_cta_form' ); ?>
                            <!-- <div class="form-note-wrap">
                                <div class="p">By submitting this form, you agree to receive automated text messages. This agreement is not a condition of any purchases. Msg & Data rates may apply. Reply STOP at any time to unsubscribe.</div>
                            </div> -->
                        </div>
                    </div>
                    <!-- End Form Wrap -->

                </div>
            </div>
        </div>
    </section>
    <!-- End CTA Option 2  - Request Info Section Gold -->
<?php endif; ?>

<?php if( get_field( 'bggb_cta_layout_option_picker' ) == 'Layout Option 3' ): ?>
    <!-- Start CTA Option 3 - Request Info Section with Background Image -->
    <section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block request-info mt-md-50 mt-30">
        <div class="cta-option-3-container ri-wrap py-30">

            <code>BGG - CTA Option 3</code>

            <?php if( get_field( 'bggb_opt_three_cta_background_image' ) ): ?>
                <!-- Start Background Image -->
                <div class="background-image-wrap ri-bg">
                    <img src="<?php the_field( 'bggb_opt_three_cta_background_image' ); ?>" alt="<?php the_field( 'bggb_opt_three_cta_background_image' )['alt']; ?>" class="background-image">
                </div>
                <!-- End Background Image -->
            <?php endif; ?>

            <!-- Start CTA Content Container -->
            <div class="cta-content-wrap container">
                <div class="row align-items-center">

                    <div class="cell-lg-6 mb-lg-0 mb-30">
                        <div class="row align-items-center">
                            
                            <?php if( get_field( 'bggb_opt_three_cta_image' ) ): ?>
                                <!-- Start Image Wrap -->
                                <div class="column-1-wrap cell-lg-5 mb-lg-0 mb-30">
                                    <div class="ri-img">
                                        <img src="<?php the_field( 'bggb_opt_three_cta_image' ); ?>" alt="<?php the_field( 'bggb_opt_three_cta_image' )['alt']; ?>" class="cta-image">
                                    </div>
                                </div>
                                <!-- End Image Wrap -->
                            <?php endif; ?>

                            <?php if( get_field( 'bggb_opt_three_cta_content' ) ): ?>
                                <!-- Start Content Wrap -->
                                <div class="column-2-wrap cell-lg-7">
                                    <div class="ri-content">
                                        <?php the_field( 'bggb_opt_three_cta_content' ); ?>
                                    </div>
                                </div>
                                <!-- End Content Wrap -->
                            <?php endif; ?>

                        </div>
                    </div>

                    <?php if( get_field( 'bggb_opt_three_cta_form' ) ): ?>
                        <!-- Start Form Wrap -->
                        <div class="cell-lg-6">
                            <div class="cell-sm-12 form-group">
                                <div class="ri-form">
                                    <!-- Gravity Form -->
                                    <?php the_field( 'bggb_opt_three_cta_form' ); ?>
                                    <!-- Form Footer Note -->
                                    <div class="form-note-wrap">
                                        <div class="p">By submitting this form, you agree to receive automated text messages. This agreement is not a condition of any purchases. Msg & Data rates may apply. Reply STOP at any time to unsubscribe.</div>
                                    </div>
                                </div>
                                <?php if( get_field( 'bggb_opt_three_mobile_device_button_link' ) ): ?>
                                    <!-- Device Button -->
                                    <div class="ri-device-btn">
                                        <a href="<?php the_field( 'bggb_opt_three_mobile_device_button_link' ); ?>" class="btn">Request Free Information Kit</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- End Form Wrap -->
                    <?php endif; ?>

                </div>
            </div>
            <!-- End CTA Content Container -->

        </div>
    </section>
    <!-- End CTA Option 3 - Request Info Section with Background Image -->
<?php endif; ?>

<?php if( get_field( 'bggb_cta_layout_option_picker' ) == 'Layout Option 4' ): ?>
    <!-- Start CTA Option 4 - Newsletter Section -->
    <section  id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> cta-option-4-container newsletter-section my-xl-75 my-md-50 my-30">
        <div class="ns-wrap">

            <code>BGG - CTA Option 4</code>

            <?php if( get_field( 'bggb_opt_four_cta_background_image' ) ): ?>
                <!-- Start Background Image -->
                <div class="ns-bg">
                    <img src="<?php the_field( 'bggb_opt_four_cta_background_image' ); ?>" alt="<?php the_field( 'bggb_opt_four_cta_background_image' )['alt']; ?>" class="background-iamge">
                </div>
                <!-- End Background Image -->
            <?php endif; ?>

            <div class="container">
                <div class="row ns-main-row">

                    <div class="cell-xl-5 d-flex ns-left">
                        <div class="row">

                            <div class="cell-xl-6 cell-lg-9 cell-md-8 cell-sm-7 d-flex align-items-center pb-xl-50 pb-0 pt-xl-50 pt-30 ns-content">
                                <div class="ns-content-inner">
                                    <div class="ns-bell-head">
                                        <div class="ns-bell-icon mb-xl-15 ml-xl-0 ml-15">
                                            <img src="<?php the_field( 'bggb_opt_four_cta_icon' ); ?>" alt="<?php the_field( 'bggb_opt_four_cta_icon' )['alt']; ?>" class="cta-icon">
                                        </div>
                                        <?php if( get_field( 'bggb_opt_four_cta_header' ) ): ?>
                                            <h2 class="h2"><?php the_field( 'bggb_opt_four_cta_header' ); ?></h2>
                                        <?php endif; ?>
                                    </div>
                                    <?php the_field( 'bggb_opt_four_cta_content' ); ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="cell-xl-7 d-flex align-items-center pt-50 pb-xl-50 pb-15 ns-right">
                        <?php the_field( 'bggb_opt_four_cta_form' ); ?>
                        <div class="form-note-wrap text-center">
                            <div class="p">By submitting this form, you agree to receive automated text messages. This agreement is not a condition of any purchases. Msg & Data rates may apply. Reply STOP at any time to unsubscribe.</div>
                        </div>
                    </div> 

                </div> 
            </div>

        </div>
    </section>
    <!-- End CTA Option 4 - Newsletter Section -->
<?php endif; ?>

<?php if( get_field( 'bggb_cta_layout_option_picker' ) == 'Layout Option 5' ): ?>
    <!-- Start CTA Option 5 - Newsletter Section with Asset -->
    <section  id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> cta-option-5-container newsletter-section my-xl-75 my-md-50 my-30">
        <div class="container">
            <div class="ns-wrap">
                
                <code>BGG - CTA Option 5</code>

                <!-- Start Background Image -->
                <?php if( get_field( 'bggb_opt_five_cta_background_image' ) ): ?>
                    <div class="background-image-wrap ns-bg">
                        <img src="<?php the_field( 'bggb_opt_five_cta_background_image' ); ?>" alt="<?php the_field( 'bggb_opt_five_cta_background_image' )['alt']; ?>" class="background-iamge">
                    </div>
                <?php endif; ?>
                <!-- End Background Image --> 

                <!-- Start CTA Content -->
                <?php if( get_field( 'bggb_opt_five_cta_icon' ) || get_field( 'bggb_opt_five_cta_content' ) ): ?>
                    <div class="container">
                        <div class="row ns-main-row">

                            <div class="cell-xl-7 d-flex ns-left">
                                <div class="row">

                                    <div class="cell-xl-6 cell-lg-9 cell-md-8 cell-sm-7 d-flex align-items-center pb-xl-50 pb-0 pt-xl-50 pt-30 ns-content">
                                        <div class="ns-content-inner">
                                            <div class="ns-bell-head">
                                                <div class="ns-bell-icon mb-xl-15 ml-xl-0 ml-15">
                                                    <img src="<?php the_field( 'bggb_opt_five_cta_icon' ); ?>" alt="<?php the_field( 'bggb_opt_five_cta_icon' )['alt']; ?>" class="cta-icon">
                                                </div>
                                                <?php if( get_field( 'bggb_opt_five_cta_header' ) ): ?>
                                                    <h2 class="h2"><?php the_field( 'bggb_opt_five_cta_header' ); ?></h2>
                                                <?php endif; ?>
                                            </div>
                                            <?php the_field( 'bggb_opt_five_cta_content' ); ?>
                                        </div>
                                    </div>

                                    <div class="cell-xl-6 cell-lg-3 cell-md-4 cell-sm-5 d-flex align-items-end justify-content-center ns-middle">
                                        <div class="ns-img mr-15">
                                            <img src="<?php the_field( 'bggb_opt_five_image_asset' ); ?>" alt="<?php the_field( 'bggb_opt_five_image_asset' )['alt']; ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="cell-xl-5 d-flex align-items-center pt-lg-50 pt-30 pb-xl-50 pb-15 ns-right">
                                <?php the_field( 'bggb_opt_five_cta_form' ); ?>
                            </div>

                        </div>
                    </div>
                <?php endif; ?>
                <!-- End CTA Content -->

            </div>
        </div>
    </section>
    <!-- End CTA Option 5 - Newsletter Section with Asset -->
<?php endif ?>