<?php

namespace App\Http\Controllers;

use App\Models\Question;

class QuestionsController extends Controller
{
    public function index()
    {

    }

    public function show($questionId)
    {
        $question = Question::published()->findOrFail($questionId);

        return view('questions.show', compact('question'));
    }

    public function store()
    {

    }
}
