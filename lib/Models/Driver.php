<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 2/22/16
 * Time: 9:53 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

/**
 * Class Driver
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Driver
{
	/**
	 * init
	 *
	 * init() creates a database connection with the Eloquent library using credentials
	 * configured in the plugin settings. Otherwise, the WordPress database is used.
	 * This driver must be called before each model extending the Eloquent model.
	 */
	public static function init() {
		// Establish a connection to configured database.
		// Use the WP database if none is configured.
		$ob_db_host = get_option('observantrecords_db_host', DB_HOST);
		$ob_db_name = get_option('observantrecords_db_name', DB_NAME);
		$ob_db_user = get_option('observantrecords_db_user', DB_USER);
		$ob_db_password = get_option('observantrecords_db_password', DB_PASSWORD);

		$capsule = new Capsule();

		$capsule->addConnection([
			'driver'    => 'mysql',
			'host'      => $ob_db_host,
			'database'  => $ob_db_name,
			'username'  => $ob_db_user,
			'password'  => $ob_db_password,
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		]);

		$capsule->setEventDispatcher( new Dispatcher( new Container() ) );

		$capsule->bootEloquent();
	}
}