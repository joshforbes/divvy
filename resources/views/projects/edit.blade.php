@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="create-project-wrapper">
            {!! Form::model($project, ['class' => 'create-project', 'method' => 'PATCH', 'route' => ['project.update', $project->id]]) !!}
            <div class="create-project__header">
                Modify Project
            </div>

            {!! Form::text('name', null, ['placeholder' => 'Name the Project', 'class' => 'create-project__input']) !!}
            {!! Form::text('description', null, ['placeholder' => 'Describe the Project', 'class' => 'create-project__input']) !!}

            {!! Form::submit('Save', ['class' => 'create-project__button']) !!}


            {!! Form::close() !!}
        </div>
    </div>
@endsection