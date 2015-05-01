@extends('layouts.app')

@section('content')

    <div class="header">
        <div class="container">
            <h3 class="header__title">Subtask</h3>

            <div class="header__controls">
                @if(!$subtask->isCompleted())
                    {!! Form::open(['route' => ['subtask.complete', $project->id, $task->id, $subtask->id]])!!}
                    <button class="header__button">
                        <i class="fa fa-file-o"></i>Complete
                    </button>
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['route' => ['subtask.incomplete', $project->id, $task->id, $subtask->id]])!!}
                    <button class="header__button">
                        <i class="fa fa-file-o"></i>Reopen
                    </button>
                    {!! Form::close() !!}
                @endif

                <div class="header__icon-wrapper">
                    {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['subtask.destroy', $project->id, $task->id, $subtask->id]]) !!}
                    <button class="header__icon"><i class="fa fa-trash-o"></i></button>
                    {!! Form::close() !!}

                    <button class="header__icon" data-toggle="modal" data-target=".edit-subtask-modal">
                        <i class="fa fa-pencil-square-o"></i>
                    </button>
                </div>

            </div>

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


        <div class="subtask-wrapper">

            @include('subtasks.partials.subtask')

            @include('comments.partials.comments')

            <div class="comments__form-wrapper hide">
                {!! Form::open(['data-remote', 'route' => ['comment.storeSubtask', $project->id, $task->id, $subtask->id], 'class' => 'comments__form']) !!}
                {!! Form::textarea('body', null, ['class' => 'comments__form__input', 'placeholder' => 'Add a comment']) !!}
                <button class="comments__form__button">Submit</button>
                {!! Form::close() !!}
            </div>

            <div class="comments__new-link"><i class="fa fa-pencil"></i>Enter a new comment</div>

        </div>

    </div>

    @include('subtasks.partials.edit-subtask-modal')


@endsection

@section('js')
    <script>
        subtaskModule.init();
        commentModule.init();
    </script>
@endsection

