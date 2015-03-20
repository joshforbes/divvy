<div class="comment-edit-form-wrapper hide">
    {!! Form::model($comment, ['class' => 'comment-edit-form', 'method' => 'PATCH', 'route' => ['comment.update', $project->id, $task->id, $comment->id]]) !!}
        {!! Form::textarea('body', null, ['class' => 'comment-edit-form__input', 'placeholder' => 'Enter text']) !!}
        {!! Form::submit('Save Changes', ['class' => 'comment-edit-form__button']) !!}
        {!! Form::reset('Cancel', ['class' => 'comment-edit-form__button comment-form__button--cancel']) !!}
    {!! Form::close() !!}
</div>