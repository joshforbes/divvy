<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Auth\Guard;

class ModifyCommentRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @param Guard $auth
	 * @return bool
	 */
	public function authorize(Guard $auth)
	{
		$projectId = $this->route('projectId');
		$commentId = $this->route('commentId');

		if ($auth->user()->isAdmin($projectId))
		{
			return true;
		}

		if ($auth->user()->isCommentAuthor($commentId))
		{
			return true;
		}

		return false;

	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'body' => 'required'
		];
	}

}
