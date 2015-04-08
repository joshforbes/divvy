<?php namespace App\Presenters;

use Illuminate\Support\Facades\Auth;
use Laracasts\Presenter\Presenter;

class TaskPresenter extends Presenter {

    public function completionPercentage()
    {
        if ($this->subtasks->count() == 0)
        {
            return $percentage = 0;
        } else {
            return $percentage = round($this->completedSubtasks->count()/$this->subtasks->count() * 100);
        }
    }

}