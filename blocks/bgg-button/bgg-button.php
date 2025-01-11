<?php
/**
 * BGG WYSIWYG Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'bgg-wysiwyg-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-bgg-wysiwyg';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block full-button">
    
    <code>BGG - Button</code>

    <?php if( get_field( 'bggb_button_text' ) && get_field( 'bggb_button_link' ) ): ?>
        <a href="<?php the_field( 'bggb_button_link' ); ?>" class="btn w-full"><?php the_field( 'bggb_button_text' ); ?></a>
    <?php endif; ?>
</section>