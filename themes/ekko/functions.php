<?php
/**
 * ekko functions file
 *
 * @package ekko
 * by KeyDesign
 */

update_option( 'keydesign-verify' , 'yes' );

require_once( get_template_directory() . '/core/init.php');

 // -------------------------------------
 // Edit below this line
 // -------------------------------------
 add_filter( 'wp_enqueue_scripts', 'replace_default_jquery_with_fallback');
function replace_default_jquery_with_fallback() {
    $ver = '1.12.4';
    wp_dequeue_script( 'jquery' );
    wp_deregister_script( 'jquery' );
    // Set last parameter to 'true' if you want to load it in footer
    wp_register_script( 'jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", '', $ver, false );
    wp_add_inline_script( 'jquery', 'window.jQuery||document.write(\'<script src="'.includes_url( '/js/jquery/jquery.js' ).'"><\/script>\')' );
    wp_enqueue_script ( 'jquery' );
}
add_filter( 'woocommerce_page_title', 'woo_shop_page_title');
    function woo_shop_page_title( $page_title ) {
        if( 'Shop' == $page_title) {
			global $post;
            return $post->post_title ;
        }
    }