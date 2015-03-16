{!! Form::model($subtask, ['class' => 'subtask-form hide', 'method' => 'PATCH', 'route' => ['subtask.update', $project->id, $task->id, $subtask->id]]) !!}

    {!! Form::text('name', null, ['placeholder' => 'Subtask Name', 'class' => 'subtask-form__input']) !!}

    <button class="subtask-form__button subtask-form__button--cancel">Cancel</button>
    {!! Form::submit('Save changes', ['class' => 'subtask-form__button']) !!}

{!! Form::close() !!}