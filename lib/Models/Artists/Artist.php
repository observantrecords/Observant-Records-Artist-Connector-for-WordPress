<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 4:00 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Artists;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class Artist
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Artists
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Artist extends Model {

	/**
	 * @var string The artists table
	 */
	protected $table = 'ep4_artists';
	/**
	 * @var string The artist table primary key
	 */
	protected $primaryKey = 'artist_id';
	/**
	 * @var bool Use soft deletes.
	 */
	protected $softDelete = true;
	/**
	 * @var array Write only to the fields specified.
	 */
	protected $fillable = array(
		'artist_last_name',
		'artist_first_name',
		'artist_display_name',
		'artist_alias',
		'artist_url',
		'artist_bio',
		'artist_bio_more',
	);
	/**
	 * @var array Exclude specified fields from being written.
	 */
	protected $guarded = array(
		'artist_id',
	);

	/**
	 * Artist constructor.
	 */
	public function __construct() {

	}

	/**
	 * albums
	 *
	 * albums() establishes a relationship with the Album model.
	 *
	 * @return mixed
	 */
	public function albums() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Album', 'album_artist_id', 'artist_id')->orderBy('album_order');
	}

	/**
	 * songs
	 *
	 * songs() establishes a relationship with the Song model.
	 *
	 * @return mixed
	 */
	public function songs() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Songs\Song', 'song_primary_artist_id', 'artist_id')->orderBy('song_title');
	}

	/**
	 * recordings
	 *
	 * recordings() establishes a relationship with the Recording model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function recordings() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings\Recording', 'recording_artist_id', 'artist_id');
	}

	/**
	 * scopeEponymous4
	 *
	 * scopeEponymous4() creates a local scope for Eponymous 4.
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeEponymous4($query) {
		return $query->where('artist_id', '=', 1);
	}

	/**
	 * scopeEmptyEnsemble
	 *
	 * scopeEmptyEnsemble() creates a local scope for Empty Ensemble.
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopeEmptyEnsemble($query) {
		return $query->where('artist_id', '=', 2);
	}

	/**
	 * scopePenziasAndWilson
	 *
	 * scopePenziasAndWilson() creates a local scope for Penzias and Wilson.
	 *
	 * @param $query
	 * @return mixed
	 */
	public function scopePenziasAndWilson($query) {
		return $query->where('artist_id', '=', 3);
	}
}