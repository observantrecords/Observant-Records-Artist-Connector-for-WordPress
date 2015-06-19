<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 2:59 PM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector\Models;


class Artist extends Base {

	public $_table = 'ep4_artists';
	public $_primary_key = 'artist_id';

	public function __construct() {
		parent::__construct();
	}

	public function get( $id, $args = null ) {
		$artist = parent::get( $id, $args );
		$artist->artist_name = $this->formatArtistName( $artist );
		return $artist;
	}

	public function getArtists( $filter = null ) {
		if (!empty($filter)) {
			$artists = $this->getManyLike( 'artist_last_name', $filter, 'after', array( 'order_by' => 'artist_last_name' ));
		} else {
			$artists = $this->getAll( array( 'order_by' => 'artist_last_name' ) );
		}

		$_this = $this;
		array_walk( $artists, function ($artist) use ($_this) {
			$artist->artist_name = $_this->formatArtistName($artist);
		});

		return $artists;
	}

	public function getArtistsNav() {
		$nav = $this->mw_db->get_results( 'select upper( substring( artist_last_name from 1 for 1 ) ) as nav from mw_artists group by nav order By nav' );
		return $nav;
	}

	public function formatArtistName( $artist ) {
		$artist_display_name = empty( $artist->artist_first_name ) ? $artist->artist_last_name : $artist->artist_first_name . ' ' . $artist->artist_last_name;
		return $artist_display_name;
	}

} 