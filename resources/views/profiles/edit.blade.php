@extends('app')

@section('content')

    <h1>Edit Profile</h1>

    {!! Form::model($user->profile, ['method' => 'PATCH', 'route' => ['profile.update', $user->username]]) !!}

    <!-- Name Form Input -->
    <div class="form-group">
        {!! Form::label('name', 'Name: ') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Company Form Input -->
    <div class="form-group">
        {!! Form::label('company', 'Company: ') !!}
        {!! Form::text('company', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Location Form Input -->
    <div class="form-group">
        {!! Form::label('location', 'Location: ') !!}
        {!! Form::text('location', null, ['class' => 'form-control']) !!}
    </div>

    <!-- Bio Form Input -->
    <div class="form-group">
        {!! Form::label('bio', 'Bio: ') !!}
        {!! Form::textarea('bio', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
    </div>


    {!! Form::close() !!}



@endsection