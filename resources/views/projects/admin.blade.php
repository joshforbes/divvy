@extends('layouts.app')

@section('css')
    <link href="/css/vendor/select2.css" rel="stylesheet"/>
@endsection

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

        <div class="activity-log-wrapper">
            <div class="activity-log">
                <span class="activity-log__header">Latest Project Activity:</span>
                @foreach($project->activity->take(3 ) as $activity)
                <p>{{ $activity->created_at->diffForHumans() }} - {!! $activity->body !!}</p>

                @endforeach
            </div>
        </div>

        @if($project->tasks)
            <div class="tasks-header">
                <span class="tasks-header__task-count">{{ count($project->tasks) }} Tasks</span>
                <a class="tasks-header__add-task" href="{{ route('task.create', $project->id) }}">+ Task</a>
            </div>

            <div class="tasks">
                @foreach($project->tasks as $task)
                    <div class="task-wrapper">

                        @include('tasks.partials.task')

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
    <script src="/js/vendor/select2.js"></script>
    <script>
        $("#usersList").select2({
            tags: true,
            placeholder: 'Pick a User or enter an email address'
        });

        $(".task__header__delete-link").click(function() {
            $(this).parent(".task__header__delete-form").submit();
        });

        $(".task__subtask__complete-form").on("change", "input:checkbox", function(){
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