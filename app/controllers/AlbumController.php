<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 3:56 PM
 */

class AlbumController extends BaseController {

	private $layout_variables = array();

	public function __construct() {
		global $config_url_base;

		$this->layout_variables = array(
			'config_url_base' => $config_url_base,
			'section_header' => 'Albums',
		);
	}

	public function browse($artist_id) {

		$artist = Artist::find($artist_id);
		$albums = $artist->albums;

		$method_variables = array(
			'artist' => $artist,
			'albums' => $albums,
			'section_label' => 'Browse',
			'page_title' => 'Albums &raquo; Browse',
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.browse', $data);
	}

	public function view($album_id) {

		$album = Album::find($album_id);
		$artist = $album->artist;

		$page_title = 'Artists &raquo; View';
		if (!empty($artist->artist_display_name)) {
			$page_title .= ' &raquo; ' . $artist->artist_display_name;
		}

		$method_variables = array(
			'artist' => $artist,
			'album' => $album,
			'section_label' => 'View ' . $artist->artist_display_name,
			'page_title' => $page_title,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.view', $data);
	}

	public function edit($album_id = null) {

		$page_title = 'Albums';

		if (!empty($album_id)) {
			$album = Album::find($album_id);
			$section_label = 'Edit ' . $album->album_title;
			if (!empty($album->artist_display_name)) {
				$page_title .= ' &raquo; Edit &raquo; ' . $album->album_title;
			}
		} else {
			$album = new Album;
			$section_label = 'Add an album';
			$page_title = ' &raquo; Add';
		}


		$method_variables = array(
			'artist' => $album,
			'artist_id' => $album_id,
			'section_label' => $section_label,
			'page_title' => $page_title,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.edit', $data);
	}

	public function delete($album_id) {

		$album = Album::find($album_id);

		$page_title = 'Artists &raquo; Delete';
		if (!empty($album->artist_display_name)) {
			$page_title .= ' &raquo; ' . $album->artist_display_name;
		}

		$method_variables = array(
			'album' => $album,
			'section_label' => 'Delete ' . $album->artist_display_name,
			'page_title' => $page_title,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.delete', $data);
	}

	public function update($album = null) {

		if (empty($album)) {
			$album = new Album;
		}

		if (!empty($album->album_id)) {
			return Redirect::action('ArtistController@view', array('id' => $album->album_id))->with('message', 'Your changes have been saved.');
		} else {
			return Redirect::action('ArtistController@browse')->with('error', 'Your changes were not saved.');
		}
	}

	public function remove($artist_id) {

	}
}