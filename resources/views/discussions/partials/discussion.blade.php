<div class="discussion">
    <div class="discussion__header">
        <div class="discussion__avatar">
            {!! $discussion->author->profile->present()->avatarHtml('60px') !!}
        </div>
        <div class="discussion__main-content">
            <div class="discussion__title">
                {{ $discussion->title }}
            </div>
            <div class="discussion__meta">
                <span class="discussion__author">
                    <a href="{{ route('activity.showTask', [$project->id, $task->id, $discussion->author->username]) }}">{{$discussion->author->username}}</a>
                </span>
                <span class="discussion__timestamp">
                    {{ $discussion->created_at->diffForHumans() }}
                </span>
            </div>
            <div class="discussion__body">
                {{ $discussion->body }}
            </div>
        </div>

    </div>
</div>