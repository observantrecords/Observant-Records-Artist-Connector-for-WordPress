<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 5/28/14
 * Time: 2:59 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class Recording
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Recording extends Model {

	/**
	 * @var string The recording table
	 */
	protected $table = 'ep4_recordings';
	/**
	 * @var string The recording table primary key
	 */
	protected $primaryKey = 'recording_id';
	/**
	 * @var bool Use soft deletes.
	 */
	protected $softDelete = true;
	/**
	 * @var array Write only to the fields specified.
	 */
	protected $fillable = array(
		'recording_song_id',
		'recording_artist_id',
		'recording_isrc_num',
	);
	/**
	 * @var array Exclude specified fields from being written.
	 */
	protected $guarded = array(
		'recording_id',
		'recording_deleted',
	);

	/**
	 * song
	 *
	 * song() establishes a relationship with the Song model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function song() {
		return $this->belongsTo('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Songs\Song', 'recording_song_id', 'song_id');
	}

	/**
	 * artist
	 *
	 * artist() establishes a relationship with the Artist model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function artist() {
		return $this->belongsTo('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Artists\Artist', 'recording_artist_id', 'artist_id');
	}

	/**
	 * isrc
	 *
	 * isrc() establishes a relationship with the Isrc model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function isrc() {
		return $this->hasOne('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings\RecordingISRC', 'isrc_code', 'recording_isrc_num');
	}

	/**
	 * audio
	 *
	 * audio() establishes a relationship with the Audio model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function audio() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings\Audio', 'audio_recording_id', 'recording_id');
	}

} 