<?php
/**
 * Template Name: Endorsements
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

get_header(); ?>

<div class="wrapper">
	<div class="main-container">

		<!-- Content area Part -->
		<main class="main-content beside-main">
			<div class="container">
				<!-- <div class="row beside-main-row mb-lg-75 mb-50"> -->
				<div class="row beside-main-row mb-50">
					<div class="cell-xl-9 cell-lg-8">

						<!-- endorsements-parent-section -->
						<section class="endorsements-parent">

							<!-- Start Breadcrumbs -->
							<?php custom_breadcrumbs(); ?>
							<!-- End Breadcrumbs -->
							
							<div class="mb-50">
								<?php the_title( '<h1 class="entry-title heading-h0">', '</h1>' ); ?>
								
								<!-- Top Page Excerpt -->
								<?php if( get_field( 'bgg_page_option_top_page_content' ) ): ?>
									<div>
										<?php the_field( 'bgg_page_option_top_page_content' ); ?>
									</div>
								<?php endif; ?>
							</div>

							<!-- Start Endorser Section -->
							<div class="row">

								<?php

									$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
									// Custom query to get posts from 'selected' category
									$args = array(
										'post_type' => 'endorser',
										'posts_per_page' => 14,
										'paged' => $paged,
										'orderby' => 'menu_order',
										'order' => 'ASC',
									);

									$endorser_query = new WP_Query($args);

									if ($endorser_query->have_posts()) :
										while ($endorser_query->have_posts()) : $endorser_query->the_post();
										$title = get_the_title();
										$post_image = get_the_post_thumbnail();
										$excerpt = get_the_excerpt();
										$categories = get_the_category();
										$permalink = get_permalink();
										// $content = get_the_content();
										// Strip Specific Tags
										$content = get_the_content();
										// $content_without_links = strip_tags($content, '<p><strong><em><a>'); // Allow certain tags
										$original_content = get_the_content();
										$limited_content = limit_content_to_character_count($original_content, 170);
										// Get the current post ID
										// $post_id = get_queried_object_id(); // Get the ID of the current page/post
										$post_id = get_the_ID();
									?>

									<!-- Start Article -->
									<article class="cell-6 mb-30">
										<div class="ep-block d-flex flex-nowrap">

											<div class="ep-img">
												<?php echo $post_image; ?>
											</div>

											<div class="ep-content">
												<div class="mb-15">
													<div class="mb-15">
														<h6 class="h6 mb-0"><?php echo esc_html( $title ); ?></h6>
														<small><?php echo esc_html( $excerpt ); ?></small>
													</div>
													<?php //echo esc_html( $content_without_links ); ?>
													<?php //echo esc_html( $content ); ?>
													<?php //custom_excerpt(20); // Change 50 to your desired word limit ?>
													<div class="desktop">
														<?php echo $limited_content; ?>
													</div>
												</div>

												<?php // If Endorser Toggle is active ?>
												<?php if( get_field( 'cpt_endorser_link_option' ) == 'endorser' ): ?>
													<a href="<?php echo esc_html( $permalink ); ?>" rel="nofollow" target="_blank" class="btn-link">Read More</a>
												<?php endif; ?>

												<?php // If Custom Toggle is active ?>
												<?php if( get_field( 'cpt_endorser_link_option' ) == 'custom' ): ?>
													<a href="<?php the_field( 'cpt_endorser_custom_link', $post_id ); ?>" rel="nofollow" target="_blank" class="btn-link"><?php the_field( 'cpt_endorser_custom_link_text', $post_id ); ?></a>
												<?php endif; ?>
											</div>

										</div>
									</article>
									<!-- End Article -->

								<?php endwhile; ?>
									
									<?php

									wp_reset_postdata();  // Reset the main query loop

								else :
									echo '<p>No endorsers found.</p>';
								endif;
							?>

							</div>
							<!-- End Endorser Section -->
						</section>

						<!-- Start Pagination -->
						<div class="pagination pt-md-15 pb-md-30 pb-15">
							<div class="container">
								<ul>
									<li><span>Page</span></li>
									<li class="page-numbers"><?php echo paginate_links( array( 
										'total' => $endorser_query->max_num_pages,
										'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#e4a933}</style><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg>',
										'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#e4a933}</style><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg>',
										) ); ?>
									</li>
								</ul>
							</div>
						</div>
						<!-- End Pagination -->

					</div>

					<!-- Start Sidebar -->
					<div class="cell-xl-3 cell-lg-4 mt-lg-30 mt-50">
						<div data-sticky="true" class="sidebar pb-30">
							<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
								<?php dynamic_sidebar( 'sidebar' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<!-- End Sidebar -->

				</div>
			</div>

			<?php if( get_field( 'bgg_template_sidebar_footer_cta_display' ) === 'Show' ) : ?>
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
