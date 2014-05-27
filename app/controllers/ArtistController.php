<?php
/**
 * Created by PhpStorm.
 * User: gregbueno
 * Date: 5/26/14
 * Time: 3:56 PM
 */

class ArtistController extends BaseController {

	private $layout_variables = array();

	public function __construct() {
		global $config_url_base;

		$this->layout_variables = array(
			'config_url_base' => $config_url_base,
			'section_header' => 'Artists',
		);
	}

	public function browse() {

		$artists = Artist::orderBy('artist_last_name')->get();

		$method_variables = array(
			'artists' => $artists,
			'section_label' => 'Browse',
			'page_title' => 'Artists &raquo; Browse',
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.browse', $data);
	}

	public function view($artist_id) {

		$artist = Artist::find($artist_id);
		$albums = $artist->albums;

		$page_title = 'Artists &raquo; View';
		if (!empty($artist->artist_display_name)) {
			$page_title .= ' &raquo; ' . $artist->artist_display_name;
		}

		$method_variables = array(
			'artist' => $artist,
			'albums' => $albums,
			'section_label' => 'View ' . $artist->artist_display_name,
			'page_title' => $page_title,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.view', $data);
	}

	public function edit($artist_id = null) {

		$page_title = 'Artists';

		if (!empty($artist_id)) {
			$artist = Artist::find($artist_id);
			$section_label = 'Edit ' . $artist->artist_display_name;
			if (!empty($artist->artist_display_name)) {
				$page_title .= ' &raquo; Edit &raquo; ' . $artist->artist_display_name;
			}
		} else {
			$artist = new Artist;
			$section_label = 'Add an artist';
			$page_title = ' &raquo; Add';
		}


		$method_variables = array(
			'artist' => $artist,
			'artist_id' => $artist_id,
			'section_label' => $section_label,
			'page_title' => $page_title,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.edit', $data);
	}

	public function delete($artist_id) {

		$artist = Artist::find($artist_id);

		$page_title = 'Artists &raquo; Delete';
		if (!empty($artist->artist_display_name)) {
			$page_title .= ' &raquo; ' . $artist->artist_display_name;
		}

		$method_variables = array(
			'artist' => $artist,
			'section_label' => 'Delete ' . $artist->artist_display_name,
			'page_title' => $page_title,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.delete', $data);
	}

	public function update($artist = null) {

		if (empty($artist)) {
			$artist = new Artist;
		}

		$artist->artist_last_name = Input::get('artist_last_name');
		$artist->artist_first_name = Input::get('artist_first_name');
		$artist->artist_display_name = Input::get('artist_display_name');
		$artist->artist_alias = Input::get('artist_alias');
		$artist->artist_url = Input::get('artist_url');
		$artist->artist_bio = Input::get('artist_bio');
		$artist->artist_bio_more = Input::get('artist_bio_more');
		$artist->save();

		if (!empty($artist->artist_id)) {
			return Redirect::action('ArtistController@view', array('id' => $artist->artist_id))->with('message', 'Your changes have been saved.');
		} else {
			return Redirect::action('ArtistController@browse')->with('error', 'Your changes were not saved.');
		}
	}

	public function remove($artist_id) {

	}
}