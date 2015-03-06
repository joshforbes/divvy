<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model {

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
