@extends('app')

@section('content')

    @if ($errors->has())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
    <div class="row">

        <div class="avatar-wrap col-md-2 col-md-offset-2">
            {!! $user->profile->present()->avatarHtml() !!}
            <span class="avatar-upload-button">Change</span>
            {!! Form::open(['method' => 'PATCH', 'id' => 'avatar-form', 'route' => ['profile.uploadAvatar', $user->username], 'files' => 'true']) !!}
                {!! Form::file('avatar-input', ['id' => 'avatar-input', 'class' =>'hide']) !!}
                {!! Form::submit('Upload Avatar', ['id' => 'avatar-submit', 'class' => 'hide']) !!}
            {!! Form::close() !!}
        </div>

        <div class="col-md-6">
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
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>



@endsection