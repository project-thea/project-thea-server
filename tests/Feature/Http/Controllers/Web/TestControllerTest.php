<?php

namespace Tests\Feature\Http\Controllers\Web;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\Test;
use App\Models\User;
use App\Models\Disease;
use App\Models\Status;
use Inertia\Testing\Assert;

class TestControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_tests_index_page_is_rendered()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/tests')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Tests/Index');
            });
    }

    public function test_a_test_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $subject = Subject::factory()->create();
        $disease = Disease::factory()->create();
        $status = Status::factory()->create();

        $expected = [
            'subject_id' => $subject->id,
            'disease_id' => $disease->id,
            'status_id' => $status->id,
            'test_date' => date('Y-m-d')
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/tests', $expected)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Tests/Index');
            });

        $this->assertDatabaseHas('tests', $expected);
    }

    public function test_a_test_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $test = Test::factory()->create();
        $status = Status::factory()->create();

        $testData = [
            'status_id' => $status->id,
            'subject_id' => $test->subject_id,
            'disease_id' => $test->disease_id,
            'test_date' => $test->test_date,
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->patch('/tests/' . $test->id, $testData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Tests/Index')
                    ->has('tests')
                    ->has('trashedTests')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $testData['id'] = $test->id;
        $this->assertDatabaseHas('tests', $testData);
    }

    public function test_failed_validation_fields()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $subject = Subject::factory()->create();
        $disease = Disease::factory()->create();

        $expected = [
            'subject_id' => $subject->id,
            'disease_id' => $disease->id,
            'status_id' => 1000,
            'test_date' => date('Y-m-d')
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/tests', $expected)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Tests/Create');
            });

        $this->assertDatabaseMissing('tests', $expected);
    }

    public function test_a_test_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $test = Test::factory()->create();

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->delete('/tests/' . $test->id . '/trash')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Tests/Index')
                    ->has('tests')
                    ->has('trashedTests')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $response->assertSuccessful();
    }

    public function test_a_test_can_be_restored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $test = Test::factory()->create();

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->put('/tests/' . $test->id . '/restore')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Tests/Index')
                    ->has('tests')
                    ->has('trashedTests')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $response->assertSuccessful();
    }
}
