@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('task.show', [$project->id, $task->id]) }}">{{ $task->name }}</a></li>
    </ol>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-3">
                <div class="page-header">{{  $subtask->name }}</div>
            </div>
        </div>
    </div>

@endsection