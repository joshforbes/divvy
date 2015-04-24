<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subtask extends Model {

	use SoftDeletes;

	/**
	 * The attributes that can be mass assigned
	 *
	 * @var array
     */
	protected $fillable = ['name', 'is_complete', 'task_id'];


	/**
	 * On soft delete cascade to comments
	 */
	public static function boot()
	{
		parent::boot();

		static::deleted(function($subtask)
		{
			foreach($subtask->comments() as $comment)
			{
				$comment->delete();
			}
		});
	}

	/**
	 * A Subtask belongs to one task
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
	public function task()
	{
		return $this->belongsTo('App\Task');
	}

	/**
	 * Subtask to Task relationship with soft deleted models
	 *
	 * @return mixed
     */
	public function taskWithTrashed()
	{
		return $this->belongsTo('App\Task', 'task_id')->withTrashed();
	}

	/**
	 * A subtask can have many comments
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
	public function comments()
	{
		return $this->morphMany('App\Comment', 'commentable');
	}

	/**
	 * Create a new instance of subtask
	 *
	 * @param array $attributes
	 * @return static
     */
	public static function add(array $attributes)
	{
		return new static($attributes);
	}


	/**
	 * Returns a boolean based on whether the subtask is completed
	 *
	 * @return mixed
     */
	public function isCompleted()
	{
		return $this->is_complete;
	}


}
