<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 8:07 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class Recording extends Base {

	public $_table = 'ep4_recordings';
	public $_primary_key = 'recording_id';

	public function __construct() {
		parent::__construct();
		$this->loadRelationship( array( 'model' => 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Audio', 'alias' => 'audio' ) );
	}

} 