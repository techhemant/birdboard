<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function guests_cannot_create_projects()
    {
        $attributes = Project::factory()->raw();

        $this->post('/projects', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_a_single_project()
    {
        $project = Project::factory()->create();

        $this->get($project->path())->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_create_project_via_form()
    {
        $this->get('/projects/create')->assertRedirect('login');
    }

    /** @test */
    public function an_authenticated_user_can_create_projects()
    {
        $this->login();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->text(10),
            'notes' => $this->faker->text(10),
        ];

        $this->get('/projects/create')->assertStatus(200);

        $response = $this->post('/projects', $attributes);

        $project = Project::where($attributes)->first();
        $response->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', $attributes);

        $this->get($project->path())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /** @test */
    public function an_authenticated_user_can_update_a_project()
    {
        $this->login();

        $project = auth()->user()->projects()->create(Project::factory()->raw());

        $this->patch($project->path(), [
            'notes' => 'Changed'
        ])
            ->assertRedirect($project->path());

        $this->assertDatabaseHas('projects', ['notes' => 'Changed']);
    }

    /** @test */
    public function an_authenticated_user_can_view_a_project()
    {
        $this->login();

        $project = Project::factory()->create(['owner_id' => auth()->id()]);

        $this->get($project->path())->assertsee($project->title);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_project_of_others()
    {
        $this->login();

        $project = Project::factory()->create();

        $this->get($project->path())->assertStatus(403);
    }

    /** @test */
    public function an_authenticated_user_cannot_update_project_of_others()
    {
        $this->login();

        $project = Project::factory()->create();

        $this->patch($project->path(), ['notes' => 'Changed'])->assertStatus(403);
    }


    /** @test */
    public function a_project_requires_a_title()
    {
        $this->login();

        $attributes = Project::factory()->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_project_requires_a_description()
    {
        $this->login();

        $attributes = Project::factory()->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
