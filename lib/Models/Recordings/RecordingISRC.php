<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 6/1/14
 * Time: 8:55 AM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings;

use Illuminate\Database\Eloquent\Model;
use ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Driver;

Driver::init();

/**
 * Class RecordingISRC
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings
 * @author Greg Bueno
 * @copyright Observant Records
 */
class RecordingISRC extends Model {

	/**
	 * @var string The ISRC table
	 */
	protected $table = 'ep4_recordings_isrc';
	/**
	 * @var string The ISRC table primary key
	 */
	protected $primaryKey = 'isrc_id';
	/**
	 * @var bool Use soft deletes.
	 */
	protected $softDelete = true;
	/**
	 * @var array Write only to the fields specified.
	 */
	protected $fillable = array(
		'isrc_code',
		'isrc_recording_id',
	);
	/**
	 * @var array Exclude specified fields from being written.
	 */
	protected $guarded = array(
		'isrc_id',
		'isrc_deleted',
	);

	/**
	 * @var string The registrant segment of the ISRC code
	 */
	private $_isrc_registrant_code;
	/**
	 * @var string The country segment of the ISRC code
	 */
	private $_isrc_country_code;
	/**
	 * @var string The numerical segment of the ISRC code
	 */
	private $_isrc_stem;

	/**
	 * RecordingISRC constructor.
	 */
	public function __construct() {
		parent::__construct();
		$this->_isrc_registrant_code = ISRC_REGISTRANT_CODE;
		$this->_isrc_country_code = ISRC_COUNTRY_CODE;

		$this->_isrc_stem = ISRC_COUNTRY_CODE . '-' . $this->_isrc_registrant_code . '-' . date('y') . '-';
	}

	/**
	 * isrc
	 *
	 * isrc() establishes a relationship with the Isrc model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function isrc() {
		return $this->hasOne('ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recordings\Recording', 'isrc_recording_id', 'recording_id');
	}

	/**
	 * generate_code
	 *
	 * generate_code() creates a new ISRC code based on the current year and last generated code.
	 *
	 * @return null|string
	 */
	public function generate_code() {
		$isrc_code = null;

		// Get the first available unassigned code for the current year.
		$result = $this->_retrieve_unassigned_code();

		// If no unassigned code is available, create one.
		$isrc_code = (empty($result)) ? $this->_create_code() : $result->isrc_code;

		return $isrc_code;
	}

	/**
	 * _create_code
	 *
	 * _create_code() creates a new ISRC code if an unassigned code doesn't exist.
	 *
	 * @return null|string
	 */
	private function _create_code() {
		$isrc_code = null;

		// Get the most recently generated code for the year.
		$result = $this->_retrieve_last_code();

		// If a result exists, increment the designation code.
		if (!empty($result)) {
			list ($country, $registrant, $year, $designation) = explode('-', $result->isrc_code);
			$new_designation = intval($designation);
			$new_designation++;
			$isrc_code = $country . '-' . $registrant . '-' . $year . '-' . sprintf('%05d', $new_designation);
		} else {
			// If no result exists, create the first code.
			$isrc_code = $this->_isrc_stem . sprintf('%05d', 1);
		}

		// Save the code in the database.
		$this->_save_unassigned_code($isrc_code);

		// Return the code.
		return $isrc_code;
	}

	/**
	 * _retrieve_last_code
	 *
	 * _retrieve_last_code() finds the last ISRC code created.
	 *
	 * @return mixed
	 */
	private function _retrieve_last_code() {
		$result = DB::table($this->table)->where('isrc_code', 'LIKE', $this->_isrc_stem . '%')->orderBy('isrc_code', 'desc')->first();
		return $result;
	}

	/**
	 * _retrieve_unassigned_code
	 *
	 * _retrieve_unassigned_code() finds an ISRC code not assigned to a recording.
	 *
	 * @return mixed
	 */
	private function _retrieve_unassigned_code() {
		$result = DB::table($this->table)->where('isrc_code', 'LIKE', $this->_isrc_stem . '%')->where('isrc_recording_id', 0)->orderBy('isrc_code')->first();
		return $result;
	}

	/**
	 * _save_unassigned_code
	 *
	 * _save_unassigned_code() stores a generated ISRC code not assigned to a recording.
	 *
	 * @param $isrc_code
	 * @return mixed
	 */
	private function _save_unassigned_code($isrc_code) {
		$this->isrc_code = $isrc_code;
		$this->isrc_recording_id = 0;
		$this->save();

		return $this->isrc_id;
	}

	/**
	 * _validate_assignment
	 *
	 * _validate_assignment() checks whether a code is not already assigned to a recording.
	 *
	 * @param $isrc_recording_id
	 * @return bool
	 */
	private function _validate_assignment($isrc_recording_id) {
		if ($isrc_recording_id == 0) {
			// Zero is an acceptable repeatable value.
			return true;
		} else {
			// If the value is greater than zero, check to make sure
			// it isn't assigned to any other code.
			$result = $this->get_by('isrc_recording_id', $isrc_recording_id);
			$result = DB::table($this->table)->where('isrc_recording_id', $isrc_recording_id)->count();
			if ($result < 1) {
				return true;
			}
		}

		return false;
	}
}