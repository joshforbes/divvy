@extends('layouts.app')

@section('content')
    <a href="{{ route('project.show', $task->project->id) }}">{{ $task->project->name }}</a>

    <div class="container">
        <div class="row">
            <div class="col-md-3 col-md-offset-4">
                <div class="page-header">{{  $task->name }}</div>
                <p>{{ $task->description }}</p>
                <ul class="list-group">
                    @foreach($task->users as $user)
                        <li style="color:black" class="list-group-item">{{ $user->username }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

@endsection