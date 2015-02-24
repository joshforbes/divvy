@extends('layouts.app')

@section('css')
    <link href="/css/vendor/select2.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">

        <div class="row" data-model="projectModule">
            {!! Form::open([
                'data-remote',
                'data-remote-on-success' => 'show',
                'route' => ['project.addUser', $project->id]]) !!}

            <div class="input-group">
                <select name="user" id="usersList" data-placeholder="Add a User to Project">
                    <option></option>
                    @foreach ( $users as $email => $username )
                        <option value="{{$email}}">{{$username}}</option>
                    @endforeach
                </select>
                {!! Form::submit('Add', ['class' => 'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}
        </div>
        <br/>

        <h1>{{ $project->name }}</h1>
        <br/>

        <h3>Admins:</h3>
        @foreach($project->adminUsers as $admin)
            <a href="{!! route('profile.show', $admin->username) !!}">
                {!! $admin->profile->present()->avatarHtml('75px') !!}
            </a>
        @endforeach

        <h3>Users:</h3>
        @foreach($project->users as $user)
            <a href="{!! route('profile.show', $user->username) !!}">
                {!! $user->profile->present()->avatarHtml('75px') !!}
            </a>
        @endforeach

    </div>

@endsection

@section('js')
    <script src="/js/vendor/select2.js"></script>
    <script>
        $("#usersList").select2({
            tags: true,
            placeholder: 'Pick a User or enter an email address'
        });
    </script>
@endsection