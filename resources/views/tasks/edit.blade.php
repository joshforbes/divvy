@extends('layouts.app')

@section('css')
    <link href="/css/vendor/select2.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="task-form-wrapper">
            {!! Form::model($task, ['class' => 'task-form', 'method' => 'PATCH', 'route' => ['task.update', $project->id, $task->id]]) !!}

            <div class="task-form__header">
                Modify Task
            </div>

            {!! Form::text('name', null, ['placeholder' => 'Task Name', 'class' => 'task-form__input']) !!}
            {!! Form::text('description', null, ['placeholder' => 'Description', 'class' => 'task-form__input']) !!}
            {!! Form::select('memberList[]', $members, null, ['class' => 'task-form__member-select', 'multiple']) !!}

            {!! Form::submit('Modify Task', ['class' => 'task-form__button']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/vendor/select2.js"></script>
    <script>
        $(".task-form__member-select").select2({
            placeholder: 'Assign the Task?'
        });
    </script>
@endsection