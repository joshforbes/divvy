{!! Form::model($subtask, ['data-remote', 'class' => 'subtask-form', 'method' => 'PATCH', 'route' => ['subtask.update', $project->id, $task->id, $subtask->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

<i class="fa fa-file"></i>{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Task Name', 'class' => 'task-form__input']) !!}

{!! Form::submit('Save Changes', ['class' => 'task-form__button']) !!}

{!! Form::close() !!}


