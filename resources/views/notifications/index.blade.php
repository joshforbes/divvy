@extends('layouts.app')

@section('content')

    @foreach($user->notifications as $notification)
        <p>@include("notifications.types.{$notification->action}")</p>
    @endforeach

    <br/>

@endsection