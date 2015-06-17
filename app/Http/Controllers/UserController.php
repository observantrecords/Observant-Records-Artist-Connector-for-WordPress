<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
	private $layout_variables = array();

	public function __construct()
	{
		$this->layout_variables = array(
			'config_url_base' => config('global.url_base'),
		);
	}

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
		$users = User::orderBy('user_name')->get();

		$method_variables = array(
			'users' => $users,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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
			'user' => $id,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return view('user.show', $data);
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
			'user' => $id,
		);

		$data = array_merge($method_variables, $this->layout_variables);

		return View::make('user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

	/**
	 * Show the form for deleting the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{

	}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
