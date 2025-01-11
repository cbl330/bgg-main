<?php
/**
 * Press Release Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'press-release-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-press-release';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block blog-listing my-50">

    <code>BGG - Posts Slider</code>

    <?php 
            // Get Selected Category
            $cat = get_field( 'bggb_posts_selector' );
    ?>

    <!-- Start Section Title -->
    <div class="mb-30">
        <!-- <h2 class="h2 mr-75 pr-15"><?php //echo esc_html($cat['label']); ?></h2> -->

        <?php 
            // Get the value of the custom text field
            $block_title = get_field('bggb_posts_block_title');

            // Check if the custom text field is filled
            if ($block_title) {
                // Custom text field is filled, show its content
                echo '<h2 class="h2 mr-75 pr-15">';
                echo $block_title;
                echo '</h2>';
            } else {
                // Custom text field is not filled, show default title
                echo '<h2 class="h2 mr-75 pr-15">';
                echo esc_html($cat['label']);
                echo '</h2>';
            }
        ?>
    </div>
    <!-- End Section Title -->

    <!-- Start Post Slider - Desktop -->
    <div class="blog-listing-slider row desktop">
        <?php
            // Custom query to get posts from 'selected' category
            $desktop_args = array(
                'category_name' => $cat['value'],
                'posts_per_page' => -1,  // You can change this to the number of posts you want to display
            );
            $slider_query_desktop = new WP_Query($desktop_args);

            if ($slider_query_desktop->have_posts()) :
                while ($slider_query_desktop->have_posts()) : $slider_query_desktop->the_post();
                $title = get_the_title();
                $post_image = get_the_post_thumbnail();
                $excerpt = get_the_excerpt();
                $categories = get_the_category();
                $permalink = get_permalink();
                $original_content = get_the_content();
                $limited_content = limit_content_to_character_count($original_content, 200);
            ?>
                <!-- Start Article -->
                <!-- <a href="<?php //echo esc_html( $permalink ); ?>" class="article-link"> -->
                    <article class="article-wrap blog-listing-item cell-md-4 cell-sm-6">
                        <!-- Featured Image -->
                        <div class="bl-img">
                            <a href="<?php echo esc_html( $permalink ); ?>" class="article-link">
                                <?php echo $post_image; ?>
                            </a>
                        </div>
                        
                        <div class="article-content-wrap">
                        <!-- Categories -->
                        <?php foreach( $categories as $category ): ?>
                            <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                        <?php endforeach; ?>
                        <!-- Title -->
                        <a href="<?php echo esc_html( $permalink ); ?>" class="article-link">
                            <h4 class="h4"><?php echo esc_html( $title ); ?></h4>
                        </a>
                        <!-- Excerpt -->
                        <div><?php echo esc_html( $limited_content ); ?></div>
                        <!-- <div><?php //echo esc_html( $excerpt ); ?></div> -->
                        <!-- Button -->
                        <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                        </div>
                    </article>
                <!-- </a> -->
                <!-- End Article -->
            <?php
                endwhile;

                wp_reset_postdata();  // Reset the main query loop

            else :
                echo '<p>No articles found.</p>';
            endif;
        ?>
    </div>
    <!-- End Post Slider - Desktop -->

    <!-- Start Post Slider - Mobile -->
    <div class="blog-listing-slider row mobile">
        <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            // Custom query to get posts from 'selected' category
            $mobile_args = array(
                'category_name' => $cat['value'],
                'posts_per_page' => 4,  // You can change this to the number of posts you want to display
                'paged' => $paged,
            );
            $slider_query_mobile = new WP_Query($mobile_args);

            if ($slider_query_mobile->have_posts()) :
                while ($slider_query_mobile->have_posts()) : $slider_query_mobile->the_post();
                $title = get_the_title();
                $post_image = get_the_post_thumbnail();
                $excerpt = get_the_excerpt();
                $categories = get_the_category();
                $permalink = get_permalink();
            ?>
                <!-- Start Article -->
                <article class="article-wrap blog-listing-item cell-md-4 cell-sm-6">
                    <!-- Featured Image -->
                    <div class="bl-img">
                        <?php echo $post_image; ?>
                    </div>
                    
                    <div class="article-content-wrap">
                    <!-- Categories -->
                    <?php foreach( $categories as $category ): ?>
                        <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                    <?php endforeach; ?>
                    <!-- Title -->
                    <h4 class="h4"><?php echo esc_html( $title ); ?></h4>
                    <!-- Excerpt -->
                    <div><?php echo esc_html( $excerpt ); ?></div>
                    <!-- Button -->
                    <a href="#" class="btn-link">Read More</a>
                    </div>
                </article>
                <!-- End Article -->
            <?php
                endwhile;

                wp_reset_postdata();  // Reset the main query loop

            else :
                echo '<p>No articles found.</p>';
            endif;
        ?>

        <!-- Start Pagination -->
        <div class="pagination pt-md-15 pb-md-30 pb-15">
            <div class="container">
                <ul>
                    <li><span>Page</span></li>
                    <!-- <li><span class="page-numbers current">1</span></li> -->
                    <li class="page-numbers"><?php echo paginate_links( array( 'total' => $slider_query_mobile->max_num_pages, ) ); ?></li>
                    <!-- <li><a href="#" class="page-numbers">3</a></li>
                    <li><a href="#" class="page-numbers">4</a></li> -->
                    <li><a href="#" class="next page-numbers icon-right-angle"></a></li>
                </ul>
            </div>
        </div>
        <!-- End Pagination -->
    </div>
    <!-- End Post Slider - Mobile -->

</section>