<?php namespace App\Presenters;

use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\Presenter;

class ProjectPresenter extends Presenter {

    public function completionPercentage()
    {
        if ($this->tasks->count() == 0)
        {
            return $percentage = 0;
        } else {
            return $percentage = round($this->completedTasks->count()/$this->tasks->count() * 100);
        }
    }

}