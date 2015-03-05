<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtask extends Model {

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

	public static function add(array $attributes)
	{
		return new static($attributes);
	}

}
