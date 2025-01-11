<?php
/**
 * Template part for displaying featured posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

?>

<section id="featured-post-section" class="featured-post-section">
	<div class="featured-post-container row">
	
		<!-- Start Featured Post Header -->
		<div class="header-wrap">
			<h2 class="section-header">Featured Posts</h2>
		</div>
		<!-- End Featured Post Header -->

		<!-- Start Loop -->
		<?php
			// Query for featured post
			$featured = new WP_Query( array(
				'posts_per_page' => 1,
				'tag'            => 'featured', // assuming you tag featured posts with "featured"
			) );

			// Query for recent posts
			$recent = new WP_Query( array(
				'posts_per_page' => 3,
				'post__not_in'   => array( $featured->posts[0]->ID ), // exclude featured post
				'tag'            => 'featured', // assuming you tag featured posts with "featured"
			) );

			if ( $featured->have_posts() ) : ?>

			<div class="featured-section row">

				<!-- Column 1: Featured Post -->
				<article class="featured-post col-6">
					<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
						<div class="post-image">
							<?php the_post_thumbnail(); ?>
						</div>
						<div class="post-category">
							<?php the_category(', '); ?>
						</div>
						<h2 class="post-title"><?php the_title(); ?></h2>
						<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
					<?php endwhile; ?>
				</article>

				<!-- Column 2: Recent Posts -->
				<article class="recent-post col-6">
					<?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
						<div class="post-image">
							<?php the_post_thumbnail(); ?>
						</div>
						<div class="post-category">
							<?php the_category(', '); ?>
						</div>
						<h2 class="post-title"><?php the_title(); ?></h2>
						<div class="post-excerpt">
							<?php the_excerpt(); ?>
						</div>
						<a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
					<?php endwhile; ?>
				</article>

			</div>

			<?php endif; 

			wp_reset_postdata();
		?>
		<!-- End Loop -->

	</div>
</section>

<section id="blog-page-builder-section" class="page-builder-section">
	<div class="page-builder-container">

		<?php 
		$query = new WP_Query($args);

		if($query->have_posts()) : 
			while($query->have_posts()): $query->the_post();
				// Display your featured post here
				the_title();
				the_excerpt();
			endwhile;
		endif; 
		wp_reset_query();
		?>

	</div>
</section>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php bgg_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'bgg' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bgg' ),
				'after'  => '</div>',
			) );
			
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->