{!! Form::model($task, ['data-remote', 'class' => 'modal-form', 'method' => 'PATCH', 'route' => ['task.update', $project->id, $task->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

<i class="fa fa-file"></i>{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Task Name', 'class' => 'modal-form__input']) !!}

<i class="fa fa-file-text"></i>{!! Form::label('description', 'Description: ') !!}
{!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'modal-form__input']) !!}

<i class="fa fa-users"></i>{!! Form::label('memberList', 'Assigned Members: ') !!}
{!! Form::select('memberList[]', $members, null, ['multiple' => true, 'class' => 'modal-form__member-select', 'data-placeholder' => 'Assign the task?', 'auto-complete' => 'off']) !!}

{!! Form::submit('Save Changes', ['class' => 'modal-form__button']) !!}

{!! Form::close() !!}


