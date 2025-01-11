
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


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block  id-section">
    <!-- <div class="container"> -->

        <code>BGG - Sidebar Posts</code>

        <?php 
            // Get Selected Category
            $cat = get_field( 'bggb_posts_selector' );
        ?>

        <!-- Start Section Title -->
        <!-- <h6><?php //echo esc_html($cat['label']); ?></h6> -->


        <?php 
            // Get the value of the custom text field
            $block_title = get_field('bggb_posts_block_title');

            // Check if the custom text field is filled
            if ($block_title) {
                // Custom text field is filled, show its content
                echo '<h6>';
                echo $block_title;
                echo '</h6>';
            } else {
                // Custom text field is not filled, show default title
                echo '<h6>';
                echo esc_html($cat['label']);
                echo '</h6>';
            }
        ?>
        <!-- End Section Title -->

        <!-- Start Post Wrap -->
        <div class="sidebar-post">
            <?php
                // Custom query to get posts from 'selected' category
                $args = array(
                    'category_name' => $cat['value'],
                    'posts_per_page' => 3,  // You can change this to the number of posts you want to display
                );

                $posts_query = new WP_Query($args);

                if ($posts_query->have_posts()) :
                    while ($posts_query->have_posts()) : $posts_query->the_post();
                    $title = get_the_title();
                    $post_image = get_the_post_thumbnail();
                    $excerpt = get_the_excerpt();
                    $categories = get_the_category();
                    $permalink = get_permalink();
                ?>
                    <!-- Start Article -->
                    <a class="sidebar-post-link" href="<?php echo $permalink; ?>">
                        <article class="sidebar-line d-flex flex-nowrap pb-15">
                            <!-- Featured Image -->
                            <div class="sidebar-line-img">
                                <?php echo $post_image; ?>
                            </div>

                            <div class="sidebar-line-wrap">
                                <!-- Title -->
                                <?php echo esc_html( $title ); ?>
                            </div>
                        </article>
                    </a>
                    <!-- End Article -->
                <?php
                    endwhile;

                    wp_reset_postdata();  // Reset the main query loop

                else :
                    echo '<p>No articles found.</p>';
                endif;
            ?>
        </div>
        <!-- End Post Wrap -->
        
    <!-- </div> -->
</section>