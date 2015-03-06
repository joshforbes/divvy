<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model {

	/**
	 * The attributes that can be mass assigned
	 *
	 * @var array
     */
	protected $fillable = ['name', 'isCompleted', 'task_id'];

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
	 * Create a new instance of subtask
	 *
	 * @param array $attributes
	 * @return static
     */
	public static function add(array $attributes)
	{
		return new static($attributes);
	}

}
