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

                {!! Form::open(['data-remote', 'method' => 'DELETE', 'route' => ['project.destroy', $project->id]])!!}
                <button class="project-overview__setting">
                    <i class="fa fa-trash"></i>Delete
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    @endif

    <p class="project-overview__description">
        <a href="{{ route('project.show', [$project->id]) }}">{{$project->description}}</a>
    </p>

    @if($project->users)
        <div class="project-overview__members">
            @foreach($project->users as $user)
                <span class="project-overview__member">
                    <a href="{{ route('activity.showProject', [$project->id, $user->username]) }}">{!! $user->profile->present()->avatarHtml('30px') !!}</a>
                    <span class="member-tooltip">{{ $user->username }}</span>
                </span>
            @endforeach
        </div>
    @endif

</div>
