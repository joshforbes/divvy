@extends('app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $user->username }} Profile</div>
                    <div class="panel-body">


                        Name: {{ $user->profile->name }}<br/>
                        Company: {{ $user->profile->name }}<br/>
                        Location: {{ $user->profile->name }}<br/>
                        Bio: <p>{{ $user->profile->bio }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection