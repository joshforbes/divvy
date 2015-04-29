{!! Form::model($subtask, ['data-remote', 'class' => 'modal-form', 'method' => 'PATCH', 'route' => ['subtask.update', $project->id, $task->id, $subtask->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

<i class="fa fa-file"></i>{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Task Name', 'class' => 'modal-form__input']) !!}

{!! Form::submit('Save Changes', ['class' => 'modal-form__button']) !!}

{!! Form::close() !!}


