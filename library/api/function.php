<?php

// Global functions added by epharmacy, site outside of the namespace and are pluggable

// import
// use epharmacy\core\log;

/** 
 * API 
 *
 */
if ( ! function_exists( 'epharmacy_bootstrap' ) ) {

	function epharmacy_bootstrap(){

		// sanity ##
		if(
			! class_exists( '\epharmacy\bootstrap\plugin' )
		){

			error_log( 'e:>epharmacy bootstrap is not available to '.__FUNCTION__ );

			return false;

		}

		// cache ##
		$instance = \epharmacy\bootstrap\plugin::get_instance();

		// sanity - make sure willow instance returned ##
		if( 
			is_null( $instance )
			|| ! ( $instance instanceof \epharmacy\bootstrap\plugin ) 
		) {

			// get stored plugin instance from filter ##
			$instance = \apply_filters( 'epharmacy/bootstrap/instance', NULL );

			// sanity - make sure epharmacy instance returned ##
			if( 
				is_null( $instance )
				|| ! ( $instance instanceof \epharmacy\bootstrap\plugin ) 
			) {

				error_log( 'Error in object instance returned to '.__FUNCTION__ );

				return false;

			}

		}

		// __log( 'epharmacy bootstrap is ok..' );

		// return epharmacy bootstrap instance ## 
		return $instance;

	}

}
