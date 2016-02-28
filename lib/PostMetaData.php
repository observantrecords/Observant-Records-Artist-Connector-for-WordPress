<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 11/8/14
 * Time: 6:39 AM
 */

namespace ObservantRecords\WordPress\Plugins\ArtistConnector;


use ObservantRecords\WordPress\Plugins\ArtistConnector\Views\BaseView;

/**
 * Class PostMetaData
 * @package ObservantRecords\WordPress\Plugins\ArtistConnector
 * @author Greg Bueno
 * @copyright Observant Records
 */
class PostMetaData {

	/**
	 * PostMetaData constructor.
	 */
	public function __construct() {

	}

	/**
	 * init
	 *
	 * init() registers WordPress actions and filters to handle metadata for posts.
	 */
	public static function init() {
		add_action( 'add_meta_boxes', array( __CLASS__, 'addMetaBoxes' ) );
		add_action( 'save_post', array( __CLASS__, 'savePostMeta' ) );
	}

	/**
	 * addMetaBoxes
	 *
	 * addMetaBoxes() creates custom fields for all post types.
	 */
	public static function addMetaBoxes() {
		add_meta_box( 'meta_ob_album_id', 'Observant Records Metadata', array( __CLASS__, 'renderAlbumMetaBox' ), 'album', 'normal', 'high' );
		add_meta_box( 'meta_ob_release_credits', 'Credits', array( __CLASS__, 'renderCreditsBox' ), 'album', 'normal', 'high' );
		add_meta_box( 'meta_ob_track_id', 'Observant Records Metadata', array( __CLASS__, 'renderTrackMetaBox' ), 'track', 'normal', 'high' );
		add_meta_box( 'meta_ob_track_lyrics', 'Lyrics', array( __CLASS__, 'renderTrackLyricsBox' ), 'track', 'normal', 'high' );
	}

	/**
	 * renderAlbumMetaBox
	 *
	 * renderAlbumMetaBox() displays input fields for album metadata.
	 *
	 * @param $post
	 */
	public static function renderAlbumMetaBox($post ) {

		$data = [
			'ob_album_alias' => get_post_meta( $post->ID, '_ob_album_alias', true ),
			'ob_release_alias' => get_post_meta( $post->ID, '_ob_release_alias', true ),
		];

		BaseView::render( 'metadata/album.php', $data );
	}

	/**
	 * renderTrackMetaBox
	 *
	 * renderTrackMetaBox() displays input fields for track metadata.
	 *
	 * @param $post
	 */
	public static function renderTrackMetaBox($post ) {

		$data = [
			'ob_release_alias' => get_post_meta( $post->ID, '_ob_release_alias', true ),
			'ob_track_alias' => get_post_meta( $post->ID, '_ob_track_alias', true ),
		];

		BaseView::render( 'metadata/track.php' , $data );
	}

	/**
	 * renderTrackLyricsBox
	 *
	 * renderTrackLyricsBox() displays input fields for track lyrics.
	 *
	 * @param $post
	 */
	public static function renderTrackLyricsBox($post ) {
		$ob_track_lyrics = get_post_meta( $post->ID, '_ob_track_lyrics', true );

		wp_editor( $ob_track_lyrics, 'ob_track_lyrics', array(
			'media_buttons' => false,
		) );
	}

	/**
	 * renderCreditsBox
	 *
	 * renderCreditsBox() displays input fields for album credits.
	 *
	 * @param $post
	 */
	public static function renderCreditsBox($post ) {
		$ob_release_credits = get_post_meta( $post->ID, '_ob_release_credits', true );

		wp_editor( $ob_release_credits, 'ob_release_credits', array(
			'media_buttons' => false,
		) );
	}

	/**
	 * savePostMeta
	 *
	 * savePostMeta() stores or destroys values for custom fields.
	 *
	 * @param $post_id
	 */
	public static function savePostMeta($post_id ) {
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