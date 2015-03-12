@extends('layouts.app')

@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></li>
            <li><a href="{{ route('task.show', [$project->id, $task->id]) }}">{{ $task->name }}</a></li>
        </ol>

        <div class="discussion-wrapper">
            @include('discussions.partials.discussion')
        </div>
    </div>


@endsection
