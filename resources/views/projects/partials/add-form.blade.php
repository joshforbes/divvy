{!! Form::open(['class' => 'modal-form', 'route' => ['project.store']]) !!}

<div class="error-container alert alert-danger hide"></div>

{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Project Name', 'class' => 'modal-form__input']) !!}

{!! Form::label('description', 'Description: ') !!}
{!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'modal-form__input']) !!}

{!! Form::submit('Save Project', ['class' => 'modal-form__button']) !!}

{!! Form::close() !!}