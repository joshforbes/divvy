@extends('layouts.app')

@section('content')
    <div class="activities">
        <div class="activities-wrapper">
            <div class="activity-log">
                <span class="activity-log__header">Latest Project Activity:</span>
                @foreach($activity as $activity)
                    <p>@include("activity.types.{$activity->action}")</p>
                @endforeach
            </div>
        </div>
    </div>

@endsection