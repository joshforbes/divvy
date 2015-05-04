@extends('layouts.app')

@section('content')
	<div class="container">

		@if ($errors->any())
			<div class="register-error-container alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

			<div class="register-wrapper">


				{!! Form::open(['class' => 'register-form', 'url' => '/auth/register']) !!}

				<h3 class="register-form__header">Register</h3>

				{!! Form::text('username', null, ['class' => 'login-form__input', 'value' => old('username'), 'placeholder' => 'USERNAME']) !!}

				{!! Form::email('email', null, ['class' => 'login-form__input', 'value' => old('email'), 'placeholder' => 'EMAIL']) !!}

				{!! Form::password('password', ['class' => 'login-form__input', 'placeholder' => 'PASSWORD']) !!}

				{!! Form::submit('Register', ['class' => 'register-form__button']) !!}
				{!! Form::close() !!}

			</div>

	</div>

@endsection

