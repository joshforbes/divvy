<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	/**
	 * A User has one Profile
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
	public function profile()
	{
		return $this->hasOne('App\Profile');
	}

	/**
	 * A User has many Projects
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function projects()
	{
		return $this->belongsToMany('App\Project');
	}

	/**
	 * A User can be the admin of many Projects
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function adminProjects()
	{
		return $this->belongsToMany('App\Project', 'project_adminUser');
	}

	/**
	 * Determine if the given user is the same
	 * as the current one.
	 *
	 * @param  $user
	 * @return bool
	 */
	public function is($user)
	{
		if (is_null($user)) return false;
		return $this->username == $user->username;
	}


}
