<?php
	/**
	 * Template Name: No Header
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
	 *
	 * @package bgg
	 */

//get_header(); ?>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link href="<?php echo $home_dir; ?>/favicon.ico" rel="shortcut icon">
	<meta name="description" content="" />
	<meta name="keywords" content="">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />

	<!-- TrustBox script -->
	<script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
	<!-- End TrustBox script -->

	<?php wp_head(); ?>
</head>

<body>

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

										<!-- Start Sidebar - Mobile -->
										<div class="cell-xl-3 cell-lg-4 mt-lg-30 mt-50 mobile-decom">
											<div class="sidebar pb-30">
											<?php if ( get_field( 'decom_template_sidebar_content' ) ) : ?>
												<?php the_field( 'decom_template_sidebar_content' ); ?>
											<?php endif; ?>
											</div>
										</div>
										<!-- End Sidebar - Mobile -->

										<!-- Post Excerpt -->
										<!-- <div><?php //the_excerpt(); ?></div> -->
										
										<!-- Top Page Excerpt -->
										<?php if( get_field( 'bgg_page_option_top_page_content' ) ): ?>
											<div>
												<?php the_field( 'bgg_page_option_top_page_content' ); ?>
											</div>
										<?php endif; ?>
									</div>

									<div class="bch-author-date d-flex align-items-center">
										<!-- <strong class="bch-line">By <?php //the_author(); ?></strong> -->
										<!-- <span class="bch-line">Last updated on <?php //the_date( 'F j, Y' ); ?></span> -->
										<!-- <div class="bch-social d-flex align-items-center">
											<span>Share</span>
											<div class="bch-social-inner d-flex align-items-center">
												<a href="https://www.facebook.com/sharer/sharer.php?u=<?php //the_permalink(); ?>" class="icon-facebook" target="_blank" rel="nofollow"></a>
												<a href="https://twitter.com/intent/tweet?url=<?php //the_permalink(); ?>&text=<?php //the_title(); ?>" class="icon-twitter" target="_blank" rel="nofollow"></a>
												<a href="https://www.linkedin.com/shareArticle?url=<?php //the_permalink(); ?>&title=<?php //the_title(); ?>" class="icon-linkedin" target="_blank" rel="nofollow"></a>
											</div>
										</div> -->
									</div>

									<!-- <div class="bch-img">
										<?php //echo $post_image; ?>
									</div> -->
									
								</section>
								<!-- End Blog Child Hero -->

								<!-- Start Page Builder Section -->
								<?php the_content(); ?>
								<!-- End Page Builder Section -->

							</div>

							<!-- Start Sidebar - Desktop -->

							<div class="cell-xl-3 cell-lg-4 mt-lg-30 mt-50 desktop-decom">
								<div data-sticky="true" class="sidebar pb-30">
								<?php if ( get_field( 'decom_template_sidebar_content' ) ) : ?>
									<?php the_field( 'decom_template_sidebar_content' ); ?>
								<?php endif; ?>
								</div>
							</div>

							<!-- <div class="cell-xl-3 cell-lg-4 mt-lg-30 mt-50">
								<div class="sidebar pb-30">
								<?php //if ( is_active_sidebar( 'no_header_template' ) ) : ?>
									<?php //dynamic_sidebar( 'no_header_template' ); ?>
								<?php //endif; ?>
								</div>
							</div> -->

							<!-- End Sidebar - Desktop -->
							
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

			<?php endwhile; ?>
		<?php endif; ?>

	</div>
</div>

<?php
get_footer();
