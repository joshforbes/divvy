{!! Form::open(['data-remote', 'class' => 'subtask-form', 'route' => ['subtask.store', $project->id, $task->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

<i class="fa fa-file"></i>{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Subtask Name', 'class' => 'subtask-form__input']) !!}

{!! Form::submit('Save Subtask', ['class' => 'subtask-form__button']) !!}

{!! Form::close() !!}