@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{ $task->name }}</h3>

            @include('tasks.partials.header-controls')

            <div class="crumbs">
                <span class="crumb">
                    <a href="{{ route('project.show', $project->id) }}">Project</a>
                </span>
                <span class="crumb crumb--active">
                    <span class="crumb--active__text">Task</span>
                </span>
            </div>
        </div>
    </div>

    @include('discussions.partials.add-discussion-modal')
    @include('subtasks.partials.add-subtask-modal')

    <div class="container">

        @if($task->isCompleted())
            @include('layouts.partials.completed-overlay')
        @else
            @include('tasks.partials.task-wrapper')
        @endif

    </div>

@endsection

@section('js')
    <script>
        taskModule.init();
    </script>
@endsection