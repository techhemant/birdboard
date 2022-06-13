<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class ProjectTasksController extends Controller
{
    public function store(Project $project)
    {
        $this->authorize('update', $project);

//        if (auth()->user()->isNot($project->owner)) {
//            return abort(403);
//        }

        request()->validate([
            'body' => 'required'
        ]);

        $project->addTask(request('body'));

        return redirect($project->path());
    }

    public function update(Project $project, Task $task)
    {
        $this->authorize('update', $task->project);

        $task->update(
            [
                "body" => request('body'),
                "completed" => request()->has('completed')
            ]
        );

        return redirect($project->path());
    }
}
