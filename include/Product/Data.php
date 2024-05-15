<?php
namespace Mcommerce\Include\App\Product;

use Mcommerce\Base;
use Mcommerce\Helper;
use Mcommerce\Abstracts\DB;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @package Plugin
 * @subpackage Admin
 * @author Mahbub <mahbub.dev>
 */
class Data {


    public function show_schema(){
        Helper::pri( 'test' );
    }

}