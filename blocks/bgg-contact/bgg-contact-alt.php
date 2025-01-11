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


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block">
    <div class="block-container contact-container">

        <code>BGG - Contact</code>

        <!-- Start Temporary Block Title -->
        <code>bgg Contact - BLOCK</code>
        <!-- End Temporary Block Title -->

        <?php if( get_field( 'bggp_contact_us_contact_info_group' ) ): ?>
            <?php while( have_rows( 'bggp_contact_us_contact_info_group' ) ) : the_row(); ?>

                <!-- Start Header Container -->
                <div class="title-container">
                    <h4 class="title">Contact</h4>
                </div>
                <!-- End Header Container -->

                <!-- Start Content Container -->
                <div class="content-container row">
                    <!-- Left Column -->
                    <div class="left-column col-6">
                        <div class="column-container">
                            
                            <?php if( get_sub_field( 'bggp_contact_us_location' ) ): ?>
                                <div class="content-wrap row">
                                    <i class="fa-solid fa-location-dot col-2"></i>
                                    <div class="content-wrap col-10">
                                        <?php the_sub_field( 'bggp_contact_us_location' ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <?php if( get_sub_field( 'bggp_contact_us_hours_of_operation' ) ): ?>
                                <div class="content-wrap row">
                                    <i class="fa-regular fa-clock col-2"></i>
                                    <div class="content-wrap col-10">
                                        <?php the_sub_field( 'bggp_contact_us_hours_of_operation' ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- Right Columnb -->
                    <div class="right-column col-6">
                        <div class="column-container">

                            <?php if( get_sub_field( 'bggp_contact_us_phone' ) ): ?>
                                <!-- Phone -->
                                <div class="content-wrap row">
                                    <i class="fa-solid fa-phone col-2"></i>
                                    <a class="contact-wrap col-10" href="#"><?php the_sub_field( 'bggp_contact_us_phone' ); ?></a>
                                </div>
                            <?php endif; ?>

                            <?php if( get_sub_field( 'bggp_contact_us_fax' ) ): ?>
                                <!-- FAX -->
                                <div class="content-wrap row">
                                    <i class="fa-solid fa-fax col-2"></i>
                                    <a class="contact-wrap col-10" href="#"><?php the_sub_field( 'bggp_contact_us_fax' ); ?></a>
                                </div>
                            <?php endif; ?>

                            <?php if( get_sub_field( 'bggp_contact_us_email' ) ): ?>
                                <!-- Email -->
                                <div class="content-wrap row">
                                <i class="fa-solid fa-envelope col-2"></i>
                                    <a class="contact-wrap col-10" href="#"><?php the_sub_field( 'bggp_contact_us_email' ); ?></a>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <!-- End Content Container -->

            <?php endwhile ?>
        <?php endif; ?>

        <?php if( get_field( 'bggp_contact_us_contact_purchases_group' ) ): ?>
            <?php while( have_rows( 'bggp_contact_us_contact_purchases_group' ) ) : the_row(); ?>

                <!-- Start Header Container -->
                <div class="title-container">
                    <h4 class="title">For Purchases</h4>
                </div>
                <!-- End Header Container -->

                <!-- Start Content Container -->
                <div class="content-container row">
                    <!-- Left Column -->
                    <div class="left-column col-6">
                        <div class="column-container">
                            
                            <?php if( get_sub_field( 'bggp_contact_us_check_payments' ) ): ?>
                                <div class="content-wrap row">
                                    <i class="fa-solid fa-location-dot col-2"></i>
                                    <div class="content-wrap col-10">
                                        <?php the_sub_field( 'bggp_contact_us_check_payments' ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- Right Columnb -->
                    <div class="right-column col-6">
                        <div class="column-container">

                            <?php if( get_sub_field( 'bggp_contact_us_supporting_docs' ) ): ?>
                                <div class="content-wrap row">
                                    <i class="fa-regular fa-clock col-2"></i>
                                    <div class="content-wrap col-10">
                                        <?php the_sub_field( 'bggp_contact_us_supporting_docs' ); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
                <!-- End Content Container -->

            <?php endwhile ?>
        <?php endif; ?>

    </div>
</div>