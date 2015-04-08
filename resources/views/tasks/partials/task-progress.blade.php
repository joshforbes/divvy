<div class="task-progress">
    <div class="task-progress__header">
        <div class="task-progress__title">Task Completion</div>
    </div>
    <div class="task-progress__body">
        <div class="task-progress__percentage">{!! $task->present()->completionPercentage() !!}%</div>
    </div>
</div>