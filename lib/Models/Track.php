<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 8:05 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class Track extends Base {

	public $_table = 'ep4_tracks';
	public $_primary_key = 'track_id';

	public function __construct() {
		parent::__construct();
		$this->loadRelationship( array( 'model' => 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Release', 'alias' => 'release' ) );
		$this->loadRelationship( array( 'model' => 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Song', 'alias' => 'song' ) );
		$this->loadRelationship( array( 'model' => 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Recording', 'alias' => 'recording' ) );
	}

	public function get( $id, $args = null ) {
		$track = parent::get( $id, $args );

		if ( !empty ($track)) {
			$track->song = $this->song->get( $track->track_song_id );
		}

		return $track;
	}

	public function getAll( $args = null ) {
		$tracks = parent::getAll( $args );

		$_this = $this;
		array_walk( $tracks, function ( $track ) use ( $_this ) {
			$track->song = $_this->song->get( $track->track_song_id );
		} );

		return $tracks;
	}

	public function getReleaseTracks( $release_id, $args = null ) {
		if ( empty( $args['order_by'] ) ) {
			$args['order_by'] = 'track_disc_num, track_track_num';
		}
		$tracks = $this->getManyBy( 'track_release_id', $release_id, $args );

		$_this = $this;
		array_walk( $tracks, function ( $track ) use ( $_this ) {
			$track->song = $_this->song->get( $track->track_song_id );
			$track->audio = $this->recording->audio->getRecordingFiles( $track->track_recording_id );
		} );

		return $tracks;
	}

}