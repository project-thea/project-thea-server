<?php

namespace Tests\Feature\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\Assert;
use Laravel\Sanctum\Sanctum;

class TrackingControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_tracking_page()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/tracking')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Tracking/Index');
            });
    }
}
