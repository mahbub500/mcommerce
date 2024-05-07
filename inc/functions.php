<?php
if( ! function_exists( 'get_plugin_data' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

/**
 * Gets the site's base URL
 * 
 * @uses get_bloginfo()
 * 
 * @return string $url the site URL
 */
if( ! function_exists( 'mcommerce_site_url' ) ) :
function mcommerce_site_url() {
	$url = get_bloginfo( 'url' );

	return $url;
}
endif;

/**
 * Database table prefix
 * 
 * @return string
 */
if( ! function_exists( 'mcommerce_db_prefix' ) ) :
	function mcommerce_db_prefix() {
		return 'mc_';
	}
endif;