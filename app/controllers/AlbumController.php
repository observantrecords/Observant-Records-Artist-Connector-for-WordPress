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

		$format_list = array();
		$formats = AlbumFormat::orderBy('format_alias')->get();
		foreach ($formats as $format) {
			$format_list[$format->format_id] = $format->format_alias;
		}

		$this->layout_variables = array(
			'config_url_base' => $config_url_base,
			'formats' => $format_list,
			'locales' => array('en', 'jp'),
		);
	}

	public function browse($artist_id) {

		$artist = Artist::find($artist_id);
		$albums = $artist->albums;

		$method_variables = array(
			'artist' => $artist,
			'albums' => $albums,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('album.browse', $data);
	}

	public function view($album_id) {

		$album = Album::find($album_id);
		$artist = $album->artist;
		$primary_release = $album->primary_release;
		$releases = $album->releases;

		$method_variables = array(
			'artist' => $artist,
			'album' => $album,
			'primary_release' => $primary_release,
			'releases' => $releases,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('album.view', $data);
	}

	public function add($artist_id = null) {

		$album = new Album;
		$album->album_artist_id = $artist_id;
		$album->album_release_date = date('Y-m-d');
		$album->album_ctype_locale = 'en';
		$album->artist = Artist::find($artist_id);

		$method_variables = array(
			'album' => $album,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('album.add', $data);
	}

	public function edit($album_id = null) {

		$album = Album::find($album_id);

		$release_list = array();
		foreach ($album->releases as $release) {
			$release_list[$release->release_id] = $release->release_catalog_num;
		}

		$method_variables = array(
			'album' => $album,
			'releases' => $release_list,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('album.edit', $data);
	}

	public function delete($album_id) {

		$album = Album::find($album_id);

		$method_variables = array(
			'album' => $album,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('album.delete', $data);
	}

	public function update($album = null) {

		if (empty($album)) {
			$album = new Album;
		}

		$fields = $album->getFillable();

		foreach ($fields as $field) {
			$value = Input::get($field);
			if (!empty($value)) {
				$album->{$field} = $value;
			}
		}

		$result = $album->save();

		if ($result !== false) {
			return Redirect::route('album.view', array('id' => $album->album_id))->with('message', 'Your changes were saved.');
		} else {
			return Redirect::route('album.browse')->with('error', 'Your changes were not saved.');
		}
	}

	public function remove(Album $album) {

		$confirm = (boolean) Input::get('confirm');
		$album_title = $album->album_title;
		$artist_id = $album->album_artist_id;

		if ($confirm === true) {
			$album->delete();
			return Redirect::route('artist.view', array('id' => $artist_id  ))->with('message', $album_title . ' was deleted.');
		} else {
			return Redirect::route('album.view', array('id' => $album->album_id))->with('error', $album_title . ' was not deleted.');
		}
	}
}