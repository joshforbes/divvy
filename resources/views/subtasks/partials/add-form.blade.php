{!! Form::open(['class' => 'subtask-form', 'route' => ['subtask.store', $project->id, $task->id]]) !!}

<i class="fa fa-file"></i>{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Subtask Name', 'class' => 'subtask-form__input']) !!}

{!! Form::submit('Save Subtask', ['class' => 'subtask-form__button']) !!}

{!! Form::close() !!}