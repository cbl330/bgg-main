<?php
/**
 * FAQ Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'faq-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-faq';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block faq-section my-xl-50 my-30">
    <div class="block-container faq-container">

        <code>BGG - FAQ</code>

        <?php if ( get_field( 'bggb_faq_block_title' ) ): ?>
            <!-- Start Title Container -->
            <h2 class="title h2 mb-xl-50 mb-30"><?php the_field( 'bggb_faq_block_title' ); ?></h2>
            <!-- End Title Container -->
        <?php endif; ?>

        <!-- Start FAQ Container -->
        <div class="accordion faq-wrap">
            <?php
                if ( have_rows( 'bggb_faq_repeater' ) ): 
                // $counter = 1;
            ?>
                <?php while( have_rows( 'bggb_faq_repeater' ) ) : the_row(); ?>
                <?php 
                    $question = get_sub_field('bggb_faq_question');
                    $answer = get_sub_field('bggb_faq_answer');
                ?>

                    <div class="faq-line">
                        <div class="faq-question">
                            <h6><?php echo $question; ?></h6>
                        </div>
                        <div class="faq-answer">
                        <?php echo $answer; ?>
                        </div>
                    </div>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <!-- End FAQ Container -->

    </div>
</section>