@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if ($errors->any())
                <div class="flash flash-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                {!! Form::open(['route' => 'project.store']) !!}

                <!-- Title Form Input -->
                <div class="input-group">
                    {!! Form::text('name', null, ['placeholder' => 'Name the Project']) !!}
                    {!! Form::submit('Create Project', ['class' => 'btn btn-info']) !!}
                </div>

                {!! Form::close() !!}
        </div>
    </div>
@endsection
