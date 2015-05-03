<div class="subtask-wrapper">

    @include('subtasks.partials.subtask')

    @include('comments.partials.comments')

    <div class="comments__form-wrapper hide">
        {!! Form::open(['data-remote', 'route' => ['comment.storeSubtask', $project->id, $task->id, $subtask->id], 'class' => 'comments__form']) !!}
        {!! Form::textarea('body', null, ['class' => 'comments__form__input', 'placeholder' => 'Add a comment']) !!}
        <button class="comments__form__button">Submit</button>
        {!! Form::close() !!}
    </div>

    <div class="comments__new-link"><i class="fa fa-pencil"></i>Enter a new comment</div>

</div>