<tr class="discussions__row" data-discussion="{{ $discussion->id }}">
    <td class="discussions__info">
        <div class="discussions__overview-title">
            <a class="discussions__overview-title discussions__overview-title--normal" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{!! $discussion->present()->truncatedTitle(90) !!}</a>
            <a class="discussions__overview-title discussions__overview-title--short" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{!! $discussion->present()->truncatedTitle(27) !!}</a>
            <a class="discussions__overview-title discussions__overview-title--medium" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{!! $discussion->present()->truncatedTitle(70) !!}</a>
        </div>
        <div class="discussions__meta">
            <a href="{{ route('activity.showTask', [$project->id, $task->id, $discussion->author->username]) }}">{{$discussion->author->username}}</a>
            {{ $discussion->created_at->diffForHumans() }}
        </div>

    </td>
    <td class="discussions__controls-wrapper">
        <div class="discussions__controls">
            @if($discussion->comments->count() > 0)
                @include('discussions.partials.comments-overview')
            @endif
            @if (Auth::user()->isDiscussionAuthor($discussion->id) || Auth::user()->isAdmin($project->id))
                <button class="discussions__controls__icon" data-toggle="modal" data-target={{"#" . $discussion->id . "-modal"}}>
                    <i class="fa fa-pencil-square-o"></i>
                </button>

                {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['discussion.destroy', $project->id, $task->id, $discussion->id]]) !!}
                <button class="discussions__controls__icon"><i class="fa fa-trash-o"></i></button>
                {!! Form::close() !!}
            @endif

        </div>
    </td>
</tr>