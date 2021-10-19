<?php

namespace Tests\Feature\Http\Controllers\Web;

use App\Models\DataType;
use App\Models\Question;
use App\Models\Questionnaire;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Inertia\Testing\Assert;

class QuestionsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_question_can_be_stored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $expected = [
            'label' => 'open-ended',
            'description' => 'Needs to ensure that respondents fully understand the questions.'
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires', $expected)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Index')
                    ->has('questionnaires')
                    ->has('trashedQuestionnaires')
                    ->has('filters', function (Assert $page) {
                        $page->has('search');
                    });
            });

        $this->assertDatabaseHas('questionnaires', $expected);
    }

    public function test_a_question_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $dataType = DataType::factory()->create();
        $question = Question::factory()->create();

        $questionsData = [
            'title' => 'How is this measured',
            'datatype_id' => $dataType->id,
            'attributes' => json_encode([
                'default' => 'yyyy-mm-dd',
                'format' => 'yyyy-mm-dd',
                'required' => 'true'
            ])
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->patch('/questionnaires/' . $question->questionnaire_id . '/questions/' . $question->id, $questionsData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Edit')
                    ->has('questionnaire')
                    ->has('questions')
                    ->has('trashedQuestions');
            });

        $questionsData['id'] = $question->id;

        $this->assertDatabaseHas('questions', $questionsData);
    }

    public function test_a_question_can_be_archived()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();
        $question = Question::factory()->create();

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->delete('/questionnaires/' . $questionnaire->id . '/questions/' . $question->id . '/trash')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Edit')
                    ->has('questionnaire')
                    ->has('questions')
                    ->has('trashedQuestions');
            });

        $response->assertSuccessful();
    }

    public function test_a_question_can_be_restored()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();
        $question = Question::factory()->create();

        $response = $this->actingAs($user)
            ->followingRedirects()
            ->put('/questionnaires/' . $questionnaire->id . '/questions/' . $question->id . '/restore')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Edit')
                    ->has('questionnaire')
                    ->has('questions')
                    ->has('trashedQuestions');
            });

        $response->assertSuccessful();
    }

    public function test_can_create_date_datatype_question()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $questionData = [
            'title' => 'Hey dude',
            'questionnaire_id' => $questionnaire->id,
            'datatype_id' => 1,
            'attributes' => json_encode([
                'default' => 'yyyy-mm-dd',
                'format' => 'yyyy-mm-dd',
                'required' => 'true'
            ])
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires/' . $questionnaire->id . '/questions', $questionData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Edit')
                    ->has('questionnaire')
                    ->has('questions')
                    ->has('trashedQuestions');
            });

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function test_can_create_time_datatype_question()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $questionData = [
            'title' => 'Whats up time',
            'questionnaire_id' => $questionnaire->id,
            'datatype_id' => 2,
            'attributes' => json_encode([
                'format' => '24hrs',
                'default' => '23:59',
                'required' => 'true'
            ])
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires/' . $questionnaire->id . '/questions', $questionData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Edit')
                    ->has('questionnaire')
                    ->has('questions')
                    ->has('trashedQuestions');
            });

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function test_can_create_datetime_datatype_question()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $questionData = [
            'title' => 'Whats up datetime',
            'questionnaire_id' => $questionnaire->id,
            'datatype_id' => 3,
            'attributes' => json_encode([
                'format' => 'yyyy-mm-dd H:i:s',
                'default' => 'yyyy-mm-dd H:i:s',
                'required' => 'true'
            ])
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires/' . $questionnaire->id . '/questions', $questionData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Edit')
                    ->has('questionnaire')
                    ->has('questions')
                    ->has('trashedQuestions');
            });

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function test_can_create_checkbox_datatype_question()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $questionData = [
            'title' => 'Whats up checkbox',
            'questionnaire_id' => $questionnaire->id,
            'datatype_id' => 4,
            'attributes' => json_encode([
                'options' => "['year', 'month', 'day', 'hour']",
                'default' => 'month',
                'required' => 'true'
            ])
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires/' . $questionnaire->id . '/questions', $questionData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Edit')
                    ->has('questionnaire')
                    ->has('questions')
                    ->has('trashedQuestions');
            });

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function test_can_create_radiobutton_datatype_question()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $questionData = [
            'title' => 'Whats up radiobutton',
            'questionnaire_id' => $questionnaire->id,
            'datatype_id' => 5,
            'attributes' => json_encode([
                'options' => "['Yes', 'No']",
                'default' => 'Yes',
                'required' => 'true'
            ])
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires/' . $questionnaire->id . '/questions', $questionData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Edit')
                    ->has('questionnaire')
                    ->has('questions')
                    ->has('trashedQuestions');
            });

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function test_can_create_text_datatype_question()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaire = Questionnaire::factory()->create();

        $questionData = [
            'title' => 'Whats up text',
            'questionnaire_id' => $questionnaire->id,
            'datatype_id' => 6,
            'attributes' => json_encode([
                'format' => "['Singleline', 'Multiline']",
                'default' => 'Singleline',
                'required' => 'true'
            ])
        ];

        $this->actingAs($user)
            ->followingRedirects()
            ->post('/questionnaires/' . $questionnaire->id . '/questions', $questionData)
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Edit')
                    ->has('questionnaire')
                    ->has('questions')
                    ->has('trashedQuestions');
            });

        $this->assertDatabaseHas('questions', $questionData);
    }

    public function test_can_edit_question_from_a_questionnaire()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaireOne = Questionnaire::factory()->create();

        $question = Question::factory()->create([
            'questionnaire_id' => $questionnaireOne->id
        ]);

        $this->actingAs($user)
            ->followingRedirects()
            ->get('/questionnaires/' . $questionnaireOne->id . '/questions/' . $question->id . '/edit')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questions/Edit');
            });
    }

    public function test_can_not_edit_question_from_different_questionnaire()
    {
        $this->withoutExceptionHandling();

        $user = Sanctum::actingAs(User::factory()->create([
            'role_id' => '2'
        ]));

        $questionnaireOne = Questionnaire::factory()->create();
        $questionnaireTwo = Questionnaire::factory()->create();

        $question = Question::factory()->create([
            'questionnaire_id' => $questionnaireOne->id
        ]);

        $this->actingAs($user)
            ->followingRedirects()
            ->get('/questionnaires/' . $questionnaireTwo->id . '/questions/' . $question->id . '/edit')
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Questionnaires/Index');
            });
    }
}