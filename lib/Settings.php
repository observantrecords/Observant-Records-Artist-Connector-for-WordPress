<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 1:33 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector;


class Settings {

	public function __construct() {

	}

	public static function init() {
		add_action( 'admin_init', array( __CLASS__, 'init_css' ) );
		add_action( 'admin_init', array( __CLASS__, 'adminInit' ) );
		add_action( 'admin_menu', array( __CLASS__, 'adminMenu' ) );
	}

	public function init_css() {
		wp_enqueue_style( 'observant-records-artist-connector-css', plugin_dir_url( plugin_dir_path( __FILE__ ) ) . 'css/style.css' );
	}

	public static function adminInit() {
		$group_name = WP_PLUGIN_DOMAIN . '-group';
		$section_name = WP_PLUGIN_DOMAIN . '-section';

		register_setting( $group_name, 'observantrecords_db_host' );
		register_setting( $group_name, 'observantrecords_db_name' );
		register_setting( $group_name, 'observantrecords_db_user' );
		register_setting( $group_name, 'observantrecords_db_password' );

		add_settings_section( $section_name, 'Artist database connection', array( __CLASS__, 'renderDatabaseDescription'), WP_PLUGIN_DOMAIN );

		add_settings_field( WP_PLUGIN_DOMAIN . '-db_host', 'Database host', array( __CLASS__, 'renderInputTextField'), WP_PLUGIN_DOMAIN, $section_name, array('field' => 'observantrecords_db_host'));
		add_settings_field( WP_PLUGIN_DOMAIN . '-db_name', 'Database name', array( __CLASS__, 'renderInputTextField'), WP_PLUGIN_DOMAIN, $section_name, array('field' => 'observantrecords_db_name'));
		add_settings_field( WP_PLUGIN_DOMAIN . '-db_user', 'Database user', array( __CLASS__, 'renderInputTextField'), WP_PLUGIN_DOMAIN, $section_name, array('field' => 'observantrecords_db_user'));
		add_settings_field( WP_PLUGIN_DOMAIN . '-db_password', 'Database password', array( __CLASS__, 'renderInputPasswordField'), WP_PLUGIN_DOMAIN, $section_name, array('field' => 'observantrecords_db_password'));
	}

	public static function adminMenu() {
		add_options_page('Observant Records Artist Connector Settings', 'Artist Connector', 'manage_options', WP_PLUGIN_DOMAIN, array( __CLASS__, 'renderConnectorSettingsPage'));
	}

	public function renderDatabaseDescription() {
		echo "Connection settings for the Observant Records artist database.";
	}

	public function renderInputTextField( $args ) {
		$field = $args['field'];
		$value = get_option( $field );
		echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
	}

	public function renderInputPasswordField( $args ) {
		$field = $args['field'];
		$value = get_option( $field );
		echo sprintf('<input type="password" name="%s" id="%s" value="%s" />', $field, $field, $value);
	}

	public function renderConnectorSettingsPage() {
		if (!current_user_can('manage_options')) {
			wp_die('You do not have sufficient permissions to access this page.');
		}

		include( plugin_dir_path( __FILE__ ) . '../templates/settings.php' );
	}
}