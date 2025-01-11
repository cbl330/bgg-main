<?php
/**
 * Table of Contents Block Template
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


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block table-contents bg-gray-200 my-30">
    <div class="block-container container">

        <code>BGG - Table of Contents</code>

        <!-- Start TAC Container -->
        <?php if( get_field( 'bggb_toc_title' ) ): ?>
            <h4 class="title tc-head"><?php the_field( 'bggb_toc_title' ); ?></h4>
        <?php endif; ?>

        <?php if( get_field( 'bggb_toc_repeater' ) ): ?>
            <div class="bullet-check tc-row">
                <ul class="tac-wrap row pb-xl-0 pb-15">
                    <?php while( have_rows( 'bggb_toc_repeater' ) ) : the_row(); ?>
                        <li class="content-item cell-sm-6"><a href="<?php the_field( 'bggb_toc_list_item_link' ); ?>"><?php the_sub_field( 'bggb_toc_list' ); ?></a></li>
                    <?php endwhile; ?>
                </ul>
            </div>
        <?php endif; ?>
        <!-- End TAC Container -->
        
    </div>
</section>