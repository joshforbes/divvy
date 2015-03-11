<div class="task__discussion-form hide">
    {!! Form::open(['class' => 'discussion-form', 'route' => ['discussion.store', $project->id, $task->id]]) !!}
        {!! Form::text('title', null, ['class' => 'discussion-form__input', 'placeholder' => 'Enter a Discussion Header']) !!}
        {!! Form::textarea('body', null, ['class' => 'discussion-form__input discussion-form__input--textarea', 'placeholder' => 'Enter text']) !!}
    {!! Form::submit('Add', ['class' => 'discussion-form__button']) !!}
    {!! Form::reset('Cancel', ['class' => 'discussion-form__button discussion-form__button--cancel']) !!}
    {!! Form::close() !!}
</div>
