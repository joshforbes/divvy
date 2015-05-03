@extends('layouts.app')

@section('content')
    <section class="splash-signup-section">
        <div class="container">
            <div class="signup-wrapper">

                <div class="text-wrapper">
                    <h1>Lorem ipsum dolor sit amet</h1>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A ab adipisci alias ex
                        facilis in incidunt rem saepe tempore temporibus.</p>
                </div>

                <div class="registration-wrapper">
                    {!! Form::open(['url' => '/auth/register']) !!}

                    <!-- Username Form Input -->
                    <div class="form-group">
                        {!! Form::text('username', null, ['placeholder' => 'Username', 'class' => 'form-control', 'required']) !!}
                    </div>

                    <!-- Email Form Input -->
                    <div class="form-group">
                        {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'required']) !!}
                    </div>

                    <!-- Password Form Input -->
                    <div class="form-group">
                        {!! Form::password('password', ['placeholder' => 'Create a password', 'class' => 'form-control', 'required']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Sign up for Divvy', ['class' => 'btn btn-success form-control']) !!}
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>
        </div>
    </section>

@endsection
