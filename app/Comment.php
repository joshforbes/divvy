<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

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

}
