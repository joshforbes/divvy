<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class EditProfileRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (is_null($this->user()))
        {
            return false;
        }

        return $this->route('username') == Auth::user()->username;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

}
