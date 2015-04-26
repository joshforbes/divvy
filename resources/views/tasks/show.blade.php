@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{ $task->name }}</h3>

            <div class="header__controls">
                <button class="header__button" data-toggle="modal" data-target=".add-subtask-modal">
                    + Subtask
                </button>
                <button class="header__button" data-toggle="modal" data-target=".add-discussion-modal">
                    + Discussion
                </button>
            </div>

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

        <div class="information-wrapper">

            <div class="activity-log-wrapper">
                @include('activity.partials.task-activity-log')
            </div>

            <div class="members-wrapper">
                @include('users.partials.task-members')
            </div>

            <div class="task-progress-wrapper">
                @include('tasks.partials.task-progress')
            </div>

        </div>

        @include('subtasks.partials.subtasks')

        @include('discussions.partials.discussions')

    </div>

@endsection

@section('js')
    <script>
        taskModule.init();
    </script>
@endsection