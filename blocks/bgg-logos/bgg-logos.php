<?php
/**
 * Logo Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'logo-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-logo';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block about-logos mb-xl-50">
    <div class="block-container logos-container al-wrap container d-flex">

        <code>BGG - Logos</code>

        <?php if( get_field( 'bggb_logos_repeater' ) ): ?>
            <?php while( have_rows( 'bggb_logos_repeater' ) ) : the_row(); ?>
                <!-- Start Logo Container -->
                <div class="logo-container al-logo">
                    <?php if( get_sub_field( 'bggb_logo_link' ) ): ?><a href="<?php the_sub_field( 'bggb_logo_link' ); ?>" class="logo-link"><?php endif; ?>
                        <img class="logo-wrap" src="<?php the_sub_field( 'bggb_logo' ); ?>" alt="<?php the_sub_field( 'bggb_logo' )['alt']; ?>">
                    <?php if( get_sub_field( 'bggb_logo_link' ) ): ?></a><?php endif; ?>
                </div>
                <!-- End Logo Container -->
            <?php endwhile; ?>
        <?php endif; ?>
        
    </div>
</section>