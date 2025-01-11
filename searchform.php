<?php
/**
 * The template for displaying the search form.
 *
 * @package bgg
 */

?>

<!-- <form role="search" method="get" id="searchform" action="<?php //echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" name="s" id="s" placeholder="Search..." value="<?php //the_search_query(); ?>" />
    <input type="submit" id="searchsubmit" value="Search" />
</form> -->

<!-- <form role="search" method="get" id="searchform" action="<?php //echo esc_url( home_url( '/' ) ); ?>">
    <div>
        <label for="s" class="screen-reader-text">Search for:</label>
        <input type="text" id="s" name="s" value="<?php //the_search_query(); ?>" placeholder="Search..." />
        <input type="submit" id="searchsubmit" value="Search" />
    </div>
</form> -->

<form class="mh-megamenu-search" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="s" class="screen-reader-text">Search for:</label>
    <button class="icon-search"></button>
    <input type="text" id="s" name="s" value="<?php the_search_query(); ?>" placeholder="Search Birch Gold Group">
</form>

<!-- <form class="mh-device-searchbar" role="search" method="get" id="searchform" action="<?php //echo esc_url( home_url( '/' ) ); ?>">
    <label for="s" class="screen-reader-text">Search keywords:</label>
    <input type="text" id="s" name="s" value="<?php //the_search_query(); ?>" placeholder="Search Keywords">
    <span class="mh-device-searchbar-btn icon-search"><input type="submit"></span>
</form> -->