{!! Form::open(['data-remote', 'class' => 'modal-form', 'route' => ['discussion.store', $project->id, $task->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

{!! Form::label('title', 'Title: ') !!}
{!! Form::text('title', null, ['placeholder' => 'Discussion Topic Name', 'class' => 'modal-form__input']) !!}

{!! Form::label('body', 'Body: ') !!}
{!! Form::textarea('body', null, ['class' => 'modal-form__input modal-form__input--textarea', 'placeholder' => 'Discussion Text']) !!}

{!! Form::submit('Save Discussion', ['class' => 'modal-form__button']) !!}

{!! Form::close() !!}