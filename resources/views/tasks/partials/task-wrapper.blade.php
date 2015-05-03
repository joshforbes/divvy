<div class="information-wrapper">

    <div class="activity-log-wrapper">
        @include('activity.partials.task-activity-log')
    </div>

    <div class="members-wrapper">
        @include('users.partials.task-members')
    </div>

    <div class="task-progress-wrapper">
        @include('tasks.partials.task-progress')
    </div>

</div>

@include('subtasks.partials.subtasks')

@include('discussions.partials.discussions')
