@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="create-project-wrapper">
            {!! Form::open(['class' => 'create-project', 'route' => 'project.store']) !!}
            <div class="create-project__header">
                Start a New Project
            </div>

                {!! Form::text('name', null, ['placeholder' => 'Name the Project', 'class' => 'create-project__input']) !!}
                {!! Form::text('description', null, ['placeholder' => 'Describe the Project', 'class' => 'create-project__input']) !!}

                {!! Form::submit('Create Project', ['class' => 'create-project__button']) !!}


            {!! Form::close() !!}
        </div>
    </div>
@endsection