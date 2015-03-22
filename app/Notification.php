<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {

    protected $fillable = ['action', 'subject_type', 'subject_id', 'user_id', 'actor_id'];

    /**
     * An Notification belongs to one user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * An Notification belongs to one actor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function actor()
    {
        return $this->belongsTo('App\User', 'actor_id');
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
     * Create a new instance of Notification
     *
     * @param array $attributes
     * @return static
     */
    public static function notify(array $attributes)
    {
        return new static($attributes);
    }

}
