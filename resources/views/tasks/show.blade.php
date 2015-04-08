@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{ $task->name }}</h3>

            <div class="header__controls">
                <button class="header__button" data-toggle="modal" data-target=".add-subtask-modal">
                    + Subtask
                </button>
                <button class="header__button" data-toggle="modal" data-target=".add-subtask-modal">
                    + Discussion
                </button>
            </div>
            <ol class="breadcrumb">
                <li><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></li>
            </ol>
        </div>
    </div>



    <div class="container">

        <div class="information-wrapper">

            <div class="discussions-wrapper">
                <div class="discussions">
                    <div class="discussions__header">
                        <div class="discussions__title">
                            Discussions
                        </div>
                    </div>
                    <div class="discussions__body">

                    </div>
                </div>
            </div>

            <div class="members-wrapper">
                @include('users.partials.task-members')
            </div>

            <div class="task-progress-wrapper">
                @include('tasks.partials.task-progress')
            </div>

        </div>


        <div class="subtasks">
            <div class="subtasks__header">
                <div class="subtasks__title">
                    Subtasks
                </div>
            </div>
        </div>


        <div class="task-show-wrapper">
            <div class="task-show">
                @include('tasks.partials.task', ['showDescription' => 'true'])
            </div>
        </div>
    </div>

@endsection