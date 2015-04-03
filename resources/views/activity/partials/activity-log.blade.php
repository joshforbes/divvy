<div class="activity-log">
    <div class="activity-log__header">
        <div class="activity-log__title">Latest Project Activity</div>
    </div>
    <div class="activity-log__body">
        @foreach($project->activity->take(7) as $activity)
            <p>@include("activity.types.{$activity->action}")</p>
        @endforeach
    </div>
</div>