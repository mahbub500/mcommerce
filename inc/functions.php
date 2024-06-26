<?php

use Mcommerce\Helper;
use Mcommerce\Include\App\Payment\Cart;
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

/**
 * Publish Course Issue
 * 
 * @author Sadekur Rahman <shadekur.rahman60@gmail.com>
 * 
 * @return input string|int
 */

 if( ! function_exists( 'mcommerce_sanitize' ) ) :
	function mcommerce_sanitize( $input, $type = 'text' ) {
		if ( is_array($input) ) {
			$sanitized = [];

			foreach ( $input as $key => $value ) {
				$sanitized[$key] = mcommerce_sanitize( $value, $type );
			}

			return $sanitized;
		}

		if ( ! in_array($type, ['textarea', 'email', 'file', 'class', 'key', 'title', 'user', 'option', 'meta']) ) {
			$type = 'text';
		}

		if ( array_key_exists($type, $maps = ['text' => 'text_field', 'textarea' => 'textarea_field', 'file' => 'file_name', 'class' => 'html_class']) ) {
			$type = $maps[$type];
		}

		if ( preg_match('/<[^>]*>/', $input) ) {
			return wp_kses_post( $input );
		} else {
			$fn = "sanitize_{$type}";
			return $fn( $input );
		}
	}
endif;

/**
 * Cart page Link
 * 
 * @param bool $url Either we need the URL or the page ID
 * 
 * @return string|int
 */
if( ! function_exists( 'mcommerce_cart_page' ) ) :
	function mcommerce_cart_page( $url = false ) {
		$cart_page_id = get_option( 'mcommerce_page_id' );

		if( $url ) {
			return get_permalink( $cart_page_id );
		}

		return $cart_page_id;
	}
endif;

/**
 * Cart page
 * 
 * @param bool $url Either we need the URL or the page ID
 * 
 * @return string|int
 */
if( ! function_exists( 'mcommerce_payment_method' ) ) :
	function mcommerce_payment_method() {
		$payment_method = get_option( 'mcommerce_payment_id' );

		return $payment_method;
	}
endif;

/**
 * Is test mode enabled?
 * 
 * @since 0.9
 * 
 * @return bool
 */
if( ! function_exists( 'mcommerce_test_mode' ) ) :
	function mcommerce_test_mode() {
		$test_mode 	= mcommerce_payment_method();
		if( $test_mode == '1' ) {
			return $test_mode == 'on';
		}

		return false;
	}
endif;




