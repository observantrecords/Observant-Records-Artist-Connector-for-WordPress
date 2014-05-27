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
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.browse', $data);
	}

	public function view($artist_id) {

		$artist = Artist::find($artist_id);
		$albums = $artist->albums;

		$method_variables = array(
			'artist' => $artist,
			'albums' => $albums,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.view', $data);
	}

	public function edit($artist_id = null) {

		$page_title = 'Artists';

		if (!empty($artist_id)) {
			$artist = Artist::find($artist_id);
		} else {
			$artist = new Artist;
		}


		$method_variables = array(
			'artist' => $artist,
			'artist_id' => $artist_id,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.edit', $data);
	}

	public function delete($artist_id) {

		$artist = Artist::find($artist_id);

		$method_variables = array(
			'artist' => $artist,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.delete', $data);
	}

	public function update(Artist $artist = null) {

		if (empty($artist)) {
			$artist = new Artist;
		}

		$input = array(
			'artist_last_name' => Input::get('artist_last_name'),
			'artist_first_name' => Input::get('artist_first_name'),
			'artist_display_name' => Input::get('artist_display_name'),
			'artist_alias' => Input::get('artist_alias'),
			'artist_url' => Input::get('artist_url'),
			'artist_bio' => Input::get('artist_bio'),
			'artist_bio_more' => Input::get('artist_bio_more'),
		);

		foreach ($input as $field => $value) {
			$artist->{$field} = $value;
		}
		$result = $artist->save();

		if ($result !== false) {
			return Redirect::action('ArtistController@view', array('id' => $artist->artist_id))->with('message', 'Your changes have been saved.');
		} else {
			return Redirect::action('ArtistController@browse')->with('error', 'Your changes were not saved.');
		}
	}

	public function remove(Artist $artist) {
		$confirm = (boolean) Input::get('confirm');
		$artist_display_name = $artist->artist_display_name;

		if ($confirm === true) {
			$artist->delete();
			return Redirect::action('ArtistController@browse')->with('message', $artist_display_name . ' was deleted.');
		} else {
			return Redirect::action('ArtistController@view', array('id' => $artist->artist_id))->with('error', $artist_display_name . ' was not deleted.');
		}
	}
}