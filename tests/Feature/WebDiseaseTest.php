<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Tests\TestCase;
use Inertia\Controller;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Inertia\Testing\Assert;
use Laravel\Sanctum\Sanctum;

class WebDiseaseTest extends TestCase
{
    use RefreshDatabase;
	
    public function test_can_view_tracking_page()
    {
		$user = Sanctum::actingAs(User::factory()->create());
		
        $this->actingAs($user)
            ->get('/diseases')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Diseases/Index');
            });
    }
}
