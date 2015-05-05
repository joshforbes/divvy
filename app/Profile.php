<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Laracasts\Presenter\PresentableTrait;

class Profile extends Model {

    use PresentableTrait;

    protected $presenter = 'App\Presenters\ProfilePresenter';

    /**
     * The profile fields that a mass assignable
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'company', 'location', 'bio', 'avatar_path'];

    /**
     * A profile belongs to one User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Creates a new blank profile for association with a new user
     *
     * @return static
     */
    public static function forNewUser()
    {
        return new static;
    }


}
