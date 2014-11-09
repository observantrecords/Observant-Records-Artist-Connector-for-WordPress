<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 8:07 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class Song extends Base {

	public $_table = 'ep4_song';
	public $_primary_key = 'song_id';

	public function __construct() {
		parent::__construct();
	}

} 