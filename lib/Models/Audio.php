<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 8:07 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class Audio extends Base {

	public $_table = 'ep4_audio';
	public $_primary_key = 'audio_id';

	public function __construct() {
		parent::__construct();
	}

	public function getRecordingFiles( $recording_id ) {
		$audio = $this->getManyBy( 'audio_recording_id', $recording_id );

		return $audio;
	}

} 