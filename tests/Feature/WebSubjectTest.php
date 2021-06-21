<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Inertia\Testing\Assert;
use Laravel\Sanctum\Sanctum;

class WebSubjectTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A feature test for a user to view the subject index page.
     *
     * @return void
     */
    public function test_can_view_subject_page()
    {
        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/subjects')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Subjects/Index');
            });
    }
}
