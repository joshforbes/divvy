@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{$project->name}}</h3>

            <div class="crumbs">
                <span class="crumb">
                    <a href="{{ route('project.show', $project->id) }}">Project</a>
                </span>
                <span class="crumb crumb--active">
                    <span class="crumb--active__text">User Activity</span>
                </span>
            </div>

        </div>
    </div>

    <div class="container">

        <div class="profile-activity-wrapper">
            <div class="profile">
                <div class="profile__avatar">
                    {!! $user->profile->present()->avatarHtml() !!}
                </div>
                <div class="profile__username">
                    {{ $user->username }}
                </div>
                <div class="profile__info">
                    @if(isset($user->profile->name))
                        <div class="profile__info-item">
                            {{ $user->profile->name }}
                        </div>
                    @endif
                    @if(isset($user->profile->company))
                        <div class="profile__info-item">
                            {{ $user->profile->company }}
                        </div>
                    @endif
                    @if(isset($user->profile->location))
                        <div class="profile__info-item">
                            {{ $user->profile->location }}
                        </div>
                    @endif
                </div>

            </div>
        </div>


        <div class="activity-wrapper--profile">
            <div class="activity-log activity-log--full">
                <div class="activity-log__header">
                    <div class="activity-log__title">Project Activity</div>
                </div>
                <div class="activity-log__body activity-log__body--full">
                    @if($activities->count() == 0)
                        <p class="activity-log__none">{{ $user->username }} has no activity in this Project</p>
                    @endif

                    @foreach($activities as $activity)
                        <div class="activity-log__activity activity-log__activity--full">
                            <div class="activity-log__info activity-log__info--condensed">
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

    </div>

@endsection