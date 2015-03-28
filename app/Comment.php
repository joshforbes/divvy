<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

    use SoftDeletes;

    /**
     * The fields that can be mass assigned
     *
     * @var array
     */
    protected $fillable = ['body', 'user_id'];


    /**
     * A comment belongs to many polymorphic relationships (discussions, subtasks)
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * polymorphic relationship with soft deleted models included
     *
     * @return $this
     */
    public function commentableWithTrashed()
    {
        return $this->morphTo('commentable')->withTrashed();
    }


    /**
     * A comment belongs to one author
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');

    }


    /**
     * Leave a new comment on a commentable object
     *
     * @param $owner
     * @param array $attributes
     * @return mixed
     */
    public static function leaveOn($owner, array $attributes)
    {
        return $owner->comments()->create($attributes);
    }

}
