<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 1:33 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector;


use ObservantRecords\WordPress\Plugins\ArtistConnector\Views\BaseView;

/**
 * Class Settings
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Settings {

	/**
	 * Settings constructor.
	 */
	public function __construct() {

	}

	/**
	 * init
	 *
	 * init() registers WordPress actions and filters to handle plugin settings.
	 */
	public static function init() {
		add_action( 'admin_init', array( __CLASS__, 'initCss' ) );
		add_action( 'admin_init', array( __CLASS__, 'adminInit' ) );
		add_action( 'admin_menu', array( __CLASS__, 'adminMenu' ) );
	}

	/**
	 * initCss
	 *
	 * initCss() queues CSS required by the plugin.
	 */
	public static function initCss() {
		wp_enqueue_style( 'observant-records-artist-connector-css', plugin_dir_url( plugin_dir_path( __FILE__ ) ) . 'css/style.css' );
	}

	/**
	 * adminInit
	 *
	 * adminInit() registers setting fields.
	 */
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

	/**
	 * adminMenu
	 *
	 * adminMenu() creates the settings page.
	 */
	public static function adminMenu() {
		add_options_page('Observant Records Artist Connector Settings', 'Artist Connector', 'manage_options', WP_PLUGIN_DOMAIN, array( __CLASS__, 'renderConnectorSettingsPage'));
	}

	/**
	 * renderDatabaseDescription
	 *
	 * renderDatabaseDescription() displays a description for the plugin.
	 */
	public static function renderDatabaseDescription() {
		echo "Connection settings for the Observant Records artist database.";
	}

	/**
	 * renderInputTextField
	 *
	 * renderInputTextField() renders a text input field.
	 *
	 * @param $args
	 */
	public static function renderInputTextField( $args ) {
		$field = $args['field'];
		$value = get_option( $field );
		echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
	}

	/**
	 * renderInputPasswordField
	 *
	 * renderInputPasswordField() renders a password input field.
	 *
	 * @param $args
	 */
	public static function renderInputPasswordField($args ) {
		$field = $args['field'];
		$value = get_option( $field );
		echo sprintf('<input type="password" name="%s" id="%s" value="%s" />', $field, $field, $value);
	}

	/**
	 * renderConnectorSettingsPage
	 *
	 * renderConnectorSettingsPage() displays the plugin settings page.
	 */
	public static function renderConnectorSettingsPage() {
		if (!current_user_can('manage_options')) {
			wp_die('You do not have sufficient permissions to access this page.');
		}

		BaseView::render( 'settings/index.php' );
	}
}