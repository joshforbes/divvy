@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {!! Form::open(['route' => 'project.store']) !!}

            <!-- Title Form Input -->
            <div class="input-group">
                {!! Form::text('name', null, ['placeholder' => 'Name the Project']) !!}
                {!! Form::submit('Create Project', ['class' => 'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}
        </div>

        @if($projects)
            <div class="projects-container col-md-4">
                <ul class="list-group">
                    @foreach($projects as $project)
                        <li class="list-group-item">
                            <a href="{{ route('project.show', $project->id) }}">{{$project->name}}</a>
                            @if(Auth::user()->isAdmin($project->id))
                                <span class="badge">Admin</span>
                            @endif
                        </li>
                    @endforeach
                </ul>

            </div>
        @endif

    </div>
@endsection
