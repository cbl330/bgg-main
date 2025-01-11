<?php
	/**
	 * The template for displaying single product custom posts.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	 *
	 * @package bgg
	 */

	get_header(); 
?>

<div class="wrapper">
	<div class="main-container">

		<!-- Page Scroll Manu -->
		<div class="page-scroll-menu">
			<div class="container">
				<?php wp_nav_menu( array( 'theme_location' => 'products-secondary' ) ); ?>
			</div>
		</div>

		<main class="main-content beside-main">
			<div class="container">
				<div class="row beside-main-row mb-sm-30">

					<!-- Start Main Section -->
					<div class="cell-xl-9 cell-lg-8">

						<!-- Start Page Header Section -->
						<section class="products-child-hero mb-30">

							<!-- Start Breadcrumbs -->
							<?php custom_breadcrumbs(); ?>
							<!-- End Breadcrumbs -->

							<!-- Start Page Title Wrap -->
							<div class="page-title">
								<h1 class="h1 mb-50"><?php the_title(); ?></h1>
							</div>
							<!-- End Page Title Wrap -->

							<!-- Start Product Hero Section -->
							<div class="row mb-50">
								<?php if( have_rows( 'bggb_pb_product_media' ) ): ?>
									<div class="cell-md-5 mb-md-0 mb-50">

										<!-- Start PCH Featured Section -->
										<div class="pch-slider">

											<?php while( have_rows( 'bggb_pb_product_media' ) ) : the_row(); ?>
												<?php if( get_sub_field( 'bggb_pb_media_select' ) == 'Image' ): ?>

													<!-- Start Featured Image Item -->
													<div class="pch-item">
														<?php if( has_term( 'IRA-Approved', 'product_categories' ) ) : ?>
															<!-- Start Ribbon Wrap -->
															<div class="pch-ribbon">IRA Eligible</div>
															<!-- End Robbon Wrap -->
														<?php endif; ?>
														<div class="pch-media">
															<img src="<?php the_sub_field( 'bggb_pb_product_image' ); ?>" alt="<?php the_sub_field( 'bggb_pb_product_image' )['alt']; ?>">
														</div>
													</div>
													<!-- End Featured Image Item -->
												<?php endif; ?>

												<?php if( get_sub_field( 'bggb_pb_media_select' ) == 'Video' ): ?>
													<!-- Start Featured Video Item -->
													<div class="pch-item">
														<?php if( has_term( 'IRA-Approved', 'product_categories' ) ) : ?>
															<!-- Start Ribbon Wrap -->
															<div class="pch-ribbon">IRA Eligible</div>
															<!-- End Robbon Wrap -->
														<?php endif; ?>
														<a href="<?php the_sub_field( 'bggb_pb_product_video_link' ); ?>" data-fancybox class="pch-media -video">
															<img src="<?php the_sub_field( 'bggb_pb_video_image' ); ?>" alt="<?php the_sub_field( 'bggb_pb_video_image' )['alt']; ?>">
														</a>
													</div>
													<!-- End Featured Video Item -->
												<?php endif; ?>
											<?php endwhile; ?>

										</div>
										<!-- End PCH Featured Section -->

										<!-- Start PCH Thmbnail Section -->
										<div class="pch-thumb-slider d-flex justify-content-center">
											<?php while( have_rows( 'bggb_pb_product_media' ) ) : the_row(); ?>
												<?php if( get_sub_field( 'bggb_pb_media_select' ) == 'Image' ): ?>
													<!-- Start Product Image Thumb -->
													<div class="pch-thumb-item">
														<div class="pch-thumb-media">
															<img src="<?php the_sub_field( 'bggb_pb_product_image' ); ?>" alt="<?php the_sub_field( 'bggb_pb_product_image' )['alt']; ?>">
														</div>
													</div>
													<!-- End Product Image Thumb -->
												<?php endif; ?>

												<?php if( get_sub_field( 'bggb_pb_media_select' ) == 'Video' ): ?>
													<!-- Start Product Video Thumb -->
													<div class="pch-thumb-item">
														<div class="pch-thumb-media -video">
															<img src="<?php the_sub_field( 'bggb_pb_video_image' ); ?>" alt="<?php the_sub_field( 'bggb_pb_video_image' )['alt']; ?>">
														</div>
													</div>
													<!-- End Product Video Thumb -->
												<?php endif; ?>
											<?php endwhile; ?>
										</div>
										<!-- End PCH Thmbnail Section -->
									</div>
								<?php endif; ?>

								<?php if( get_field( 'bggb_pb_product_facts' ) ): ?>
									<div class="cell-md-7">
										<h4>Facts at a Glance</h4>
										<?php the_field( 'bggb_pb_product_facts' ); ?>
									</div>
								<?php endif; ?>

							</div>
							<!-- End Product Hero Section -->

						</section>
						<!-- End Page Header Section -->

						<!-- Start Page Builder Section -->
						<section class="products-child-hero mb-30">
							<?php the_content(); ?>
						</section>
						<!-- End Page Builder Section -->

					</div>
					<!-- End Main Section -->

					<!-- Start Sidebar Section -->
					<div class="cell-xl-3 cell-lg-4 mt-lg-30 mt-50">
						<div data-sticky="true" class="sidebar pb-30">
							<?php if ( is_active_sidebar( 'products_child' ) ) : ?>
								<?php dynamic_sidebar( 'products_child' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<!-- End Sidebar Section -->

				</div>
			</div>

			<?php if( get_field( 'bgg_product_settings_enable_related_products' ) === 'Show' ) : ?>
				<!-- Start Related Products Section -->
				<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block products-listing py-15">
					<div class="container">

						<!-- Start Section Title -->
						<h2 class="mb-30">Related Products</h2>
						<!-- End Section Title -->

						<!-- Start Post Wrap -->
						<div class="row roducts-block-row">
							<?php

								// Get the current product category
								$product_cats = get_the_terms( get_the_ID(), 'product_categories' );
								if( $product_cats && !is_wp_error( $product_cats ) ) {
									$single_cat = array_shift( $product_cats );
									$product_cat_id = $single_cat->term_id;
								}

								// Custom query to get posts from 'selected' category
								$args = array(
									'post_type' => 'products',
									'posts_per_page' => 5,  // You can change this to the number of posts you want to display
									'post__not_in'   => array( get_the_ID() ), // exclude current product
									'tax_query' => array(
										array(
											'taxonomy' => 'product_categories', // Your custom taxonomy name
											'field'    => 'id',
											'terms'    => $product_cat_id,
											'operator' => 'IN'
										),
									),
								);

								$related_products = new WP_Query($args);

								if ($related_products->have_posts()) :
									while ($related_products->have_posts()) : $related_products->the_post();
									$title = get_the_title();
									$post_image = get_the_post_thumbnail();
									$excerpt = get_the_excerpt();
									$categories = get_the_category();
									$permalink = get_permalink();
									$limited_excerpt = limit_content_to_character_count($excerpt, 125);
								?>
									<!-- Start Article -->
									<article class="cell-lg-3 cell-md-4 cell-sm-6 mb-15 products-block-cell products">
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
											<div class="pl-content product-content-wrap">
												<!-- Title -->
												<h5 class="h5"><?php echo esc_html( $title ); ?></h5>
												<!-- Excerpt -->
												<!-- <div><?php //echo esc_html( $excerpt ); ?></div> -->
												<div class="excerpt pb-15"><?php echo esc_html( $limited_excerpt ); ?></div>
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
						</div>
						<!-- End Post Wrap -->
						
					</div>
				</section>
				<!-- End Related Products Section -->
			<?php endif; ?>

			<?php //if( get_field( 'bgg_product_settings_enable_related_products' ) === 'Show' ) : ?>
				<!-- Start Related Products Section -->
				<?php //if ( is_active_sidebar( 'product_pre_footer' ) ) : ?>
					<?php //dynamic_sidebar( 'product_pre_footer' ); ?>
				<?php //endif; ?>
				<!-- End Related Products Section -->
			<?php //endif; ?>


			<?php if( get_field( 'bgg_product_settings_enable_pre-footer_cta' ) === 'Show' ) : ?>
				<!-- Start Footer CTA Section -->
				<?php if ( is_active_sidebar( 'top_footer' ) ) : ?>
					<?php dynamic_sidebar( 'top_footer' ); ?>
				<?php endif; ?>
				<!-- End Footer CTA Section -->
			<?php endif; ?>

		</main>

	</div>
</div>

<?php
get_footer();
