<?php

/**
 * Customizing the Genesis Grid Loop Content
 *
 * Setting up the features and grid posts to display the excerpt instead of a truncated version of the content. This way you can write a summary of the post to show up on your blog.
 * Moving the thumbnail in the grid posts from below the title to above it.
 * Adding a divider between each row of the grid.
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/genesis-grid-loop-content/
 */

// Setup Grid Loop
remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'child_grid_loop_helper' );
function child_grid_loop_helper() {
    if ( function_exists( 'genesis_grid_loop' ) ) {
		genesis_grid_loop( array(
            'features' => 2,
            'feature_image_size' => 'child_full',
            'feature_image_class' => 'aligncenter post-image',
            'feature_content_limit' => 0,
            'grid_image_size' => 0,
            'grid_content_limit' => 0,
            'more' => __( '[Continue reading...]', 'adaptation' ),
            'posts_per_page' => 6,
        ) );
    } else {
        genesis_standard_loop();
    }
}
 
// Customize Grid Loop Content
add_action('genesis_before_post', 'child_switch_content');
function child_switch_content() {
    remove_action('genesis_post_content', 'genesis_grid_loop_content');
    add_action('genesis_post_content', 'child_grid_loop_content');
    add_action('genesis_after_post', 'child_grid_divider');
    add_action('genesis_before_post_title', 'child_grid_loop_image');
}
 
function child_grid_loop_content() {
 
    global $_genesis_loop_args;
 
    if ( in_array( 'genesis-feature', get_post_class() ) ) {
        if ( $_genesis_loop_args['feature_image_size'] ) {
            printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute('echo=0'), genesis_get_image( array( 'size' => $_genesis_loop_args['feature_image_size'], 'attr' => array( 'class' => esc_attr( $_genesis_loop_args['feature_image_class'] ) ) ) ) );
        }
 
        the_excerpt();
        $num_comments = get_comments_number();
        if ($num_comments == '1') $comments = '<span>'.$num_comments.'</span> ' . __( 'comment', 'adaptation' );
        else $comments = '<span>'.$num_comments.'</span> ' . __( 'comments', 'adaptation' );
        echo '<p class="to_comments"><span class="bracket">{</span><a href="'.get_permalink().'/#comments" rel="nofollow">'.$comments.'</a><span class="bracket">}</span></p>';
    }
    else {
 
        the_excerpt();
        $num_comments = get_comments_number();
        if ($num_comments == '1') $comments = $num_comments.' ' . __( 'comment', 'adaptation' );
        else $comments = $num_comments.' ' . __( 'comments', 'adaptation' );
        echo '<p class="more"><a class="comments" href="'.get_permalink().'/#comments">'.$comments.'</a> <a href="'.get_permalink().'">' . __( 'Read the full article &#187;', 'adaptation' ) . '</a></p>';
    }
 
}
 
function child_grid_loop_image() {
    if ( in_array( 'genesis-grid', get_post_class() ) ) {
        global $post;
        echo '<p class="thumbnail"><a href="'.get_permalink().'">'.get_the_post_thumbnail($post->ID, 'child_thumbnail').'</a></p>';
    }
}
 
function child_grid_divider() {
    global $loop_counter, $paged;
    if ((($loop_counter + 1) % 2 == 0) && !($paged == 0 && $loop_counter < 2)) echo '<hr />';
}
 
 /** Remove the post meta function for front page only **/
remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
 
genesis();
?>
