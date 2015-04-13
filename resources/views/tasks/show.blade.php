@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{ $task->name }}</h3>

            <div class="header__controls">
                <button class="header__button" data-toggle="modal" data-target=".add-subtask-modal">
                    + Subtask
                </button>
                <button class="header__button" data-toggle="modal" data-target=".add-discussion-modal">
                    + Discussion
                </button>
            </div>
            <ol class="breadcrumb">
                <li><a href="{{ route('project.show', $project->id) }}">{{ $project->name }}</a></li>
            </ol>
        </div>
    </div>

    @include('discussions.partials.add-discussion-modal')
    @include('subtasks.partials.add-subtask-modal')


    <div class="container">

        <div class="information-wrapper">

            <div class="discussions-wrapper">
                @include('discussions.partials.discussions')
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
                <button class="subtasks__add" data-toggle="modal" data-target=".add-subtask-modal">
                    +
                </button>
            </div>
            <div class="subtasks__body">
                <table class="subtasks__table">
                    <tbody>
                    @foreach($subtasks as $subtask)
                        <tr class="subtasks__row">
                            <td class="subtasks__name"><a href="{{ route('subtask.show', [$project->id, $task->id, $subtask->id]) }}">{{$subtask->name}}</a></td>
                            <td class="subtasks__controls-wrapper">
                                <div class="subtasks__controls">
                                    @if($subtask->comments->count() > 0)
                                        <div class="subtasks__controls__comments">
                                            <i class="fa fa-comments-o"></i>
                                            <span class="subtasks__controls__comments-count">{{ $subtask->comments->count() }}</span>
                                        </div>
                                    @endif
                                    <button class="subtasks__controls__icon" data-toggle="modal" data-target={{"#" . $subtask->id . "-modal"}}>
                                        <i class="fa fa-pencil-square-o"></i>
                                    </button>

                                    {!! Form::open(['method' => 'DELETE', 'route' => ['subtask.destroy', $project->id, $task->id, $subtask->id]]) !!}
                                        <button class="subtasks__controls__icon"><i class="fa fa-trash-o"></i></button>
                                    {!! Form::close() !!}


                                    @if(!$subtask->isCompleted())
                                        {!! Form::open(['route' => ['subtask.complete', $project->id, $task->id, $subtask->id]])!!}
                                            <button class="subtasks__controls__button">
                                                <i class="fa fa-file-o"></i>Complete
                                            </button>
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open(['route' => ['subtask.incomplete', $project->id, $task->id, $subtask->id]])!!}
                                            <button class="subtasks__controls__button">
                                            <i class="fa fa-file-o"></i>Reopen
                                        </button>
                                        {!! Form::close() !!}
                                    @endif

                                </div>
                            </td>
                        </tr>
                        @include('subtasks.partials.edit-subtask-modal')
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection