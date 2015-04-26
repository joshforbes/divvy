{!! Form::model($discussion, ['data-remote', 'class' => 'discussion-form', 'method' => 'PATCH', 'route' => ['discussion.update', $project->id, $task->id, $discussion->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

<i class="fa fa-file"></i>{!! Form::label('title', 'Title: ') !!}
{!! Form::text('title', null, ['placeholder' => 'Discussion Topic Name', 'class' => 'discussion-form__input']) !!}

<i class="fa fa-file-text"></i>{!! Form::label('body', 'Body: ') !!}
{!! Form::textarea('body', null, ['class' => 'discussion-form__input discussion-form__input--textarea', 'placeholder' => 'Discussion Text']) !!}

{!! Form::submit('Save Changes', ['class' => 'discussion-form__button']) !!}

{!! Form::close() !!}


