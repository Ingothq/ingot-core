<?php
/**
 * Plan/license handling for Freemius
 *
 * @package   ingot
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 Josh Pollock
 */

namespace ingot\licensing;


class freemius extends license {

	/**
	 * Setup plan object
	 *
	 * @since 1.2.0
	 */
	protected function set_plan(){
		$_plan = false;
		if( function_exists( 'ingot_woo_fs' ) ){
			$_plan = ingot_woo_fs()->is_registered() ? ingot_woo_fs()->get_plan()->name : 'false';
		}
		if( ! $_plan && function_exists( 'ingot_give_fs' ) ){
			$_plan = ingot_give_fs()->is_registered() ? ingot_give_fs()->get_plan()->name : 'false';

		}
		if( ! $_plan && function_exists( 'ingot_edd_fs' ) ) {
			$_plan = ingot_edd_fs()->is_registered() ? ingot_edd_fs()->get_plan()->name : 'false';
		}
		if( ! $_plan ) {
			$_plan = ingot_fs()->is_registered() ? ingot_fs()->get_plan()->name : 'nugget';
		}

		$this->plan = new plan( $_plan );
	}

	/**
	 * Save plan details
	 *
	 *  @since 1.2.0
	 *
	 * @param array $plan
	 */
	public function save_plan( array $plan ){

	}


}
