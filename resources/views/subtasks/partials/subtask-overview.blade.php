<td class="subtasks__name"><a href="{{ route('subtask.show', [$project->id, $task->id, $subtask->id]) }}">{{$subtask->name}}</a></td>

<td class="subtasks__controls-wrapper">
    <div class="subtasks__controls">
        @if($subtask->comments->count() > 0)
            <div class="subtasks__controls__comments">
                <i class="fa fa-comments-o"></i>
                <span class="subtasks__controls__comments-count">{{ $subtask->comments->count() }}</span>
            </div>
        @endif
        <button class="subtasks__controls__icon" data-toggle="modal" data-target={{"#" . $subtask->id . "-modal"}}>
            <i class="fa fa-pencil-square-o"></i>
        </button>

        {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['subtask.destroy', $project->id, $task->id, $subtask->id]]) !!}
        <button class="subtasks__controls__icon"><i class="fa fa-trash-o"></i></button>
        {!! Form::close() !!}


        @if(!$subtask->isCompleted())
            {!! Form::open(['route' => ['subtask.complete', $project->id, $task->id, $subtask->id]])!!}
            <button class="subtasks__controls__button">
                <i class="fa fa-file-o"></i>Complete
            </button>
            {!! Form::close() !!}
        @else
            {!! Form::open(['route' => ['subtask.incomplete', $project->id, $task->id, $subtask->id]])!!}
            <button class="subtasks__controls__button">
                <i class="fa fa-file-o"></i>Reopen
            </button>
            {!! Form::close() !!}
        @endif

    </div>
</td>