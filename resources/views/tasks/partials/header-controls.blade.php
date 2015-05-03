<div class="header__controls">
    @if(!$task->isCompleted())
        <button class="header__button" data-toggle="modal" data-target=".add-subtask-modal">
            + Subtask
        </button>
        <button class="header__button" data-toggle="modal" data-target=".add-discussion-modal">
            + Discussion
        </button>
    @endif
</div>