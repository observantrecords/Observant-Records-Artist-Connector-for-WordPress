<?php

class ArtistController extends \BaseController {

	private $layout_variables = array();

	public function __construct() {
		global $config_url_base;

		$this->layout_variables = array(
			'config_url_base' => $config_url_base,
		);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$artists = Artist::orderBy('artist_last_name')->get();

		$method_variables = array(
			'artists' => $artists,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.index', $data);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$artist = new Artist;

		$method_variables = array(
			'artist' => $artist,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.create', $data);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$artist = new Artist;

		$fields = $artist->getFillable();

		foreach ($fields as $field) {
			$artist->{$field} = Input::get($field);
		}

		$result = $artist->save();

		if ($result !== false) {
			return Redirect::route('artist.show', array('id' => $artist->artist_id))->with('message', 'Your changes were saved.');
		} else {
			return Redirect::route('artist.index')->with('error', 'Your changes were not saved.');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$method_variables = array(
			'artist' => $id,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.show', $data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$method_variables = array(
			'artist' => $id,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.edit', $data);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

		$fields = $id->getFillable();

		foreach ($fields as $field) {
			$id->{$field} = Input::get($field);
		}

		$result = $id->save();

		if ($result !== false) {
			return Redirect::route('artist.show', array('id' => $id->artist_id))->with('message', 'Your changes were saved.');
		} else {
			return Redirect::route('artist.index')->with('error', 'Your changes were not saved.');
		}
	}

	/**
	 * Show the form for deleting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id) {

		$method_variables = array(
			'artist' => $id,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('artist.delete', $data);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$confirm = (boolean) Input::get('confirm');
		$artist_display_name = $id->artist_display_name;

		if ($confirm === true) {
			$id->delete();
			return Redirect::route('artist.index')->with('message', $artist_display_name . ' was deleted.');
		} else {
			return Redirect::route('artist.show', array('id' => $id->artist_id))->with('error', $artist_display_name . ' was not deleted.');
		}
	}


}
