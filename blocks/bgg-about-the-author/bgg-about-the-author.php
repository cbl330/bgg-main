<?php
/**
 * About the Author Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'author-block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-author-block';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block author-section my-30">
    <div class="block-container author-block-container as-wrap">

        <code>BGG - About the Author</code>

        <!-- Start Avatar Wrap -->
        <div class="avatar-wrap as-img">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?>
        </div>
        <!-- End Avatar Wrap -->

        <!-- Start COntent Wrap -->
        <div class="content-wrap as-content">
            <h4 class="title">About The Author</h4>
            <div class="content"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a> <?php echo nl2br( esc_textarea( get_the_author_meta( 'description' ) ) ); ?></div>
        </div>
        <!-- End COntent Wrap -->
        
    </div>
</section>