<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 5/28/14
 * Time: 2:58 PM
 */

class ReleaseController extends BaseController {

	private $layout_variables = array();

	public function __construct() {
		global $config_url_base;

		$this->layout_variables = array(
			'config_url_base' => $config_url_base,
		);
	}

	public function browse($___id) {

		$method_variables = array(
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('___.browse', $data);
	}

	public function view($release_id) {

		$release = Release::find($release_id);
		$track_model = new Track();
		$release->release_track_list = $track_model->findReleaseTracks($release_id);

		$method_variables = array(
			'release_id' => $release_id,
			'release' => $release,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('release.view', $data);
	}

	public function add($album_id = null) {

		$release = new Release;
		$release->release_album_id = $album_id;
		$release->release_release_date = date('Y-m-d');
		$release->album = Album::find($album_id);

		$albums = Album::orderBy('album_title')->get();
		$formats = ReleaseFormat::all();

		$method_variables = array(
			'release' => $release,
			'albums' => $albums,
			'formats' => $formats,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('release.add', $data);
	}

	public function edit($release_id) {

		$release = Release::find($release_id);

		$albums = Album::where('album_artist_id', $release->album->album_artist_id)->orderBy('album_title')->lists('album_title', 'album_id');
		$formats = ReleaseFormat::lists('format_alias', 'format_id');

		$method_variables = array(
			'release_id' => $release_id,
			'release' => $release,
			'albums' => $albums,
			'formats' => $formats,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('release.edit', $data);
	}

	public function delete($release_id) {

		$release = Release::find($release_id);

		$method_variables = array(
			'release_id' => $release_id,
			'release' => $release,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('release.delete', $data);
	}

	public function update(Release $release = null) {

		if (empty($release)) {
			$release = new Release;
		}

		$fields = $release->getFillable();

		foreach ($fields as $field) {
			$value = Input::get($field);
			if (!empty($value)) {
				$release->{$field} = $value;
			}
		}

		$result = $release->save();

		if ($result !== false) {
			return Redirect::route('release.view', array('id' => $release->release_id))->with('message', 'Your changes were saved.');
		} else {
			return Redirect::route('album.browse')->with('error', 'Your changes were not saved.');
		}
	}

	public function remove(Release $release) {

		$confirm = (boolean) Input::get('confirm');
		$release_catalog_num = $release->release_catalog_num;
		$album_id = $release->album_id;

		if ($confirm === true) {
			$release->delete();
			return Redirect::route('album.view', array('id' => $album_id  ))->with('message', 'The record was deleted.');
		} else {
			return Redirect::route('release.view', array('id' => $release->release_id))->with('error', 'The record was not deleted.');
		}
	}

} 