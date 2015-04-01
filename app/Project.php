<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;

class Project extends Model {

	use SoftDeletes;
	use PresentableTrait;

	protected $presenter = 'App\Presenters\ProjectPresenter';


	protected $fillable = ['name', 'description'];

	/**
	 * On soft delete cascade to tasks, subtasks, discussions, and comments
	 */
	public static function boot()
	{
		parent::boot();

		static::deleted(function ($project)
		{
			foreach ($project->tasks as $task)
			{
				foreach ($task->subtasks as $subtask)
				{
					$subtask->comments()->delete();
					$subtask->delete();
				}

				foreach ($task->discussions as $discussion)
				{
					$discussion->comments()->delete();
					$discussion->delete();
				}
			}
		});
	}

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

	/**
	 * returns completed tasks
	 *
	 * @return mixed
     */
	public function completedTasks()
	{
		return $this->tasks()->where('is_complete', 1);
	}

}
