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
                    {!! Form::open(['method' => 'DELETE', 'route' => ['subtask.destroy', $project->id, $task->id, $subtask->id]]) !!}
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
            <div class="subtask">
                <div class="subtask__header">
                    <div class="subtask__title">
                        {{ $subtask->name }}
                    </div>
                    <div class="subtask__timestamp">
                        {{ $subtask->created_at->diffForHumans() }}
                    </div>
                </div>

                <div class="comments">
                    @foreach($comments as $comment)
                        <div class="comment">
                            <div class="comment__avatar">
                                {!! $comment->author->profile->present()->avatarHtml('60px') !!}
                            </div>

                            <div class="comment__main-content">
                                <div class="comment__meta">
                                    <a class="comment__author" href="{{ route('profile.show', $comment->author->username) }}">{{$comment->author->username}}</a>
                                    <span class="comment__timestamp">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="comment__body">
                                    {{ $comment->body }}
                                </div>

                                @if(Auth::user()->isCommentAuthor($comment->id))

                                    <button class="comment__settings-button"><i class="fa fa-gear"></i></button>

                                    <div class="comment__settings-overlay hide">
                                        <button class="comment__settings-close"><i class="fa fa-times"></i></button>
                                        <div class="comment__settings">
                                            <button class="comment__setting" data-toggle="modal" data-target={{"#" . $comment->id . "-modal"}}>
                                                <i class="fa fa-edit"></i>Edit
                                            </button>

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['comment.destroy', $project->id, $task->id, $comment->id]]) !!}
                                            <button class="comment__setting">
                                                <i class="fa fa-trash"></i>Delete
                                            </button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>

                                @endif

                            </div>
                            @include('comments.partials.edit-comment-modal')
                        </div>
                    @endforeach
                    <div class="comments__form-wrapper hide">
                        {!! Form::open(['route' => ['comment.storeSubtask', $project->id, $task->id, $subtask->id], 'class' => 'comments__form']) !!}
                        {!! Form::textarea('body', null, ['class' => 'comments__form__input', 'placeholder' => 'Add a comment']) !!}
                        <button class="comments__form__button">Submit</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="comments__new-link"><i class="fa fa-pencil"></i>Enter a new comment</div>



            </div>
        </div>


    </div>

    @include('subtasks.partials.edit-subtask-modal')


@endsection

@section('js')
    <script>
        subtaskModule.init();
    </script>
@endsection

