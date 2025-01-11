<?php
	/**
	 * The template for displaying all single posts.
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	 *
	 * @package bgg
	 */

	get_header(); 

	// Single Page Variables based on which hero option is selected
	$heroOption1 = 'template-file-1.php';
	$heroOption2 = 'template-file-2.php';
	$heroOption3 = 'template-file-3.php';
	$heroOption4 = 'template-file-4.php';
	$heroOption5 = 'template-file-5.php';
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<!-- START HERO SECTION -->
		<!-- ================================= -->
		<?php //if( get_template_part( $heroOption1 || $heroOption2 || $heroOption3 || $heroOption4 || $heroOption5 ) ) : ?>
		<section id="post-hero-section" class="hero-section">
			<div class="hero-container">

				<!-- Fetch Hero Option 1 Template -->
				<!-- Fetch Hero Option 2 Template -->
				<!-- Fetch Hero Option 3 Template -->
				<!-- Fetch Hero Option 4 Template -->
				<!-- Fetch Hero Option 5 Template -->

			</div>
		</section>
		<?php //endif; ?>
		<!-- ================================= -->
		<!-- END HERO SECTION -->

		<!-- START HEADER SECTION -->
		<!-- ================================= -->
		<section id="post-header-section" class="post-header-section">
			<div class="post-header-container">

				<!-- Post Category -->
				<div class="post-category-wrap">
					<?php the_category(); ?>
				</div>

				<!-- Post Title -->
				<div class="post-title-wrap">
					<?php the_title(); ?>
				</div>
				
				<!-- Post Image -->
				<div class="post-image-wrap">
					<?php the_post_thumbnail(); ?>
				</div>

				<!-- Start Post Meta Wrap -->
				<div class="post-meta-wrap row">
					<!-- Author -->
					<div class="author-wrap">
						By <?php the_author(); ?>
					</div>

					<!-- Date -->
					<div class="date-wrap">
						Last updated on <?php echo get_the_date( 'F j, Y' ); ?>
					</div>

					<!-- Social Share -->
					<div class="social-wrap">

					</div>
				</div>
				<!-- End Post Meta Wrap -->

			</div>
		</section>
		<!-- ================================= -->
		<!-- END HESADER SECTION -->

		<!-- START PAGE BUILDER SECTION -->
		<!-- ================================= -->
		<section id="page-builder" class="page-builder-section">
			<div class="page-builder-container">

			<?php the_content(); ?>

				<!-- This section is for content built with blocks -->
				<?php
					// Start The Loop
					// ---------------------
					// while ( have_posts() ) : the_post();

					// 	get_template_part( 'template-parts/content', get_post_format() );

					// 	the_post_navigation();

						// *** DISABLEING COMMENTS ***
						// ------------------------------
						// If comments are open or we have at least one comment, load up the comment template.
						// if ( comments_open() || get_comments_number() ) :
						// 	comments_template();
						// endif;

					//endwhile;
					// ---------------------
					// End The Loop
				?>

			</div>
		</section>
		<!-- ================================= -->
		<!-- END PAGE BUILDER SECTION -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php
	get_sidebar();
	get_footer();