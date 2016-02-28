<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:58 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Songs;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class Song
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Songs
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Song extends Model {

	/**
	 * @var string The song table.
	 */
	protected $table = 'ep4_songs';
	/**
	 * @var string The song table primary key.
	 */
	protected $primaryKey = 'song_id';
	/**
	 * @var bool Use soft deletes.
	 */
	protected $softDelete = true;
	/**
	 * @var array Write only to the fields specified.
	 */
	protected $fillable = array(
		'song_primary_artist_id',
		'song_title',
		'song_alias',
		'song_author',
		'song_abstract',
		'song_lyrics',
		'song_influences',
		'song_style',
		'song_written_date',
		'song_revised_date',
		'song_recorded_date',
	);
	/**
	 * @var array Exclude specified fields from being written.
	 */
	protected $guarded = array(
		'song_id',
		'song_deleted',
	);


	/**
	 * artist
	 *
	 * artist() establishes a relationship with the Artist model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function artist() {
		return $this->belongsTo('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Artists\Artist', 'song_primary_artist_id', 'artist_id');
	}

	/**
	 * recordings
	 *
	 * recordings() establishes a relationship with the Recording model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function recordings() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings\Recording', 'recording_song_id', 'song_id');
	}

	/**
	 * tracks
	 *
	 * tracks() establishes a relationship with the Track model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function tracks() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Track', 'track_song_id', 'song_id');
	}

} 