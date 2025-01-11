<?php
/**
 * Single Video Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'single-video-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-single-video';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block full-video my-xl-75 my-30">

    <code>BGG - Single Video</code>

    <?php if( get_field( 'bggb_sv_vg_video_link' ) ): ?>
        <a href="<?php the_field( 'bggb_sv_vg_video_link' ); ?>" data-fancybox class="fv-wrap">
            <img src="<?php the_field( 'bggb_sv_video_image_overlay' ); ?>" alt="<?php the_field( 'bggb_sv_video_image_overlay' )['alt']; ?>">
        </a>
    <?php endif; ?>

</section>