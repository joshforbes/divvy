@extends('layouts.app')

@section('content')
    <div class="container">

        <section class="projects">

            <article class="project-overview-wrapper">
                <a href="{{ route('project.create') }}">
                    <div class="project-overview">
                        <div class="project-overview__new-project">
                            + <br/>
                            Create New Project
                        </div>
                    </div>
                </a>
            </article>

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
