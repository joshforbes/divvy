<?php namespace App\Presenters;

use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\Presenter;

class ActivityPresenter extends Presenter {

    public function username()
    {
//        if (Auth::user()->username === $this->user->username)
//        {
//            return 'You';
//        }

        return $this->user->username;
    }

}