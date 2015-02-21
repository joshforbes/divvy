<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model {

	protected $fillable = ['name', 'description'];

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

	/**
	 * Start a new Project
	 *
	 * @param $name
	 * @return static
     */
	public static function start($name)
	{
		$project = new static([
			'name' => $name
		]);

		return $project;
	}

}
