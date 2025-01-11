<?php
	/**
	 * The template for displaying all single posts.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	 *
	 * @package bgg
	 */

get_header(); ?>

<div class="wrapper">
	<div class="main-container">

		<?php if( have_posts() ): ?>
			<?php while( have_posts() ) : the_post(); ?>
			<?php 
				$title = get_the_title();
				$post_image = get_the_post_thumbnail();
				$excerpt = get_the_excerpt();
				$categories = get_the_category();
				$permalink = get_permalink();
			?>

				<!-- Page Scroll Menu -->
				<div class="page-scroll-menu">
					<div class="container">
						<?php wp_nav_menu( array( 'theme_location' => 'posts-secondary' ) ); ?>
					</div>
				</div>

				<!-- Content area Part -->
				<main class="main-content beside-main">
					<div class="container">
						<!-- <div class="row beside-main-row mb-lg-75 mb-50"> -->
						<div class="row beside-main-row mb-50">
							<div class="cell-xl-9 cell-lg-8">

								<!-- Start Blog Child Hero -->
								<section class="blog-child-hero mb-30">
									
									<!-- Start Breadcrumbs -->
									<?php custom_breadcrumbs(); ?>
									<!-- End Breadcrumbs -->

									<div class="bch-content mb-30">
										<!-- Post Category -->
										<?php $categories = get_the_category(); ?>
										<?php foreach( $categories as $category ): ?>
											<small class="eyebrow-text -small"><?php echo esc_html( $category->cat_name ); ?></small>
										<?php endforeach; ?>
										<!-- Post Title -->
										<h1 class="h1"><?php the_title(); ?></h1>
										<!-- Post Excerpt -->
										<div><?php the_excerpt(); ?></div>
									</div>

									<div class="bch-author-date d-flex align-items-center">
										<strong class="bch-line">By <?php the_author(); ?></strong>
										<span class="bch-line">Last updated on <?php the_date( 'F j, Y' ); ?></span>
										<div class="bch-social d-flex align-items-center">
											<span>Share</span>
											<div class="bch-social-inner d-flex align-items-center">
												<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="icon-facebook" target="_blank" rel="nofollow"></a>
												<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" class="icon-twitter" target="_blank" rel="nofollow"></a>
												<a href="https://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>" class="icon-linkedin" target="_blank" rel="nofollow"></a>
											</div>
										</div>
									</div>

									<div class="bch-img">
										<?php echo $post_image; ?>
									</div>
									
								</section>
								<!-- End Blog Child Hero -->

								<!-- Start Page Builder Section -->
								<?php the_content(); ?>
								<!-- End Page Builder Section -->

								<!-- Start Author Box -->
								<!-- <section id="<?php //echo esc_attr($id); ?>" class="<?php //echo esc_attr( $class_name ); ?> bgg-block author-section my-30">
									<div class="block-container author-block-container as-wrap">

										<code>BGG - About the Author</code> -->

										<!-- Start Avatar Wrap -->
										<!-- <div class="avatar-wrap as-img">
											<?php //echo get_avatar( get_the_author_meta( 'ID' ), 96 ); ?>
										</div> -->
										<!-- End Avatar Wrap -->

										<!-- Start Content Wrap -->
										<!-- <div class="content-wrap as-content">
											<h4 class="title">About The Author</h4>
											<div class="content"><a href="<?php //echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php //the_author(); ?></a> <?php //echo nl2br( esc_textarea( get_the_author_meta( 'description' ) ) ); ?></div>
										</div> -->
										<!-- End Content Wrap -->
										
									<!-- </div>
								</section> -->
								<!-- End Author Box -->

							</div>

							<!-- Start Sidebar -->
							<div class="cell-xl-3 cell-lg-4 mt-lg-30 mt-50">
								<div data-sticky="true" class="sidebar pb-30">

									<!-- Start Sidebar Widget -->
									<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
										<?php dynamic_sidebar( 'sidebar' ); ?>
									<?php endif; ?>
									<!-- End Sidebar Widget -->

									<!-- Start Related Posts -->
									<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr( $class_name ); ?> bgg-block  id-section">
										<?php 
											// Get Selected Category
											$cat = get_field( 'bggb_posts_selector' );
										?>

										<!-- Start Section Title -->
										<h6>Related Posts</h6>
										<!-- End Section Title -->

										<!-- Start Post Wrap -->
										<div class="sidebar-post">
											<?php
												$current_post_id = get_the_ID();
												$post_categories = get_the_category($current_post_id);

												// Custom query to get posts from 'selected' category
												$args = array(
													'category__in'   => wp_list_pluck($post_categories, 'term_id'),
													'post__not_in'   => array($current_post_id),
													'posts_per_page' => 3, // Adjust the number of related posts to display
												);

												$related_posts_query = new WP_Query($args);

												if ($related_posts_query->have_posts()) :
													while ($related_posts_query->have_posts()) : $related_posts_query->the_post();
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
											
									</section>
									<!-- End Related Posts -->
								</div>
							</div>
							<!-- End Sidebar -->
							
						</div>
					</div>
					
					<?php //if( get_field( 'bgg_template_sidebar_footer_cta_display' ) === 'Show' ) : ?>
						<!-- Start Footer CTA Section -->
						<?php if ( is_active_sidebar( 'top_footer' ) ) : ?>
							<?php dynamic_sidebar( 'top_footer' ); ?>
						<?php endif; ?>
						<!-- End Footer CTA Section -->
					<?php //endif; ?>
				</main>

			<?php endwhile; ?>
		<?php endif; ?>

	</div>
</div>

<?php
get_footer();
