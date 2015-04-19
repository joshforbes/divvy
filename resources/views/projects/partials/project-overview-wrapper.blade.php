<div class="project-wrapper" data-task="{{ $project->id }}">
    @include('projects.partials.project-overview')
</div>
@if(Auth::user()->isAdmin($project->id))
    @include('projects.partials.edit-project-modal')
@endif
