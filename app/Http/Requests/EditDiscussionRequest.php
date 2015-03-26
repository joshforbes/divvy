<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Contracts\Auth\Guard;

class EditDiscussionRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @param Guard $auth
	 * @return bool
	 */
	public function authorize(Guard $auth)
	{
		$projectId = $this->route('projectId');
		$discussionId = $this->route('discussionId');

		if ($auth->user()->isAdmin($projectId))
		{
			return true;
		}

		if ($auth->user()->isDiscussionAuthor($discussionId))
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
			'title' => 'required'
		];
	}

}
