<div class="discussions">
    <div class="discussions__header">
        <div class="discussions__title">
            Discussions
        </div>
        <button class="discussions__add" data-toggle="modal" data-target=".add-discussion-modal">
            +
        </button>
    </div>

    <div class="discussions__body">
        <table class="discussions__table">
            <tbody>
            @foreach($task->discussions as $discussion)
                <tr class="discussion__row">
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

                                {!! Form::open(['method' => 'DELETE', 'route' => ['discussion.destroy', $project->id, $task->id, $discussion->id]]) !!}
                                <button class="discussion__controls__icon"><i class="fa fa-trash-o"></i></button>
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
    <div class="discussions__more-link">
        <a href="{{ route('discussion.show', [$project->id, $task->id]) }}">See More</a>
    </div>
    @endif
</div>