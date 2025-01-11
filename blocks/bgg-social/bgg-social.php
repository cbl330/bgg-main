<?php
/**
 * Social Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'social-options-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-social-options';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block stay-connected bg-primary-200 my-50">
    <div class="block-container social-options-container container pt-xl-50 pt-30 pb-xl-30 pb-15">

        <code>BGG - Social</code>

        <!-- Start Social Banner -->
        <?php if( get_field( 'bggb_social_title' ) ): ?>
            <div class="title-wrap">
                <h3 class="title h3 text-center mb-30"><?php the_field( "bggb_social_title" ); ?></h3>
            </div>
        <?php endif; ?>

        <?php if( get_field( 'bggb_social_repeater' ) ): ?>
            <div class="social-link-wrap sc-wrap d-flex justify-content-center">
                <?php while( have_rows( 'bggb_social_repeater' ) ) : the_row(); ?>
                    <div class="sc-cell mb-15">
                        
                        <?php if( get_sub_field( 'bggb_social_option_banner_account' ) == 'Facebook' ): ?>
                            <!-- Facebook -->
                            <a class="sc-icon" href="<?php the_sub_field( 'bggb_social_option_banner_link' ); ?>">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        <?php endif; ?>

                        <?php if( get_sub_field( 'bggb_social_option_banner_account' ) == 'Twitter' ): ?>
                            <!-- Twitter -->
                            <a class="sc-icon" href="<?php the_sub_field( 'bggb_social_option_banner_link' ); ?>">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        <?php endif; ?>

                        <?php if( get_sub_field( 'bggb_social_option_banner_account' ) == 'Youtube' ): ?>
                            <!-- YouTube -->
                            <a class="sc-icon" href="<?php the_sub_field( 'bggb_social_option_banner_link' ); ?>">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        <?php endif; ?>

                        <?php if( get_sub_field( 'bggb_social_option_banner_account' ) == 'LinkIn' ): ?>
                            <!-- LinkedIn -->
                            <a class="sc-icon" href="<?php the_sub_field( 'bggb_social_option_banner_link' ); ?>">
                                <i class="fa-brands fa-linkedin"></i>
                            </a>
                        <?php endif; ?>

                        <?php if( get_sub_field( 'bggb_social_option_banner_account' ) == 'Instagram' ): ?>
                            <!-- Instagram -->
                            <a class="sc-icon" href="<?php the_sub_field( 'bggb_social_option_banner_link' ); ?>">
                                <!-- <i class="fa-brands fa-pinterest"></i> -->
                                <i class="fa-brands fa-square-instagram"></i>
                            </a>
                        <?php endif; ?>

                    </div>

                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <!-- End Social Banner -->
        
    </div>
</section>