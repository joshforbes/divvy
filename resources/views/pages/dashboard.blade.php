@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">Dashboard</h3>

            <div class="header__controls">
                <button class="header__button" data-toggle="modal" data-target=".add-project-modal">
                    + Project
                </button>
            </div>
        </div>

    </div>

    <div class="container">

        @if ($errors->any())
            <div class="project-error-container alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="projects">

            @if($projects)
                @foreach($projects as $project)
                    @include('projects.partials.project-overview-wrapper')
                @endforeach
            @endif

        </section>

    </div>

    @include('projects.partials.add-project-modal')


@endsection

@section('js')
    <script>
        dashboardModule.init();
    </script>
@endsection
