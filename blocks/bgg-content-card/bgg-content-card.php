<?php
/**
 * Content Card Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'content-card-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-content-card';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block column-icon-block mt-xl-75 mt-50 mb-xl-15">
    <div class="block-container content-card-container row">

        <code>BGG - Content Card</code>

        <!-- Start Card Container -->
        <div class="cell-sm-12 mb-50">
            
            <?php if( get_field( 'bggb_card_image' ) ): ?>
                <!-- Icon Wrap -->
                <div class="icon-wrap cib-img">
                    <img src="<?php the_field( 'bggb_card_image' ); ?>" alt="<?php the_field( 'bggb_card_image' )['alt']; ?>" class="icon">
                </div>
            <?php endif; ?>

            <?php if( get_field( 'bggb_card_title' ) ): ?>
                <!-- Title Wrap -->
                <div class="title-wrap">
                    <h3 class="title"><?php the_field( 'bggb_card_title' ); ?></h3>
                </div>
            <?php endif; ?>

            <?php if( get_field( 'bggb_card_content' ) ): ?>
                <!-- Body Wrap -->
                <div class="body-wrap">
                    <?php the_field( 'bggb_card_content' ); ?>
                </div>
            <?php endif; ?>
            
        </div>
        <!-- End Card Container -->
        
    </div>
</div>