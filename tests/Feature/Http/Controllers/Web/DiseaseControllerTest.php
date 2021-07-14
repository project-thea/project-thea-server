<?php

namespace Tests\Feature\Http\Controllers\Web;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use App\Models\Disease;
use App\Models\User;
use Inertia\Testing\Assert;

class DiseaseControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_diseases_index_page_is_rendered()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());

        $this->actingAs($user)
            ->get('/diseases')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Diseases/Index')
                    ->has('diseases')
                    ->has('trashedDiseases')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });
    }

    public function test_a_disease_name_is_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $this->actingAs($user);

        $diseasesData = [
            'name' => '',
            'description' => 'Very deadly disease',
        ];

        $response = $this->post('/diseases', $diseasesData);

        $response->assertSessionHasErrors('name');
    }

    public function test_a_disease_description_is_required()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $this->actingAs($user);

        $diseasesData = [
            'name' => 'COVID-19',
            'description' => '',
        ];

        $response = $this->post('/diseases', $diseasesData);

        $response->assertSessionHasErrors('description');
    }

    public function test_a_disease_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());

        $expected = [
            'name' => 'COVID-19',
            'description' => 'This is a deadly disease'
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/diseases', $expected)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Diseases/Index')
                    ->has('diseases')
                    ->has('trashedDiseases')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $disease = Disease::where('name', $expected['name'])->get();

        $this->assertIsObject($disease);
    }

    public function test_a_disease_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $disease = Disease::factory()->create();

        $disease->name = 'COVID-21';
        $disease->description = 'This consists of many variants';
        $disease->update();

        $diseaseData = [
            'name' => 'COVID-19',
            'description' => 'This is a very deadly disease',
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->patch('/diseases/' . $disease->id, $diseaseData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Diseases/Index')
                    ->has('diseases')
                    ->has('trashedDiseases')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $updatedDisease = Disease::find($disease->id);
        $this->assertIsObject($updatedDisease);

        $this->assertEquals($updatedDisease->name, $diseaseData['name']);
        $this->assertEquals($updatedDisease->description, $diseaseData['description']);
    }

    public function test_a_disease_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $disease = Disease::factory()->create();

        $this->actingAs($user)
            ->followingRedirects()
            ->delete('/diseases/' . $disease->id . '/trash')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Diseases/Index')
                    ->has('diseases')
                    ->has('trashedDiseases')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $this->assertCount(0, Disease::all());
    }

    public function test_a_disease_can_be_restored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create());
        $disease = Disease::factory()->create();

        $this->actingAs($user)
            ->followingRedirects()
            ->put('/diseases/' . $disease->id . '/restore')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Diseases/Index')
                    ->has('diseases')
                    ->has('trashedDiseases')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $this->assertCount(1, Disease::all());
    }
}
