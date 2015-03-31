@extends('layouts.app')

@section('content')
    <div class="header">
        <div class="container">
            <h3 class="header__title">Dashboard</h3>

            <div class="header__controls">
                <a href="{{ route('project.create') }}">
                    <button class="header__button">+ Project</button>
                </a>
            </div>
        </div>

    </div>

    <div class="container">
        <section class="projects">

            @if($projects)
                @foreach($projects as $project)
                    <article class="project-overview-wrapper">
                        @include('projects.partials.project-overview')
                    </article>
                @endforeach
            @endif

        </section>


    </div>

@endsection
