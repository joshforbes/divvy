@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="project-header">

            <div class="project-header__title">
                <h1 class="project-header__name">{{ $project->name }}</h1>
                <p class="project-header__description">{{ $project->description }}</p>
            </div>

            <div class="project-header__summary">
                <span class="project-header__member-count">{{ count($project->users) }}<br/>Members</span>
            </div>

        </div>

        @if(isset($currentUserTasks))
            <div class="tasks-header">
                <span class="tasks-header__task-count">{{ count($currentUserTasks) }} Tasks</span>
            </div>

            <div class="tasks">
                @foreach($currentUserTasks as $task)
                    <div class="task-wrapper">

                        @include('tasks.partials.task')

                    </div>
                @endforeach
            </div>
        @endif


        <div class="members-container">
            <p>Members:
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
    <script>

        $(".task__header__delete-link").click(function() {
            $(this).parent(".task__header__delete-form").submit();
        });

        $(".task__header__complete-link").click(function() {
            $(this).parent(".task__header__complete-form").submit();
        });

        $(".task__subtask__complete-form").on("change", "input:checkbox", function() {
            $(this).parent(".task__subtask__complete-form").submit();
        });

        $(".task__add-button").click(function() {
            $(this).siblings(".task__discussion-form").removeClass("hide");
        });

        $(".task__discussion__edit-button").click(function() {
            $(this).siblings(".task__discussion-edit-form").removeClass("hide");
        });

        $(".discussion-form__button--cancel").click(function() {
            $(this).closest(".task__discussion-form").addClass("hide");
            $(this).closest(".task__discussion-edit-form").addClass("hide");
        });

        $(".task__subtask__edit-button").click(function() {
            $(this).closest(".task__subtask__controls-wrapper").addClass("hide");
            $(this).parent().siblings().removeClass("hide");
        });

        $(".subtask-form__button--cancel").click(function(e) {
            e.preventDefault();
            $(".task__subtask__controls-wrapper").removeClass("hide");
            $(".subtask-form").addClass("hide");
        });

    </script>
@endsection