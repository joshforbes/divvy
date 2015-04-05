@if($task->isCompleted())
    @include('tasks.partials.task-complete')
@endif

<div class="task-overview">
    <div class="task-overview__header">
        <div class="task-overview__title">
            <a href="{{ route('task.show', [$project->id, $task->id]) }}">{{$task->name}}</a>
        </div>

        @if(!$task->isCompleted())
            <button class="task-overview__settings-button"><i class="fa fa-gear"></i></button>
        @endif

        <div class="task-overview__settings-overlay hide">
            <button class="task-overview__settings-close"><i class="fa fa-times"></i></button>
            <div class="task-overview__settings">
                @if($task->isCompletable() && !$task->isCompleted())
                    {!! Form::open(['data-remote', 'route' => ['task.complete', $project->id, $task->id]])!!}
                    <button class="task-overview__setting">
                        <i class="fa fa-file-o"></i>Complete
                    </button>
                    {!! Form::close() !!}
                @endif
            </div>
        </div>

    </div>

    <div class="task-overview__body">
        <p class="task-overview__description">{{$task->description}}</p>

        <div class="task-overview__information-wrapper">
            <span class="task-overview__information-label"><i class="fa fa-tasks"></i> Subtasks</span>
            <span class="task-overview__information">7</span>
        </div>

        <div class="task-overview__information-wrapper">
            <span class="task-overview__information-label"><i class="fa fa-comments"></i> Discussions</span>
            <span class="task-overview__information">4</span>
        </div>

        <div class="task-overview__information-wrapper task-overview__information-wrapper--last">
            <span class="task-overview__information-label"><i class="fa fa-users"></i> Members</span>
            <span class="task-overview__information">3</span>
        </div>

    </div>



    @if($task->users)
        <div class="task-overview__members">
            @foreach($task->users as $user)
                <span class="task-overview__member">{!! $user->profile->present()->avatarHtml('30px') !!}</span>
            @endforeach
        </div>
    @endif

</div>
