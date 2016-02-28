<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:35 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();
class ReleaseFormat extends Model {

	protected $table = 'ep4_albums_releases_formats';
	protected $primaryKey = 'format_id';
	protected $softDelete = true;

}