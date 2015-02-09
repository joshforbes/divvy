@extends('app')

@section('content')


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ $user->username }} Profile</div>
                <div class="panel-body">


                    Name: {{ $user->profile->name }}<br/>
                    Company: {{ $user->profile->company }}<br/>
                    Location: {{ $user->profile->location }}<br/>
                    Bio: <p>{{ $user->profile->bio }}</p>
                </div>
            </div>
            {!! link_to_route('profile.edit', 'Edit Profile', $user->username, ['class' => 'btn btn-primary']) !!}
        </div>
    </div>








@endsection