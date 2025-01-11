
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

        <code>BGG - Sidebar Related Posts</code>

        <?php 
            // Get Selected Category
            $cat = get_field( 'bggb_posts_selector' );
        ?>

        <!-- Start Section Title -->
        <h6><?php echo esc_html($cat['label']); ?></h6>
        <!-- End Section Title -->

        <!-- Start Post Wrap -->
        <div class="sidebar-post">
            <?php
            // Get the categories of the current post
            $post_categories = get_the_category();

            // Check if there are categories
            if ($post_categories) {
                // Extract category IDs
                $category_ids = wp_list_pluck($post_categories, 'term_id');

                // Custom query to get posts from the current post's categories
                $args = array(
                    'category__in'   => $category_ids,
                    'post__not_in'   => array(get_the_ID()), // Exclude the current post
                    'post_type'      => 'post',
                    'order'          => 'DESC',
                    'posts_per_page' => 3,
                );

                $related_posts_query = new WP_Query($args);

                // Check if there are related posts
                if ($related_posts_query->have_posts()) :
                    while ($related_posts_query->have_posts()) : $related_posts_query->the_post();

                        // Get post details
                        $title = get_the_title();
                        $post_image = get_the_post_thumbnail();
                        $permalink = get_permalink();
                        ?>

                        <!-- Start Article -->
                        <a class="sidebar-post-link" href="<?php echo esc_url($permalink); ?>">
                            <article class="sidebar-line d-flex flex-nowrap pb-15">
                                <!-- Featured Image -->
                                <div class="sidebar-line-img">
                                    <?php echo $post_image; ?>
                                </div>

                                <div class="sidebar-line-wrap">
                                    <!-- Title -->
                                    <?php echo esc_html($title); ?>
                                </div>
                            </article>
                        </a>
                        <!-- End Article -->

            <?php
                    endwhile;

                    wp_reset_postdata();  // Reset the main query loop

                else :
                    echo '<p>No related posts found.</p>';
                endif;
            } else {
                echo '<p>No categories found for this post.</p>';
            }
            ?>
        </div>
        <!-- End Post Wrap -->

        
    <!-- </div> -->
</section>