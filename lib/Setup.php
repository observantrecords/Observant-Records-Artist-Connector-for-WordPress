<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 6:19 AM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector;

/**
 * Use this constant for functions with an argument for scope.
 */
const WP_PLUGIN_DOMAIN = 'observantrecords_artist_connector';

/**
 * Class Setup
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Setup {

	/**
	 * Setup constructor.
	 */
	public function __construct() {

	}

	/**
	 * init
	 *
	 * init() registers WordPress actions and filters to setup the plugin.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'createPostTypes' ) );
	}

	/**
	 * activate
	 *
	 * Use this method with register_activation_hook().
	 */
	public static function activate() {
		delete_option('aws_secret_key');
	}

	/**
	 * deactivate
	 *
	 * Use this method with register_deactivation_hook.
	 */
	public static function deactivate() {

	}

	/**
	 * uninstall
	 *
	 * Use this method with register_uninstall_hook().
	 */
	public static function uninstall() {

	}

	/**
	 * createPostTypes
	 *
	 * createPostTypes() registers all custom post types for the plugin.
	 */
	public static function createPostTypes() {

		register_post_type( 'artist', array(
			'labels' => array(
				'name' => 'Artists',
				'singular_name' => 'Artist',
			),
			'public' => true,
			'menu_position' => 5,
			'supports' => array(
				'title',
				'editor',
				'revisions',
			),
			'has_archive' => true,
			'rewrite' => array(
				'slug' => 'artists',
			),
		) );
		register_post_type( 'album', array(
			'labels' => array(
				'name' => 'Albums',
				'singular_name' => 'Album',
			),
			'public' => true,
			'menu_position' => 5,
			'supports' => array(
				'title',
				'editor',
				'revisions',
			),
			'has_archive' => true,
			'rewrite' => array(
				'slug' => 'releases',
			),
		) );
		register_post_type( 'track', array(
			'labels' => array(
				'name' => 'Tracks',
				'singular_name' => 'Track',
			),
			'public' => true,
			'menu_position' => 5,
			'supports' => array(
				'title',
				'editor',
				'revisions',
			),
			'has_archive' => true,
			'rewrite' => true,
		) );

	}

}