<?php
/**
 * Product Specs Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'product-specs-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-product-specs';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block specifications-section my-xl-50 my-30 py-sm-50 py-30">
    <div class="block-container product-specs-container container">
        <div class="ss-top pb-md-15 mb-md-50 mb-30">

            <code>BGG - Product Specs</code>

            <!-- Start Title Container -->
            <div class="title-container">
                <h4 class="h4 mb-30">Specifications</h4>
            </div>
            <!-- End Title Container -->

            <!-- Start Spec Details Repeater -->
            <div class="row">
                <?php if( get_field( 'bggb_ps_specs_repeater' ) ): ?>
                    <?php while( have_rows( 'bggb_ps_specs_repeater' ) ) : the_row(); ?>
                        <!-- Start Spec Details Container -->
                        <div class="spec-details-container cell-sm-6 mb-30">
                            <?php the_sub_field( 'bggb_ps_spec_details' ); ?>
                        </div>
                        <!-- End Spec Details Container -->
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <!-- End Spec Details Repeater -->
        
        </div>

        <?php if( get_field( 'bggb_ps_specs_repeater' ) ): ?>
            <!-- Start Note Container -->
            <div class="note-container">
                <?php the_field( 'bggb_ps_block_text' ); ?>
            </div>
            <!-- End Note Container -->
        <?php endif; ?>

    </div>
</section>