@extends('layouts.app')

@section('content')
    <header class="flex items-end justify-between mb-5">
        <div class="text-gray-500">My Projects</div>
        <a href="/projects/create" class="button">Add Project</a>
    </header>

    <main class="lg:flex lg:flex-wrap -mx-3">
        @forelse ($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                <div class="bg-white rounded-lg shadow p-5" style="height: 200px">
                    <h3 class="font-normal text-xl py-4 -mx-5 border-l-4 border-blue-500 pl-4 mb-4">
                        <a href="{{ $project->path() }}">{{ $project->title }}</a>
                    </h3>

                    <div class="text-gray-500">{{ Str::limit($project->description,200) }}</div>
                </div>
            </div>
        @empty
            <li>No projects</li>
        @endforelse
    </main>
@endsection
