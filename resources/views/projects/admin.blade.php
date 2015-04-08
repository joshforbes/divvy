@extends('layouts.app')

@section('css')
    <link href="/css/vendor/select2.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{ $project->name }}</h3>

            <div class="header__controls">
                <button class="header__button" data-toggle="modal" data-target=".add-task-modal">
                    + Task
                </button>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="information-wrapper">

            <div class="activity-log-wrapper">
                @include('activity.partials.activity-log')
            </div>

            <div class="members-wrapper">
                @include('users.partials.project-members')
            </div>

            <div class="task-progress-wrapper">
                @include('projects.partials.project-progress')
            </div>

        </div>

        @if($project->tasks)
            <div class="tasks">
                @foreach($project->tasks as $task)
                    @include('tasks.partials.task-overview-wrapper')
                @endforeach
            </div>
        @endif

    </div>


    @include('tasks.partials.add-task-modal')


@endsection

@section('js')
    <script src="/js/vendor/select2.js"></script>
    <script>
        $(".task-form__member-select").select2();
    </script>
@endsection