<?php
/**
 * Template Name: Info Kit
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

get_header(); ?>

<div class="wrapper">
	<div class="main-container">

		<!-- Information Kit Hero -->
		<!-- <section class="info-kit-hero mb-xl-75 mb-50"> -->
		<section class="info-kit-hero mb-50">
			<div class="ikh-bg">
				<img src="<?php echo get_template_directory_uri(); ?>/images/info-kit-hero.jpg" alt="info-kit-hero">
			</div>
			<div class="container">
				<div class="ikh-wrap">

					<div class="text-white-all pt-15">
						<!-- Start Breadcrumbs -->
						<?php custom_breadcrumbs(); ?>
						<!-- End Breadcrumbs -->
					</div>
					
					<?php if( get_field( 'bggp_info_kit_hero_title' ) ): ?>
						<div class="ikh-heading text-center mb-30 text-white-all">
							<?php the_field( 'bggp_info_kit_hero_title' ); ?>
						</div>
					<?php endif; ?>
					<div class="ikh-bottom bg-primary-200">
						<div class="row">
							<div class="cell-xl-7 mb-xl-0">
								<div class="row flex-row-reverse">
									<div class="cell-md-6">
										<?php if( get_field( 'bggp_info_kit_cta_image' ) ): ?>
											<div class="ikh-img">
												<img src="<?php the_field( 'bggp_info_kit_cta_image' ); ?>" alt="<?php the_field( 'bggp_info_kit_cta_image' )['alt']; ?>">
											</div>
										<?php endif; ?>
									</div>
									<?php if( get_field( 'bggp_info_kit_cta_text' ) ): ?>
										<div class="cell-md-6">
											<div class="ikh-left-content">
												<?php the_field( 'bggp_info_kit_cta_text' ); ?>
											</div>
										</div>
									<?php endif; ?>
								</div>
							</div>
							<?php if( get_field( 'bggp_info_kit_cta_form' ) ): ?>
								<div class="cell-xl-5">
									<div class="ikh-form p-md-50 p-30">
										<?php the_field( 'bggp_info_kit_cta_form' ); ?>
									</div>
									<!-- <form class="ikh-form p-md-50 p-30">
										<div class="row">
											<div class="cell-sm-6 form-group">
												<label for="ikh-field-1">First Name</label>
												<input type="text" id="ikh-field-1">
											</div>
											<div class="cell-sm-6 form-group">
												<label for="ikh-field-2">Last Name</label>
												<input type="text" id="ikh-field-2">
											</div>
											<div class="cell-12 form-group">
												<label for="ikh-field-4">Email Address</label>
												<input type="email" id="ikh-field-4">
											</div>
											<div class="cell-12 form-group">
												<label for="ikh-field-5">Phone Number</label>
												<input type="tel" id="ikh-field-5">
											</div>
											<div class="cell-12 form-group">
												<div class="checkbox">
													<input type="checkbox" name="" id="ikh-c1">
													<label for="ikh-c1">By checking this box, I have read and agree to Birch Gold Group’s <a href="#">Terms & Conditions</a>.</label>
												</div>
											</div>
											<div class="cell-12 form-group">
												<input class="w-full" type="submit" value="Request Free Information Kit">
											</div>
											<div class="cell-12">
												<p>By submitting this form, you agree to receive automated text messages. This agreement is not a condition of any purchases. Msg & Data rates may apply. Reply STOP at any time to unsubscribe.</p>
											</div>
										</div>
									</form> -->
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Content area Part -->
		<main class="main-content">
		</main>
	</div>
</div>

<?php
get_footer();
