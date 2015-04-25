<div class="activity-log">
    <div class="activity-log__header">
        <div class="activity-log__title">Latest Task Activity</div>
    </div>
    <div class="activity-log__body">
        @foreach($task->activity->take(3) as $activity)
            <div class="activity-log__activity">
                <div class="activity-log__actor-avatar">
                    {!! $activity->user->profile->present()->avatarHtml('30px') !!}
                </div>

                <div class="activity-log__info">
                    <a href="{{ route('activity.showTask', [$project->id, $task->id, $activity->user->username]) }}">{{ $activity->present()->username }}</a>
                    @include("activity.types.{$activity->action}")
                    <div class="activity-log__timestamp">
                        {{ $activity->created_at->diffForHumans() }}
                    </div>
                </div>

            </div>
        @endforeach
    </div>
    <div class="activity-log__more-link">
        <a href="{{ route('activity.taskIndex', [$project->id, $task->id]) }}">- See More -</a>
    </div>
</div>