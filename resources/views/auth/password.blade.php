@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('status'))
            <div class="password-success alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="password-error-container alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="password-wrapper">

            {!! Form::open(['class' => 'login-form', 'url' => '/password/email']) !!}

            <h3 class="password-form__header">Reset Password</h3>
            {!! Form::email('email', null, ['class' => 'password-form__input', 'value' => old('email'), 'placeholder' =>'EMAIL']) !!}

            {!! Form::submit('Send Password Reset Link', ['class' => 'password-form__button']) !!}

            {!! Form::close() !!}

        </div>

    </div>

@endsection
