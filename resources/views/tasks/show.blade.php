@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></li>
    </ol>

    <div class="container">
        <div class="task-show-wrapper">
            <div class="task-show">
                @include('tasks.partials.task', ['showDescription' => 'true'])
            </div>
        </div>
    </div>

@endsection