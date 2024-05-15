<?php
/**
 * All helpers functions
 */
namespace Mcommerce;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Helper
 * @author mahbub <mahbub.dev>
 */
class Helper {

	public static function pri( $data, $admin_only = true, $hide_adminbar = true ) {

		if( $admin_only && ! current_user_can( 'manage_options' ) ) return;

		echo '<pre>';
		if( is_object( $data ) || is_array( $data ) ) {
			print_r( $data );
		}
		else {
			var_dump( $data );
		}
		echo '</pre>';

		if( is_admin() && $hide_adminbar ) {
			echo '<style>#adminmenumain{display:none;}</style>';
		}
	}


	

	/**
	 * Includes a template file resides in /views directory
	 *
	 * It'll look into /mcommerce directory of your active theme
	 * first. if not found, default template will be used.
	 * can be overwritten with codesigner_template_overwrite_dir hook
	 *
	 * @param string $slug slug of template. Ex: template-slug.php
	 * @param string $sub_dir sub-directory under base directory
	 * @param array $fields fields of the form
	 */
	public static function get_template( $slug, $base = 'views', $args = null ) {

		// templates can be placed in this directory
		$overwrite_template_dir = apply_filters( 'mcommerce_template_overwrite_dir', get_stylesheet_directory() . '/mcommerce/', $slug, $base, $args );
		
		// default template directory
		$plugin_template_dir = dirname( MCOMMERCE ) . "/{$base}/";

		// full path of a template file in plugin directory
		$plugin_template_path =  $plugin_template_dir . $slug . '.php';
		
		// full path of a template file in overwrite directory
		$overwrite_template_path =  $overwrite_template_dir . $slug . '.php';

		// if template is found in overwrite directory
		if( file_exists( $overwrite_template_path ) ) {
			ob_start();
			include $overwrite_template_path;
			return ob_get_clean();
		}
		// otherwise use default one
		elseif ( file_exists( $plugin_template_path ) ) {
			ob_start();
			include $plugin_template_path;
			return ob_get_clean();
		}
		else {
			return __( 'Template not found!', 'mcommerce' );
		}
	}

	/**
	 * Includes a template file resides in /views diretory
	 *
	 * It'll look into /coschool directory of your active theme
	 * first. if not found, default template will be used.
	 * can be overwriten with coschool_template_overwrite_dir hook
	 *
	 * @param string $slug slug of template. Ex: template-slug.php
	 * @param string $sub_dir sub-directory under base directory
	 * @param array $fields fields of the form
	 */
	public static function get_view( $slug, $base = 'views', $args = null ) {

		// templates can be placed in this directory
		$overwrite_template_dir = apply_filters( 'mcommerce_template_overwrite_dir', get_stylesheet_directory() . '/mcommerce/', $slug, $base, $args );
		
		// default template directory
		$plugin_template_dir 	= dirname( MCOMMERCE ) . "/{$base}/";

		// full path of a template file in plugin directory
		$plugin_template_path 	=  $plugin_template_dir . $slug . '.php';
		
		// full path of a template file in overwrite directory
		$overwrite_template_path =  $overwrite_template_dir . $slug . '.php';

		// if template is found in overwrite directory
		if( file_exists( $overwrite_template_path ) ) {
			ob_start();
			include $overwrite_template_path;
			return ob_get_clean();
		}
		// otherwise use default one
		elseif ( file_exists( $plugin_template_path ) ) {
			ob_start();
			include $plugin_template_path;
			return ob_get_clean();
		}
		else {
			return __( 'Template not found!', 'mcommerce' );
		}
	}
}