@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></li>
    </ol>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="task-container">
                    <div class="task-container__header">
                        <a href="{{ route('task.show', [$project->id, $task->id]) }}">
                            <h4>{{ $task->name }}</h4></a>

                        <div class="task-container__header__edit-link">
                            <a href="{{ route('task.edit', [$project->id, $task->id]) }}">edit</a>
                        </div>
                    </div>

                    <div class="task-container__body">
                        <p>{{ $task->description }}</p>

                        {!! Form::open(['class' => 'form-inline', 'route' => ['subtask.store', $project->id, $task->id]]) !!}
                        <div class="form-group">
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'What needs to be done?']) !!}
                        </div>
                        {!! Form::submit('Add', ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}

                        <div class="task-container__body__subtasks">
                            @if($subtasks)
                                <ul>
                                    @foreach($subtasks as $subtask)
                                        <li>
                                            {!! Form::open(['method' => 'DELETE', 'class' => 'form-inline', 'route' => ['subtask.destroy', $project->id, $task->id, $subtask->id]]) !!}
                                            <input type="checkbox"/>
                                            <a href="{{ route('subtask.show', [$project->id, $task->id, $subtask->id]) }}">{{ $subtask->name }}</a>
                                            {!! Form::submit('Delete', ['class' => 'btn btn-default btn-sm pull-right']) !!}
                                            {!! Form::close() !!}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        @if($task->users)
                            @foreach($task->users as $user)
                                {!! $user->profile->present()->avatarHtml('30px') !!}
                            @endforeach
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection