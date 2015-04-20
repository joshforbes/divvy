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
    <script src="/js/vendor/select2.js"></script>
    <script>
        dashboardModule.init();
    </script>
@endsection
