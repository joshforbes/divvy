<a href="{{ route('project.show', $project->id) }}">
    <div class="project-overview">
        <div class="project-overview__header">
            <div class="project-overview__title">{{$project->name}}</div>
        </div>
        <p class="project-overview__description">{{$project->description}}</p>


        @if($project->users)
            <div class="project-overview__members">
                @foreach($project->users as $user)
                    <span class="project-overview__member">{!! $user->profile->present()->avatarHtml('40px') !!}</span>
                @endforeach
            </div>
        @endif

    </div>
</a>