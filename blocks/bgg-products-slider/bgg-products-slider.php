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


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block products-listing mt-xl-75 mt-50 mb-lg-0 mb-30">

    <code>BGG - Products Slider</code>

    <?php 
        // Get Selected Category
        $cat = get_field( 'bggb_products_selector' );
    ?>

    <!-- Start Section Title -->
    <!-- <div class="d-flex align-items-center justify-content-between mb-30"> -->
    <!-- <h2 class="mb-30 mr-sm-75 pr-sm-15"><?php //echo esc_html($cat['label']); ?></h2> -->
    <!-- </div> -->

    <?php 
        // Get the value of the custom text field
        $block_title = get_field('bggb_products_block_title');

        // Check if the custom text field is filled
        if ($block_title) {
            // Custom text field is filled, show its content
            echo '<h2 class="mb-30 mr-sm-75 pr-sm-15">';
            echo $block_title;
            echo '</h2>';
        } else {
            // Custom text field is not filled, show default title
            echo '<h2 class="mb-30 mr-sm-75 pr-sm-15">';
            echo esc_html($cat['label']);
            echo '</h2>';
        }
    ?>
    <!-- End Section Title -->

    <!-- Start Desktop View -->
    <div class="row products-block-row products-listing-slider desktop">

        <!-- Start Post Wrap -->
        <?php
            // Custom query to get posts from 'selected' category
            $args_desktop = array(
                'post_type' => 'products',
                'posts_per_page' => -1,  // You can change this to the number of posts you want to display
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_categories', // Your custom taxonomy name
                        'field'    => 'slug',
                        'terms'    => $cat['value'],
                    ),
                ),
            );

            $products_query_desktop = new WP_Query($args_desktop);

            if ($products_query_desktop->have_posts()) :
                while ($products_query_desktop->have_posts()) : $products_query_desktop->the_post();
                $title = get_the_title();
                $post_image = get_the_post_thumbnail();
                $excerpt = get_the_excerpt();
                $categories = get_the_category();
                $permalink = get_permalink();
                $original_content = get_the_content();
                $limited_content = limit_content_to_character_count($original_content, 200);
            ?>
                <!-- Start Article -->
                <article class="products cell-lg-3 cell-md-4 cell-sm-6 mb-15 products-block-cell">
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
                            <div><?php echo esc_html( $limited_content ); ?></div>
                            <!-- <div><?php //echo esc_html( $excerpt ); ?></div> -->
                            <!-- Button -->
                            <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                        </div>
                    </div>
                </article>
                <!-- End Article -->
            <?php
                endwhile;

                wp_reset_postdata();  // Reset the main query loop

            else :
                echo '<p>No products found.</p>';
            endif;
        ?>
        <!-- End Post Wrap -->

    </div>
    <!-- End Desktop View -->

    <!-- Start Mobile View -->
    <div class="row products-block-row products-listing-slider mobile">

        <!-- Start Post Wrap -->
        <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            // Custom query to get posts from 'selected' category
            $args_mobile = array(
                'post_type' => 'products',
                'posts_per_page' => 4,  // You can change this to the number of posts you want to display
                'paged' => $paged,
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

            $products_query_mobile = new WP_Query($args_mobile);

            if ($products_query_mobile->have_posts()) :
                while ($products_query_mobile->have_posts()) : $products_query_mobile->the_post();
                $title = get_the_title();
                $post_image = get_the_post_thumbnail();
                $excerpt = get_the_excerpt();
                $categories = get_the_category();
                $permalink = get_permalink();
            ?>
                <!-- Start Article -->
                <a href="<?php echo esc_html( $permalink ); ?>" class="product-link">
                    <article class="cell-lg-3 cell-md-4 cell-sm-6 mb-15 products-block-cell">
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
                                <div><?php echo esc_html( $excerpt ); ?></div>
                                <!-- Button -->
                                <a href="<?php echo esc_html( $permalink ); ?>" class="btn-link">Read More</a>
                            </div>
                        </div>
                    </article>
                </a>
                <!-- End Article -->
            <?php
                endwhile;

                wp_reset_postdata();  // Reset the main query loop

            else :
                echo '<p>No products found.</p>';
            endif;
        ?>

        <!-- Start Pagination -->
        <div class="pagination pt-md-15 pb-md-30 pb-15">
            <div class="container">
                <ul>
                    <li><span>Page</span></li>
                    <!-- <li><span class="page-numbers current">1</span></li> -->
                    <li class="page-numbers"><?php echo paginate_links( array( 'total' => $products_query_mobile->max_num_pages, ) ); ?></li>
                    <!-- <li><a href="#" class="page-numbers">3</a></li>
                    <li><a href="#" class="page-numbers">4</a></li> -->
                    <li><a href="#" class="next page-numbers icon-right-angle"></a></li>
                </ul>
            </div>
        </div>
        <!-- End Pagination -->

        <!-- End Post Wrap -->

    </div>
    <!-- End Mobile View -->

</section>