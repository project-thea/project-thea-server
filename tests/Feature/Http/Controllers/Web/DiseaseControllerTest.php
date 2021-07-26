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

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

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

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

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

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $expected = [
            'name' => 'Ebola',
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

        $this->assertDatabaseHas('diseases', $expected);
    }

    public function test_a_disease_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $disease = Disease::factory()->create();

        $diseaseData = [
            'name' => 'Covid',
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

        $diseaseData['id'] = $disease->id;    
        $this->assertDatabaseHas('diseases', $diseaseData);
    }

    public function test_a_disease_can_be_deleted()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $disease = Disease::factory()->create();

        $response = $this->actingAs($user)
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

        $response->assertSuccessful();
    }

    public function test_a_disease_can_be_restored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $disease = Disease::factory()->create();

        $response = $this->actingAs($user)
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

        $response->assertSuccessful();
    }
}
