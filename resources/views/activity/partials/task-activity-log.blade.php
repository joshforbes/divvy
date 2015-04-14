<div class="activity-log">
    <div class="activity-log__header">
        <div class="activity-log__title">Latest Task Activity</div>
    </div>
    <div class="activity-log__body">
        @foreach($task->activity->take(6) as $activity)
            <p>@include("activity.types.{$activity->action}")</p>
        @endforeach
    </div>
    <div class="activity-log__more-link">
        <a href="{{ route('activity.index', [$project->id, $task->id]) }}">- See More -</a>
    </div>
</div>