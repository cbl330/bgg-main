<?php
/**
 * Contact - Contact Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'contact-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-contact';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block contact-us pb-xl-75 pb-50">
    <div class="block-container contact-container">
        <div class="row">

            <code>BGG - Contact</code>

            <!-- Start Content Container -->
            <div class="cell-lg-5 cu-left cu-content-container">
                <div class="row">
                
                    <?php if( get_field( 'bggp_contact_us_contact_info_group' ) ): ?>
                        <?php while( have_rows( 'bggp_contact_us_contact_info_group' ) ) : the_row(); ?>
                            <!-- Start Contact Container -->
                            <div class="cell-sm-12">
                                <div class="cu-left-line mb-30">
                                    <!-- Container Title -->
                                    <strong class="cu-title">Contact</strong> 
                                    <div class="row mb-15">
                                        <div class="cell-sm-6">

                                            <?php if( get_sub_field( 'bggp_contact_us_location' ) ): ?>
                                                <!-- Start Address Wrap -->
                                                <div class="cu-left-block d-flex flex-nowrap">
                                                    <i class="icon-pin"></i>
                                                    <address>
                                                        <?php the_sub_field( 'bggp_contact_us_location' ); ?>
                                                    </address>
                                                </div>
                                                <!-- End Address Wrap -->
                                            <?php endif; ?>
                                            
                                            <?php if( get_sub_field( 'bggp_contact_us_hours_of_operation' ) ): ?>
                                                <!-- Start Hours Wrap -->
                                                <div class="cu-left-block d-flex flex-nowrap">
                                                    <i class="icon-clock"></i>
                                                    <div>
                                                        <?php the_sub_field( 'bggp_contact_us_hours_of_operation' ); ?>
                                                    </div>
                                                </div>
                                                <!-- End Hours Wrap -->
                                            <?php endif; ?>

                                        </div>

                                        <div class="cell-sm-6">
                                            <?php if( get_sub_field( 'bggp_contact_us_phone' ) ): ?>
                                                <!-- Start Phone Wrap -->
                                                <div class="cu-left-block d-flex flex-nowrap">
                                                    <i class="icon-call1"></i>
                                                    <a href="tel:<?php the_sub_field( 'bggp_contact_us_phone' ); ?>"><?php the_sub_field( 'bggp_contact_us_phone' ); ?></a>
                                                </div>
                                                <!-- End Phone Wrap -->
                                            <?php endif; ?>

                                            <?php if( get_sub_field( 'bggp_contact_us_fax' ) ): ?>
                                                <!-- Start Fax Wrap -->
                                                <div class="cu-left-block d-flex flex-nowrap">
                                                    <i class="icon-fax"></i>
                                                    <a href="tel:<?php the_sub_field( 'bggp_contact_us_fax' ); ?>"><?php the_sub_field( 'bggp_contact_us_fax' ); ?></a>
                                                </div>
                                                <!-- End Fax Wrap -->
                                            <?php endif; ?>

                                            <?php if( get_sub_field( 'bggp_contact_us_email' ) ): ?>
                                                <!-- Start Email Wrap -->
                                                <div class="cu-left-block d-flex flex-nowrap">
                                                    <i class="icon-mail"></i>
                                                    <a href="mailto:<?php the_sub_field( 'bggp_contact_us_email' ); ?>"><?php the_sub_field( 'bggp_contact_us_email' ); ?></a>
                                                </div>
                                                <!-- End Email Wrap -->
                                            <?php endif; ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- End Contact Container -->
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <?php if( get_field( 'bggp_contact_us_contact_purchases_group' ) ): ?>
                        <?php while( have_rows( 'bggp_contact_us_contact_purchases_group' ) ) : the_row(); ?>
                            <!-- Start Purchase Container -->
                            <div class="cell-sm-12">
                                <div class="cu-left-line mb-30">
                                    <strong class="cu-title">For Purchases</strong> 
                                    <div class="row mb-15">
                                        
                                        <?php if( get_sub_field( 'bggp_contact_us_check_payments' ) ): ?>
                                            <!-- Start Check Payment Wrap -->
                                            <div class="cell-sm-6">
                                                <div class="cu-left-block d-flex flex-nowrap">
                                                    <i class="icon-post-office"></i>
                                                    <address>
                                                        <?php the_sub_field( 'bggp_contact_us_check_payments' ); ?>
                                                    </address>
                                                </div>
                                            </div>
                                            <!-- End Check Payment Wrap -->
                                        <?php endif; ?>

                                        <?php if( get_sub_field( 'bggp_contact_us_supporting_docs' ) ): ?>
                                            <!-- Start Document Wrap -->
                                            <div class="cell-sm-6">
                                                <div class="cu-left-block d-flex flex-nowrap">
                                                    <i class="icon-document"></i>
                                                    <address>
                                                        <?php the_sub_field( 'bggp_contact_us_supporting_docs' ); ?>
                                                    </address>
                                                </div>
                                            </div>
                                            <!-- End Document Wrap -->
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>
                            <!-- End Purchase Container -->
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <?php if( get_field( 'bggb_contact_social' ) ): ?>
                        <!-- Start Social Container -->
                        <div class="cell-sm-12">
                            <div class="cu-social">
                                <?php the_field( 'bggb_contact_social' ); ?>
                            </div>
                        </div>
                        <!-- End Social Container -->
                    <?php endif; ?>

                </div>
            </div>
            <!-- End Content Container -->

            <?php if( get_field( 'bggb_contact_form' ) ): ?>
                <!-- Start Form Container -->
                <div class="cell-lg-7 mb-lg-0 mb-30 cu-form-container">
                    <div class="cu-form-wrap p-sm-50 p-30">
                        <?php the_field( 'bggb_contact_form' ); ?>
                    </div>
                </div>
                <!-- End Form Container -->
            <?php endif; ?>

        </div>
    </div>
</section>