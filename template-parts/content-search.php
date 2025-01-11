<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h2 class="entry-title mt-50 mb-15"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
    </header>

    <div class="entry-content">
        <?php
        custom_excerpt(50); // Change 50 to your desired word limit
        ?>
        <div><a href="<?php the_permalink(); ?>" class="read-more">Read More</a></div>

        <?php
        $product_cats = get_the_terms( get_the_ID(), 'product_cat' );

        if ( $product_cats && ! is_wp_error( $product_cats ) ) :
            echo '<div class="product-categories">';
            echo '<span class="category-label">Categories:</span>';
            foreach ( $product_cats as $cat ) {
                echo '<a href="' . esc_url( get_term_link( $cat ) ) . '">' . esc_html( $cat->name ) . '</a>';
            }
            echo '</div>';
        endif;
        ?>
    </div>
</article>

