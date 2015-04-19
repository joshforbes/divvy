{!! Form::open(['class' => 'task-form', 'route' => ['project.store']]) !!}

<div class="error-container alert alert-danger hide"></div>

<i class="fa fa-file"></i>{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Task Name', 'class' => 'task-form__input']) !!}

<i class="fa fa-file-text"></i>{!! Form::label('description', 'Description: ') !!}
{!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'task-form__input']) !!}

{!! Form::submit('Save Project', ['class' => 'task-form__button']) !!}

{!! Form::close() !!}