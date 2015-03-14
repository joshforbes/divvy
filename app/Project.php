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
	public function admins()
	{
		return $this->belongsToMany('App\User', 'project_adminUser');
	}

	/**
	 * A Project has many tasks
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
	public function tasks()
	{
		return $this->hasMany('App\Task');
	}

	/**
	 * A Project has many Activities
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function activity()
	{
		return $this->hasMany('App\Activity')->orderBy('created_at', 'desc');
	}

	/**
	 * Start a new Project
	 *
	 * @param $name
	 * @param $description
	 * @return static
	 */
	public static function start($name, $description)
	{
		$project = new static([
			'name' => $name,
			'description' => $description
		]);

		return $project;
	}

}
