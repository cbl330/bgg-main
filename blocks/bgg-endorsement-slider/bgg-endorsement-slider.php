<?php
/**
 * Endorsement Slider Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'endorsement-slider-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-endorsement-slider';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
$card_slide = get_field( 'bggb_endorsement_slider' );
?>

<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block endorsed-section pb-xl-75 pb-md-30">

    <code>BGG - Endorsement Slider</code>

    <?php 
        // $post_id = get_queried_object_id(); // Get the ID of the current page/post
        // $post_id = get_the_ID(); 
    ?>

    <?php if( get_field( 'bggb_endorsement_slider_title' ) ): ?>
        <!-- Start Section Header -->
        <div class="container es-head text-center">
            <h6 class="h6"><?php the_field( 'bggb_endorsement_slider_title' ); ?></h6>
        </div>
        <!-- End Section Header -->
    <?php endif; ?>

    <!-- Start Endorsement Wrap -->
    <div class="es-wrap">
        <div class="es-block-wrap">

            <?php foreach( get_field( 'bggb_endorsement_slider' ) as $card ):
                $title = get_the_title( $card -> ID );
                $post_image = get_the_post_thumbnail( $card -> ID );
                $excerpt = get_the_excerpt( $card -> ID );
                $permalink = get_the_permalink( $card -> ID );
                $content = get_the_content( $card -> ID );
                $original_content = get_the_excerpt( $card -> ID );
                $limited_content = limit_content_to_character_count($original_content, 170);
                // $post_id = get_queried_object_id(); // Get the ID of the current page/post
                // $post_id = get_the_ID( $card -> ID );
                // $related_post_id = $post -> ID;
                $post_id = $card -> ID;
            ?>

                    <?php //if( get_field( 'cpt_endorser_link_option', $post_id ) == 'endorser' ): ?>
                        <!-- Start Endorser - If Endorser toggle is active -->
                        <!-- <a href="<?php //echo $permalink; ?>" target="_blank"> -->
                    <?php //endif; ?>

                    <?php //if( get_field( 'cpt_endorser_link_option', $post_id ) == 'custom' ): ?>
                        <!-- Start Endorser - If Custom toggle is active -->
                        <!-- <a href="<?php //the_field( 'cpt_endorser_custom_link', $post_id ); ?>" target="_blank"> -->
                    <?php //endif; ?>

                    <?php //if( get_field( 'cpt_endorser_link_option', $post_id ) == 'none' ): ?>
                        <!-- Start Endorser - If None toggle is active -->
                        <!-- <a href="#"> -->
                    <?php //endif; ?>

                        <div class="es-block">
                            <div class="es-img"><?php echo $post_image; ?></div>
                            <div class="es-tooltip">
                                <h6 class="h6"><?php echo $title; ?></h6>
                                <?php the_field( 'cpt_endorser_summary', $post_id ); ?>
                            </div>
                        </div>
                    <!-- </a> -->

            <?php endforeach; ?>

        </div>
    </div>
    <!-- End Endorsement Wrap -->

</section>