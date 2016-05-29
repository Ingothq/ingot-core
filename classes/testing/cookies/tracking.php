<?php
/**
 * Track a specific type of cookie in an option
 *
 * @package   ingot
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link
 * @copyright 2016 Josh Pollock
 */


namespace ingot\testing\cookies;


abstract class tracking {

	/**
	 * Option key to track
	 *
	 * MUST defined in subcalss
	 *
	 * @since 1.3.1
	 *
	 * @var string
	 */
	protected  $option_key;

	/**
	 * Array of group IDs to track
	 *
	 * @since 1.3.1
	 *
	 * @var array
	 */
	protected  $tracking = [];

	/**
	 * Get groups we are saving
	 *
	 * @since 1.3.1
	 *
	 * @return array
	 */
	public function get_tracked(){
		return $this->tracking;
	}

	/**
	 * tracking constructor.
	 *
	 * Is protected to force singleton on subclasses
	 *
	 * @since 1.3.1
	 */
	protected function __construct(){
		$this->read();
	}

	/**
	 * Ad group to tracking
	 *
	 * @since 1.3.1
	 *
	 * @param int $group_id
	 */
	public function add_to_tracking( $group_id ){
		$this->tracking[ $group_id ] = $group_id;
	}

	/**
	 * Is a group being tracked?
	 *
	 * @since 1.3.1
	 *
	 * @param $group_id
	 *
	 * @return bool
	 */
	public function is_tracking( $group_id ){
		return in_array( $group_id,  $this->tracking );
	}

	/**
	 * Remove a group from tracking
	 *
	 * @since 1.3.1
	 *
	 * @param int $group_id
	 * @param bool $save Optional. Should we save? Default is true, which saves
	 */
	public function remove_from_tracking( $group_id, $save = true){
		unset( $this->tracking[ $group_id ] );

		if(  $save ) {
			$this->save();
		}
		
	}

	/**
	 * Read from option
	 *
	 * @since 1.3.1
	 */
	protected function read(){
		$this->tracking = get_option( $this->option_key, [] );
		if( ! is_array( $this->tracking ) ){
			$this->tracking = [];
		}
	}

	/**
	 * Save values
	 *
	 * @since 1.3.1
	 *
	 */
	public function save(){
		update_option( $this->option_key, $this->tracking  );
	}


}
