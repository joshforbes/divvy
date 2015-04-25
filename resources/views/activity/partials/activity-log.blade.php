<div class="activity-log">
    <div class="activity-log__header">
        <div class="activity-log__title">Latest Project Activity</div>
    </div>
    <div class="activity-log__body">
        @foreach($project->activity->take(3) as $activity)
            <div class="activity-log__activity">
                <div class="activity-log__actor-avatar">
                    {!! $activity->user->profile->present()->avatarHtml('30px') !!}
                </div>

                <div class="activity-log__info">
                    <a href="{{ route('activity.showProject', [$project->id, $activity->user->username]) }}">{{ $activity->present()->username }}</a>
                    @include("activity.types.{$activity->action}")
                    <div class="activity-log__timestamp">
                        {{ $activity->created_at->diffForHumans() }}
                    </div>
                </div>

            </div>
        @endforeach
    </div>
    <div class="activity-log__more-link">
        <a href="{{ route('activity.index', [$project->id]) }}">- See More -</a>
    </div>
</div>