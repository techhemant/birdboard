@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-5">
        <a href="/projects/create">New project</a>
    </div>
    <ul>
        @forelse ($projects as $project)
            <li><a href={{ $project->path() }}>{{ $project->title }}</a></li>
        @empty
            <li>No projects</li>
        @endforelse
    </ul>
@endsection
