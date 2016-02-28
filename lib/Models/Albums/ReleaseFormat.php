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

/**
 * Class ReleaseFormat
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums
 * @author Greg Bueno
 * @copyright Observant Records
 */
class ReleaseFormat extends Model {

	/**
	 * @var string The release format table
	 */
	protected $table = 'ep4_albums_releases_formats';
	/**
	 * @var string The release format table primary key
	 */
	protected $primaryKey = 'format_id';
	/**
	 * @var bool Use soft deletes
	 */
	protected $softDelete = true;

}