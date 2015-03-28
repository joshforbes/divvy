<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discussion extends Model {

	use SoftDeletes;

	protected $fillable = ['title', 'body', 'task_id', 'user_id'];

	/**
	 * On soft delete cascade to comments
     */
	public static function boot()
	{
		parent::boot();

		static::deleted(function($discussion)
		{
			foreach($discussion->comments() as $comment)
			{
				$comment->delete();
			}
		});
	}

	/**
	 * A Discussion belongs to one task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function task()
	{
		return $this->belongsTo('App\Task');
	}

	/**
	 * Discussion to task relationship with soft deleted models included
	 *
	 * @return mixed
     */
	public function taskWithTrashed()
	{
		return $this->belongsTo('App\Task', 'task_id')->withTrashed();
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
