<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 5/28/14
 * Time: 2:58 PM
 */

class TrackController extends BaseController {

	private $layout_variables = array();

	public function __construct() {
		global $config_url_base;

		$this->layout_variables = array(
			'config_url_base' => $config_url_base,
		);
	}

	public function browse($release_id) {

		$tracks = Track::orderBy('track_disc_num, track_track_num')->get();

		$method_variables = array(
			'tracks' => $tracks,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('track.browse', $data);
	}

	public function view($track_id) {

		$track = Track::find($track_id);

		$method_variables = array(
			'track' => $track,
			'track_id' => $track_id,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('track.view', $data);
	}

	public function add($release_id) {

		$release = Release::find($release_id);

		$track = new Track;
		$track->release = $release;
		$track->track_album_id = $release->release_album_id;

		$last_disc_num = Track::where('track_release_id', '=', $release_id)->max('track_disc_num');
		if (empty($last_disc_num)) {
			$last_disc_num = 1;
		}

		$track->track_disc_num = $last_disc_num;

		$last_track_num = Track::where('track_release_id', '=', $release_id)->max('track_track_num');
		if (empty($last_track_num)) {
			$last_track_num = 1;
		}

		$track->track_track_num = $last_track_num + 1;

		$songs = $this->build_song_options();

		$recordings = $this->build_recording_options();

		$method_variables = array(
			'track' => $track,
			'songs' => $songs,
			'recordings' => $recordings,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('track.add', $data);
	}

	public function edit($track_id) {

		$track = Track::find($track_id);

		$songs = $this->build_song_options();

		$recordings = $this->build_recording_options();

		$method_variables = array(
			'track' => $track,
			'songs' => $songs,
			'recordings' => $recordings,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('track.edit', $data);
	}

	private function build_song_options() {
		$songs = Song::where('song_primary_artist_id', '=', $track->release->album->artist->artist_id)->orderBy('song_title')->lists('song_title', 'song_id');
		$songs = array(0 => '&nbsp;') + $songs;
		return $songs;
	}

	private function build_recording_options() {
		$recording_songs = Recording::with('song')->where('recording_artist_id', '=', $track->release->album->artist->artist_id)->orderBy('recording_isrc_num')->get();
		$recordings = $recording_songs->lists('recording_isrc_num', 'recording_id');
		foreach ($recordings as $r => $recording) {
			$recordings[$r] = empty($recording) ? 'ISRC no. not set' : $recording;
			$recordings[$r] .= ' (' . $recording_songs->find($r)->song->song_title . ')';
		}
		$recordings = array(0 => '&nbsp;') + $recordings;
		return $recordings;
	}

	public function delete($track_id) {

		$track = Track::find($track_id);

		$method_variables = array(
			'track' => $track,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('track.delete', $data);
	}

	public function save_order($release_id) {
		$tracks = Input::get('tracks');

		$is_success = true;
		if (count($tracks) > 0) {
			foreach ($tracks as $track) {
				if (false === $this->_update_track($track['track_id'], $track)) {
					$is_success = false;
					$error = 'Track order was not saved. Check disc ' . $track['track_disc_num'] . ', track ' . $track['track_track_num'] . '.';
					break;
				}
			}
		}

		echo ($is_success == true) ? 'Track order has been saved.' : $error;
	}

	private function _update_track($track_id, $input) {
		$track = Track::find($track_id);

		$track->track_disc_num = $input['track_disc_num'];
		$track->track_track_num = $input['track_track_num'];

		return $track->save();
	}

	public function update(Track $track = null) {

		if (empty($track)) {
			$track = new Track;
		}

		$fields = $track->getFillable();

		foreach ($fields as $field) {
			$value = Input::get($field);
			if (!empty($value)) {
				$track->{$field} = $value;
			}
		}

		$result = $track->save();

		if ($result !== false) {
			return Redirect::route('track.view', array('id' => $track->track_id))->with('message', 'Your changes were saved.');
		} else {
			return Redirect::route('release.view', array('id' => $track->track_release_id))->with('error', 'Your changes were not saved.');
		}
	}

	public function remove(Track $track) {

		$confirm = (boolean) Input::get('confirm');
		$track_song_title = $track->song->song_title;
		$release_id = $track->track_release_id;

		if ($confirm === true) {
			$track->delete();
			return Redirect::route('release.view', array('id' => $release_id  ))->with('message', $track_song_title . ' was deleted.');
		} else {
			return Redirect::route('track.view', array('id' => $track->track_id))->with('error', $track_song_title . ' was not deleted.');
		}
	}
}