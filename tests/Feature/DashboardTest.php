<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\Assert;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    // public function test_can_view_dashboard()
    // {
    //     $this->actingAs($this->user)
    //         ->get('/dashboard')
    //         ->assertStatus(200)
    //         ->assertInertia(function (Assert $page) {
    //             $page->component('Dashboard');
    //         });
    // }
}
