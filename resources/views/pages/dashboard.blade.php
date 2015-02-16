@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
                {!! Form::open(['route' => 'project.store']) !!}

                <!-- Title Form Input -->
                <div class="input-group">
                    {!! Form::text('title', null, ['placeholder' => 'Name the Project']) !!}
                    {!! Form::submit('Create Project', ['class' => 'btn btn-info']) !!}
                </div>

                {!! Form::close() !!}
        </div>
    </div>
@endsection
