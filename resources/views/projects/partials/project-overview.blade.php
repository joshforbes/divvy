<a href="{{ route('project.show', $project->id) }}">
    <div class="project-overview">
        <div class="project-overview__header">
            {{$project->name}}
        </div>
        <div class="project-overview__summary">
            <div class="project-overview__members">{{count($project->users)}} Members</div>
            <div class="project-overview__tasks">{{count($project->tasks)}} Tasks</div>
        </div>
        @if(Auth::user()->isAdmin($project->id))
            <div class="project-overview__footer">Admin</div>
        @endif
    </div>
</a>