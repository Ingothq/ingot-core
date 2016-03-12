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
		$plan = ingot_fs()->get_plan();
		if ( $plan ) {
			$this->plan = new plan( $plan->name );
		}else{
			$this->plan = new plan( 'nugget' );
		}
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
