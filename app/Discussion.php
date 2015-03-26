<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model {

	use SoftDeletes;

	protected $fillable = ['title', 'body', 'task_id', 'user_id'];

	/**
	 * A Discussion belongs to one task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function task()
	{
		return $this->belongsTo('App\Task');
	}

	public function trashedTask()
	{
		return $this->belongsTo('App\Task')->withTrashed();
	}

	/**
	 * A Discussion belongs to one user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function author()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	/**
	 * A discussion can have many comments
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
	public function comments()
	{
		return $this->morphMany('App\Comment', 'commentable');
	}

	/**
	 * Start a new Discussion
	 *
	 * @param array $attributes
	 * @return static
     */
	public static function start(array $attributes)
	{
		return new static($attributes);
	}

}
