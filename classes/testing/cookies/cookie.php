<?php
/**
 * Base class for making cookies
 *
 * @package   ingot
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2015 Josh Pollock
 */

namespace ingot\testing\cookies;


abstract class cookie {

	/**
	 * What type of test is being done.
	 *
	 * MUST EXTEND in subclass.
	 *
	 * @since 1.3.1
	 *
	 * @var string
	 */
	protected static $type;

	/**
	 * Set a cookie for a this type of test
	 *
	 * @since 1.3.1
	 *
	 * @param int $group_id ID of group
	 * @param int $variant_id ID of chosen variant
	 */
	public static function set_cookie( $group_id, $variant_id ){
		$name = static::cookie_key( $group_id );
		if ( ! headers_sent() && ! isset( $_COOKIE[ $name ] )) {
			$expires = time() + ingot_cookie_time();

			$set = setcookie( $name, (string) $variant_id, $expires, COOKIEPATH, COOKIE_DOMAIN, false );

			do_action( static::get_prefix() . 'cookie_set', $set, $name, $group_id, $variant_id, $expires  );
		}

	}

	/**
	 * Clear destination test cookie
	 *
	 * @since 1.3.1
	 *
	 * @param int $group_id ID of group
	 */
	public static function clear_cookie( $group_id ){
		$key = static::cookie_key( $group_id );
		if( isset( $_COOKIE[ $key ] ) ){
			unset( $_COOKIE[ $key ]);
			if ( ! headers_sent() ) {
				setcookie( $key, '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN, false );
			}

		}

	}

	/**
	 * Set a cookie from COOKIES
	 *
	 * @since 1.3.1
	 *
	 * @param int $group_id ID of group
	 *
	 * @return int Variant ID
	 */
	public static function get_cookie( $group_id ) {
		$key = static::cookie_key( $group_id );
		if ( isset( $_COOKIE[ $key ] ) ) {
			return absint( $_COOKIE[ $key ] );
		}

	}


	/**
	 * Get the index name to use in cookie
	 *
	 * @since 1.3.1
	 *
	 * @param int $group_id ID of group
	 *
	 * @return string
	 */
	public static function cookie_key( $group_id ){
		return static::get_prefix() . $group_id;
	}

	/**
	 * Get cookie key
	 *
	 * @since 1.3.1
	 *
	 * @return string
	 */
	protected static function get_prefix(){
		if( empty( static::$type  ) ){
			return fale;
		}
		return 'ingot_' . static::$type . '_';
	}

	/**
	 * Get all cookies of this type
	 *
	 * @since 1.3.1
	 *
	 * @return array
	 */
	public static function get_all_cookies(){
		if ( isset( $_COOKIE ) && is_array( $_COOKIE) ) {
			return \ingot\testing\utility\array_filters::filter_results( $_COOKIE, static::get_prefix() );
		} else {
			return [];
		}

	}

}
