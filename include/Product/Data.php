<?php
namespace Mcommerce\Include\App\Product;

use Mcommerce\Helper;
use Mcommerce\Abstracts\DB;
use Mcommerce\Abstracts\Post_Data;

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
class Data extends Post_Data {

    /**
	 * @var obj
	 */
	public $product;

    /**
	 * Constructor function
	 * 
	 * @param int|obj $product the product
	 */
	public function __construct( $product ) {
		$this->product = get_post( $product );
		parent::__construct( $this->course );
	}



}