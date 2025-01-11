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
$id = 'block-quote-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-block-quote';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block">
    <div class="block-container block-quote-container">

        <code>BGG - Block Quote</code>

        <?php if( get_field( 'bggb_bq_text' ) ): ?>
            <!-- Start Quote Container -->
            <blockquote class="quote-container">
                <?php the_field( 'bggb_bq_text' ); ?>
            </blockquote>
            <!-- End Quote Container -->
        <?php endif; ?>
        
    </div>
</div>