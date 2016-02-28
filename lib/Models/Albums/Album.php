<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:26 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class Album
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Album extends Model {

	/**
	 * @var string The album table
	 */
	protected $table = 'ep4_albums';
	/**
	 * @var string The album table primary key
	 */
	protected $primaryKey = 'album_id';
	/**
	 * @var bool Use soft deletes.
	 */
	protected $softDelete = true;
	/**
	 * @var array Write only to the fields specified.
	 */
	protected $fillable = array(
		'album_artist_id',
		'album_primary_release_id',
		'album_format_id',
		'album_ctype_locale',
		'album_title',
		'album_alias',
		'album_image',
		'album_music_description',
		'album_release_date',
		'album_is_visible',
	);
	/**
	 * @var array Exclude specified fields from being written.
	 */
	protected $guarded = array(
		'artist_id',
	);

	/**
	 * artist
	 *
	 * artist() establishes a relationship with the Artist model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function artist() {
		return $this->belongsTo('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Artists\Artist', 'album_artist_id', 'artist_id');
	}

	/**
	 * releases
	 *
	 * releases() establishes a relationship with the Release model to list all related releases.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function releases() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Release', 'release_album_id', 'album_id');
	}

	/**
	 * primary_release
	 *
	 * primary_release() establishes a relationship with the Release model to list the primary release for an album.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function primary_release() {
		return $this->hasOne('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Release', 'release_id', 'album_primary_release_id');
	}

	/**
	 * format
	 *
	 * format() establishes a relationship with the AlbumFormat model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function format() {
		return $this->hasOne('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\AlbumFormat', 'format_id', 'album_format_id');
	}

	/**
	 * scopeEponymous4
	 *
	 * scopeEponymous4() establishes a scope for only releases by Eponymous 4.
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeEponymous4($query) {
		return $query->where('album_artist_id', '=', 1);
	}

	/**
	 * scopeEmptyEnsemble
	 *
	 * scopeEmptyEnsemble() establishes a scope for only releases by Empty Ensemble.
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeEmptyEnsemble($query) {
		return $query->where('album_artist_id', '=', 2);
	}

	/**
	 * scopePenziasAndWilson
	 *
	 * scopePenziasAndWilson() establishes a scope for only releases by Penzias and Wilson.
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopePenziasAndWilson($query) {
		return $query->where('album_artist_id', '=', 3);
	}

}