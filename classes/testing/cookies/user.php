<?php

namespace ingot\testing\cookies;
use ingot\testing\crud\session;

class user extends init {


	/**
	 * @inheritdoc
	 */
	 protected function set_cookie( $cookie ){
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
