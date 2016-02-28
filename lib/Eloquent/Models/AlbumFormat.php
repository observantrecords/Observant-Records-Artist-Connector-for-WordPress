<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:29 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Eloquent\Driver;

Driver::init();
class AlbumFormat extends Model {

	protected $table = 'ep4_albums_formats';
	protected $primaryKey = 'format_id';
	protected $softDelete = true;

	public function albums() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Eloquent\Models\Album', 'album_format_id', 'format_id');
	}

}