<?php

namespace Tests\Feature\Http\Controllers\Web;

use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\Test;
use App\Models\User;
use App\Models\Disease;
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

        $user = Sanctum::actingAs(User::factory()->create());

        $subject = Subject::factory()->create();
        $disease = Disease::factory()->create();

        $expected = [
            'subject_id' => $subject->id,
            'disease_id' => $disease->id,
            'status' => 'Negative',
            'test_date' => date('Y-m-d')
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/tests', $expected)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Tests/Index');
            });

        $test = Test::where('subject_id', $expected['subject_id'])
            ->where('disease_id', $expected['disease_id'])
            ->where('test_date', $expected['test_date'])->get();

        $this->assertIsObject($test);
    }


    public function test_a_test_can_be_updated()
    {
        $user = Sanctum::actingAs(User::factory()->create());

        $test = Test::factory()->create();

        $test->status = 'Unknown';
        $test->update();

        $testData = [
            'status' => 'Negative',
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

        $updatedTest = Test::find($test->id);
        $this->assertIsObject($updatedTest);

        $this->assertEquals($updatedTest->status, $testData['status']);
    }

    public function test_a_test_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $test = Test::factory()->create();

        $this->actingAs($user)
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

        $this->assertCount(0, Test::all());
    }

    public function test_a_test_can_be_restored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $test = Test::factory()->create();

        $this->actingAs($user)
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

        $this->assertCount(1, Test::all());
    }
}
