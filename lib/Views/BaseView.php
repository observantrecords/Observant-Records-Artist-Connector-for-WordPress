<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 2/27/16
 * Time: 5:13 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Views;


/**
 * Class BaseView
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Views
 * @author Greg Bueno
 * @copyright Observant Records
 */
class BaseView
{

	/**
	 * BaseView constructor.
	 */
	public function __construct()
	{
	}

	/**
	 * render
	 *
	 * render() displays a view template with an associate array of data. Keys of the $data
	 * array become variable names in the template. Specify an alternate template directory
	 * with $template_dir. The default is the Views directory itself. $template_path should
	 * include subdirectories if templates are organzied in such a manner.
	 *
	 * @param $template_path
	 * @param null $data
	 * @param null $template_dir
	 */
	public static function render($template_path, $data = null, $template_dir = null ) {

		if ( !empty( $data ) ) {
			extract( $data );
		}

		if ( empty( $template_dir ) ) {
			$template_dir = plugin_dir_path( __FILE__ );
		}

		include_once $template_dir . $template_path;
	}

}