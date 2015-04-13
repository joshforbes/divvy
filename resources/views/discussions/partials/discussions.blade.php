<div class="discussions-overview">
    <div class="discussions-overview__header">
        <div class="discussions-overview__title">
            Discussions
        </div>
        <button class="discussions-overview__add" data-toggle="modal" data-target=".add-discussion-modal">
            +
        </button>
    </div>

    <div class="discussions-overview__body">
        <table class="discussions-overview__table">
            <tbody>
            @foreach($task->discussions->take(3) as $discussion)
                <tr class="discussion-overview__row">
                    <td class="discussion-overview__info">
                        <div class="discussion-overview__title">
                            <a class="discussion-overview__title discussion-overview__title--normal" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{!! $discussion->present()->truncatedTitle(48) !!}</a>
                            <a class="discussion-overview__title discussion-overview__title--short" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{!! $discussion->present()->truncatedTitle(27) !!}</a>
                            <a class="discussion-overview__title discussion-overview__title--long" href="{{ route('discussion.show', [$project->id, $task->id, $discussion->id]) }}">{!! $discussion->present()->truncatedTitle(70) !!}</a>
                        </div>
                        <div class="discussion-overview__meta">
                            <a href="{{ route('profile.show', $discussion->author->username) }}">{{$discussion->author->username}}</a>
                            {{ $discussion->created_at->diffForHumans() }}
                        </div>

                    </td>
                    <td class="discussion-overview__controls-wrapper">
                        <div class="discussion-overview__controls">
                            @if($discussion->comments->count() > 0)
                                <div class="discussion-overview__controls__comments">
                                    <i class="fa fa-comments-o"></i>
                                    <span class="discussion-overview__controls__comments-count">{{ $discussion->comments->count() }}</span>
                                </div>
                            @endif
                            @if (Auth::user()->isDiscussionAuthor($discussion->id) || Auth::user()->isAdmin($project->id))
                                <button class="discussion-overview__controls__icon" data-toggle="modal" data-target={{"#" . $discussion->id . "-modal"}}>
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>

                                {!! Form::open(['method' => 'DELETE', 'route' => ['discussion.destroy', $project->id, $task->id, $discussion->id]]) !!}
                                <button class="discussion-overview__controls__icon"><i class="fa fa-trash-o"></i></button>
                                {!! Form::close() !!}
                            @endif

                        </div>
                    </td>
                </tr>
                @include('discussions.partials.edit-discussion-modal')
            @endforeach
            </tbody>
        </table>
    </div>
    @if ($task->discussions->count() > 3)
    <div class="discussions-overview__more-link">
        <a href="{{ route('discussion.show', [$project->id, $task->id]) }}">See More</a>
    </div>
    @endif
</div>