<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $fillable = ['title', 'description'];

	/**
	 * A Project has many Users
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function users()
	{
		return $this->belongsToMany('App\User');
	}

	/**
	 * A Project can have many Admins
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
	public function adminUsers()
	{
		return $this->belongsToMany('App\User', 'project_adminUser');
	}

}
