<?php
/**
 * Template Name: Category Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bgg
 */

get_header(); 
?>

    <?php
        // $current_cat = get_queried_object();
        // $product_parent_id = 379; // Replace this with the ID of the "Product" category
        // $blog_parent_id = 386; // Replace this with the ID of the "Blog" category

        // if ( $current_cat->parent == $product_parent_id ) {
        //     get_template_part('category-products'); // Pull product child caetgories template
        // } elseif ( $current_cat->parent == $blog_parent_id ) {
        //     get_template_part('category-articles'); //Pull blog child categories template
        // } else {
        //     // Default category template content
        //     get_header();
        //     // ... rest of the default category content ...
        //     get_footer();
        // }

        //get_template_part('category-articles'); //Pull blog child categories template

        // if ( has_term( '', 'product_categories' ) ) {
        //     get_template_part('category-products'); // Pull product child caetgories template
        // } else {
        //     get_template_part('category-articles'); //Pull blog child categories template
        //     // // Default category template content
        //     // get_header();
        //     // // ... rest of the default category content ...
        //     // get_footer();
        // }

    ?>

<?php
if (is_tax('product_categories')) {
    // You are in the "product-category" custom category
    // Display the template part specific to this category
    get_template_part('category-products');
} else {
    // You are not in the "product-category" custom category
    // Display the default content or template part
    get_template_part('category-blogs');
}
?>

<?php 
get_footer(); 
