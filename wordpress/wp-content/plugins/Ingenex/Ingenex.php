<?php

/**
 * Plugin Name: INGENEX PLUGINS
 * Plugin URI: http://ingenexdigital.com
 * Description: Needed Plugins to keep functions out of the theme
 * Version: 0.1
 * Author: John Wright
 * Author URI: http://pluginstarter.com
 * Contributors: martythornley
 *
 * @copyright 2012 Marty Thornley
 * @link http://pluginstarter.com
 *
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 *
 */

	if ( !defined( 'IDM_PLUGIN_PATH' ) )    define( 'IDM_PLUGIN_PATH',	plugin_dir_path( __FILE__ ));
	if ( !defined( 'IDM_PLUGIN_URL' ) )     define( 'IDM_PLUGIN_URL',	plugin_dir_url( __FILE__ ));

    // Custom Functions
	//require_once( trailingslashit( IDM_PLUGIN_PATH ) . 'functions/functions.php' );
    // Metaboxes
    require_once( trailingslashit( IDM_PLUGIN_PATH ) . 'metaboxes/setup.php');
    require_once( trailingslashit( IDM_PLUGIN_PATH ) . 'metaboxes/conversion-tracking-spec.php');

?>