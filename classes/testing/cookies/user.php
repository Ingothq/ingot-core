<?php

namespace ingot\testing\cookies;
class user extends init {


	/**
	 * Set cookie property for class
	 *
	 * @since 1.1.0
	 *
	 * @access protected
	 *
	 * @param array $cookie Current contents of this part of cookie
	 * @param bool $reset Optional. Whether to rest or not, default is false
	 */
	 protected function set_cookie( $cookie, $reset ){
		 //TRACK INGOT IDs CROSS device/IPs
		 
		 $this->check_ingot_id();

	 }

	protected function check_ingot_id() {
		if ( ! isset( $this->cookie[ 'ingot_id' ] ) ) {
			$ingot_id                   = session::find_ingot_id( get_current_user_id(), ingot_get_ip() );
			$this->cookie[ 'ingot_id' ] = $ingot_id;

		}
	}

}
