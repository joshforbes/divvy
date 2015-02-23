@extends('layouts.app')

@section('content')
    <div class="container">

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
@endsection