@extends('layouts.app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></li>
        <li><a href="{{ route('task.show', [$project->id, $task->id]) }}">{{ $task->name }}</a></li>
    </ol>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-3">
                <div class="page-header">{{  $subtask->name }}</div>
            </div>
        </div>

        <div class="comment-form-wrapper">
            {!! Form::open(['route' => ['comment.storeSubtask', $subtask->id], 'class' => 'comment-form']) !!}
            {!! Form::text('body', null, ['class' => 'comment-form__input', 'placeholder' => 'Enter a comment']) !!}
            {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
            {!! Form::close() !!}
        </div>

        <div class="comments-wrapper">
            @foreach($comments as $comment)

                <div class="comment">
                    {{ $comment->body }}
                    {{ $comment->author->username }}
                </div>

            @endforeach
        </div>
    </div>

@endsection