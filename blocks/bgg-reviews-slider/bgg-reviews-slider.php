<?php
/**
 * Reviews Slider Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'reivews-slider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-reivews-slider';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block customers-reviews py-xl-75 py-md-50 py-30">
    <div class="block-container reivews-slider-container container">

        <code>BGG - Reviews Slider</code>

        <h6 class="h6 text-secondary-100 text-center mb-xl-50 mb-30">Reviews From Satisfied Birch Gold Customers</h6>
        
        <!-- TrustBox widget - Carousel -->
        <div class="trustpilot-widget" data-locale="en-US" data-template-id="53aa8912dec7e10d38f59f36" data-businessunit-id="5197f9b0000064000535361e" data-style-height="141px" data-style-width="100%" data-theme="light" data-stars="4,5" data-review-languages="en" data-text-color="#373737">
            <a href="https://www.trustpilot.com/review/birchgold.com" target="_blank" rel="noopener">Trustpilot</a>
        </div>
        <!-- End TrustBox widget -->
        
    </div>
</section>