<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Activity extends Model {

    use PresentableTrait;

    protected $presenter = 'App\Presenters\ActivityPresenter';

    /**
     * The fields that can be mass assigned
     *
     * @var array
     */
    protected $fillable = ['action', 'subject_type', 'subject_id', 'user_id', 'project_id', 'task_id'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity';

    /**
     * An Activity belongs to one project
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    /**
     * An Activity belongs to one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the subject of the activity.
     *
     * @return mixed
     */
    public function subject()
    {
        return $this->morphTo()->withTrashed();
    }

    /**
     * Create a new instance of Activity
     *
     * @param array $attributes
     * @return static
     */
    public static function log(array $attributes)
    {
        return new static($attributes);
    }

}
