<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

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
        return $this->morphTo();
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
