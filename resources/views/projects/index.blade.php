@extends('layouts.app')

@section('content')
    <div class="flex items-center mb-5">
        <a href="/projects/create">New project</a>
    </div>

    <div class="flex">
        @forelse ($projects as $project)
            <div class="bg-white mr-4 rounded shadow w-1/3 p-5 h-80">
                <h3 class="font-normal text-xl py-4">{{ $project->title }}</h3>

                <div class="text-gray-500">{{ Str::limit($project->description,200) }}</div>
            </div>
        @empty
            <li>No projects</li>
        @endforelse
    </div>

@endsection
