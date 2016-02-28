<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 2/27/16
 * Time: 5:13 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Views;


class BaseView
{

	public function __construct()
	{
	}

	public static function render( $template_path, $data = null, $template_dir = null ) {

		if ( !empty( $data ) ) {
			extract( $data );
		}

		if ( empty( $template_dir ) ) {
			$template_dir = plugin_dir_path( __FILE__ );
		}

		include_once $template_dir . $template_path;
	}

}