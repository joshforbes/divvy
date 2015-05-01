<div class="subtask">
    <div class="subtask__header">
        <div class="subtask__title">
            {{ $subtask->name }}
        </div>
        <div class="subtask__timestamp">
            {{ $subtask->created_at->diffForHumans() }}
        </div>
    </div>
</div>
