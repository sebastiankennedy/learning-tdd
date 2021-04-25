<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Question;
use Tests\TestCase;

class ViewQuestionsTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function user_can_view_questions()
    {
        // 抛出异常
        $this->withoutExceptionHandling();

        // 假设路由存在、访问路由
        $test = $this->get('/questions');

        // 正常返回 200
        $test->assertStatus(200);
    }

    /** @test */
    public function user_can_view_a_single_question()
    {
        // 创建一个问题
        $question = Question::factory()->create();

        // 访问连接
        $test = $this->get('/questions/'.$question->id);

        // 那么应该看到问题的内容
        $test->assertStatus(200)
            ->assertSee($question->title)
            ->assertSee($question->content);
    }
}
