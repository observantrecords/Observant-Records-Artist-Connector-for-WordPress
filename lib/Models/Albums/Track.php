<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 5:38 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class Track
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Track extends Model {

	/**
	 * @var string The tracks table
	 */
	protected $table = 'ep4_tracks';
	/**
	 * @var string The tracks table primary key
	 */
	protected $primaryKey = 'track_id';
	/**
	 * @var bool Use soft deletes
	 */
	protected $softDelete = true;
	/**
	 * @var array Write only to the fields specified.
	 */
	protected $fillable = array(
		'track_song_id',
		'track_release_id',
		'track_recording_id',
		'track_disc_num',
		'track_track_num',
		'track_alias',
		'track_is_visible',
		'track_audio_is_linked',
		'track_audio_is_downloadable',
		'track_uplaya_score',
	);
	/**
	 * @var array Exclude specified fields from being written.
	 */
	protected $guarded = array(
		'track_id',
		'track_deleted',
	);

	/**
	 * release
	 *
	 * release() establishes a relationship with the Release model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function release() {
		return $this->belongsTo('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Albums\Release', 'track_release_id', 'release_id');
	}

	/**
	 * song
	 *
	 * song() establishes a relationship with the Song model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function song() {
		return $this->hasOne('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Songs\Song', 'song_id', 'track_song_id');
	}

	/**
	 * recording
	 *
	 * recording() establishes a relationship with the Recording model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function recording() {
		return $this->hasOne('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings\Recording', 'recording_id', 'track_recording_id');
	}

	/**
	 * ecommerce
	 *
	 * ecommerce() establishes a relationship with the Ecommerce model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function ecommerce() {
		return $this->hasMany('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Ecommerce\Ecommerce', 'ecommerce_track_id', 'track_id');
	}

	/**
	 * findReleaseTracks
	 *
	 * findReleaseTracks() finds tracks related to a release.
	 *
	 * @param $release_id
	 * @return array
	 */
	public function findReleaseTracks($release_id) {
		$tracks_formatted = array();
		$tracks = Track::where('track_release_id', $release_id)->orderBy('track_disc_num')->orderBy('track_track_num')->get();

		if (!empty($tracks)) {
			foreach ($tracks as $track) {
				$tracks_formatted[$track->track_disc_num][] = $track;
			}
		}

		return $tracks_formatted;
	}
}