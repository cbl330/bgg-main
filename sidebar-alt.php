<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bgg
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php //dynamic_sidebar( 'sidebar-1' ); ?>
	<?php if ( is_active_sidebar( 'custom_sidebar' ) ) : ?>
    <?php dynamic_sidebar( 'custom_sidebar' ); ?>
<?php endif; ?>
</aside><!-- #secondary -->
