<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterUserRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'username' => 'required|max:255|unique:users|alpha_num',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6',
		];
	}

}
