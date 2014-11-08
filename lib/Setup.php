<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 6:19 AM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector;


class Setup {

	public function __construct() {

	}

	public static function init() {

	}

	public static function activate() {
		delete_option('aws_secret_key');
	}

	public static function deactivate() {

	}

	public static function install() {

	}
}