@extends('layouts.app')

@section('css')
    <link href="/css/vendor/select2.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{ $project->name }}</h3>

            <div class="header__controls">
                <a class="tasks-header__add-task" href="{{ route('task.create', $project->id) }}">
                    <button class="header__button">+ Task</button>
                </a>
            </div>
        </div>

    </div>

    <div class="container">

        <div class="information-wrapper">

            <div class="activity-log-wrapper">
                @include('activity.partials.activity-log')
            </div>

            <div class="members-wrapper">
                @include('users.partials.members')
            </div>

            <div class="task-progress-wrapper">
                @include('tasks.partials.task-progress')
            </div>

        </div>

        @if($project->tasks)

            <div class="tasks">
                @foreach($project->tasks as $task)
                    <div class="task-wrapper">
                        @include('tasks.partials.task-overview')
                    </div>
                @endforeach
            </div>
        @endif

        <div class="row">
            {!! Form::open(['route' => ['project.addUser', $project->id]]) !!}

            <div class="input-group">
                <select name="user" class="js-user-list" id="usersList" data-placeholder="Add a User to Project">
                    <option></option>
                    @foreach ( $users as $email => $username )
                        <option value="{{$email}}">{{$username}}</option>
                    @endforeach
                </select>
                {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}
            </div>
            {!! Form::close() !!}
        </div>

    </div>




@endsection

@section('js')
    <script src="/js/vendor/select2.js"></script>
    <script>
        $("#usersList").select2({
            tags: true,
            placeholder: 'Pick a User or enter an email address'
        });

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