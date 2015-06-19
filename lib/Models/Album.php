<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 3:17 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class Album extends Base {

	public $_table = 'ep4_albums';
	public $_primary_key = 'album_id';

	public function __construct() {
		parent::__construct();
		$this->loadRelationship( array( 'model' => 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Artist', 'alias' => 'artist') );
		$this->loadRelationship( array( 'model' => 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\AlbumFormat', 'alias' => 'format') );
	}

	public function get( $id, $args = null ) {
		$album = parent::get( $id, $args );
		if ( !empty( $album ) ) {
			$album->album_format = $this->format->get( $album->album_format_id );
		}
		return $album;
	}

	public function getArtistAlbums( $artist_id, $args = null ) {
		$albums = $this->getManyBy( 'album_artist_id', $artist_id, $args );
		$formats = $this->format->getAll();
		$_this = $this;
		array_walk($albums, function ( $album ) use ( $_this, $formats ) {
			foreach ( $formats as $format ) {
				if ( $album->album_format_id == $format->format_id ) {
					$album->album_format = $format;
				}
			}
		});
		return $albums;
	}

}