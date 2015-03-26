<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class AddUserToProjectRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$projectId = $this->route('projectId');
		return Auth::user()->isAdmin($projectId);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'user' => 'required|email'
		];
	}

}
