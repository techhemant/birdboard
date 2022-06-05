<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_create_a_task()
    {
        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test Task'])
            ->assertRedirect('/login');
    }

    /** @test */
    public function only_project_owner_can_create_a_task()
    {
        $this->login();

        $project = Project::factory()->create();

        $this->post($project->path() . '/tasks', ['body' => 'Test Task'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Test Task']);
    }

    /** @test */
    public function a_project_has_task(): void
    {
        $this->login();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $this->post($project->path() . '/tasks', ['body' => 'Test Task']);

        $this->get($project->path())
            ->assertSee('Test Task');
    }

    /** @test */
    public function a_task_requires_body()
    {
        $this->login();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $attributes = Task::factory()->raw(['body' => '']);

        $this->post($project->path() . '/tasks', $attributes)
            ->assertSessionHasErrors('body');
    }

    public function test_a_task_can_be_update()
    {
        $this->withoutExceptionHandling();

        $this->login();
        $project = auth()->user()->projects()->create(Project::factory()->raw());
        $task = $project->addTask('test task');

        $this->patch($project->path() . '/tasks/' . $task->id,
            [
                "body" => "changed",
                "completed" => true,
            ]
        );

        $this->assertDatabaseHas('tasks',
            [
                "body" => "changed",
                "completed" => true
            ]
        );
    }
}
