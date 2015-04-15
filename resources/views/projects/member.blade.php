@extends('layouts.app')

@section('css')
    <link href="/css/vendor/select2.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">{{ $project->name }}</h3>
        </div>
    </div>

    <div class="container">

        <div class="tasks">
            @if($currentUserTasks->count() > 0)
                @foreach($currentUserTasks as $task)
                    @include('tasks.partials.task-overview-wrapper')
                @endforeach
            @else
                <div class="no-assigned-tasks-message">You have not been assigned any tasks within this project</div>
            @endif
        </div>


    </div>

@endsection

@section('js')
    <script src="/js/vendor/select2.js"></script>
    <script>
        projectModule.init();
    </script>
@endsection