<?php

declare(strict_types = 1);

namespace epharmacy\bootstrap\example;

// import classes ##
use epharmacy;
use epharmacy\bootstrap\plugin as bootstrap;

// If this file is called directly, Bulk!
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/*
* Register and Enqueue assets
*/
class asset {

	private 
		$plugin
	;

    /**
     * Class constructor to define object props --> empty
     * 
     * @since   0.0.1
     * @return  void
    */
    function __construct( \epharmacy\bootstrap\plugin $plugin ) {

		$this->plugin = $plugin; 

	}
	
	/**
	 * WP Hooks
	 * 
	 * @since  	0.0.1
	 * @return	__void
	*/
	public function hooks(){

		// register user\asset\javascript file ##
		// \add_action( 'wp_head', [ $this, 'javascript' ] );

	}

}
