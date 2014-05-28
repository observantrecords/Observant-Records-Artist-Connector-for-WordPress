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

	public function add() {

		$artist = new Artist;

		$method_variables = array(
			'artist' => $artist,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.add', $data);
	}

	public function edit($artist_id = null) {

		$artist = Artist::find($artist_id);

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

		$fields = $artist->getFillable();

		foreach ($fields as $field) {
			$value = Input::get($field);
			if (!empty($value)) {
				$artist->{$field} = $value;
			}
		}

		$result = $artist->save();

		if ($result !== false) {
			return Redirect::route('artist.view', array('id' => $artist->artist_id))->with('message', 'Your changes were saved.');
		} else {
			return Redirect::route('artist.browse')->with('error', 'Your changes were not saved.');
		}
	}

	public function remove(Artist $artist) {
		$confirm = (boolean) Input::get('confirm');
		$artist_display_name = $artist->artist_display_name;

		if ($confirm === true) {
			$artist->delete();
			return Redirect::route('artist.browse')->with('message', $artist_display_name . ' was deleted.');
		} else {
			return Redirect::route('artist.view', array('id' => $artist->artist_id))->with('error', $artist_display_name . ' was not deleted.');
		}
	}
}