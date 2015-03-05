@extends('layouts.app')

@section('css')
    <link href="/css/vendor/select2.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="page-header">
            <h1>{{ $project->name }}</h1>
        </div>

        @if($project->tasks)
            <div class="row">
                <div class="tasks-container col-md-12">
                    <h2>Tasks:</h2>

                    <p><a href="{{ route('task.create', $project->id) }}">Add a Task</a></p>

                    @foreach($project->tasks as $task)
                        <div class="col-md-6">
                            <div class="task-container">
                                <div class="task-container__header">
                                    <a href="{{ route('task.show', [$project->id, $task->id]) }}">
                                        <h4>{{ $task->name }}</h4></a>

                                    <div class="task-container__header__edit-link">
                                        <a href="{{ route('task.edit', [$project->id, $task->id]) }}">edit</a>
                                    </div>
                                </div>

                                <div class="task-container__body">

                                    {!! Form::open(['class' => 'form-inline', 'route' => ['subtask.store', $project->id, $task->id]]) !!}
                                    <div class="form-group">
                                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'What needs to be done?']) !!}
                                    </div>
                                    {!! Form::submit('Add', ['class' => 'btn btn-default']) !!}
                                    {!! Form::close() !!}

                                    <div class="task-container__body__subtasks">
                                        @if($task->subtasks)
                                            <ul>
                                                @foreach($task->subtasks as $subtask)
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
                    @endforeach

                </div>

            </div>
        @endif


        <br/><br/><br/>

        <div class="row">
            {!! Form::open(['route' => ['project.addUser', $project->id]]) !!}

            <div class="input-group">
                <select name="user" class="js-user-list" id="usersList" data-placeholder="Add a User to Project">
                    <option></option>
                    @foreach ( $users as $email => $username )
                        <option value="{{$email}}">{{$username}}</option>
                    @endforeach
                </select>
                {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>

        <div class="members-container">
            <p>Admins:
                @foreach($project->admins as $admin)
                    <a href="{!! route('profile.show', $admin->username) !!}">
                        {!! $admin->profile->present()->avatarHtml('40px') !!}
                    </a>
                @endforeach
            </p>


            <p>Users:
                @foreach($project->users as $user)
                    <a href="{!! route('profile.show', $user->username) !!}">
                        {!! $user->profile->present()->avatarHtml('40px') !!}
                    </a>
                @endforeach
            </p>
        </div>


    </div>

@endsection

@section('js')
    <script src="/js/vendor/select2.js"></script>
    <script>
        $(".js-member-list").select2({
            placeholder: 'Assign the Task?'
        });

        $("#usersList").select2({
            tags: true,
            placeholder: 'Pick a User or enter an email address'
        });
    </script>
@endsection