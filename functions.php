<?php
/** Start the engine */
require_once(TEMPLATEPATH.'/lib/init.php');

/** Localization */
load_child_theme_textdomain( 'adaptation', get_stylesheet_directory() . '/lib/languages');

/** Child theme (do not remove) */
define( 'CHILD_THEME_NAME', 'Adaptation Theme' );
define( 'CHILD_THEME_URL', 'http://www.aaronhartland.com/themes/adaptation' );

/** Add support for custom background */
add_custom_background();

/** Add support for custom header */
add_theme_support( 'genesis-custom-header', array( 'width' => 930, 'height' => 110 ) );

/** Unregister 3-column site layouts */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

/** Unregister Secondary Sidebar */
unregister_sidebar('sidebar-alt');

/** Add new image sizes **/
add_image_size('child_full', 610, 230, TRUE);
add_image_size('child_thumbnail', 288, 110, TRUE);

/** Add support for 3-column footer widgets */
add_theme_support( 'genesis-footer-widgets', 3 );

/** Reposition the primary navigation */
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

/** Reposition the sub navigation */
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_before', 'genesis_do_subnav' );

/** Add support for structural wraps */
add_theme_support( 'genesis-structural-wraps', array( 'header', 'nav', 'subnav', 'inner', 'footer-widgets', 'footer' ) );

/** Customize the post info function **/
add_filter('genesis_post_info', 'child_post_info_filter');
function child_post_info_filter( $post_info ) {
	if ( ! is_page() ) {
		$post_info = __( 'on', 'adaptation' ) . ' [post_date] [post_edit]';
		return $post_info;
	}
}



