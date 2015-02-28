@extends('layouts.app')

@section('css')
    <link href="/css/vendor/select2.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="row col-md-4 col-md-offset-4">

            <h2>Add Task:</h2>

            {!! Form::open(['route' => ['task.store', $project->id]]) !!}

            <!-- Task Name Form Input -->
            <div class="form-group">
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Task Name']) !!}
            </div>

            <!-- Description Form Input -->
            <div class="form-group">
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description']) !!}
            </div>

            <div class="form-group select-members">
                {!! Form::select('members[]', $members, null, ['class' => 'js-member-list', 'multiple']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('js')
    <script src="/js/vendor/select2.js"></script>
    <script>
        $(".js-member-list").select2({
            placeholder: 'Assign the Task?'
        });
    </script>
@endsection