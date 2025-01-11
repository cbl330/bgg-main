<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bgg 
 */

global $home_dir; 

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
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

<body <?php body_class(); ?>>
    <div id="page" class="site wrapper">
        <div class="main-container">

            <!-- Start Device Menu Section -->
            <div class="mbnav">
                <div class="mbnav__backdrop"></div>
                <?php if( have_rows( 'global_header_main_header', 'option' ) ): ?>
                    <?php while( have_rows( 'global_header_main_header', 'option' ) ) : the_row(); ?>
                        <div class="mbnav__state" data-clickable="true">
                            <!--  main responsive menu -->
                            <div class="mbnav__inner">
                                
                                <?php if( have_rows( 'global_header_main_header_interest_repeater', 'option' ) ): ?>
                                    <!-- Start Interest Selection - Mobile -->
                                    <div class="mh-block mh-select">
                                        <span>I’m interested in...</span>
                                        <select name="select-interest" id="pageSelect" onchange="top.location.href = this.options[this.selectedIndex].value;">
                                            <option value="Select your interest" disabled selected>Select your interest</option>
                                            <?php while( have_rows( 'global_header_main_header_interest_repeater', 'option' ) ) : the_row(); ?>
                                                <option value="<?php the_sub_field( 'global_header_interest_repeater_option_link', 'option' ); ?>"><?php the_sub_field( 'global_header_interest_repeater_option_text', 'option' ); ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <!-- End Intterest Selection - Mobile -->
                                <?php endif; ?>

                                <!-- Start Mobile - Top Header Container -->
                                <div class="container">

                                    <?php if( get_sub_field( 'global_header_phone_number', 'option' ) ): ?>
                                        <!-- Start Call Wrap -->
                                        <div class="mh-block mh-call">
                                            <span>Call Our Gold Experts</span>
                                            <div class="d-flex flex-nowrap align-items-center">
                                                <i class="icon-call"></i>
                                                <a href="tel:<?php the_sub_field( 'global_header_phone_number', 'option' ); ?>" class="mh-call-link"><?php the_sub_field( 'global_header_phone_number', 'option' ); ?></a>
                                            </div>
                                        </div>
                                        <!-- End Call Wrap -->
                                    <?php endif; ?>

                                    <!-- Start Sub Nav Search Container - Mobile -->
                                    <?php get_search_form(); ?>
                                    <!-- End Sub Nav Search Container - Mobile -->

                                </div>
                                <!-- End Mobile - Top Header Container -->

                                <!-- Start Mobile - Bottom Header Navigation -->
                                <ul>
                                    <?php if( have_rows( 'global_header_main_header_navigation_one', 'option' ) ): ?>
                                        <?php while( have_rows( 'global_header_main_header_navigation_one', 'option' ) ) : the_row(); ?>
                                            <!-- Start Mobile - Top Level Nav 1 -->
                                            <li class="has-sub"><a href="<?php the_sub_field( 'global_header_main_header_navigation_one_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_main_header_navigation_one_nav_text', 'option' ); ?></a>
                                                
                                                <!-- Start Mobile - Sub Nav 1 -->
                                                <ul>
                                                    <li class="mh-megamenu">
                                                        <div class="mh-megamenu-inner">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="cell-xl-7">
                                                                        <div class="row">
                                                                            
                                                                            <?php if( have_rows( 'global_header_why_gold_ira_sub_menu_left_side_menu', 'option' ) ): ?>
                                                                                <!-- Start Mobile - Top Navigation Container -->
                                                                                <div class="cell-md-5 left-cell">
                                                                                    <ul>
                                                                                        <?php while( have_rows( 'global_header_why_gold_ira_sub_menu_left_side_menu', 'option' ) ) : the_row(); ?>
                                                                                            <!-- Start Mobile - Nav Item Wrap -->
                                                                                            <li>
                                                                                                <a href="<?php the_sub_field( 'global_header_why_gold_ira_sub_menu_left_side_menu_sub_menu_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_why_gold_ira_sub_menu_left_side_menu_sub_menu_nav_text', 'option' ); ?></a>
                                                                                            </li>
                                                                                            <!-- End Mobile - Nav Item Wrap -->
                                                                                        <?php endwhile; ?>
                                                                                    </ul>
                                                                                </div>
                                                                                <!-- End Mobile - Top Navigation Container -->
                                                                            <?php endif; ?>

                                                                            <?php if( have_rows( 'global_header_why_gold_ira_sub_menu_right_side_menu', 'option' ) ): ?>
                                                                                <!-- Start Mobile - Botton Navigation Container -->
                                                                                <div class="cell-md-7 middle-cell">
                                                                                    <div class="middle-title">Storage Options</div>
                                                                                    <ul>
                                                                                        <?php while( have_rows( 'global_header_why_gold_ira_sub_menu_right_side_menu', 'option' ) ) : the_row(); ?>
                                                                                            <!-- Start Mobile - Nav Item Wrap -->
                                                                                            <li>
                                                                                                <div>
                                                                                                    <a href="<?php the_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_link', 'option' ); ?>">
                                                                                                        <!-- Nav Item Image -->
                                                                                                        <?php if( get_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_image', 'option' ) ): ?>
                                                                                                            <div class="middle-img"><img src="<?php the_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_image', 'option' ); ?>" alt="<?php the_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_image', 'option' )['alt']; ?>"></div>
                                                                                                        <?php endif; ?>
                                                                                                        
                                                                                                        <!-- Nav Item Text -->
                                                                                                        <span><?php the_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_text', 'option' ); ?></span>
                                                                                                    </a>
                                                                                                </div>
                                                                                            </li>
                                                                                            <!-- End Mobiel - Nav Item Wrap -->
                                                                                        <?php endwhile; ?>
                                                                                    </ul>
                                                                                </div>
                                                                                <!-- End Mobile - Bottom Navigation Container -->
                                                                            <?php endif; ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- End Mobiel - Sub Nav 1 -->

                                            </li>
                                            <!-- End Mobile - Top Level Nav 1 -->
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                    <?php if( have_rows( 'global_header_main_header_navigation_two', 'option' ) ): ?>
                                        <?php while( have_rows( 'global_header_main_header_navigation_two', 'option' ) ) : the_row(); ?>
                                            <!-- Start Mobile - Top Level Nav 2 -->
                                            <li class="has-sub"><a href="<?php the_sub_field( 'global_header_main_header_navigation_two_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_main_header_navigation_two_nav_text', 'option' ); ?></a>
                                                
                                                <!-- Start Mobile - Sub Nav 2 -->
                                                <ul>
                                                    <li class="mh-megamenu">
                                                        <div class="mh-megamenu-inner">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="cell-xl-7">
                                                                        <div class="row">

                                                                            <?php if( have_rows( 'global_header_products_product_category_repeater', 'option' ) ): ?>
                                                                                <?php while( have_rows( 'global_header_products_product_category_repeater', 'option' ) ) : the_row(); ?>
                                                                                    <!-- Start Mobile - Product Category Nav Container -->
                                                                                    <div class="cell-md-3 cell-6 left-cell lc2">
                                                                                        <!-- Nav image -->
                                                                                        <div class="lc2-img"><img src="<?php the_sub_field( 'global_header_products_product_category_repeater_product_category_image', 'option' ); ?>" alt="<?php the_sub_field( 'global_header_products_product_category_repeater_product_category_image', 'option' )['alt']; ?>"></div>

                                                                                        <!-- Start Category Sub Nav -->
                                                                                        <ul>
                                                                                            <?php if( get_sub_field( 'global_header_products_product_category_repeater_product_category_title', 'option' ) ): ?>
                                                                                                <!-- Start Nav Title -->
                                                                                                <li><a href="<?php the_sub_field( 'global_header_products_product_category_repeater_product_category_title_link', 'option' ); ?>"><strong><?php the_sub_field( 'global_header_products_product_category_repeater_product_category_title', 'option' ); ?></strong></a></li>
                                                                                                <!-- End Nab Title -->
                                                                                            <?php endif; ?>

                                                                                            <?php if( have_rows( 'global_header_product_sub_category_repeater', 'option' ) ): ?>
                                                                                                <?php while( have_rows( 'global_header_product_sub_category_repeater', 'option' ) ) : the_row(); ?>
                                                                                                    <!-- Start Sub Nav Item Wrap -->
                                                                                                    <li><a href="<?php the_sub_field( 'global_header_product_sub_category_repeater_category_link', 'option' ); ?>"><?php the_sub_field( 'global_header_product_sub_category_repeater_category_name', 'option' ); ?></a></li>
                                                                                                    <!-- End Sub Nav Item Wrap -->
                                                                                                <?php endwhile; ?>
                                                                                            <?php endif; ?>
                                                                                        </ul>
                                                                                        <!-- End Category Sub Nav -->
                                                                                    </div>
                                                                                    <!-- End Mobile - Product Category Nav Container -->
                                                                                <?php endwhile; ?>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- End Mobile - Sub Nav 2 -->

                                            </li>
                                            <!-- End Mobile - Top Level Nav 2 -->
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                    <?php if( have_rows( 'global_header_main_header_navigation_three', 'option' ) ): ?>
                                        <?php while( have_rows( 'global_header_main_header_navigation_three', 'option' ) ) : the_row(); ?>
                                            <!-- Start Mobile - Top Level Nav 3 -->
                                            <li class="has-sub"><a href="<?php the_sub_field( 'global_header_main_header_navigation_three_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_main_header_navigation_three_nav_text', 'option' ); ?></a>
                                                
                                                <!-- Start Mobile - Sub Nav 3 -->
                                                <ul>
                                                    <li class="mh-megamenu">
                                                        <div class="mh-megamenu-inner">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="cell-xl-7 lc3">
                                                                        <div class="row">

                                                                            <?php if( have_rows( 'global_header_news_and_resources_sub_menu_right_side_menu', 'option' ) ): ?>
                                                                                <!-- Start Mobile - Top Nav Container -->
                                                                                <div class="cell-md-5 left-cell">
                                                                                    <ul>
                                                                                        <?php while( have_rows( 'global_header_news_and_resources_sub_menu_right_side_menu', 'option' ) ) : the_row(); ?>
                                                                                            <!-- Start Nav Item Wrap -->
                                                                                            <li>
                                                                                                <a href="<?php the_sub_field( 'global_header_news_and_resources_sub_menu_right_side_menu_sub_menu_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_news_and_resources_sub_menu_right_side_menu_sub_menu_nav_text', 'option' ); ?></a>
                                                                                            </li>
                                                                                            <!-- End Nav Item Wrap -->
                                                                                        <?php endwhile; ?>
                                                                                    </ul>
                                                                                </div>
                                                                                <!-- End Mobile - Top Nav Container -->
                                                                            <?php endif; ?>

                                                                            <?php if( get_field( 'global_header_news_and_resources_sub_menu_left_side_menu_latests_post_selector', 'option' ) ): ?>
                                                                                <!-- Start Mobile - Post List Container -->
                                                                                <div class="cell-md-7 middle-cell">
                                                                                    
                                                                                    <?php 
                                                                                        // Get Selected Category
                                                                                        $cat = get_field( 'global_header_news_and_resources_sub_menu_left_side_menu_latests_post_selector', 'option' );
                                                                                    ?>

                                                                                    <div class="middle-title"><a href="/blog/"><?php echo esc_html($cat['label']); ?></a></div>

                                                                                    <ul>
                                                                                        <?php
                                                                                            // Custom query to get posts from 'selected' category
                                                                                            $args = array(
                                                                                                'category_name' => $cat['value'],
                                                                                                'posts_per_page' => 4,  // You can change this to the number of posts you want to display
                                                                                            );

                                                                                            $posts_query = new WP_Query($args);

                                                                                            if ($posts_query->have_posts()) :
                                                                                                while ($posts_query->have_posts()) : $posts_query->the_post();
                                                                                                $title = get_the_title();
                                                                                                $post_image = get_the_post_thumbnail();
                                                                                                $excerpt = get_the_excerpt();
                                                                                                $categories = get_the_category();
                                                                                                $permalink = get_permalink();
                                                                                        ?>

                                                                                        <!-- Start Post Article -->
                                                                                        <li>
                                                                                            <a href="<?php echo esc_html( $permalink ); ?>">
                                                                                                <div class="middle-img">
                                                                                                    <?php echo $post_image; ?>
                                                                                                </div>
                                                                                                <span><?php echo esc_html( $title ); ?></span>
                                                                                            </a>
                                                                                        </li>
                                                                                        <!-- End Post Article -->

                                                                                        <?php
                                                                                            endwhile;
                                                                                            wp_reset_postdata();  // Reset the main query loop
                                                                                            else :
                                                                                                echo '<p>No articles found.</p>';
                                                                                            endif;
                                                                                        ?>
                                                                                    </ul>

                                                                                    <!-- <strong><a href="<?php //echo site_url(); ?>/category/<?php //echo esc_html($cat['value']); ?>">View All <?php //echo esc_html($cat['label']); ?></a></strong> -->
                                                                                    <strong><a href="/blog/">View All <?php echo esc_html($cat['label']); ?></a></strong>

                                                                                </div>
                                                                                <!-- End Mobile - Post List Container -->
                                                                            <?php endif; ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- End Mobile - Sub Nav 3 -->

                                            </li>
                                            <!-- End Mobile - Top Level Nav 3 -->
                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                    <?php if( have_rows( 'global_header_main_header_navigation_four', 'option' ) ): ?>
                                        <?php while( have_rows( 'global_header_main_header_navigation_four', 'option' ) ) : the_row(); ?>
                                            <!-- Start Mobile - Top Level Nav 4 -->
                                            <li class="has-sub"><a href="<?php the_sub_field( 'global_header_main_header_navigation_four_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_main_header_navigation_four_nav_text', 'option' ); ?></a>
                                                
                                                <!-- Start Mobile - Sub Nav 4 -->
                                                <ul>
                                                    <li class="mh-megamenu">
                                                        <div class="mh-megamenu-inner">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="cell-xl-7 lc4">
                                                                        <div class="row">

                                                                            <?php if( have_rows( 'global_header_about_sub_menu_right_side_menu', 'option' ) ): ?>
                                                                                <!-- Start Mobile - Nav Wrap -->
                                                                                <div class="cell-md-5 left-cell">
                                                                                    <ul>
                                                                                        <?php while( have_rows( 'global_header_about_sub_menu_right_side_menu', 'option' ) ) : the_row(); ?>
                                                                                            <!-- Start Nav Item Wrap -->
                                                                                            <li>
                                                                                                <a href="<?php the_sub_field( 'global_header_about_sub_menu_right_side_menu_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_about_sub_menu_right_side_menu_nav_text', 'option' ); ?></a>
                                                                                            </li>
                                                                                            <!-- End Nav Item Wrap -->
                                                                                        <?php endwhile; ?>
                                                                                    </ul>
                                                                                </div>
                                                                                <!-- End Mobile - Nav Wrap -->
                                                                            <?php endif; ?>

                                                                            <?php if( get_field( 'global_header_about_sub_menu_endorsement_selector', 'option' ) ): ?>
                                                                                <!-- Start Endorsement Listing -->
                                                                                <div class="cell-md-7 middle-cell">
                                                                                <div class="middle-title"><a href="/endorsements/">Endorsements</a></div>
                                                                                    <ul>
                                                                                        <?php foreach( get_field( 'global_header_about_sub_menu_endorsement_selector', 'option' ) as $card ):
                                                                                            $title = get_the_title( $card -> ID );
                                                                                            $post_image = get_the_post_thumbnail( $card -> ID );
                                                                                            $excerpt = get_the_excerpt( $card -> ID );
                                                                                            $permalink = get_the_permalink( $card -> ID );
                                                                                            $post_id = $card -> ID;
                                                                                        ?>

                                                                                            <!-- Start Endorser -->
                                                                                            <li>

                                                                                                <?php if( get_field( 'cpt_endorser_link_option', $post_id ) == 'endorser' ): ?>
                                                                                                    <!-- Start Endorser - If Endorser toggle is active -->
                                                                                                    <a href="<?php echo $permalink; ?>" rel="nofollow" target="_blank">
                                                                                                <?php endif; ?>

                                                                                                <?php if( get_field( 'cpt_endorser_link_option', $post_id ) == 'custom' ): ?>
                                                                                                    <!-- Start Endorser - If Custom toggle is active -->
                                                                                                    <a href="<?php the_field( 'cpt_endorser_custom_link', $post_id ); ?>" rel="nofollow" target="_blank">
                                                                                                <?php endif; ?>

                                                                                                <?php if( get_field( 'cpt_endorser_link_option', $post_id ) == 'none' ): ?>
                                                                                                    <!-- Start Endorser - If None toggle is active -->
                                                                                                    <a href="#" rel="nofollow">
                                                                                                <?php endif; ?>

                                                                                                <!-- <a href="<?php //echo $permalink; ?>"> -->
                                                                                                    <div class="middle-img">
                                                                                                        <?php echo $post_image; ?>
                                                                                                    </div>
                                                                                                    <span><?php echo $title; ?></span>
                                                                                                </a>
                                                                                            </li>
                                                                                            <!-- End Endorser -->

                                                                                            <!-- Start Endorser -->
                                                                                            <!-- <li>
                                                                                                <a href="<?php //echo $permalink; ?>">
                                                                                                    <div class="middle-img">
                                                                                                        <?php //echo $post_image; ?>
                                                                                                    </div>
                                                                                                    <span><?php //echo $title; ?></span>
                                                                                                </a>
                                                                                            </li> -->
                                                                                            <!-- End Endorser -->
                                                                                        <?php endforeach; ?>
                                                                                    </ul>

                                                                                    <strong><a href="/endorsements/">View All Endorsements</a></strong>

                                                                                </div>
                                                                                <!-- End Endorsement Listing -->
                                                                            <?php endif; ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!-- End Mobile - Sub Nav 4 -->

                                            </li>
                                            <!-- End Mobile - Top Level Nav 4 -->
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </ul>
                                <!-- End Mobile - Bottom Header Navigation -->

                                <?php if( get_field( 'global_header_mobile_cta', 'option' ) ): ?>
                                    <!-- Start Mobile - Header CTA -->
                                    <div class="container">
                                        <div class="mh-megamenu-inner">
                                            <div class="right-cell">
                                                <div class="right-inner">
                                                    <?php the_field( 'global_header_mobile_cta', 'option' ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Mobile - Header CTA -->
                                <?php endif; ?>

                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <!-- End Device Menu Section -->

            <!-- Start Main Header Section -->
            <header class="main-header">

                <!-- Start Top Header Container -->
                <div class="mh-top">
                    <div class="container mh-top-container d-flex flex-nowrap justify-content-between">

                        <!-- Start Metal Ticker -->
                        <!-- <div class="mh-top-left">
                            <span class="mh-top-left-line"><strong>Gold</strong> $1,934.81 <span class="mh-top-green">+1.56%</span></span>
                            <span class="mh-top-left-line"><strong>Silver</strong> $23.95 <span class="mh-top-green">+1.77%</span></span>
                            <span class="mh-top-left-line"><strong>Platinum</strong> $1,046.97 <span class="mh-top-green">+0.11%</span></span>
                            <span class="mh-top-left-line"><strong>Palladium</strong> $1,795.56 <span class="mh-top-green">+3.01%</span></span>
                        </div> -->

                        <div id='eec56117-a729-43af-ad70-7c864288b8a7' class="price-ticker mh-top-left" style='width:100%;height:100%;'></div>
                        <script>
                            (function(){
                                var t = document.getElementsByTagName('script')[0];
                                var s = document.createElement('script'); s.async = true;
                                s.src = 'https://widget.nfusionsolutions.com/widget/script/ticker/1/eadb6273-0b0a-466d-97c0-668f1e9b29de/eec56117-a729-43af-ad70-7c864288b8a7';
                                t.parentNode.insertBefore(s, t);
                            })();
                        </script>
                        
                        <!-- End Metal Ticker -->

                        <!-- Start Right Side Wrap -->
                        <div class="mh-top-right">
                            <?php if( have_rows( 'global_header_top_header', 'option' ) ): ?>
                                <?php while( have_rows( 'global_header_top_header', 'option' ) ) : the_row(); ?>
                                    <!-- Start Contact Us Navigation -->
                                    <div class="mh-top-right-inner">
                                        <a href="<?php the_sub_field( 'global_header_nav_link', 'option' ); ?>" class="mh-top-contact"><?php the_sub_field( 'global_header_nav_text', 'option' ); ?></a>
                                    </div>
                                    <!-- End Contact Us Navigation -->
                                <?php endwhile; ?>
                            <?php endif; ?>

                            <!-- Start Keyword Search Form -->
                            <form class="mh-searchbar" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <label for="s" class="screen-reader-text">Search keyword:</label>
                                <button class="icon-search"></button>
                                <input type="search" id="s" name="s" value="<?php the_search_query(); ?>" placeholder="Search Keywords">
                            </form>
                            <!-- End Keyword Search Form -->
                        </div>
                        <!-- End Right Side Wrap -->

                    </div>
                </div>
                <!-- End Top Header Contaier -->

                <?php if( have_rows( 'global_header_main_header', 'option' ) ): ?>
                    <?php while( have_rows( 'global_header_main_header', 'option' ) ) : the_row(); ?>
                        <!-- Start Bottom Header Container -->
                        <div class="mh-bottom">
                            <div class="container d-flex flex-nowrap align-items-center justify-content-between">
                                
                                <!-- Start Main Navigation Container -->
                                <div class="mh-bottom-left d-flex flex-nowrap">

                                    <?php if( get_sub_field( 'global_header_header_logo', 'option' ) ): ?>
                                        <!-- Start Logo Wrap -->
                                        <a href="<?php the_sub_field( 'global_header_header_logo_link', 'option' ); ?>" class="brand">
                                            <img src="<?php the_sub_field( 'global_header_header_logo', 'option' ); ?>" alt="<?php the_sub_field( 'global_header_header_logo', 'option' )['alt']; ?>">
                                        </a>
                                        <!-- End Logo Wrap -->
                                    <?php endif; ?>

                                    <!-- Start Main Nav Wrap -->
                                    <nav class="navigation ">
                                        <ul>
                                            <?php if( have_rows( 'global_header_main_header_navigation_one', 'option' ) ): ?>
                                                <?php while( have_rows( 'global_header_main_header_navigation_one', 'option' ) ) : the_row(); ?>
                                                    <!-- Start Top Level Nav 1 -->
                                                    <li class="has-sub"><a href="<?php the_sub_field( 'global_header_main_header_navigation_one_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_main_header_navigation_one_nav_text', 'option' ); ?></a>
                                                        
                                                        <!-- Start Sub Nav 1 -->
                                                        <ul>
                                                            <li class="mh-megamenu">
                                                                <div class="mh-megamenu-inner">
                                                                    <div class="container">
                                                                        
                                                                        <!-- Start Sub Nav Search Container -->
                                                                        <?php get_search_form(); ?>
                                                                        <!-- End Sub Nav Search Container -->

                                                                        <!-- Start Sub Nav Bottom Container -->
                                                                        <div class="row">

                                                                            <!-- Start Navigation Container -->
                                                                            <div class="cell-lg-7">
                                                                                <div class="row">

                                                                                    <?php if( have_rows( 'global_header_why_gold_ira_sub_menu_left_side_menu', 'option' ) ): ?>
                                                                                        <!-- Start Left Side Navigation -->
                                                                                        <div class="cell-md-5 left-cell">
                                                                                            <ul>
                                                                                                <?php while( have_rows( 'global_header_why_gold_ira_sub_menu_left_side_menu', 'option' ) ) : the_row(); ?>
                                                                                                    <!-- Start Nav Item Wrap -->
                                                                                                    <li>
                                                                                                        <a href="<?php the_sub_field( 'global_header_why_gold_ira_sub_menu_left_side_menu_sub_menu_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_why_gold_ira_sub_menu_left_side_menu_sub_menu_nav_text', 'option' ); ?></a>
                                                                                                    </li>
                                                                                                    <!-- End Nav Item Wrap -->
                                                                                                <?php endwhile; ?>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <!-- End Left Side Navigation -->
                                                                                    <?php endif; ?>

                                                                                    <?php if( have_rows( 'global_header_why_gold_ira_sub_menu_right_side_menu', 'option' ) ): ?>
                                                                                        <!-- Start Right Side Navigation -->
                                                                                        <div class="cell-md-7 middle-cell">
                                                                                            <div class="middle-title">Storage Options</div>
                                                                                            <ul>
                                                                                                <?php while( have_rows( 'global_header_why_gold_ira_sub_menu_right_side_menu', 'option' ) ) : the_row(); ?>
                                                                                                <!-- Start Nav Item Wrap -->
                                                                                                    <li>
                                                                                                        <a href="<?php the_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_link', 'option' ); ?>">
                                                                                                            <?php if( get_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_image', 'option' ) ): ?>
                                                                                                                <div class="middle-img"><img src="<?php the_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_image', 'option' ); ?>" alt="<?php the_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_image', 'option' )['alt']; ?>"></div>
                                                                                                            <?php endif; ?>
                                                                                                            <span><?php the_sub_field( 'global_header_why_gold_ira_sub_menu_right_side_menu_nav_text', 'option' ); ?></span>
                                                                                                        </a>
                                                                                                    </li>
                                                                                                <!-- End Nav Item Wrap -->
                                                                                                <?php endwhile; ?>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <!-- End Right Side Navigation -->
                                                                                    <?php endif; ?>

                                                                                </div>
                                                                            </div>
                                                                            <!-- End Navigation Container -->

                                                                            <?php if( get_field( 'global_header_why_gold_ira_sub_menu_cta', 'option' ) ): ?>
                                                                                <!-- Start Sub Nav CTA -->
                                                                                <div class="cell-lg-5 right-cell">
                                                                                    <div class="right-inner">
                                                                                        <?php the_field( 'global_header_why_gold_ira_sub_menu_cta', 'option' ); ?>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- End Sub Nav CTA -->
                                                                            <?php endif; ?>

                                                                        </div>
                                                                        <!-- End Sub Nav Bottom Container -->

                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        <!-- End Sub Nav 1 -->

                                                    </li>
                                                    <!-- End Top Level Nav 1 -->
                                                <?php endwhile; ?>
                                            <?php endif; ?>

                                            <?php if( have_rows( 'global_header_main_header_navigation_two', 'option' ) ): ?>
                                                <?php while( have_rows( 'global_header_main_header_navigation_two', 'option' ) ) : the_row(); ?>
                                                    <!-- Start Top Level Nav 2 -->
                                                    <li class="has-sub"><a href="<?php the_sub_field( 'global_header_main_header_navigation_two_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_main_header_navigation_two_nav_text', 'option' ); ?></a>
                                                        <ul>
                                                            <li class="mh-megamenu">
                                                                <div class="mh-megamenu-inner">
                                                                    <div class="container">
                                                                        
                                                                        <!-- Start Sub Nav Search Container -->
                                                                        <?php get_search_form(); ?>
                                                                        <!-- End Sub Nav Search Container -->

                                                                        <!-- Start Sub Nav Bottom Container -->
                                                                        <div class="row">

                                                                            <!-- Start Navigation Container -->
                                                                            <div class="cell-xl-7">
                                                                                <div class="row">

                                                                                    <?php if( have_rows( 'global_header_products_product_category_repeater', 'option' ) ): ?>
                                                                                        <?php while( have_rows( 'global_header_products_product_category_repeater', 'option' ) ) : the_row(); ?>
                                                                                            
                                                                                            <!-- Start Product Category Nav -->
                                                                                            <div class="cell-md-3 cell-6 left-cell lc2">
                                                                                                <?php if( get_sub_field( 'global_header_products_product_category_repeater_product_category_image', 'option' ) ): ?>
                                                                                                    <!-- Nav Image -->
                                                                                                    <div class="lc2-img"><img src="<?php the_sub_field( 'global_header_products_product_category_repeater_product_category_image', 'option' ); ?>" alt="<?php the_sub_field( 'global_header_products_product_category_repeater_product_category_image', 'option' )['alt']; ?>"></div>
                                                                                                <?php endif; ?>

                                                                                                <!-- Start Category Sub Nav -->
                                                                                                <ul>
                                                                                                    <?php if( get_sub_field( 'global_header_products_product_category_repeater_product_category_title', 'option' ) ): ?>
                                                                                                        <!-- Start Sub Nav Title -->
                                                                                                        <li>
                                                                                                            <a href="<?php the_sub_field( 'global_header_products_product_category_repeater_product_category_title_link', 'option' ); ?>"><strong><?php the_sub_field( 'global_header_products_product_category_repeater_product_category_title', 'option' ); ?></strong></a>
                                                                                                        </li>
                                                                                                        <!-- End Sub Nav Title -->
                                                                                                    <?php endif; ?>

                                                                                                    <?php if( have_rows( 'global_header_product_sub_category_repeater', 'option' ) ): ?>
                                                                                                        <?php while( have_rows( 'global_header_product_sub_category_repeater', 'option' ) ) : the_row(); ?>
                                                                                                            <!-- Start Sub Nav Item Wrap -->
                                                                                                            <li><a href="<?php the_sub_field( 'global_header_product_sub_category_repeater_category_link', 'option' ); ?>"><?php the_sub_field( 'global_header_product_sub_category_repeater_category_name', 'option' ); ?></a></li>
                                                                                                            <!-- End Sub Nav Item Wrap -->
                                                                                                        <?php endwhile; ?>
                                                                                                    <?php endif; ?>

                                                                                                    <!-- Start View All Link -->
                                                                                                    <li><a href="<?php the_sub_field( 'global_header_products_product_category_repeater_product_category_title_link', 'option' ); ?>"><strong>View All <?php the_sub_field( 'global_header_products_product_category_repeater_product_category_title', 'option' ); ?></strong></a></li>

                                                                                                </ul>
                                                                                                <!-- End Category Sub Nav -->

                                                                                            </div>
                                                                                            <!-- End Product Category Nav -->

                                                                                        <?php endwhile; ?>
                                                                                    <?php endif; ?>

                                                                                </div>
                                                                            </div>
                                                                            <!-- End Navigation Container -->

                                                                            <?php if( get_field( 'global_header_news_and_resources_sub_menu_cta', 'option' ) ): ?>
                                                                                <!-- Start Sub Nav CTA -->
                                                                                <div class="cell-lg-5 right-cell">
                                                                                    <div class="right-inner">
                                                                                        <?php the_field( 'global_header_news_and_resources_sub_menu_cta', 'option' ); ?>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- End Sub Nav CTA -->
                                                                            <?php endif; ?>

                                                                        </div>
                                                                        <!-- End Sub Nav Bottom Container -->

                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <!-- End Top Level Nav 2 -->
                                                <?php endwhile; ?>
                                            <?php endif; ?>

                                            <?php if( have_rows( 'global_header_main_header_navigation_three', 'option' ) ): ?>
                                                <?php while( have_rows( 'global_header_main_header_navigation_three', 'option' ) ) : the_row(); ?>
                                                    <!-- Start Top Level Nav 3 -->
                                                    <li class="has-sub"><a href="<?php the_sub_field( 'global_header_main_header_navigation_three_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_main_header_navigation_three_nav_text', 'option' ); ?></a>
                                                        <ul>
                                                            <li class="mh-megamenu">
                                                                <div class="mh-megamenu-inner">
                                                                    <div class="container">

                                                                        <!-- Start Sub Nav Search Container -->
                                                                        <?php get_search_form(); ?>
                                                                        <!-- End Sub Nav Search Container -->

                                                                        <div class="row">

                                                                            <!-- Start Left Navigation Container -->
                                                                            <div class="cell-lg-7 lc3">
                                                                                <div class="row">

                                                                                    <?php if( have_rows( 'global_header_news_and_resources_sub_menu_right_side_menu', 'option' ) ): ?>
                                                                                        <!-- Start Sub Nav Wrap -->
                                                                                        <div class="cell-md-5 left-cell">
                                                                                            <ul>
                                                                                                <?php while( have_rows( 'global_header_news_and_resources_sub_menu_right_side_menu', 'option' ) ) : the_row(); ?>
                                                                                                    <!-- Start Sub Nav Item Wrap -->
                                                                                                    <li><a href="<?php the_sub_field( 'global_header_news_and_resources_sub_menu_right_side_menu_sub_menu_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_news_and_resources_sub_menu_right_side_menu_sub_menu_nav_text', 'option' ); ?></a></li>
                                                                                                    <!-- End Sub Nav Item Wrap -->
                                                                                                <?php endwhile; ?>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <!-- End Sub Nav Wrap -->
                                                                                    <?php endif; ?>

                                                                                    <?php if( get_field( 'global_header_news_and_resources_sub_menu_left_side_menu_latests_post_selector', 'option' ) ): ?>
                                                                                        <!-- Start Post List Wrap -->
                                                                                        <div class="cell-md-7 middle-cell">

                                                                                            <?php 
                                                                                                // Get Selected Category
                                                                                                $cat = get_field( 'global_header_news_and_resources_sub_menu_left_side_menu_latests_post_selector', 'option' );
                                                                                            ?>

                                                                                            <!-- <div class="middle-title"><?php //echo esc_html($cat['label']); ?></div> -->
                                                                                            <div class="middle-title"><a href="/blog/"><?php echo esc_html($cat['label']); ?></a></div>
                                                                                            <ul>
                                                                                            <?php
                                                                                                // Custom query to get posts from 'selected' category
                                                                                                $args = array(
                                                                                                    'category_name' => $cat['value'],
                                                                                                    'posts_per_page' => 4,  // You can change this to the number of posts you want to display
                                                                                                );

                                                                                                $posts_query = new WP_Query($args);

                                                                                                if ($posts_query->have_posts()) :
                                                                                                    while ($posts_query->have_posts()) : $posts_query->the_post();
                                                                                                    $title = get_the_title();
                                                                                                    $post_image = get_the_post_thumbnail();
                                                                                                    $excerpt = get_the_excerpt();
                                                                                                    $categories = get_the_category();
                                                                                                    $permalink = get_permalink();
                                                                                            ?>
                                                                                                <!-- Start Post Article -->
                                                                                                <li>
                                                                                                    <a href="<?php echo esc_html( $permalink ); ?>">
                                                                                                        <div class="middle-img">
                                                                                                            <?php echo $post_image; ?>
                                                                                                        </div>
                                                                                                        <span><?php echo esc_html( $title ); ?></span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <!-- End Post Article -->

                                                                                                <?php
                                                                                                    endwhile;
                                                                                                    wp_reset_postdata();  // Reset the main query loop
                                                                                                    else :
                                                                                                        echo '<p>No articles found.</p>';
                                                                                                    endif;
                                                                                                ?>
                                                                                            </ul>
                                                                                            <!-- <strong><a href="<?php //echo site_url(); ?>/category/<?php //echo esc_html($cat['value']); ?>">View All <?php //echo esc_html($cat['label']); ?></a></strong> -->
                                                                                            <strong><a href="/blog/">View All <?php echo esc_html($cat['label']); ?></a></strong>
                                                                                        </div>
                                                                                        <!-- End Post List Wrap -->
                                                                                    <?php endif; ?>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <!-- End Left Navigation Container -->

                                                                            <?php if( get_field( 'global_header_why_gold_ira_sub_menu_cta', 'option' ) ): ?>
                                                                                <!-- Start Sub Nav CTA -->
                                                                                <div class="cell-lg-5 right-cell">
                                                                                    <div class="right-inner">
                                                                                        <?php the_field( 'global_header_why_gold_ira_sub_menu_cta', 'option' ); ?>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- End Sub Nav CTA -->
                                                                            <?php endif; ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <!-- End Top Level Nav 3 -->
                                                <?php endwhile; ?>
                                            <?php endif; ?>

                                            <?php if( have_rows( 'global_header_main_header_navigation_four', 'option' ) ): ?>
                                                <?php while( have_rows( 'global_header_main_header_navigation_four', 'option' ) ) : the_row(); ?>
                                                    <!-- Start Top Level Nav 4 -->
                                                    <li class="has-sub"><a href="<?php the_sub_field( 'global_header_main_header_navigation_four_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_main_header_navigation_four_nav_text', 'option' ); ?></a>
                                                        <ul>
                                                            <li class="mh-megamenu">
                                                                <div class="mh-megamenu-inner">
                                                                    <div class="container">

                                                                        <!-- Start Sub Nav Search Container -->
                                                                        <?php get_search_form(); ?>
                                                                        <!-- End Sub Nav Search Container --> 

                                                                        <div class="row">

                                                                            <!-- Start Left Navigation Container -->
                                                                            <div class="cell-xl-7 lc4">
                                                                                <div class="row">
                                                                        
                                                                                    <?php if( have_rows( 'global_header_about_sub_menu_right_side_menu', 'option' ) ): ?>
                                                                                        <!-- Start Sub Nav Wrap -->
                                                                                        <div class="cell-md-5 left-cell">
                                                                                            <ul>
                                                                                                <?php while( have_rows( 'global_header_about_sub_menu_right_side_menu', 'option' ) ) : the_row(); ?>
                                                                                                    <!-- Start Sub Nav Item Wrap -->
                                                                                                    <li>
                                                                                                        <a href="<?php the_sub_field( 'global_header_about_sub_menu_right_side_menu_nav_link', 'option' ); ?>"><?php the_sub_field( 'global_header_about_sub_menu_right_side_menu_nav_text', 'option' ); ?></a>
                                                                                                    </li>
                                                                                                    <!-- End Sub Nav Item Wrap -->
                                                                                                <?php endwhile; ?>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <!-- End Sub Nav Wrap -->
                                                                                    <?php endif; ?>

                                                                                    <?php if( get_field( 'global_header_about_sub_menu_endorsement_selector', 'option' ) ): ?>
                                                                                        <!-- Start Endoresment Listing -->
                                                                                        <div class="cell-md-7 middle-cell">
                                                                                            <div class="middle-title"><a href="/endorsements/">Endorsements</a></div>
                                                                                            <ul>
                                                                                                <?php foreach( get_field( 'global_header_about_sub_menu_endorsement_selector', 'option' ) as $card ):
                                                                                                    $title = get_the_title( $card -> ID );
                                                                                                    $post_image = get_the_post_thumbnail( $card -> ID );
                                                                                                    $excerpt = get_the_excerpt( $card -> ID );
                                                                                                    $permalink = get_the_permalink( $card -> ID );
                                                                                                    $post_id = $card -> ID;
                                                                                                ?>

                                                                                                    <!-- Start Endorser -->
                                                                                                    <li class="endorsers-item">
                                                                                                            <div class="middle-img">
                                                                                                                <?php echo $post_image; ?>
                                                                                                            </div>

                                                                                                            <?php if( get_field( 'cpt_endorser_link_option', $post_id ) == 'endorser' ): ?>
                                                                                                            <!-- Start Endorser - If Endorser toggle is active -->
                                                                                                            <a href="<?php echo $permalink; ?>" rel="nofollow" target="_blank">
                                                                                                        <?php endif; ?>

                                                                                                        <?php if( get_field( 'cpt_endorser_link_option', $post_id ) == 'custom' ): ?>
                                                                                                            <!-- Start Endorser - If Custom toggle is active -->
                                                                                                            <a href="<?php the_field( 'cpt_endorser_custom_link', $post_id ); ?>" rel="nofollow" target="_blank">
                                                                                                        <?php endif; ?>

                                                                                                        <?php if( get_field( 'cpt_endorser_link_option', $post_id ) == 'none' ): ?>
                                                                                                            <!-- Start Endorser - If None toggle is active -->
                                                                                                            <a href="#" rel="nofollow">
                                                                                                        <?php endif; ?>
                                                                                                            <span><?php echo $title; ?></span>
                                                                                                        </a>
                                                                                                    </li>
                                                                                                    <!-- End Endorser -->

                                                                                                <?php endforeach; ?>
                                                                                            </ul>
                                                                                            <strong><a href="/endorsements/">View All Endorsements</a></strong>
                                                                                        </div>
                                                                                        <!-- End Endorsement Listing -->
                                                                                    <?php endif; ?>

                                                                                </div>
                                                                            </div>
                                                                            <!-- End Left Navigation Container -->

                                                                            <?php if( get_field( 'global_header_why_gold_ira_sub_menu_cta', 'option' ) ): ?>
                                                                                <!-- Start Sub Nav CTA -->
                                                                                <div class="cell-lg-5 right-cell">
                                                                                    <div class="right-inner">
                                                                                        <?php the_field( 'global_header_why_gold_ira_sub_menu_cta', 'option' ); ?>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- End Sub Nav CTA -->
                                                                            <?php endif; ?>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    <!-- End Top Level Nav 4 -->
                                                <?php endwhile; ?>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                    <!-- End Main Nav Wrap -->
                                </div>
                                <!-- End Main Navigation Container -->

                                <!-- Start Main Head Right Side -->
                                <div class="mh-bottom-right">
                                    
                                    <?php if( get_sub_field( 'global_header_phone_number', 'option' ) ): ?>
                                        <!-- Start Call Wrap -->
                                        <div class="mh-block mh-call">
                                            <span>Call Our Gold Experts</span>
                                            <div class="d-flex flex-nowrap align-items-center">
                                                <i class="icon-call"></i>
                                                <a href="tel:<?php the_sub_field( 'global_header_phone_number', 'option' ); ?>" class="mh-call-link"><?php the_sub_field( 'global_header_phone_number', 'option' ); ?></a>
                                            </div>
                                        </div>
                                        <!-- End Call Wrap -->
                                    <?php endif; ?>

                                    <?php if( have_rows( 'global_header_main_header_interest_repeater', 'option' ) ): ?>
                                        <!-- Start Interest Selection -->
                                        <div class="mh-block mh-select">
                                            <span>I’m interested in...</span>
                                            <select name="select-interest" id="pageSelect" onchange="top.location.href = this.options[this.selectedIndex].value;">
                                                <option value="Select your interest" disabled selected>Select your interest</option>
                                                <?php while( have_rows( 'global_header_main_header_interest_repeater', 'option' ) ) : the_row(); ?>
                                                    <option value="<?php the_sub_field( 'global_header_interest_repeater_option_link', 'option' ); ?>"><?php the_sub_field( 'global_header_interest_repeater_option_text', 'option' ); ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <!-- End Intterest Selection -->
                                    <?php endif; ?>

                                </div>
                                <!-- End Main Head Right Side -->

                                <!-- Start Main Device Right Container -->
                                <div class="mh-device-right d-flex flex-no-wrap align-items-center">
                                    <!-- Mobile - Call Link -->
                                    <?php if( get_sub_field( 'global_header_phone_number', 'option' ) ): ?>
                                        <a href="tel:<?php the_sub_field( 'global_header_phone_number', 'option' ); ?>" class="mh-device-call icon-call"><?php the_sub_field( 'global_header_phone_number', 'option' ); ?></a>
                                    <?php endif; ?>

                                    <!-- Mobile - Keyword Search Form -->
                                    <form class="mh-device-searchbar" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <label for="s" class="screen-reader-text">Search keyword:</label>
                                        <input type="search" id="s" name="s" value="<?php the_search_query(); ?>" placeholder="Search Keywords">
                                        <span class="mh-device-searchbar-btn icon-search"><input type="submit"></span>
                                    </form>

                                    <!-- <form class="mh-device-searchbar">
                                        <input type="search" placeholder="Search Keywords">
                                        <span class="mh-device-searchbar-btn icon-search"><input type="submit"></span>
                                    </form> -->
                                    
                                    <!-- hamburger -->
                                    <a href="javascript:;" class="hamburger">
                                        <span></span>
                                    </a>
                                </div>
                                <!-- End Main Device Right Container -->

                            </div>
                        </div>
                        <!-- End Bottom Header Container -->
                    <?php endwhile; ?>
                <?php endif; ?>

            </header>
            <!-- End Main Header Section -->

        </div>

	<!-- <div id="content" class="site-content" style="visibility:hidden; opacity:0; transition:opacity .75s ease-in-out;"> -->
    <div id="content" class="site-content" style="display:none;">