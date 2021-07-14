<?php

namespace Tests\Feature\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\Assert;
use Laravel\Sanctum\Sanctum;

class AnalysisControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_view_analysis_page()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/analysis')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Analysis/Index');
            });
    }
}
