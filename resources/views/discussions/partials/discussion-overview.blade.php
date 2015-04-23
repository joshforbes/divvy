<tr class="discussion__row" data-discussion="{{ $discussion->id }}">
    <td class="discussion__info">
        <div class="discussion__title">
            <a class="discussion__title discussion__title--normal" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{!! $discussion->present()->truncatedTitle(90) !!}</a>
            <a class="discussion__title discussion__title--short" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{!! $discussion->present()->truncatedTitle(27) !!}</a>
            <a class="discussion__title discussion__title--medium" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{!! $discussion->present()->truncatedTitle(70) !!}</a>
        </div>
        <div class="discussion__meta">
            <a href="{{ route('profile.show', $discussion->author->username) }}">{{$discussion->author->username}}</a>
            {{ $discussion->created_at->diffForHumans() }}
        </div>

    </td>
    <td class="discussion__controls-wrapper">
        <div class="discussion__controls">
            @if($discussion->comments->count() > 0)
                <div class="discussion__controls__comments">
                    <i class="fa fa-comments-o"></i>
                    <span class="discussion__controls__comments-count">{{ $discussion->comments->count() }}</span>
                </div>
            @endif
            @if (Auth::user()->isDiscussionAuthor($discussion->id) || Auth::user()->isAdmin($project->id))
                <button class="discussion__controls__icon" data-toggle="modal" data-target={{"#" . $discussion->id . "-modal"}}>
                    <i class="fa fa-pencil-square-o"></i>
                </button>

                {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['discussion.destroy', $project->id, $task->id, $discussion->id]]) !!}
                <button class="discussion__controls__icon"><i class="fa fa-trash-o"></i></button>
                {!! Form::close() !!}
            @endif

        </div>
    </td>
</tr>