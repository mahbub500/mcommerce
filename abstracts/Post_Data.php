<?php
/**
 * An abstraction for the Post_Data
 */
namespace Mcommerce\Abstracts;

/**
 * if accessed directly, exit.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


abstract class Post_Data {

    /**
     * @var obj
     */
    public $post;

    /**
     * List of keys/phrases for alternative using
     * 
     * @var obj
     */
    public $correction;

    /**
     * Constructor function
     * 
     * @uses WP_Post class
     * @param int|obj $post the post
     */
    public function __construct( $post ) {

        $this->post = get_post( $post );

        $this->correction = apply_filters( 'mcommerce_post-data-correction', [
            'id'            => 'ID',
            'title'         => 'post_title',
            'name'          => 'post_title',            
            'updated'       => 'post_modified',
        ], $this->post );
    }

    /**
     * Gets post data
     * 
     * @param string $key the key
     * @param string $default default value
     * 
     * @uses get_post_meta()
     * @uses WP_Post class
     * 
     * @return mix|null the post data if found, null otherwise
     */
    public function get( $key, $default = null ) {

        // if we have a dedicated method written for this
        if( method_exists( $this, ( $method = "get_{$key}" ) ) ) {
            return $this->$method();
        }

        // get the correct key
        if( array_key_exists( $key, $this->correction ) ) {
            $key = $this->correction[ $key ];
        }

        // if it's a post `data`
        if( isset( $this->post->$key ) && $this->post->$key != '' ) {
            return $this->post->$key;
        }

        return $default;
    }

    /**
     * Sets a data
     * 
     * @param string $key the key
     * @param mix $value the value for the given key
     * 
     * @return void
     */
    public function set( $key, $value ) {

        // we shouldn't allow to update the ID, should we?
        if( strtolower( $key ) == 'id' ) return;

        // get the correct key
        if( array_key_exists( $key, $this->correction ) ) {
            $key = $this->correction[ $key ];
        }

        // if it's a post `data`
        if( in_array( $key, array_values( $this->correction ) ) ) {
			wp_update_post( [
				'ID'	=> $this->post->ID,
				$key	=> $value
			] );
        }

        // post meta
        else {
            update_post_meta( $this->post->ID, $key, $value );
        }
    }

    /**
     * Sets a data
     * 
     * @param string $key the key
     * @param mix $value the value for the given key
     * 
     * @return void
     */
    public function unset( $key ) {

        // get the correct key
        if( array_key_exists( $key, $this->correction ) ) {
            $key = $this->correction[ $key ];
        }

        // if it's a post `meta data`
        delete_post_meta( $this->post->ID, $key );
    }

    /**
     * Is this content visible by the given user?
     * 
     * @return bool
     */
    public function is_visible_by() {
        return true;
    }

    

 
}