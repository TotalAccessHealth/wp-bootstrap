<?php

declare(strict_types = 1);

namespace epharmacy\bootstrap;

// import classes ##
// use epharmacy\plugin as plugin;
use epharmacy\core\helper as h;

// If this file is called directly, Bulk!
if ( ! defined( 'ABSPATH' ) ) {
	return;
}

/*
* Main Plugin Class
*/
final class plugin {

    /**
     * Instance
     *
     * @var     Object      $_instance
     */
	private static $_instance;

	// static ##
	public static 
	
		// current tag ##
		$_version = '0.0.1',
		
		// log ##
		$_log = null
		
	;

	/**
	 * Props
	 * 
	 * @var		Array		$props
	*/
	public $_example = null;

    /**
     * Initiator
     *
     * @since   0.0.2
     * @return  Object    
     */
    public static function get_instance() {

        // object defined once --> singleton ##
        if ( 
            isset( self::$_instance ) 
            && NULL !== self::$_instance
        ){

            return self::$_instance;

        }

        // create an object, if null ##
        self::$_instance = new self;

        // store instance in filter, for potential external access ##
        \add_filter( __NAMESPACE__.'/instance', function() {

            return self::$_instance;
            
        });

        // return the object ##
        return self::$_instance; 

    }

    /**
     * Class constructor to define object props --> empty
     * 
     * @since   0.0.1
     * @return  void
    */
    private function __construct() {

        // empty ##
		
	}
	
    /**
     * Get stored object property
	 * 
     * @param   $key    string
     * @since   0.0.2
     * @return  Mixed
    */
    public function get( $key = null ) {

        // check if key set ##
        if( is_null( $key ) ){

            // return false;
			return self::get_instance();

        }
        
        // return if isset ##
        return $this->{$key} ?? false ;

    }

    /**
     * Set stored object properties 
     * 
	 * @todo	Make this work with single props, not from an array
     * @param   $key    string
     * @param   $value  Mixed
     * @since   0.0.2
     * @return  Mixed
    */
    public function set( $key = null, $value = null ) {

        // sanity ##
        if( 
            is_null( $key ) 
        ){

            return false;

        }

        // __log( 'prop->set: '.$key.' -> '.$value );

        // set new value ##
		return $this->{$key} = $value;

    }

    /**
     * Load Text Domain for translations
     *
     * @since       0.0.1
     * @return      Void
     */
    public function load_plugin_textdomain(){

        // The "plugin_locale" filter is also used in load_plugin_textdomain()
        $locale = apply_filters( 'plugin_locale', \get_locale(), 'e-pharmacy-bootstrap' );

        // try from global WP location first ##
        \load_textdomain( 'e-pharmacy-bootstrap', WP_LANG_DIR.'/plugins/e-pharmacy-bootstrap-'.$locale.'.mo' );

        // try from plugin last ##
        \load_plugin_textdomain( 'e-pharmacy-bootstrap', FALSE, \plugin_dir_path( __FILE__ ).'src/languages/' );

    }

    /**
     * Plugin activation
     *
     * @since   0.0.1
     * @return  void
     */
    public static function activation_hook(){

        // Log::write( 'Plugin Activated..' );

        // check user caps ##
        if ( ! \current_user_can( 'activate_plugins' ) ) {
            
            return;

        }

        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        \check_admin_referer( "activate-plugin_{$plugin}" );

        // store data about the current plugin state at activation point ##
        $config = [
            'configured'            => true , 
            'version'               => self::$_version ,
            'wp'                    => \get_bloginfo( 'version' ) ?? null ,
			'timestamp'             => time(),
		];
		
        // activation running, so update configuration flag ##
        \update_option( 'epharmacy-bootstrap', $config, true );

    }

    /**
     * Plugin deactivation
     *
     * @since   0.0.1
     * @return  void
     */
    public static function deactivation_hook(){

        // Log::write( 'Plugin De-activated..' );

        // check user caps ##
        if ( ! \current_user_can( 'activate_plugins' ) ) {
        
            return;
        
        }

        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        \check_admin_referer( "deactivate-plugin_{$plugin}" );

        // de-configure plugin ##
        \delete_option('epharmacy-bootstrap');

        // clear rewrite rules ##
        \flush_rewrite_rules();

	}
	
    /**
     * Get Plugin URL
     *
	 * @todo		__deprecate
     * @since       0.1
     * @param       string      $path   Path to plugin directory
     * @return      string      Absoulte URL to plugin directory
     */
    public static function get_plugin_url( $path = '' ){

        return \plugins_url( $path, __FILE__ );

    }

    /**
     * Get Plugin Path
     *
	 * @todo		__deprecate
     * @since       0.1
     * @param       string      $path   Path to plugin directory
     * @return      string      Absoulte URL to plugin directory
     */
    public static function get_plugin_path( $path = '' ){

        return \plugin_dir_path( __FILE__ ).$path;

	}
	
}
