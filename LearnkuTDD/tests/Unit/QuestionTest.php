<?php

namespace Tests\Unit;

use App\Models\Answer;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_question_has_many_answers()
    {
        $question = Question::factory()->create();

        Answer::factory()->create([
            'question_id' => $question->id,
        ]);

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\HasMany', $question->answers());
    }

    /**
     * @test
     */
    public function questions_with_published_at_date_are_published()
    {
        $publishedQuestion1 = Question::factory()->create([
            'published_at' => Carbon::parse('-1 week'),
        ]);
        $publishedQuestion2 = Question::factory()->create([
            'published_at' => Carbon::parse('-1 week'),
        ]);

        $unpublishedQuestion = Question::factory()->create();
        $publishedQuestions = Question::published()->get();

        $this->assertTrue($publishedQuestions->contains($publishedQuestion1));
        $this->assertTrue($publishedQuestions->contains($publishedQuestion2));
        $this->assertFalse($publishedQuestions->contains($unpublishedQuestion));
    }
}
