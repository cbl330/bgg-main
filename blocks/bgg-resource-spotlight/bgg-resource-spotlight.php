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

        <code>BGG - Resource Spotlight</code>

        <?php if( have_rows('bggb_spotlight_tab_repeater') ): ?>
            <!-- Start Header Container -->
            <div class="header-container">

                <!-- Start Block Title Wrap -->
                <!-- <div class="block-title-wrap"> -->
                <h2 class="heading-h0 text-center">Resource Spotlight</h2>
                <!-- </div> -->
                <!-- End Block Title Wrap -->
            </div>
            <!-- End Header Container -->

            <!-- Start Tab Header Container -->
            <!-- <ul class="nav nav-tabs" id="myTab" role="tablist"> -->
            <div class="rs-tab d-flex justify-content-center mb-xl-50 mb-30">
                <?php $count = 0; while( have_rows('bggb_spotlight_tab_repeater') ): the_row(); $count++; ?>
                    <button class="nav-item" data-tab="rs-tab-<?php echo $count; ?>"><?php the_sub_field( 'bggb_spotlight_tab_title' ); ?></button>
                <?php endwhile; ?>
            </div>
            <!-- </ul> -->
            <!-- End Tab Header Container -->

            <!-- Start Tab Content Container -->
            <div class="tab-content tab-content-container rs-tab-content-wrap" id="myTabContent">
                <?php $count = 0; while( have_rows('bggb_spotlight_tab_repeater') ): the_row(); $count++; ?>
                    <!-- <div class="tab-pane fade rs-tab-content <?php //echo $count === 1 ? 'show active' : ''; ?>" id="content-<?php //echo $count; ?>" role="tabpanel" aria-labelledby="tab-<?php //echo $count; ?>"> -->

                    <?php // If post option is selected ?>
                    <?php if( get_sub_field( 'bggb_spotlight_media_option' ) == 'posts' ): ?>
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
                                                <a href="<?php echo $permalink; ?>">
                                                    <?php echo $post_image; ?>
                                                </a>
                                                <!-- <img src="/wp-content/uploads/2023/08/post-2.jpg" alt="Sample"> -->
                                            </div>
                                            <!-- End Featured Image Wrap -->
                                            
                                            <!-- Start Content Wrap -->
                                            <div class="article-content-wrap">
                                                <div class="article-content">
                                                    <!-- Category -->
                                                    <?php foreach( $categories as $category ): ?>
                                                        <div class="article-category eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></div>
                                                    <?php endforeach; ?>
                                                    <!-- Title -->
                                                    <a class="rs-link" href="<?php echo $permalink; ?>">
                                                        <h4 class="article-title h4 rs-article-title"><?php echo esc_html( $title ); ?></h4>
                                                    </a>
                                                    <!-- Excerpt -->
                                                    <div class="article-excerpt"><?php echo esc_html( $excerpt ); ?></div>
                                                </div>
                                                <!-- Read More Button -->
                                                <!-- <div class="read-more-wrap link-wrap"> -->
                                                    <a href="<?php echo $permalink; ?>" class="read-more btn-link pt-15">Read More</a>
                                                <!-- </div> -->
                                            </div>
                                            <!-- End Content Wrap -->
                                        </article>
                                        <!-- End Article Wrap -->
                                    <?php endforeach; ?>

                                </div>      
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php // If video option is selected ?>
                    <?php if( get_sub_field( 'bggb_spotlight_media_option' ) == 'videos' ): ?>
                        <div class="rs-tab-content" data-id="rs-tab-<?php echo $count; ?>">
                            <div class="tab-content-wrap row justify-content-center">

                                <!-- Start Article Wrap -->
                                <?php if( have_rows( 'bggb_spotlight_videos' ) ): ?>
                                    <?php while( have_rows( 'bggb_spotlight_videos' ) ) : the_row(); ?>
                                        <article class="article-wrap cell-lg-3 cell-md-4 cell-sm-6 mb-30">
                                            <a class="ffs-media -video fv-wrap" href="<?php the_sub_field( 'bggb_spotlight_video_repeater_video_link' ); ?>" data-fancybox>
                                                <?php if( get_sub_field( 'bggb_spotlight_video_image' ) ): ?>
                                                    <img src="<?php the_sub_field( 'bggb_spotlight_video_image' ); ?>" alt="<?php the_sub_field( 'bggb_spotlight_video_image' )['alt']; ?>">
                                                <?php endif; ?>
                                            </a>
                                        </article>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <!-- End Article Wrap -->

                            </div>      
                        </div>
                    <?php endif; ?>
                    
                <?php endwhile; ?>
            </div>
            <!-- End Tab Content Container -->
        <?php endif; ?>

    </div>
</section>