<?php
/**
 * Resource Spotlight Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'resource-spotlight-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-resource-spotlight';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block resource-spotlight py-xl-75 py-md-50 py-30">
    <div class="block-container resource-spotlight-container container">

        <?php if( have_rows('bggb_spotlight_tab_repeater') ): ?>
            <!-- Start Header Container -->
            <h2 class="heading-h0 text-center">Resource Spotlight</h2>
            <!-- End Header Container -->

            <!-- Start Tab Header Container -->
            <div class="rs-tab d-flex justify-content-center mb-xl-50 mb-30">
                <?php $count = 0; while( have_rows('bggb_spotlight_tab_repeater') ): the_row(); $count++; ?>
                    <button class="nav-item" data-tab="rs-tab-<?php echo $count; ?>"><?php the_sub_field( 'bggb_spotlight_tab_title' ); ?></button>
                <?php endwhile; ?>
            </div>
            <!-- End Tab Header Container -->

            <!-- Start Tab Content Container -->
            <div class="tab-content tab-content-container rs-tab-content-wrap" id="myTabContent">
                <?php $count = 0; while( have_rows('bggb_spotlight_tab_repeater') ): the_row(); $count++; ?>
                    <div class="rs-tab-content" data-id="rs-tab-<?php echo $count; ?>">
                        
                        <?php 
                            $related_posts = get_sub_field( 'bggb_spotlight_posts' );
                            if( $related_posts ):
                        ?>
                            <div class="tab-content-wrap row justify-content-center">

                                <?php 
                                    foreach( get_sub_field( 'bggb_spotlight_posts' ) as $related_post):
                                        $title = get_the_title( $related_post -> ID );
                                        $post_image = get_the_post_thumbnail( $related_post -> ID );
                                        $excerpt = get_the_excerpt( $related_post -> ID );
                                        $categories = get_the_category( $related_post -> ID );
                                        $permalink = get_permalink( $related_post -> ID );
                                ?>
                                    <!-- Start Article Wrap -->
                                    <article class="article-wrap cell-lg-3 cell-md-4 cell-sm-6 mb-30">
                                        <!-- Start Featured Image Wrap -->
                                        <div class="article-image-wrap rs-img">
                                            <?php echo $post_image; ?>
                                        </div>
                                        <!-- End Featured Image Wrap -->
                                        
                                        <!-- Start Content Wrap -->
                                        <div class="article-content-wrap">
                                            <!-- Category -->
                                            <?php foreach( $categories as $category ): ?>
                                                <small class="article-category eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
                                            <?php endforeach; ?>
                                            <!-- Title -->
                                            <h4 class="article-title h4"><?php echo esc_html( $title ); ?></h4>
                                            <!-- Excerpt -->
                                            <div class="article-excerpt"><?php echo esc_html( $excerpt ); ?></div>
                                            <!-- Read More Button -->
                                            <div class="read-more-wrap link-wrap">
                                                <a href="<?php echo $permalink; ?>" class="read-more btn-link">Read More</a>
                                            </div>
                                        </div>
                                        <!-- End Content Wrap -->
                                    </article>
                                    <!-- End Article Wrap -->
                                <?php endforeach; ?>

                            </div>      
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <!-- End Tab Content Container -->
        <?php endif; ?>

    </div>
</section>