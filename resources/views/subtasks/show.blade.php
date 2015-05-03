@extends('layouts.app')

@section('content')

    <div class="header">
        <div class="container">
            <h3 class="header__title">Subtask</h3>

            @include('subtasks.partials.header-controls')

            <div class="crumbs">
                <span class="crumb">
                    <a href="{{ route('project.show', $project->id) }}">Project</a>
                </span>
                <span class="crumb">
                    <a href="{{ route('task.show', [$project->id, $task->id]) }}">Task</a>
                </span>
                <span class="crumb crumb--active">
                    <span class="crumb--active__text">Subtask</span>
                </span>
            </div>

        </div>
    </div>

    <div class="container">

        @if($subtask->isCompleted())
            @include('layouts.partials.completed-overlay')
        @else
            @include('subtasks.partials.subtask-wrapper')
        @endif

    </div>

    @include('subtasks.partials.edit-subtask-modal')


@endsection

@section('js')
    <script>
        subtaskModule.init();
        commentModule.init();
    </script>
@endsection

