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
@endsection