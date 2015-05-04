@extends('layouts.app')

@section('content')
	<div class="container">

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


			{!! Form::open(['class' => 'login-form', 'url' => '/password/reset']) !!}
			<input type="hidden" name="token" value="{{ $token }}">

			<h3 class="password-form__header">Reset Password</h3>
			{!! Form::email('email', null, ['class' => 'password-form__input', 'value' => old('email'), 'placeholder' =>'EMAIL']) !!}

			{!! Form::password('password', ['class' => 'password-form__input', 'placeholder' => 'PASSWORD']) !!}

			{!! Form::password('password_confirmation', ['class' => 'password-form__input', 'placeholder' => 'CONFIRM PASSWORD']) !!}

			{!! Form::submit('Reset Password', ['class' => 'password-form__button']) !!}
			{!! Form::close() !!}

		</div>

	</div>

@endsection
