{!! Form::model($task, ['data-remote', 'class' => 'task-form', 'method' => 'PATCH', 'route' => ['task.update', $project->id, $task->id]]) !!}

<i class="fa fa-file"></i>{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Task Name', 'class' => 'task-form__input']) !!}

<i class="fa fa-file-text"></i>{!! Form::label('description', 'Description: ') !!}
{!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'task-form__input']) !!}

<i class="fa fa-users"></i>{!! Form::label('memberList', 'Assigned Members: ') !!}
{!! Form::select('memberList[]', $members, null, ['multiple' => true, 'class' => 'task-form__member-select', 'data-placeholder' => 'Assign the task?']) !!}

{!! Form::submit('Save Changes', ['class' => 'task-form__button']) !!}

{!! Form::close() !!}

