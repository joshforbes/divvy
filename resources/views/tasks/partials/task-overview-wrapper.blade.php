<div class="task-wrapper" data-task="{{ $task->id }}">
    @include('tasks.partials.task-overview')
</div>
@if(Auth::user()->isAdmin($project->id))
    @include('tasks.partials.edit-task-modal')
@endif
