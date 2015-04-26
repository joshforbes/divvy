
<div class="profile-form__avatar">
    {!! $user->profile->present()->avatarHtml() !!}
    <span class="profile-form__avatar-upload">Change</span>
    {!! Form::open(['method' => 'PATCH', 'id' => 'avatar-form', 'route' => ['profile.uploadAvatar', $user->username], 'files' => 'true']) !!}
    <div class="error-container alert alert-danger hide"></div>
    {!! Form::file('avatar-input', ['id' => 'avatar-input', 'class' =>'hide']) !!}
    {!! Form::submit('Upload Avatar', ['id' => 'avatar-submit', 'class' => 'hide']) !!}
    {!! Form::close() !!}
</div>

{!! Form::model($user->profile, ['method' => 'PATCH', 'class' => 'profile-form', 'route' => ['profile.update', $user->username]]) !!}

{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'task-form__input']) !!}

{!! Form::label('company', 'Company: ') !!}
{!! Form::text('company', null, ['placeholder' => 'Company', 'class' => 'task-form__input']) !!}

{!! Form::label('location', 'Location: ') !!}
{!! Form::text('location', null, ['Location' => 'Location', 'class' => 'task-form__input']) !!}


{!! Form::submit('Save Changes', ['class' => 'task-form__button']) !!}

{!! Form::close() !!}


