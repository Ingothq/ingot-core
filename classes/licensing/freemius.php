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
		$_plan = ingot_fs()->is_registered() ? ingot_fs()->get_plan()->name : 'nugget';
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
