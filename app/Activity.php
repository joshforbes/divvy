<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

    protected $fillable = ['body', 'project_id'];

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
