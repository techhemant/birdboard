@extends('layouts.app')

@section('content')
    <div class="lg:flex justify-between pb-6">
        <p class="text-gray-600 text-sm font-normal">
            <a href="/projects"> My Projects</a> / {{ $project->title }}
        </p>
        <div>
            <a href="/projects/create" class="button">Add Project</a>
        </div>
    </div>

    <h1 class="text-xl text-gray-600 pb-3">Tasks</h1>
    <div class="flex -mx-3">
        <div class="w-3/4">
            <div class="lg:w-full px-3 pb-6">
                <div class="card-white w-full mb-3">Lorem ipsum.</div>
                <div class="card-white w-full mb-3">Lorem ipsum.</div>
                <div class="card-white w-full mb-3">Lorem ipsum.</div>
                <div class="card-white w-full mb-3">Lorem ipsum.</div>
            </div>

            <div class="px-3">
                <div class="lg:w-full">
                    <h1 class="text-xl text-gray-600 mb-3">General Notes</h1>
                    <textarea class="card-white w-full" style="height: 200px"> Lorem ipsum.</textarea>
                </div>
            </div>
        </div>

        <div class="w-1/4">
            <div class="lg:w-full px-3 pb-6">
                <div class="bg-white rounded-lg shadow p-5" style="height: 200px">
                    <h3 class="font-normal text-xl py-4 -mx-5 border-l-4 border-blue-500 pl-4 mb-4">
                        <a href="{{ $project->path() }}">{{ $project->title }}</a>
                    </h3>

                    <div class="text-gray-500">{{ Str::limit($project->description,200) }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
