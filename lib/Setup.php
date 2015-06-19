<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 6:19 AM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector;

const WP_PLUGIN_DOMAIN = 'observantrecords_artist_connector';

class Setup {

	public function __construct() {

	}

	public static function init() {
		add_action( 'init', array( __CLASS__, 'createPostTypes' ) );
	}

	public static function activate() {
		delete_option('aws_secret_key');
	}

	public static function deactivate() {

	}

	public static function install() {

	}

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