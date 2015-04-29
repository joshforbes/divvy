{!! Form::model($comment, ['data-remote', 'class' => 'modal-form', 'method' => 'PATCH', 'route' => ['comment.update', $project->id, $task->id, $comment->id]]) !!}

<div class="error-container alert alert-danger hide"></div>

<i class="fa fa-file"></i>{!! Form::label('comment', 'Comment: ') !!}
{!! Form::textarea('body', null, ['placeholder' => 'Enter comment', 'class' => 'modal-form__input']) !!}

{!! Form::submit('Save Changes', ['class' => 'modal-form__button']) !!}

{!! Form::close() !!}


