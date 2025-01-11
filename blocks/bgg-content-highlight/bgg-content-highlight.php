<?php
/**
 * Content Highlight Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'content-highlight-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-content-highlight';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block bg-primary-200 my-xl-75 my-30 py-xl-50 py-30">
    <div class="block-container content-highlight-container container">

        <code>BGG - Content Highlight</code>

            <!-- Start Content Container -->
            <div class="content-container">
                <?php if( get_field( 'bggb_ch_sub_head' ) ): ?>
                    <!-- Subhead Wrap -->
                    <div class="subhead-wrap">
                        <small class="subhead eyebrow-text"><?php the_field( 'bggb_ch_sub_head' ); ?></small>
                    </div>
                <?php endif; ?>

                <?php if( get_field( 'bggb_ch_content' ) ): ?>
                    <!-- Content Wrap -->
                    <div class="content-wrap">
                        <?php the_field( 'bggb_ch_content' ); ?>
                    </div>
                <?php endif; ?>

                <?php if( get_field( 'bggb_ch_button_text' ) && get_field ( 'bggb_ch_button_link' ) ): ?>
                    <!-- Button Wrap -->
                    <div class="button-wrap">
                        <a href="<?php the_field( 'bggb_ch_button_link' ); ?>" class="btn w-full mt-xl-30 mt-15"><?php the_field( 'bggb_ch_button_text' ); ?></a>
                    </div>
                <?php endif; ?>

            </div>
            <!-- End Content Container -->
        
    </div>
</section>