<?php

declare(strict_types = 1);

namespace epharmacy\bootstrap;

// import classes ##
use epharmacy;
// use epharmacy\plugin as plugin;
use epharmacy\core\helper as h;

// If this file is called directly, Bulk!
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/*
* Hooks Factory Class
*/
final class hooks {

	private $plugin;

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
	 * example hooks
	*/
	public function example( 
		\epharmacy\bootstrap\example\asset $asset  
	):void {

		// load asset ##
		$asset->hooks();

	}

}
