{!! Form::open(['data-remote', 'class' => 'modal-form', 'route' => ['discussion.store', $project->id, $task->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

<i class="fa fa-file"></i>{!! Form::label('title', 'Title: ') !!}
{!! Form::text('title', null, ['placeholder' => 'Discussion Topic Name', 'class' => 'modal-form__input']) !!}

<i class="fa fa-file-text"></i>{!! Form::label('body', 'Body: ') !!}
{!! Form::textarea('body', null, ['class' => 'modal-form__input modal-form__input--textarea', 'placeholder' => 'Discussion Text']) !!}

{!! Form::submit('Save Discussion', ['class' => 'modal-form__button']) !!}

{!! Form::close() !!}