@extends('app')

@section('content')


    <div class="row">
        <div class="avatar-wrap col-md-2 col-md-offset-2">
            {!! $user->profile->present()->avatarHtml() !!}
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->username }} Profile</div>
                <div class="panel-body">
                    Name: {{ $user->profile->name }}<br/>
                    Company: {{ $user->profile->company }}<br/>
                    Location: {{ $user->profile->location }}<br/>
                    Bio: <p>{{ $user->profile->bio }}</p>
                </div>
            </div>
            @if ($user->is(Auth::user()))
                {!! link_to_route('profile.edit', 'Edit Profile', $user->username, ['class' => 'btn btn-primary']) !!}
            @endif
        </div>
    </div>



@endsection