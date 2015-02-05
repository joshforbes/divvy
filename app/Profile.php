<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    protected $fillable = ['user_id', 'name', 'company', 'location', 'bio', 'avatar_path'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

}
