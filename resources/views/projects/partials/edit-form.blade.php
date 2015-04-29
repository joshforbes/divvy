{!! Form::model($project, ['data-remote', 'class' => 'modal-form', 'method' => 'PATCH', 'route' => ['project.update', $project->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

<i class="fa fa-file"></i>{!! Form::label('name', 'Name: ') !!}
{!! Form::text('name', null, ['placeholder' => 'Project Name', 'class' => 'modal-form__input']) !!}

<i class="fa fa-file-text"></i>{!! Form::label('description', 'Description: ') !!}
{!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'modal-form__input']) !!}

{!! Form::submit('Save Changes', ['class' => 'modal-form__button']) !!}

{!! Form::close() !!}


