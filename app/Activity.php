<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Activity extends Model {

    use PresentableTrait;

    protected $presenter = 'App\Presenters\ActivityPresenter';


    protected $fillable = ['action', 'subject_type', 'subject_id', 'user_id', 'project_id'];

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

    public function task()
    {
        return $this->subject->task()->withTrashed()->first();
    }

    public function commentable()
    {
        return $this->subject->commentable()->withTrashed()->first();
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
