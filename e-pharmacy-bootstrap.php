<?php

declare(strict_types = 1);

/**
 * E-Pharmacy Components
 *
 * @package         E-Pharmacy Bootstrap
 * @author          Q Studio <social@qstudio.us>
 * @license         GPL-2.0+
 * @copyright       2020 Q Studio
 *
 * @wordpress-plugin
 * Plugin Name:     E-Pharmacy Bootstrap
 * Plugin URI:      https://github.com/qstudio/e-pharmacy-bootstrap
 * Description:     E-Pharmacy Bootstrap
 * Version:         0.0.1
 * Author:          E-Pharmacy
 * Author URI:      https://e-pharmacy.com
 * License:         GPL-2.0+
 * Requires PHP:    7.0 
 * Copyright:       E-Pharmacy
 * Class:           epharmacy-bootstrap
 * Text Domain:     epharmacy-bootstrap
 * Domain Path:     /languages
 * GitHub Plugin URI: qstudio/e-pharmacy-bootstrap
*/

// namespace plugin ##
namespace epharmacy\bootstrap;

// import ##
use epharmacy;

// If this file is called directly, Bulk!
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

// plugin activation hook to store current application and plugin state ##
\register_activation_hook( __FILE__, [ '\\epharmacy\\bootstrap\\plugin', 'activation_hook' ] );

// plugin deactivation hook - clear stored data ##
\register_deactivation_hook( __FILE__, [ '\\epharmacy\\bootstrap\\plugin', 'deactivation_hook' ] );

// required bits to get set-up ##
require_once __DIR__ . '/library/api/function.php';
require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/plugin.php';
require_once __DIR__ . '/hooks.php';

// get plugin instance ##
$plugin = plugin::get_instance();

// validate instance ##
if( ! ( $plugin instanceof epharmacy\bootstrap\plugin ) ) {

	error_log( 'Error in epharmacy bootstrap plugin instance' );

	// nothing else to do here ##
	return;

}

// set text domain on init hook ##
\add_action( 'init', [ $plugin, 'load_plugin_textdomain' ], 1 );

// fire hooks - build factory objects and translations ## 
\add_action( 'after_setup_theme', function() use( $plugin ){

	// build hooks factory ##
	$hooks = new epharmacy\bootstrap\hooks( $plugin );

	// UI hooks ##
	$hooks->example( 
		new \epharmacy\bootstrap\example\asset( $plugin )  
	);

}, 3 );
