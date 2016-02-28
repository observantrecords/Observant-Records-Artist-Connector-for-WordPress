<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:31 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class Release
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Release extends Model {

	/**
	 * @var string The releases table
	 */
	protected $table = 'ep4_albums_releases';
	/**
	 * @var string The releases table primary key
	 */
	protected $primaryKey = 'release_id';
	/**
	 * @var bool Use soft deletes
	 */
	protected $softDelete = true;
	/**
	 * @var array Write only to the fields specified.
	 */
	protected $fillable = array(
		'release_album_id',
		'release_upc_num',
		'release_catalog_num',
		'release_format_id',
		'release_alternate_title',
		'release_alias',
		'release_label',
		'release_release_date',
		'release_image',
		'release_is_visible',
	);
	/**
	 * @var array Exclude specified fields from being written.
	 */
	protected $guarded = array(
		'release_id',
		'release_date_modified',
		'release_deleted',
	);
	/**
	 * @var Catalog number prefix.
	 */
	private $_catalog_stem = 'OBRC-';

	/**
	 * album
	 *
	 * album() establishes a relationship with the Album model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function album() {
		return $this->belongsTo('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Album', 'release_album_id', 'album_id');
	}

	/**
	 * tracks
	 *
	 * tracks() establishes a relationship with the Track model.
	 *
	 * @return mixed
	 */
	public function tracks() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Track', 'track_release_id', 'release_id')->orderBy('track_disc_num')->orderBy('track_track_num');
	}

	/**
	 * format
	 *
	 * format() establishes a relationship with the ReleaseFormat model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function format() {
		return $this->hasOne('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\ReleaseFormat', 'format_id', 'release_format_id');
	}

	/**
	 * ecommerce
	 *
	 * ecommerce() establishes a relationship with the Ecommerce model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ecommerce() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Ecommerce\Ecommerce', 'ecommerce_release_id', 'release_id');
	}

	/**
	 * generate_catalog_num
	 *
	 * generate_catalog_num() generates a catalog number iterated from the most recent number.
	 *
	 * @return null|string
	 */
	public function generate_catalog_num() {
		$catalog_num = null;

		// Get the most recently generated catalog number.
		$result = $this->_retrieve_last_number();

		// If a result exists, increment the catalog number.
		if (!empty($result)) {
			list ($stem, $suffix) = explode('-', $result->release_catalog_num);
			$new_suffix = intval( substr($suffix, 0, 3) );
			$new_suffix++;
			$catalog_num = $stem . '-' . sprintf('%03d', $new_suffix) . 'B';
		} else {
			// If no result exists, create the first catalog number.
			$catalog_num = $this->_catalog_stem . sprintf('%03d', 1) . 'B';
		}

		// Return the code.
		return $catalog_num;
	}

	/**
	 * _retrieve_last_number
	 *
	 * _retrieve_last_number() retrieves the most recent catalog number.
	 *
	 * @return mixed
	 */
	private function _retrieve_last_number() {
		$result = DB::table($this->table)->where('release_catalog_num', 'LIKE', 'OBRC-%B')->orderBy('release_catalog_num', 'desc')->first();
		return $result;
	}

}