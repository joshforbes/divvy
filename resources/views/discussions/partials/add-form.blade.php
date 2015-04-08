{!! Form::open(['class' => 'discussion-form', 'route' => ['discussion.store', $project->id, $task->id]]) !!}

<i class="fa fa-file"></i>{!! Form::label('title', 'Title: ') !!}
{!! Form::text('title', null, ['placeholder' => 'Discussion Topic Name', 'class' => 'discussion-form__input']) !!}

<i class="fa fa-file-text"></i>{!! Form::label('body', 'Body: ') !!}
{!! Form::textarea('body', null, ['class' => 'discussion-form__input discussion-form__input--textarea', 'placeholder' => 'Discussion Text']) !!}

{!! Form::submit('Save Discussion', ['class' => 'discussion-form__button']) !!}

{!! Form::close() !!}