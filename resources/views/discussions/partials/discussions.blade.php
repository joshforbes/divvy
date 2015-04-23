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
                @include('discussions.partials.discussion-overview')

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