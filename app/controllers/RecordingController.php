<?php
/**
 * Created by PhpStorm.
 * User: gbueno
 * Date: 5/28/14
 * Time: 2:59 PM
 */

class RecordingController {

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

	public function view($___id) {

		$method_variables = array(
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('___.view', $data);
	}

	public function add($___id = null) {

		$method_variables = array(
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('___.add', $data);
	}

	public function edit($___id = null) {

		$method_variables = array(
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('___.edit', $data);
	}

	public function delete($___id) {

		$method_variables = array(
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('___.delete', $data);
	}

	public function update(Model $___ = null) {

		if (empty($___)) {
		}

		$fields = $___->getFillable();

		foreach ($fields as $field) {
			$value = Input::get($field);
			if (!empty($value)) {
				$___->{$field} = $value;
			}
		}

		$result = $___->save();

		if ($result !== false) {
			return Redirect::route('___.view', array('id' => $___->id))->with('message', 'Your changes were saved.');
		} else {
			return Redirect::route('___.browse')->with('error', 'Your changes were not saved.');
		}
	}

	public function remove(Model $___) {

		$confirm = (boolean) Input::get('confirm');
		$album_title = $___->album_title;
		$artist_id = $___->album_artist_id;

		if ($confirm === true) {
			$___->delete();
			return Redirect::route('___.view', array('id' => $___id  ))->with('message', 'The record was deleted.');
		} else {
			return Redirect::route('___.view', array('id' => $___->id))->with('error', 'The record was not deleted.');
		}
	}
}