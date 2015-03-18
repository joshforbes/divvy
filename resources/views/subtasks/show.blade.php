@extends('layouts.app')

@section('content')

    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></li>
            <li><a href="{{ route('task.show', [$project->id, $task->id]) }}">{{ $task->name }}</a></li>
        </ol>

        <div class="subtask-wrapper">
            @include('subtasks.partials.subtask')
        </div>

        <div class="comment-form-wrapper">
            {!! Form::open(['route' => ['comment.storeSubtask', $subtask->id], 'class' => 'comment-form']) !!}
                {!! Form::textarea('body', null, ['class' => 'comment-form__input', 'placeholder' => 'Add a comment']) !!}
                {!! Form::submit('Add', ['class' => 'comment-form__button']) !!}
            {!! Form::close() !!}
        </div>

        <div class="comments-wrapper">
            @foreach($comments as $comment)
                @include('comments.partials.comment')
            @endforeach
        </div>

    </div>


@endsection