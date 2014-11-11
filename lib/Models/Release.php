<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 3:25 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class Release extends Base {

	public $_table = 'ep4_albums_releases';
	public $_primary_key = 'release_id';

	public function __construct() {
		parent::__construct();
		$this->loadRelationship( array( 'model' => 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Album', 'alias' => 'album') );
		$this->loadRelationship( array( 'model' => 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\ReleaseFormat', 'alias' => 'format' ) );
		$this->loadRelationship( array( 'model' => 'ObservantRecords\WordPress\Plugins\ArtistConnector\Models\Ecommerce', 'alias' => 'ecommerce' ) );
	}

	public function get( $id, $args = null ) {
		$release = parent::get( $id, $args );
		if ( !empty( $release ) ) {
			$format = $this->format->get( $release->release_format_id );
			$release->release_format_name = $format->format_name;
			$release->release_format_alias = $format->format_alias;
		}
		return $release;
	}

	public function getAlbumReleases( $album_id, $args = null ) {
		$releases = $this->getManyBy( 'release_album_id', $album_id, $args );

		if ( !empty( $releases ) ) {
			$formats = $this->format->getAll();
			array_walk( $releases, function ( $release ) use ( $formats ) {
				foreach ( $formats as $format ) {
					if ($format->format_id == $release->release_format_id) {
						$release->release_format_name = $format->format_name;
						$release->release_format_alias = $format->format_alias;
					}
				}
			});
		}

		return $releases;
	}

}