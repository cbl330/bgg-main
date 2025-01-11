<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package bgg
 */

get_header(); ?>

<div class="wrapper">
	<div class="main-container">

		<!-- Content area Part -->
		<main class="main-content beside-main main-404">
			<div class="container">
				<!-- <div class="row beside-main-row mb-lg-75"> -->
				<div class="row beside-main-row">

					<!-- Start Main Section -->
					<div class="cell-xl-9 cell-lg-8">
						<!-- Error 404 section -->
						<section class="error-404 mt-xl-75 mt-30">
							<div class="text-center mb-md-50 mb-30">
								<h1 class="heading-h0">Sorry, this page does not exist.</h1>
								<p>The page you requested does not exist. <a href="javascript:void(0);" onclick="window.history.back()" class="back-link">Click here</a> to go back to the previous page.</p>
							</div>

							<!-- Start Search Form -->
							<form class="error-searchbar mb-md-75 mb-50 pb-15" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
								<label for="s" class="screen-reader-text">Search for:</label>
								<button class="icon-search"></button>
								<input type="search" id="s" name="s" value="<?php the_search_query(); ?>" placeholder="Search keyword(s) then hit ‘enter’">
							</form>
							<!-- End Search Forem -->

							<div class="error-block-wrap text-center">
								<h3 class="mb-sm-30">Popular Pages</h3>
								<div class="row justify-content-center">
									<div class="cell-xl-3 cell-sm-4 cell-6 mb-30">
										<a href="<?php the_field( 'options_404_home_page_link', 'option' ); ?>" class="error-block bg-primary-200">
											<div class="error-block-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/error-block-icon-1.svg" alt="error-block-icon">
											</div>
											<h6 class="mb-0">Home Page</h6>
										</a>
									</div>
									<div class="cell-xl-3 cell-sm-4 cell-6 mb-30">
										<a href="<?php the_field( 'options_404_products_link', 'option' ); ?>" class="error-block bg-primary-200">
											<div class="error-block-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/error-block-icon-2.svg" alt="error-block-icon">
											</div>
											<h6 class="mb-0">Products</h6>
										</a>
									</div>
									<div class="cell-xl-3 cell-sm-4 cell-6 mb-30">
										<a href="<?php the_field( 'options_404_news_and_resources_link', 'option' ); ?>" class="error-block bg-primary-200">
											<div class="error-block-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/error-block-icon-3.svg" alt="error-block-icon">
											</div>
											<h6 class="mb-0">News & Resources</h6>
										</a>
									</div>
									<div class="cell-xl-3 cell-sm-4 cell-6 mb-30">
										<a href="<?php the_field( 'options_404_contact_us_link', 'option' ); ?>" class="error-block bg-primary-200">
											<div class="error-block-icon">
												<img src="<?php echo get_template_directory_uri(); ?>/images/error-block-icon-4.svg" alt="error-block-icon">
											</div>
											<h6 class="mb-0">Contact Us</h6>
										</a>
									</div>
								</div>
							</div>
						</section>
					</div>
					<!-- End Main Section -->

					<!-- Start Sidebar Section -->
					<?php get_sidebar(); ?>
					<!-- End Sidebar Section -->

				</div>
			</div>
		</main>
		
	</div>
</div>

<?php
get_footer();