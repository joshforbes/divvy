@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{$task->name}}</h3>

            <div class="crumbs">
                <span class="crumb">
                    <a href="{{ route('project.show', $task->project->id) }}">Project</a>
                </span>
                <span class="crumb">
                    <a href="{{ route('task.show', [$task->project->id, $task->id]) }}">Task</a>
                </span>
                <span class="crumb crumb--active">
                    <span class="crumb--active__text">Activity</span>
                </span>
            </div>
        </div>
    </div>

    <div class="activity-wrapper">
        <div class="activity-log activity-log--full">
            <div class="activity-log__header">
                <div class="activity-log__title">Latest Task Activity</div>
            </div>
            <div class="activity-log__body activity-log__body--full">
                @foreach($activities as $activity)
                    <div class="activity-log__activity activity-log__activity--full">
                        <div class="activity-log__actor-avatar">
                            {!! $activity->user->profile->present()->avatarHtml('40px') !!}
                        </div>

                        <div class="activity-log__info">
                            <a href="{{ route('activity.showTask', [$task->project->id, $task->id, $activity->user->username]) }}">{{ $activity->present()->username }}</a>
                            @include("activity.types.{$activity->action}")
                            <div class="activity-log__timestamp">
                                {{ $activity->created_at->diffForHumans() }}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
            <div class="activity-log__pagination">
                {!! $activities->render() !!}
            </div>
        </div>
    </div>

@endsection