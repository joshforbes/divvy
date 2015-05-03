<div class="header__controls">
    @if(!$subtask->isCompleted())
        {!! Form::open(['data-remote', 'route' => ['subtask.complete', $project->id, $task->id, $subtask->id]])!!}
        <button class="header__button">
            <i class="fa fa-file-o"></i>Complete
        </button>
        {!! Form::close() !!}

        <div class="header__icon-wrapper">
            {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['subtask.destroy', $project->id, $task->id, $subtask->id]]) !!}
            <button class="header__icon"><i class="fa fa-trash-o"></i></button>
            {!! Form::close() !!}

            <button class="header__icon" data-toggle="modal" data-target=".edit-subtask-modal">
                <i class="fa fa-pencil-square-o"></i>
            </button>
        </div>
    @else
        {!! Form::open(['data-remote', 'route' => ['subtask.incomplete', $project->id, $task->id, $subtask->id]])!!}
        <button class="header__button">
            <i class="fa fa-file-o"></i>Reopen
        </button>
        {!! Form::close() !!}
    @endif

</div>