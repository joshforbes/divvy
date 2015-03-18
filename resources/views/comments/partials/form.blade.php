{!! Form::open(['route' => ['comment.storeDiscussion', $discussion->id], 'class' => 'comment-form']) !!}
    {!! Form::textarea('body', null, ['class' => 'comment-form__input', 'placeholder' => 'Add a comment']) !!}
    {!! Form::submit('Add', ['class' => 'comment-form__button']) !!}
{!! Form::close() !!}