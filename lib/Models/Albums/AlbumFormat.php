<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:29 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class AlbumFormat
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums
 * @author Greg Bueno
 * @copyright Observant Records
 */
class AlbumFormat extends Model {

	/**
	 * @var string The album format table
	 */
	protected $table = 'ep4_albums_formats';
	/**
	 * @var string The album format primary key
	 */
	protected $primaryKey = 'format_id';
	/**
	 * @var bool Use soft deletes
	 */
	protected $softDelete = true;

	/**
	 * albums
	 *
	 * albums() establishes a relationship with the Album model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function albums() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Album', 'album_format_id', 'format_id');
	}

}