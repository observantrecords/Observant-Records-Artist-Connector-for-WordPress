<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 3:33 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class ReleaseFormat extends Base {

	public $_table = 'ep4_albums_releases_formats';
	public $_primary_key = 'format_id';

	public function __construct() {
		parent::__construct();
	}


}