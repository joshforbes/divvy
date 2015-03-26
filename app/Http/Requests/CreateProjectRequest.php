<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Auth\Guard;

class CreateProjectRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @param Guard $auth
	 * @return bool
	 */
	public function authorize(Guard $auth)
	{
		return $auth->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required'
		];
	}

}
