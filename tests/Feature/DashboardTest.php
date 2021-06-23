<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\Assert;

class DashboardTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_view_dashboard()
    {
        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Dashboard');
            });
    }
}
