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
$id = 'bgg-products-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-bgg-products';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block products-listing py-15 mb-sm-0 mb-15 id-section">
    <div class="products-container">

        <code>BGG - Products</code>

        <?php 
            // Get Selected Category
            $cat = get_field( 'bggb_products_selector' );
        ?>

        <!-- Start Section Title -->
        <div class="pl-head d-flex align-items-center justify-content-between mb-sm-30 mb-15">
            
            <?php 
                // Get the value of the custom text field
                $block_title = get_field('bggb_products_block_title');

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
            
            <a href="<?php echo site_url(); ?>/product-category/<?php echo esc_html($cat['value']); ?>" class="btn">See All</a>
        </div>
        <!-- End Section Title -->

        <!-- Start Post Loop - Desktop -->
        <div class="row products-block-row desktop">
            <?php
                // Custom query to get posts from 'selected' category
                $desktop_args = array(
                    'post_type' => 'products',
                    'posts_per_page' => 5,  // You can change this to the number of posts you want to display
                    'orderby' => 'title',    // Order by post title
                    'order' => 'ASC',         // Sort in ascending order (A to Z)
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_categories', // Your custom taxonomy name
                            'field'    => 'slug',
                            'terms'    => $cat['value'],
                        ),
                    ),
                );

                $products_query_desktop = new WP_Query($desktop_args);

                if ($products_query_desktop->have_posts()) :
                    while ($products_query_desktop->have_posts()) : $products_query_desktop->the_post();
                    $title = get_the_title();
                    $post_image = get_the_post_thumbnail();
                    $excerpt = get_the_excerpt();
                    $categories = get_the_category();
                    $permalink = get_permalink();
                    $original_content = get_the_content();
                    $limited_content = limit_content_to_character_count($original_content, 200);
                    $limited_excerpt = limit_content_to_character_count($excerpt, 125);
                    // $post_id = get_the_ID();
                ?>
                    <!-- Start Article -->
                    <!-- <a href="<?php //echo esc_html( $permalink ); ?>" class="product-link"> -->
                        <article class="products cell-lg-3 cell-md-4 cell-6 mb-15 products-block-cell">
                            <div class="products-block">

                                <?php if( has_term( 'IRA-Approved', 'product_categories' ) ) : ?>
                                    <!-- Start Ribbon Wrap -->
                                    <div class="pl-ribbon">IRA Eligible</div>
                                    <!-- End Robbon Wrap -->
                                <?php endif; ?>

                                <!-- Featured Image -->
                                <div class="pl-img">
                                    <?php echo $post_image; ?>
                                </div>

                                <!-- Product Content -->
                                <div class="product-content-wrap pl-content">
                                    <!-- Title -->
                                    <h5 class="h5"><?php echo esc_html( $title ); ?></h5>
                                    <!-- Excerpt -->
                                    <!-- <div class="excerpt"><?php //echo esc_html( $limited_content ); ?></div> -->
                                    <?php //print($post_id); ?>
                                    <!-- <div class="excerpt"><?php //echo esc_html( get_field( 'bggb_text_editor', $post_id ) ); ?></div> -->
                                    <div class="excerpt pb-15"><?php echo esc_html( $limited_excerpt ); ?></div>
                                    <!-- Button -->
                                    <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                                </div>
                            </div>
                        </article>
                    <!-- </a> -->
                    <!-- End Article -->
                <?php
                    endwhile;

                    wp_reset_postdata();  // Reset the main query loop

                else :
                    echo '<p>No products found.</p>';
                endif;
            ?>
        </div>
        <!-- End Post Loop - Desktop -->

        <!-- Start Post Loop - Mobile -->
        <div class="row products-block-row mobile">
            <?php
                // Custom query to get posts from 'selected' category
                $mobile_args = array(
                    'post_type' => 'products',
                    'posts_per_page' => 4,  // You can change this to the number of posts you want to display
                    'orderby' => 'title',    // Order by post title
                    'order' => 'ASC',         // Sort in ascending order (A to Z)
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_categories', // Your custom taxonomy name
                            'field'    => 'slug',
                            'terms'    => $cat['value'],
                        ),
                    ),
                );

                $products_query_mobile = new WP_Query($mobile_args);

                if ($products_query_mobile->have_posts()) :
                    while ($products_query_mobile->have_posts()) : $products_query_mobile->the_post();
                    $title = get_the_title();
                    $post_image = get_the_post_thumbnail();
                    $excerpt = get_the_excerpt();
                    $categories = get_the_category();
                    $permalink = get_permalink();
                    // $original_content = get_the_content();
                    // $limited_content = limit_content_to_character_count($original_content, 200);
                    // $limited_excerpt = limit_content_to_character_count($excerpt, 125);
                ?>
                    <!-- Start Article -->
                    <!-- <a href="<?php //echo esc_html( $permalink ); ?>" class="product-link"> -->
                        <article class="products cell-lg-3 cell-md-4 cell-6 mb-15 products-block-cell">
                            <div class="products-block">

                                <?php if( has_term( 'IRA-Approved', 'product_categories' ) ) : ?>
                                    <!-- Start Ribbon Wrap -->
                                    <div class="pl-ribbon">IRA Eligible</div>
                                    <!-- End Robbon Wrap -->
                                <?php endif; ?>

                                <!-- Featured Image -->
                                <div class="pl-img">
                                    <?php echo $post_image; ?>
                                </div>

                                <!-- Product Content -->
                                <div class="product-content-wrap pl-content">
                                    <!-- Title -->
                                    <h5 class="h5"><?php echo esc_html( $title ); ?></h5>
                                    <!-- Excerpt -->
                                    <!-- <div class="excerpt"><?php //echo esc_html( $limited_content ); ?></div> -->
                                    <!-- <div class="excerpt"><?php //echo esc_html( $excerpt ); ?></div> -->
                                    <!-- <div class="excerpt pb-15"><?php //echo esc_html( $limited_excerpt ); ?></div> -->
                                    <!-- Button -->
                                    <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                                </div>
                            </div>
                        </article>
                    <!-- </a> -->
                    <!-- End Article -->
                <?php
                    endwhile;

                    wp_reset_postdata();  // Reset the main query loop

                else :
                    echo '<p>No products found.</p>';
                endif;
            ?>
        </div>
        <!-- End Post Loop - Mobile -->

        <!-- Start Mobile Button -->
        <div class="pl-device-btn">
            <!-- <a href="http://birchgold.local/category/<?php //echo esc_html($cat['label']); ?>" class="btn">See All Gold</a> -->
            <a href="<?php echo site_url(); ?>/product-category/<?php echo esc_html($cat['value']); ?>" class="btn">See All <?php echo esc_html($cat['label']); ?></a>
        </div>
        <!-- End Mobile Button -->
        
    </div>

</section>