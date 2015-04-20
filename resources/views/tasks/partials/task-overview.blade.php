@if($task->isCompleted())
    @include('tasks.partials.task-complete')
@endif

<div class="task-overview">
    <div class="task-overview__header">
        <div class="task-overview__title">
            <a href="{{ route('task.show', [$project->id, $task->id]) }}">{{$task->name}}</a>
        </div>

        @if(Auth::user()->isAdmin($project->id))

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

                <button class="task-overview__setting" data-toggle="modal" data-target={{"#" . $task->id . "-modal"}}>
                    <i class="fa fa-edit"></i>Edit
                </button>

                {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['task.destroy', $project->id, $task->id]])!!}
                <button class="task-overview__setting">
                    <i class="fa fa-trash"></i>Delete
                </button>
                {!! Form::close() !!}
            </div>
        </div>
        @endif

    </div>

    <div class="task-overview__body">
        <a href="{{ route('task.show', [$project->id, $task->id]) }}">

        <p class="task-overview__description">{{$task->description}}</p>

        <div class="task-overview__information-wrapper">
            <span class="task-overview__information-label"><i class="fa fa-tasks"></i> Subtasks</span>
            <span class="task-overview__information">{{$task->subtasks->count()}}</span>
        </div>

        <div class="task-overview__information-wrapper">
            <span class="task-overview__information-label"><i class="fa fa-comments"></i> Discussions</span>
            <span class="task-overview__information">{{$task->discussions->count()}}</span>
        </div>

        <div class="task-overview__information-wrapper task-overview__information-wrapper--last">
            <span class="task-overview__information-label"><i class="fa fa-users"></i> Members</span>
            <span class="task-overview__information">{{$task->users->count()}}</span>
        </div>

        </a>
    </div>



    @if($task->users)
        <div class="task-overview__members">
            @foreach($task->users as $user)
                <span class="task-overview__member">
                    <a href="{{ route('activity.showTask', [$project->id, $task->id, $user->username]) }}">{!! $user->profile->present()->avatarHtml('40px') !!}</a>
                    <span class="member-tooltip">{{ $user->username }}</span>
                </span>
            @endforeach
        </div>
    @endif

</div>


