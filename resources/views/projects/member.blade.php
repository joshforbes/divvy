@extends('layouts.app')

@section('content')
    <div class="container">

        <h1>{{ $project->name }}</h1>
        <br/>

        <div class="row">
            <div class="tasks-container col-md-6">
                @if(Auth::user()->tasks)

                    <h2>Your Tasks:</h2>
                    <ul class="list-group">
                        @foreach(Auth::user()->tasks as $task)
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
@endsection