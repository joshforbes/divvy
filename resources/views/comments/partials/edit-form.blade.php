<div class="comment-edit-form-wrapper">
    {!! Form::model($comment, ['class' => 'comment-form', 'method' => 'PATCH', 'route' => ['comment.update', $project->id, $task->id, $comment->id]]) !!}
        {!! Form::textarea('body', null, ['class' => 'comment-form__input', 'placeholder' => 'Enter text']) !!}
        {!! Form::submit('Add', ['class' => 'discussion-form__button']) !!}
        {!! Form::reset('Cancel', ['class' => 'discussion-form__button discussion-form__button--cancel']) !!}
    {!! Form::close() !!}
</div>