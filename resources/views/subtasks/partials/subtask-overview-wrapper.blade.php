@if($subtask->isCompleted())
    <tr class="subtasks__row subtasks__row--completed hide" data-subtask="{{ $subtask->id }}">
@else
    <tr class="subtasks__row" data-subtask="{{ $subtask->id }}">
@endif
    @include('subtasks.partials.subtask-overview')
</tr>
@include('subtasks.partials.edit-subtask-modal')