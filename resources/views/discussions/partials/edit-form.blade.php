<div class="task__discussion-edit-form hide">
    {!! Form::model($discussion, ['class' => 'discussion-form', 'method' => 'PATCH', 'route' => ['discussion.update', $project->id, $task->id, $discussion->id]]) !!}
        {!! Form::text('title', null, ['class' => 'discussion-form__input', 'placeholder' => 'Enter a Discussion Header']) !!}
        {!! Form::textarea('body', null, ['class' => 'discussion-form__input discussion-form__input--textarea', 'placeholder' => 'Enter text']) !!}
        {!! Form::submit('Add', ['class' => 'discussion-form__button']) !!}
        {!! Form::reset('Cancel', ['class' => 'discussion-form__button discussion-form__button--cancel']) !!}
    {!! Form::close() !!}
</div>
