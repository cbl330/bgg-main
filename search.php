<?php
get_header(); ?>

<div class="wrapper">
	<div class="main-container">
		<main class="main-content beside-main">
			<div class="container">
				<div class="row beside-main-row mb-lg-75 mb-50">
					
					<!-- Start Main Section -->
                    <div class="cell-xl-9 cell-lg-8">
                        <?php //if ( have_posts() ) : ?>
                    
                            <!-- Start Search Results Counter -->
                            <h1 class="search-results-count page-title mb-30 mt-75"><?php echo $wp_query->found_posts; ?> Search Results for <?php echo get_search_query(); ?></h1>
                            <!-- End Search Results Counter -->
                            
                            <?php if ( have_posts() ) : ?>
                                <div class="search-results">
                                    <?php
                                    while ( have_posts() ) :
                                        the_post();
                                        get_template_part( 'template-parts/content', 'search' );
                                    endwhile;
                                    ?>

                                    <!-- Pagination -->
                                    <div class="pagination mt-30">
                                        <?php the_posts_pagination(); ?>
                                    </div>
                                </div>
                            <?php else : ?>
                                <p><?php esc_html_e( 'No results found.', 'bgg' ); ?></p>
                            <?php endif; ?>
                    </div>
					<!-- End Main Section -->

					<!-- Start Sidebar -->
					<div class="cell-xl-3 cell-lg-4 mt-lg-30 mt-50">
						<div class="sidebar pb-30">
							<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
								<?php dynamic_sidebar( 'sidebar' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<!-- End Sidebar -->

				</div>
			</div>
		</main>
	</div>
</div>


<?php
get_footer();
