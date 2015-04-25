@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{$project->name}}</h3>
        </div>
    </div>

    <div class="activity-wrapper">
        <div class="activity-log activity-log--full">
            <div class="activity-log__header">
                <div class="activity-log__title">{{ $user->username }} Project Activity</div>
            </div>
            <div class="activity-log__body activity-log__body--full">
                @foreach($activities as $activity)
                    <div class="activity-log__activity activity-log__activity--full">
                        <div class="activity-log__info">
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