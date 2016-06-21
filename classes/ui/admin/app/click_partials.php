<?php
/**
 * Get URL for the click partials (thrid part of click group UI)
 *
 * @package   ingot-core
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 Josh Pollock
 */

namespace ingot\ui\admin\app;


use ingot\testing\types;


class click_partials {

	/**
	 * Internal URLS
	 *
	 * @since 1.3.1
	 *
	 * @var array
	 */
	protected $urls;

	/**
	 * Class instance
	 *
	 * @since 1.3.1
	 *
	 * @var click_partials
	 */
	protected static $instance;

	/**
	 * @since 1.3.1
	 */
	protected function __construct(){
		$this->get_partial_urls();
	}

	/**
	 * Get all partial URLs
	 *
	 * @param bool|true $escaped Optional, if true, the default esc_url() is called recursively
	 *
	 * @since 1.3.1
	 *
	 * @return array
	 */
	public function get_urls( $escaped = true ){
		$urls =  array_merge( $this->urls, $this->apply_filter() );
		if( $escaped ){
			$urls = array_map( 'esc_url', $urls );
		}

		return $urls;
	}

	/**
	 * Get class instance
	 *
	 * @since 1.3.1
	 *
	 * @return click_partials
	 */
	public static function get_instance(){
		if ( null == static::$instance ){
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Add from filter
	 *
	 * Use this to provide UI from add-ons!
	 *
	 * @since 1.3.1
	 *
	 * @return array
	 */
	protected function apply_filter(){

		/**
		 * Add a partial UI for a click type
		 *
		 * Please use type => url
		 *
		 * @since 1.3.1
		 *
		 * @param array $url URL of extra partials
		 */
		return apply_filters( 'ingot_click_type_ui_urls', [] );

	}

	/**
	 * Populate $this->urls with internals
	 *
	 * @since 1.3.1
	 */
	protected  function get_partial_urls(){
		$internal = types::internal_click_types();
		$internal[] = 'destination';
		foreach( $internal as $type  ){
			$this->urls[ $type ] = INGOT_ASSETS_URL . '/admin/partials/content-test-partials/' . $type . '.html';
		}

	}

}
