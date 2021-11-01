<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Questionnaire;
use App\Models\User;
use Tests\TestCase;
use Inertia\Testing\Assert;
use Laravel\Sanctum\Sanctum;

class ResponseControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_response_from_a_questionnaire_preview_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $questionnaireData = [
            'questionnaire_id' => $questionnaire->id,
            'data' => '{
                "1": {
                    "value": "One",
                    "dataType": "checkbox"
                },

                "4": {
                    "value": "2021-10-27",
                    "dataType": "date"
                },

                "5": {
                    "value": "Any text",
                    "dataType": "text"
                }
            }'
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires/' . $questionnaire->id, $questionnaireData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Index')
                    ->has('questionnaires')
                    ->has('trashedQuestionnaires')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $this->assertDatabaseHas('responses', $questionnaireData);
    }
}
