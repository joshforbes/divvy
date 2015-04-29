@extends('layouts.app')

@section('content')
	<div class="container">

		@if ($errors->any())
			<div class="login-error-container alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif

		<div class="login-wrapper">


			{!! Form::open(['class' => 'login-form', 'url' => '/auth/login']) !!}

				<h3 class="login-form__header">Please Sign In</h3>
				{!! Form::email('email', null, ['class' => 'login-form__input', 'value' => old('email'), 'placeholder' => 'EMAIL']) !!}

				{!! Form::password('password', ['class' => 'login-form__input', 'placeholder' => 'PASSWORD']) !!}

				<div class="login-form__link-lockup">
					<span class="login-form__remember"><input type="checkbox" name="remember"> Remember Me</span>
					<a class="login-form__forgot"  href="/password/email">Forgot?</a>
				</div>

				{!! Form::submit('Login', ['class' => 'login-form__button']) !!}
			{!! Form::close() !!}

		</div>

	</div>

@endsection
