<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 6:39 AM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector;


class PostMetaData {

	public function __construct() {

	}

	public static function init() {
		add_action( 'add_meta_boxes', array( __CLASS__, 'addMetaBoxes' ) );
		add_action( 'save_post', array( __CLASS__, 'savePostMeta' ) );
	}

	public static function addMetaBoxes() {
		add_meta_box( 'meta_ob_album_id', 'Observant Records Metadata', array( __CLASS__, 'renderAlbumMetaBox' ), 'album', 'normal', 'high' );
		add_meta_box( 'meta_ob_release_credits', 'Credits', array( __CLASS__, 'renderCreditsBox' ), 'album', 'normal', 'high' );
		add_meta_box( 'meta_ob_track_id', 'Observant Records Metadata', array( __CLASS__, 'renderTrackMetaBox' ), 'track', 'normal', 'high' );
		add_meta_box( 'meta_ob_track_lyrics', 'Lyrics', array( __CLASS__, 'renderTrackLyricsBox' ), 'track', 'normal', 'high' );
	}

	public static function renderAlbumMetaBox( $post ) {
		$ob_album_alias = get_post_meta( $post->ID, '_ob_album_alias', true );
		$ob_release_alias = get_post_meta( $post->ID, '_ob_release_alias', true );

		include( plugin_dir_path( __FILE__ ) . '../templates/album_meta_box.php' );
	}

	public static function renderTrackMetaBox( $post ) {
		$ob_release_alias = get_post_meta( $post->ID, '_ob_release_alias', true );
		$ob_track_alias = get_post_meta( $post->ID, '_ob_track_alias', true );

		include( plugin_dir_path( __FILE__ ) . '../templates/track_meta_box.php' );
	}

	public static function renderTrackLyricsBox( $post ) {
		$ob_track_lyrics = get_post_meta( $post->ID, '_ob_track_lyrics', true );

		wp_editor( $ob_track_lyrics, 'ob_track_lyrics', array(
			'media_buttons' => false,
		) );
	}

	public static function renderCreditsBox( $post ) {
		$ob_release_credits = get_post_meta( $post->ID, '_ob_release_credits', true );

		wp_editor( $ob_release_credits, 'ob_release_credits', array(
			'media_buttons' => false,
		) );
	}

	public static function savePostMeta( $post_id ) {
		$ob_album_alias = $_POST['ob_album_alias'];
		$ob_release_alias = $_POST['ob_release_alias'];
		$ob_release_credits = $_POST['ob_release_credits'];
		$ob_track_alias = $_POST['ob_track_alias'];
		$ob_track_lyrics = $_POST['ob_track_lyrics'];

		( isset( $_POST['ob_album_alias'] ) && empty( $ob_album_alias ) ) ? delete_post_meta( $post_id, '_ob_album_alias' ) : update_post_meta( $post_id, '_ob_album_alias', $ob_album_alias );
		( isset( $_POST['ob_release_alias'] ) && empty( $ob_release_alias ) ) ? delete_post_meta( $post_id, '_ob_release_alias' ) : update_post_meta( $post_id, '_ob_release_alias', $ob_release_alias );
		( isset( $_POST['ob_track_alias'] ) && empty( $ob_track_alias ) ) ? delete_post_meta( $post_id, '_ob_track_alias' ) : update_post_meta( $post_id, '_ob_track_alias', $ob_track_alias );
		( isset( $_POST['ob_track_lyrics'] ) && empty( $ob_track_lyrics ) ) ? delete_post_meta( $post_id, '_ob_track_lyrics' ) : update_post_meta( $post_id, '_ob_track_lyrics', $ob_track_lyrics );
		( isset( $_POST['ob_release_credits'] ) && empty( $ob_release_credits ) ) ? delete_post_meta( $post_id, '_ob_release_credits' ) : update_post_meta( $post_id, '_ob_release_credits', $ob_release_credits );
	}

} 