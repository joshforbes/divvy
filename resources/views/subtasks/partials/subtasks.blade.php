<div class="subtasks">
    <div class="subtasks__header">
        <div class="subtasks__title">
            Subtasks
        </div>
        <button class="subtasks__add" data-toggle="modal" data-target=".add-subtask-modal">
            +
        </button>
    </div>
    <div class="subtasks__body">
        <table class="subtasks__table">
            <tbody>
                @foreach($subtasks as $subtask)
                    @include('subtasks.partials.subtask-overview-wrapper')
                @endforeach
            </tbody>
        </table>
    </div>

    @if(in_array('1', $subtasks->lists('is_complete')))
        <div class="subtasks__more-link">
            <a href="#">- See Completed Subtasks -</a>
        </div>
    @endif
</div>