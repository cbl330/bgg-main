<?php
/**
 * Alternating Media/Content Block Template
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 */

// Define Block ID
$id = 'media-content-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


// Define Block Class
$class_name = 'section-media-content';
if( !empty($block['className']) ) {
    $class_name .= ' ' . $block['className'];
}


// ACF Variables
// $block_open_positions = get_field('block_open_positions');
?>


<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block fifty-fifty-section py-xl-75 py-md-50 py-30">
    <div class="block-container media-content container">

        <?php if( get_field( 'bggb_mc_image_layout' ) === 'Image Right' ): ?>
            <?php if( get_field( 'bggb_content_group' ) || get_field( 'bggb_media_group' ) ): ?>
                <div class="media-content-container row align-items-center flex-row-reverse">

                    <?php if( get_field( 'bggb_media_group' ) ): ?>
                        <?php while( have_rows( 'bggb_media_group' ) ) : the_row(); ?>
                            <!-- Start Media Column -->
                            <div class="image-container cell-md-6 mb-md-0 mb-30">

                                <?php if( get_sub_field( 'bggb_mg_image' ) ): ?>
                                    <!-- Image Wrap -->
                                    <img src="<?php the_sub_field( 'bggb_mg_image' ); ?>" alt="<?php the_sub_field( 'bggb_mg_image' )['alt']; ?>" class="block-image">
                                <?php endif; ?>

                                <?php if( get_sub_field( 'bggb_mg_video_link' ) ): ?>
                                    <!-- Video Wrap -->
                                    <a class="ffs-media -video" href="<?php the_sub_field( 'bggb_mg_video_link' ); ?>" data-fancybox>
                                        <!-- <i class="fa-solid fa-play"></i> -->
                                        <img src="<?php the_sub_field( 'bggb_mg_video_image' ); ?>" alt="<?php the_sub_field( 'bggb_mg_video_image' )['alt']; ?>">
                                    </a>
                                    <!-- <video width="320" height="240" controls>
                                        <source src="<?php //the_sub_field( 'bggb_mg_video_link' ); ?>" type="video/youtube/mp4">
                                    </video> -->
                                <?php endif; ?>

                            </div>
                            <!-- End Image Column -->
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <?php if( get_field( 'bggb_content_group' ) ): ?>
                        <?php while( have_rows( 'bggb_content_group' ) ) : the_row(); ?>
                            <!-- Start Content Column -->
                            <div class="content-container cell-md-6">

                                <?php if( get_sub_field( 'bggb_mc_sub_head' ) ): ?>
                                    <!-- Sub Head -->
                                    <!-- <div class="subhead-wrap"> -->
                                        <h3 class="subhead eyebrow-text"><?php the_sub_field( 'bggb_mc_sub_head' ); ?></h3>
                                    <!-- </div> -->
                                <?php endif; ?>

                                <?php if( get_sub_field( 'bggb_mc_header' ) ): ?>
                                    <!-- Title -->
                                    <!-- <div class="title-wrap"> -->
                                        <h2 class="title heading-h0"><?php the_sub_field( 'bggb_mc_header' ); ?></h2>
                                    <!-- </div> -->
                                <?php endif; ?>

                                <?php if( get_sub_field( 'bggb_mc_text' ) ): ?>
                                    <!-- Content -->
                                    <div class="media-content-wrap"><?php the_sub_field( 'bggb_mc_text' ); ?></div>
                                <?php endif; ?>

                                <?php if( get_sub_field( 'bggb_mc_button_text' ) && get_sub_field( 'bggb_mc_button_link' ) ): ?>
                                    <!-- Button Wrap -->
                                    <div class="button-wrap">
                                        <a href="<?php the_sub_field( 'bggb_mc_button_link' ); ?>" class="btn w-full mt-15"><?php the_sub_field( 'bggb_mc_button_text' ); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- End Content Column -->
                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if( get_field( 'bggb_mc_image_layout' ) === 'Image Left' ): ?>
            <?php if( get_field( 'bggb_content_group' ) || get_field( 'bggb_media_group' ) ): ?>
                <div class="media-content-container row align-items-center">

                    <?php if( get_field( 'bggb_media_group' ) ): ?>
                        <?php while( have_rows( 'bggb_media_group' ) ) : the_row(); ?>
                            <!-- Start Media Column -->
                            <div class="image-container cell-md-6 mb-md-0 mb-30">

                                <?php if( get_sub_field( 'bggb_mg_image' ) ): ?>
                                    <!-- Image Wrap -->
                                    <img src="<?php the_sub_field( 'bggb_mg_image' ); ?>" alt="<?php the_sub_field( 'bggb_mg_image' )['alt']; ?>" class="block-image">
                                <?php endif; ?>

                                <?php if( get_sub_field( 'bggb_mg_video_link' ) ): ?>
                                    <!-- Video Wrap -->
                                    <a class="ffs-media -video" href="<?php the_sub_field( 'bggb_mg_video_link' ); ?>" data-fancybox>
                                        <!-- <i class="fa-solid fa-play"></i> -->
                                        <img src="<?php the_sub_field( 'bggb_mg_video_image' ); ?>" alt="<?php the_sub_field( 'bggb_mg_video_image' )['alt']; ?>">
                                    </a>
                                    <!-- <video width="320" height="240" controls>
                                        <source src="<?php //the_sub_field( 'bggb_mg_video_link' ); ?>" type="video/youtube/mp4">
                                    </video> -->
                                <?php endif; ?>

                            </div>
                            <!-- End Image Column -->
                        <?php endwhile; ?>
                    <?php endif; ?>

                    <?php if( get_field( 'bggb_content_group' ) ): ?>
                        <?php while( have_rows( 'bggb_content_group' ) ) : the_row(); ?>
                            <!-- Start Content Column -->
                            <div class="content-container cell-md-6">

                                <?php if( get_sub_field( 'bggb_mc_sub_head' ) ): ?>
                                    <!-- Sub Head -->
                                    <!-- <div class="subhead-wrap"> -->
                                        <h3 class="subhead eyebrow-text"><?php the_sub_field( 'bggb_mc_sub_head' ); ?></h3>
                                    <!-- </div> -->
                                <?php endif; ?>

                                <?php if( get_sub_field( 'bggb_mc_header' ) ): ?>
                                    <!-- Title -->
                                    <!-- <div class="title-wrap"> -->
                                        <h2 class="title heading-h0"><?php the_sub_field( 'bggb_mc_header' ); ?></h2>
                                    <!-- </div> -->
                                <?php endif; ?>

                                <?php if( get_sub_field( 'bggb_mc_text' ) ): ?>
                                    <!-- Content -->
                                    <div class="media-content-wrap"><?php the_sub_field( 'bggb_mc_text' ); ?></div>
                                <?php endif; ?>

                                <?php if( get_sub_field( 'bggb_mc_button_text' ) && get_sub_field( 'bggb_mc_button_link' ) ): ?>
                                    <!-- Button Wrap -->
                                    <div class="button-wrap">
                                        <a href="<?php the_sub_field( 'bggb_mc_button_link' ); ?>" class="btn w-full mt-15"><?php the_sub_field( 'bggb_mc_button_text' ); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- End Content Column -->
                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</section>