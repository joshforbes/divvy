<div class="task">

    <div class="task__header">
        <a class="task__header__title" href="{{ route('task.show', [$project->id, $task->id]) }}">{{ $task->name }}</a>
        <a class="task__header__edit-link" href="{{ route('task.edit', [$project->id, $task->id]) }}">edit</a>
    </div>

    @if(isset($showDescription))
        <p class="task__description">{{ $task->description }}</p>
    @endif

    {!! Form::open(['class' => 'task__add-form', 'route' => ['subtask.store', $project->id, $task->id]]) !!}
        {!! Form::text('name', null, ['class' => 'task__add-form__input', 'placeholder' => 'What needs to be done?']) !!}
        {!! Form::submit('Add', ['class' => 'task__add-form__button']) !!}
    {!! Form::close() !!}

    @if($task->subtasks)
        <ul class="task__subtasks-wrapper">
            @foreach($task->subtasks as $subtask)
                @if($subtask->isCompleted === '0')
                <li class="task__subtask">
                    <input class="task__subtask__checkbox" type="checkbox"/>
                    <a class ="task__subtask__link" href="{{ route('subtask.show', [$project->id, $task->id, $subtask->id]) }}">{{ $subtask->name }}</a>
                    {!! Form::open(['class' => 'task__subtask__complete-form', 'route' => ['subtask.complete', $project->id, $task->id, $subtask->id]]) !!}
                        {!! Form::submit('Complete', ['class' => 'task__subtask__complete']) !!}
                    {!! Form::close() !!}
                    {!! Form::open(['class' => 'task__subtask__delete-form', 'method' => 'DELETE', 'route' => ['subtask.destroy', $project->id, $task->id, $subtask->id]]) !!}
                        {!! Form::submit('Delete', ['class' => 'task__subtask__delete']) !!}
                    {!! Form::close() !!}
                </li>
                @endif
            @endforeach

            @foreach($task->subtasks as $subtask)
                @if($subtask->isCompleted === '1')
                    <li class="task__subtask task__subtask--completed">
                        <input class="task__subtask__checkbox" type="checkbox"/>
                        <a class ="task__subtask__link" href="{{ route('subtask.show', [$project->id, $task->id, $subtask->id]) }}">{{ $subtask->name }}</a>
                        {!! Form::open(['class' => 'task__subtask__complete-form', 'route' => ['subtask.notComplete', $project->id, $task->id, $subtask->id]]) !!}
                        {!! Form::submit('Not Complete', ['class' => 'task__subtask__complete']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['class' => 'task__subtask__delete-form', 'method' => 'DELETE', 'route' => ['subtask.destroy', $project->id, $task->id, $subtask->id]]) !!}
                        {!! Form::submit('Delete', ['class' => 'task__subtask__delete']) !!}
                        {!! Form::close() !!}
                    </li>
                @endif
            @endforeach

        </ul>
    @endif

    <button class="task__add-button">Start a New Discussion</button>

    @include('discussions.partials.form')


@if($task->discussions)
        <ul class="task__discussions-wrapper">
            @foreach($task->discussions as $discussion)
                <li class="task__discussion">
                    <span class="task__discussion__avatar">{!! $discussion->author->profile->present()->avatarHtml('30px') !!}</span>
                    <a class="task__discussion__title" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{{ $discussion->title }}</a>
                    <span class="task__discussion__date">{{ $discussion->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    @if($task->users)
        <div class="task__users">
            @foreach($task->users as $user)
                <span class="task__user">{!! $user->profile->present()->avatarHtml('30px') !!}</span>
            @endforeach
        </div>
    @endif

</div>