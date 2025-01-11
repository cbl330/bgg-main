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


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block blog-listing my-75 my-xl-50 id-section">
    <div class="container">

        <code>BGG - Posts</code>

        <?php 
            // Get Selected Category
            $cat = get_field( 'bggb_posts_selector' );
        ?>

        <!-- Start Section Title -->
        <div class="d-flex align-items-center justify-content-between mb-sm-30 mb-15">
            <!-- <h2 class="h2 mr-30"><?php //echo esc_html($cat['label']); ?></h2> -->

            <?php 
                // Get the value of the custom text field
                $block_title = get_field('bggb_posts_block_title');

                // Check if the custom text field is filled
                if ($block_title) {
                    // Custom text field is filled, show its content
                    echo '<h2 class="h2 mr-30">';
                    echo $block_title;
                    echo '</h2>';
                } else {
                    // Custom text field is not filled, show default title
                    echo '<h2 class="h2 mr-30">';
                    echo esc_html($cat['label']);
                    echo '</h2>';
                }
            ?>

            <a href="<?php echo site_url(); ?>/category/<?php echo esc_html($cat['value']); ?>" class="btn">See All</a>
        </div>
        <!-- End Section Title -->

        <!-- Start Post Wrap - Desktop -->
        <div class="row justify-content-center desktop">
            <?php
                // Custom query to get posts from 'selected' category
                $args = array(
                    'category_name' => $cat['value'],
                    'posts_per_page' => 4,  // You can change this to the number of posts you want to display
                );

                $posts_query_deskctop = new WP_Query($args);

                if ($posts_query_deskctop->have_posts()) :
                    while ($posts_query_deskctop->have_posts()) : $posts_query_deskctop->the_post();
                    $title = get_the_title();
                    $post_image = get_the_post_thumbnail();
                    $excerpt = get_the_excerpt();
                    $categories = get_the_category();
                    $permalink = get_permalink();
                    $original_content = get_the_content();
                    $limited_content = limit_content_to_character_count($original_content, 200);
                ?>
                    <!-- Start Article -->
                    <a class="article-link" href="<?php echo esc_html( $permalink ); ?>">
                        <article class="article-wrap cell-lg-3 cell-md-4 cell-sm-6 mb-30">
                            <!-- Featured Image -->
                            <div class="bl-img">
                                <?php echo $post_image; ?>
                            </div>

                            <div class="article-content-wrap bl-content">
                                <!-- Categories -->
                                <?php foreach( $categories as $category ): ?>
                                    <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                                <?php endforeach; ?>
                                <!-- Title -->
                                <h4 class="h4"><?php echo esc_html( $title ); ?></h4>
                                <!-- Excerpt -->
                                <!-- <div class="excerpt"><?php //echo esc_html( $excerpt ); ?></div> -->
                                <div class="excerpt"><?php echo esc_html( $limited_content ); ?></div>
                                <!-- Button -->
                                <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link pt-15">Read More</a>
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
        <!-- End Post Wrap - Desktop -->

        <!-- Start Post Wrap - Mobile -->
        <div class="row justify-content-center mobile">
            
            <?php //Start First Post Loop for Mobile View ?>
            <?php
                // Custom Query for first Post
                $first_args = array(
                    'category_name' => $cat['value'],
                    'posts_per_page' => 1,  // You can change this to the number of posts you want to display
                    'post_status' => 'publish'
                );

                $first_query = new WP_Query($first_args);

                if ($first_query->have_posts()) :
                    while ($first_query->have_posts()) : $first_query->the_post();
                    $title = get_the_title();
                    $post_image = get_the_post_thumbnail();
                    $excerpt = get_the_excerpt();
                    $categories = get_the_category();
                    $permalink = get_permalink();
                    $original_content = get_the_content();
                    $limited_content = limit_content_to_character_count($original_content, 150);
            ?>

                <!-- Start Article -->
                <!-- <a class="article-link" href="<?php //echo esc_html( $permalink ); ?>"> -->
                    <article class="cell-lg-3 cell-md-4 cell-sm-6 mb-30">
                        <div class="bl-img">
                            <?php echo $post_image; ?>
                        </div>
                        <div class="bl-content">
                                <!-- Categories -->
                                <?php foreach( $categories as $category ): ?>
                                    <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                                <?php endforeach; ?>
                                <!-- Title -->
                                <h4 class="h4"><?php echo esc_html( $title ); ?></h4>
                                <!-- Excerpt -->
                                <!-- <div class="excerpt"><?php //echo esc_html( $excerpt ); ?></div> -->
                                <div class="excerpt"><?php echo esc_html( $limited_content ); ?></div>                            
                                <!-- Button -->
                                <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link pt-15">Read More</a>
                        </div>
                    </article>
                <!-- </a> -->
                <!-- End Article -->

                <?php
                    endwhile;

                    wp_reset_postdata();  // Reset the main query loop

                    else :
                    echo '<p>No news articles found.</p>';
                    endif;
                ?>

            <?php //End First Post Loop for Mobile View ?>

            <?php
                // Custom query to get posts from 'selected' category
                $args = array(
                    'category_name' => $cat['value'],
                    'posts_per_page' => 3,  // You can change this to the number of posts you want to display
                    'offset' => 1,
                );

                $posts_query_mobile = new WP_Query($args);

                if ($posts_query_mobile->have_posts()) :
                    while ($posts_query_mobile->have_posts()) : $posts_query_mobile->the_post();
                    $title = get_the_title();
                    $post_image = get_the_post_thumbnail();
                    $excerpt = get_the_excerpt();
                    $categories = get_the_category();
                    $permalink = get_permalink();
                    $original_content = get_the_content();
                    $limited_content = limit_content_to_character_count($original_content, 200);
                ?>
                    <!-- Start Article -->
                    <a class="article-link" href="<?php echo esc_html( $permalink ); ?>">
                        <article class="article-wrap cell-lg-3 cell-md-4 cell-sm-6 mb-30">
                            <!-- Featured Image -->
                            <div class="bl-img">
                                <?php echo $post_image; ?>
                            </div>

                            <div class="article-content-wrap bl-content">
                                <!-- Categories -->
                                <?php foreach( $categories as $category ): ?>
                                    <small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                                <?php endforeach; ?>
                                <!-- Title -->
                                <h4 class="h4"><?php echo esc_html( $title ); ?></h4>
                                <!-- Excerpt -->
                                <!-- <div class="excerpt"><?php //echo esc_html( $excerpt ); ?></div> -->
                                <div class="excerpt"><?php echo esc_html( $limited_content ); ?></div>
                                <!-- Button -->
                                <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link pt-15">Read More</a>
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
        <!-- End Post Wrap - Mobile -->
        
    </div>
</section>