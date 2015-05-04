{!! Form::open(['data-remote', 'class' => 'modal-form', 'route' => ['subtask.store', $project->id, $task->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Subtask Name', 'class' => 'modal-form__input']) !!}

{!! Form::submit('Save Subtask', ['class' => 'modal-form__button']) !!}

{!! Form::close() !!}