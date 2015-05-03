@extends('layouts.app')

@section('content')

    <div class="header">
        <div class="container">
            <h3 class="header__title">Discussion</h3>

            @if(!$task->isCompleted())
            <div class="header__controls header__controls--discussion">

                <div class="header__icon-wrapper header__icon-wrapper--discussion">
                    {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['discussion.destroy', $project->id, $task->id, $discussion->id]]) !!}
                    <button class="header__icon"><i class="fa fa-trash-o"></i></button>
                    {!! Form::close() !!}

                    <button class="header__icon" data-toggle="modal" data-target=".edit-discussion-modal">
                        <i class="fa fa-pencil-square-o"></i>
                    </button>
                </div>
            </div>
            @endif

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

        @if($task->isCompleted())
            @include('layouts.partials.completed-overlay')
        @else
            <div class="discussion-wrapper">

                @include('discussions.partials.discussion')

                @include('comments.partials.comments')

                <div class="comments__form-wrapper hide">
                    {!! Form::open(['route' => ['comment.storeDiscussion', $project->id, $task->id, $discussion->id], 'class' => 'comments__form']) !!}
                    {!! Form::textarea('body', null, ['class' => 'comments__form__input', 'placeholder' => 'Add a comment']) !!}
                    <button class="comments__form__button">Submit</button>
                    {!! Form::close() !!}
                </div>

                <div class="comments__new-link"><i class="fa fa-pencil"></i>Enter a new comment</div>

            </div>
        @endif



    </div>

    @include('discussions.partials.edit-discussion-modal')


@endsection

@section('js')
    <script>
        discussionModule.init();
        commentModule.init();
    </script>
@endsection

