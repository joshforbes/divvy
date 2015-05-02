@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">Profile</h3>

            @if ($user->is(Auth::user()))
                <div class="header__controls">
                    <button class="header__button" data-toggle="modal" data-target=".edit-profile-modal">
                        Edit
                    </button>
                </div>
            @endif
        </div>
    </div>

    @include('profiles.partials.edit-profile-modal')

    @if ($errors->any())
        <div class="profile-error-container alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    @endif

    <div class="profile-wrapper">
        <div class="profile">
            <div class="profile__avatar">
                {!! $user->profile->present()->avatarHtml() !!}
            </div>
            <div class="profile__username">
                {{ $user->username }}
            </div>
            <div class="profile__info">
                @if(isset($user->profile->name))
                    <div class="profile__info-item">
                        {{ $user->profile->name }}
                    </div>
                @endif
                @if(isset($user->profile->company))
                    <div class="profile__info-item">
                        {{ $user->profile->company }}
                    </div>
                @endif
                @if(isset($user->profile->location))
                    <div class="profile__info-item">
                        {{ $user->profile->location }}
                    </div>
                @endif
            </div>

        </div>
    </div>

@endsection