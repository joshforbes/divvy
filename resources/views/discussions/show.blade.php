@extends('layouts.app')

@section('content')

    <div class="header">
        <div class="container">
            <h3 class="header__title">Discussion</h3>

            <div class="header__controls header__controls--discussion">

                <div class="header__icon-wrapper header__icon-wrapper--discussion">
                    {!! Form::open(['method' => 'DELETE', 'route' => ['discussion.destroy', $project->id, $task->id, $discussion->id]]) !!}
                    <button class="header__icon"><i class="fa fa-trash-o"></i></button>
                    {!! Form::close() !!}

                    <button class="header__icon" data-toggle="modal" data-target=".edit-discussion-modal">
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
                    <span class="crumb--active__text">Discussion</span>
                </span>
            </div>

        </div>
    </div>

    <div class="container">

        <div class="discussion-wrapper">
            <div class="discussion">
                <div class="discussion__header">
                    <div class="discussion__avatar">
                        {!! $discussion->author->profile->present()->avatarHtml('60px') !!}
                    </div>
                    <div class="discussion__main-content">
                        <div class="discussion__title">
                            {{ $discussion->title }}
                        </div>
                        <div class="discussion__meta">
                            <span class="discussion__author">
                                <a href="{{ route('activity.showTask', [$project->id, $task->id, $discussion->author->username]) }}">{{$discussion->author->username}}</a>
                            </span>
                            <span class="discussion__timestamp">
                                {{ $discussion->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <div class="discussion__body">
                            {{ $discussion->body }}
                        </div>
                    </div>

                </div>

                <div class="comments">
                    @foreach($comments as $comment)
                        <div class="comment" data-comment="{{ $comment->id }}">
                            <div class="comment__avatar">
                                {!! $comment->author->profile->present()->avatarHtml('60px') !!}
                            </div>

                            <div class="comment__main-content">
                                <div class="comment__meta">
                                    <a class="comment__author" href="{{ route('activity.showTask', [$project->id, $task->id, $comment->author->username]) }}">{{$comment->author->username}}</a>
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
                        {!! Form::open(['route' => ['comment.storeDiscussion', $project->id, $task->id, $discussion->id], 'class' => 'comments__form']) !!}
                        {!! Form::textarea('body', null, ['class' => 'comments__form__input', 'placeholder' => 'Add a comment']) !!}
                        <button class="comments__form__button">Submit</button>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="comments__new-link"><i class="fa fa-pencil"></i>Enter a new comment</div>



            </div>
        </div>


    </div>

    @include('discussions.partials.edit-discussion-modal')


@endsection

@section('js')
    <script>
        discussionModule.init();
        commentModule.init();
    </script>
@endsection

