<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 6/1/14
 * Time: 8:55 AM
 */

class RecordingISRC extends Eloquent {

	protected $table = 'ep4_recordings_isrc';
	protected $primaryKey = 'isrc_id';
	protected $softDelete = true;
	protected $fillable = array(
		'isrc_code',
		'isrc_recording_id',
	);
	protected $guarded = array(
		'isrc_id',
		'isrc_deleted',
	);

	public function isrc() {
		return $this->hasOne('Recording', 'isrc_recording_id', 'recording_id');
	}

	public function generate_code() {
		$isrc_code = null;

		// Get the first available unassigned code for the current year.
		$result = $this->_retrieve_unassigned_code();

		// If no unassigned code is available, create one.
		$isrc_code = (empty($result)) ? $this->_create_code() : $result->isrc_code;

		return $isrc_code;
	}

}