<?php
/*
Template Name: Landing
*/

/** Filter the layout option to force full width */
add_filter( 'genesis_pre_get_option_site_layout', 'adaptation_landing_page_layout' );

function adaptation_landing_page_layout( $opt ) {
	return 'full-width-content';
}

/** Remove navigation, breadcrumbs, footer */
remove_action('genesis_header', 'genesis_header_markup_open', 5);
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_header', 'genesis_header_markup_close', 15);
remove_action('genesis_before_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');
remove_action('genesis_before_loop', 'genesis_do_breadcrumbs');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

genesis();