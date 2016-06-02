<?php
/**
 * Cleanup utility for removing old session data.
 *
 * @package   ingot
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2015 Josh Pollock
 */
namespace ingot\testing\db;


use ingot\testing\crud\session;

class sessions_cleanup {

	/**
	 * Number of days between cleanups
	 *
	 * @since 1.3.1
	 *
	 * @var int
	 */
	protected $days = 0;

	/**
	 * Last time cleanup occurred
	 *
	 * @since 1.3.1
	 *
	 * @var int
	 */
	protected $last = 0;

	/**
	 * Current time
	 *
	 * @since 1.3.1
	 *
	 * @var int|string
	 */
	protected $now;

	/**
	 * Option key for storing last save
	 *
	 * @since 1.3.1
	 *
	 * @var string
	 */
	protected $key = '_ingot_sessions_last_clean';

	/**
	 * sessions_cleanup constructor.
	 *
	 * @since 1.3.1
	 *
	 * @param int $days
	 */
	public function __construct( $days = 0  ) {
		if( 0 < $days ){
			
			$this->now = current_time( 'mysql');
			
			$this->days = $days;
			$this->set_last();
			if( $this->is_needed() ){
				$this->cleanup();
			}
		}

	}

	/**
	 * Is cleanup called for
	 *
	 * @since 1.3.1
	 *
	 * @return bool
	 */
	protected function is_needed(){
		if( 0 != $this->days ){
			if( 0 == $this->last ){
				return true;
			}

			$threshold = strtotime( $this->now ) - ( $this->days * DAY_IN_SECONDS );
			if(	$threshold   > $this->last ){
				return true;
			}


		}

		return false;
	}

	/**
	 * Run cleanup
	 *
	 * @since 1.3.1
	 *
	 */
	protected function cleanup(){
		$older = strtotime( $this->now ) - ( $this->days * DAY_IN_SECONDS );
		$deleted = session::delete_older_than( $older );
		update_option( $this->key, current_time( 'mysql')  );
	}


	/**
	 * Set last property
	 *
	 * @since 1.3.1
	 *
	 */
	protected function set_last(){
		$this->last = get_option( $this->key, 0 );
		if( ! is_numeric( $this->last ) ){
			$this->last = strtotime( $this->last );
		}
		
	}
}
