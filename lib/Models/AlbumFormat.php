<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 3:23 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class AlbumFormat extends Base {

	public $_table = 'ep4_albums_formats';
	public $_primary_key = 'format_id';

	public function __construct() {
		parent::__construct();
	}

}