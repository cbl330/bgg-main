<?php
/**
 * Template Name: Sidebar
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

get_header(); ?>

<!-- start -->
<div class="wrapper">
	<div class="main-container">
		<main class="main-content beside-main">
			<div class="container">
				<!-- <div class="row beside-main-row mb-lg-75 mb-50"> -->
				<div class="row beside-main-row mb-50">
					
					<!-- Start Main Section -->
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="cell-xl-9 cell-lg-8">

							<!-- Start Breadcrumbs -->
							<?php custom_breadcrumbs(); ?>
							<!-- End Breadcrumbs -->
							
							<!-- Start Page Title -->
							<?php //the_title( '<h1 class="entry-title heading-h0 mb-xl-75 mb-30 pb-15">', '</h1>' ); ?>
							<?php the_title( '<h1 class="entry-title heading-h0 mb-30 pb-15">', '</h1>' ); ?>
							<!-- End Page Title -->
							
							<?php if ( has_post_thumbnail() ) : ?>
								<!-- Start Featured Image -->
								<!-- <div class="bph-bg mb-30"> -->
								<div class="pfi mb-30">
									<?php echo the_post_thumbnail(); ?>
								</div>
								<!-- End Featured Image -->
							<?php endif; ?>

							<!-- Start Page Content -->
							<?php the_content(); ?>
							<!-- End Page Content -->

						</div>
					<?php endwhile; ?>
					<!-- End Main Section -->

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
