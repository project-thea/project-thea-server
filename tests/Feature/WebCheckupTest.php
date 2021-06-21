<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\Assert;
use Laravel\Sanctum\Sanctum;

class WebCheckupTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A feature test for a user to view the tests page.
     *
     * @return void
     */
    public function test_can_view_tests_index_page()
    {
        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/tests')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Tests/Index');
            });
    }
}
