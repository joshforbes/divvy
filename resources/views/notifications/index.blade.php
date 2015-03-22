@extends('layouts.app')

@section('content')

    @foreach($user->notifications as $notification)
        {{ $notification->action }}
    @endforeach

    <br/>

@endsection