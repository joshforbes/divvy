<div class="overview-overlay-wrapper">
    <div class="overview-overlay overview-overlay--completed"></div>
    @if(Auth::user()->isAdmin($project->id))
        {!! Form::open(['data-remote', 'route' => ['task.incomplete', $project->id, $task->id]])!!}
        <button class="overview-overlay--completed__button">
            <i class="fa fa-file-o"></i>Reopen
        </button>
        {!! Form::close() !!}
    @endif
</div>