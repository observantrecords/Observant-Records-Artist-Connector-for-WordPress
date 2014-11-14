<?php
/**
 * Plugin Name: Observant Records Artist Connector
 * Plugin URI: https://bitbucket.org/observantrecords/observant-records-artist-connector-for-wordpress
 * Description: This custom plugin connects to the Observant Records Artist database.
 * Version: 1.0.2
 * Author: Greg Bueno
 * Author URI: http://vigilantmedia.com
 * License: MIT
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector;

if (!function_exists( __NAMESPACE__ . '\\autoload' )) {
	function autoload( $class_name )
	{
		$class_name = ltrim($class_name, '\\');
		if ( strpos( $class_name, __NAMESPACE__ ) !== 0 ) {
			return;
		}

		$class_name = str_replace( __NAMESPACE__, '', $class_name );

		$path = plugin_dir_path(__FILE__) . '/lib' . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';

		require_once($path);
	}
}

spl_autoload_register(__NAMESPACE__ . '\\autoload');

register_activation_hook(__FILE__, array('ObservantRecords\WordPress\Plugins\ArtistConnector\Setup', 'activate'));
register_deactivation_hook(__FILE__, array('ObservantRecords\WordPress\Plugins\ArtistConnector\Setup', 'deactivate'));

Setup::init();
Settings::init();
PostMetaData::init();