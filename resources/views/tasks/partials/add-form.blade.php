{!! Form::open(['data-remote', 'class' => 'modal-form', 'route' => ['task.store', $project->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Task Name', 'class' => 'modal-form__input']) !!}

{!! Form::label('description', 'Description: ') !!}
{!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'modal-form__input']) !!}

{!! Form::label('memberList', 'Assigned Members: ') !!}
{!! Form::select('memberList[]', $members, null, ['multiple' => true, 'class' => 'modal-form__member-select', 'data-placeholder' => 'Assign the task?']) !!}

{!! Form::submit('Save Task', ['class' => 'modal-form__button']) !!}

{!! Form::close() !!}