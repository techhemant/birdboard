<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;


abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function login(User $user = null)
    {
        $this->actingAs($user ?: User::factory()->create());
    }

}
