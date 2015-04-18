<div class="project-overview">
    <div class="project-overview__header">
        <div class="project-overview__title">
            <a href="{{ route('project.show', [$project->id]) }}">{{$project->name}}</a>
        </div>
    </div>

    @if(Auth::user()->isAdmin($project->id))
        <button class="project-overview__settings-button"><i class="fa fa-gear"></i></button>

        <div class="project-overview__settings-overlay hide">
            <button class="project-overview__settings-close"><i class="fa fa-times"></i></button>
            <div class="project-overview__settings">

                <button class="project-overview__setting" data-toggle="modal" data-target={{"#" . $project->id . "-modal"}}>
                    <i class="fa fa-edit"></i>Edit
                </button>

                {!! Form::open(['method' => 'DELETE', 'route' => ['project.destroy', $project->id]])!!}
                <button class="project-overview__setting">
                    <i class="fa fa-trash"></i>Delete
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    @endif

    <p class="project-overview__description">{{$project->description}}</p>

    @if($project->users)
        <div class="project-overview__members">
            @foreach($project->users as $user)
                <span class="project-overview__member">{!! $user->profile->present()->avatarHtml('40px') !!}</span>
            @endforeach
        </div>
    @endif

</div>
