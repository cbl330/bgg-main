<?php
/**
 * Key Takeaways Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'key-takeaways-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-key-takeaways';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block key-takeaways my-50">
    <div class="block-container key-takeaways-container kt-wrap py-xl-50 py-30">

        <code>BGG - Key Takeaway</code>

        <div class="container">

            <?php if( get_field( 'bggb_kta_title' ) ): ?>
                <!-- Start Title Wrap -->
                <h4 class="block-title"><?php the_field( 'bggb_kta_title' ); ?></h4>
                <!-- End Title Wrap -->
            <?php endif; ?>

            <?php if( get_field( 'bggb_kta_text' ) ): ?>
                <!-- Start List Container Container -->
                <?php the_field( 'bggb_kta_text' ); ?>
                <!-- End List Container Container -->
            <?php endif; ?>

        </div>

    </div>
</section>