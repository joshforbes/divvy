@extends('layouts.app')

@section('css')
    <link href="/css/vendor/select2.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <h1>{{ $project->name }}</h1>

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

        <br/><br/><br/>

        <div class="row">
            <div class="tasks-container col-md-6">
                @if($project->tasks)

                    <h2>Tasks:</h2>
                    <ul class="list-group">
                        @foreach($project->tasks as $task)
                            <li class="list-group-item">
                                {{ $task->name }}
                                @if($task->users)
                                    @foreach($task->users as $user)
                                        {!! $user->profile->present()->avatarHtml('30px') !!}
                                    @endforeach
                                @endif<br/>
                                {{ $task->description }} <br/>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="col-md-6">
                <h2>Add Task:</h2>

                {!! Form::open(['route' => ['task.store', $project->id]]) !!}

                <!-- Task Name Form Input -->
                <div class="form-group">
                    {!! Form::label('name', 'Task Name: ') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <!-- Description Form Input -->
                <div class="form-group">
                    {!! Form::label('description', 'Description: ') !!}
                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group select-members">
                    {!! Form::select('members[]', $members, null, ['class' => 'js-member-list', 'multiple']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>


        <br/><br/><br/>

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