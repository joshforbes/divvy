<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;

class ProfilesController extends Controller {

	/**
	 * Display the specified resource.
	 *
	 * @param $username
	 * @return Response
	 * @internal param int $id
	 */
	public function show($username)
	{
		$user = User::with('profile')->whereUsername($username)->firstOrFail();
		return view('profiles.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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

}
