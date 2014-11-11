<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 1:22 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;

class Driver {

	private $ob_db;
	private $is_ready;
	private $status_message;

	public function __construct() {
		$this->is_ready = false;

		$this->init();
	}

	public function init() {
		// Establish a connection to configured database.
		// Use the WP database if none is configured.
		$ob_db_host = get_option('observantrecords_db_host', DB_HOST);
		if (empty($ob_db_host)) {
			$ob_db_host = DB_HOST;
		}

		$ob_db_name = get_option('observantrecords_db_name', DB_NAME);
		if (empty($ob_db_name)) {
			$ob_db_name = DB_NAME;
		}

		$ob_db_user = get_option('observantrecords_db_user', DB_USER);
		if (empty($ob_db_user)) {
			$ob_db_user = DB_USER;
		}

		$ob_db_password = get_option('observantrecords_db_password', DB_PASSWORD);
		if (empty($ob_db_password)) {
			$ob_db_password = DB_PASSWORD;
		}

		if ( false === ( $this->ob_db = new \wpdb($ob_db_user, $ob_db_password, $ob_db_name, $ob_db_host ) ) ) {
			$this->ob_db = $GLOBALS['wpdb'];
		}

		// Exit if we don't have at least the artist table.
		$ob_artist_table = $this->ob_db->get_var("show tables like 'ep4_artists';");
		if ($ob_artist_table != 'ep4_artists') {
			$this->ob_db = null;
			$this->status_message = 'Observant Records Artist table was not found.';
			return false;
		}

		// Everything look cool?
		$this->is_ready = true;
	}

	public function isReady() {
		return $this->is_ready;
	}

	public function getDriver() {
		return $this->ob_db;
	}

	public function getStatus() {
		return $this->status_message;
	}

}