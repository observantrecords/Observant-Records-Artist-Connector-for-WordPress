<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/28/14
 * Time: 4:43 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class Audio
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings
 * @author Greg Bueno
 * @copyright Observant Records
 */
class Audio extends Model {

	/**
	 * @var string The audio table
	 */
	protected $table = 'ep4_audio';
	/**
	 * @var string The audio table primary key
	 */
	protected $primaryKey = 'audio_id';
	/**
	 * @var bool Use soft deletes.
	 */
	protected $softDelete = true;
	/**
	 * @var array Write only to the fields specified.
	 */
	protected $fillable = array(
		'audio_recording_id',
		'audio_display_label',
		'audio_file_server',
		'audio_file_path',
		'audio_file_name',
		'audio_file_type',
		'audio_isrc_num',
	);
	/**
	 * @var array Exclude specified fields from being written.
	 */
	protected $guarded = array(
		'audio_id',
		'audio_deleted',
	);

	/**
	 * recording
	 *
	 * recording() establishes a relationship with the Recording model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function recording() {
		return $this->belongsTo('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings\Recording', 'audio_recording_id', 'recording_id');
	}

}