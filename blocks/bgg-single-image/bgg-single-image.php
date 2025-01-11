<?php
/**
 * Single Image Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'single-image-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-single-image';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block full-image my-xl-75 my-30">

    <code>BGG - Single Image</code>

    <?php if( get_field( 'bggb_si_image' ) ): ?>
        <div class="single-image-wrap fi-wrap">
            <img src="<?php the_field( 'bggb_si_image' ); ?>" alt="<?php the_field( 'bggb_si_image' )['alt']; ?>">
        </div>
    <?php endif; ?>

</section>